import { chromium } from 'playwright';
import { CONFIG } from './config.js';
import { checkLoginStatus, clickSellButton, searchGame, selectGame, fillProductDetails, uploadImages } from './actions.js';
import PRODUCT_DATA from './product_data.json' with { type: "json" };

(async () => {
    console.log("🚀 Launching ZeusX Bot...");

    const context = await chromium.launchPersistentContext(CONFIG.PROFILE_PATH, CONFIG.LAUNCH_OPTIONS);
    const page = await context.pages().length > 0 ? context.pages()[0] : await context.newPage();

    // Navigate to Base URL
    console.log(`🌐 Navigating to ${CONFIG.BASE_URL}...`);
    try {
        await page.goto(CONFIG.BASE_URL, { waitUntil: "domcontentloaded", timeout: CONFIG.TIMEOUTS.PAGE_LOAD });
    } catch (e) {
        console.log("⚠️ Navigation timeout or error (continuing if page loaded):", e.message);
    }
    await page.waitForTimeout(4000); // Wait for potential dynamic content to load

    // 1. Check Login
    const isLoggedIn = await checkLoginStatus(page);
    if (!isLoggedIn) {
        console.log("⚠️ Stopping script: User needs to log in manually first.");
        // We might want to keep browser open or close it. 
        // For now, let's close to end the script, or we could leave it open for debugging.
        // await context.close(); 
        return; 
    }

    // 2. Perform Actions: Click Sell Item
    const sellClicked = await clickSellButton(page);
    
    // 3. Search and Select Game
    if (sellClicked) {
        const searched = await searchGame(page, "coc");
        if (searched) {
            await selectGame(page, "CoC");
            
            // 4. Fill Product Form
            await fillProductDetails(page, PRODUCT_DATA);
            
            // 5. Upload Images
            if (PRODUCT_DATA.images && PRODUCT_DATA.images.length > 0) {
                 await uploadImages(page, PRODUCT_DATA.images);
            }
        }
    }

    console.log("🧠 Automation sequence completed.");
    
    // Uncomment to close browser automatically
    // await context.close();
})();
