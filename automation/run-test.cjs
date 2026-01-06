const fs = require('fs');
const { chromium } = require('playwright');

const COOKIE_FILE_PATH = 'zeusxcookies.json';

async function run() {
  console.log('Starting automation...');

  // 1. Check if cookie file exists and is not empty
  if (!fs.existsSync(COOKIE_FILE_PATH)) {
    console.error('Error: Cookie file not found:', COOKIE_FILE_PATH);
    process.exit(1);
  }

  const fileContent = fs.readFileSync(COOKIE_FILE_PATH, 'utf-8');
  if (!fileContent.trim()) {
      console.error('Error: Cookie file is empty.');
      process.exit(1);
  }

  // 2. Parse JSON Cookies
  let cookies = [];
  try {
      cookies = JSON.parse(fileContent);
      console.log(`Parsed ${cookies.length} cookies.`);
      
      // Basic validation/cleanup if needed (Playwright is usually good with standard JSON exports)
      // Some exports might use different keys, but standard array of objects is expected.
      // We might need to ensure 'domain', 'path', etc. are present.
      
      // Optional: Filter for zeusx.com domain if the file contains others
      // cookies = cookies.filter(c => c.domain.includes('zeusx.com'));

  } catch (error) {
      console.error('Error parsing JSON:', error);
      process.exit(1);
  }

  // 3. Launch Browser
  const browser = await chromium.launch({ headless: false }); // Headless: false to see it action
  const context = await browser.newContext();

  if (cookies.length > 0) {
      // Playwright expects 'expires' to be in seconds, but some exports (like EditUser) might have it in ms or different field.
      // The provided JSON has 'expiry' (looks like ms, e.g. 1774937103000) and 'sameSite' as integer. 
      // Playwright expects:
      // - 'expires': number (Unix time in seconds)
      // - 'sameSite': "Strict" | "Lax" | "None" (string)
      
      const adaptedCookies = cookies.map(c => {
          const adapted = {
              name: c.name,
              value: c.value,
              domain: c.domain,
              path: c.path,
              secure: c.secure === 1 || c.secure === true,
              httpOnly: c.httpOnly === 1 || c.httpOnly === true
          };

          // Handle Expiry
          if (c.expiry) {
              // Check if ms (13 digits) or seconds (10 digits)
              // 1774937103000 is definitely ms
              adapted.expires = c.expiry / 1000;
          } else if (c.expirationDate) {
              adapted.expires = c.expirationDate;
          }

          // Handle SameSite
          // 256 or integers are often internal browser codes. Playwright wants strings.
          // Usually: 1=Lax, 2=Strict, 0=None (varies by browser/export tool)
          // For safety, we can often omit sameSite if problematic, or map it.
          // Let's omit it for now to let browser default handle it unless strict is needed.
          // Or map common values if we knew the source map.
          if (c.sameSite === "no_restriction" || c.sameSite === 0) adapted.sameSite = "None";
          else if (c.sameSite === "lax" || c.sameSite === 1) adapted.sameSite = "Lax";
          else if (c.sameSite === "strict" || c.sameSite === 2) adapted.sameSite = "Strict";
          
          return adapted;
      });

      try {
          await context.addCookies(adaptedCookies);
          console.log('Cookies added to context.');
      } catch (e) {
          console.error('Failed to add cookies:', e.message);
      }
  } else {
      console.warn('No cookies extracted. Proceeding without auth (or creating new session).');
  }

  const page = await context.newPage();

  // 4. Navigate
  console.log('Navigating to https://zeusx.com ...');
  await page.goto('https://zeusx.com', { waitUntil: 'networkidle' });

  // 5. Verification
  // Take a screenshot
  await page.screenshot({ path: 'zeusx_homepage.png' });
  console.log('Screenshot saved to zeusx_homepage.png');

  // Check for login indicator (e.g., "My Account", user avatar, etc.)
  // Adjust selector based on actual site
  try {
      const loggedInElement = await page.$('text=My Account'); 
      if (loggedInElement) {
          console.log('SUCCESS: "My Account" found. User is likely logged in.');
      } else {
          console.log('WARNING: "My Account" not found. Check if logged in.');
      }
  } catch(e) {
      console.log('Error checking login status element:', e);
  }

  // Keep open for a bit if needed, or close
  // await new Promise(r => setTimeout(r, 5000));
  await browser.close();
  console.log('Automation finished.');
}

run().catch(console.error);
