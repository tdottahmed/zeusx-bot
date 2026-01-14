import { SELECTORS } from './selectors.js';
import { CONFIG } from './config.js';

/**
 * Checks if the user is currently logged in.
 * @param {import('playwright').Page} page
 * @returns {Promise<boolean>}
 */
export async function checkLoginStatus(page) {
    try {
        console.log("🔍 Checking login status...");
        await page.waitForSelector(SELECTORS.LOGIN.LOGGED_IN_INDICATOR, {
            timeout: CONFIG.TIMEOUTS.SELECTOR,
        });
        console.log("✅ Logged in successfully.");
        return true;
    } catch {
        console.log("❌ Not logged in or login expired.");
        await page.screenshot({ path: "not_logged_in.png" });
        return false;
    }
}

/**
 * Clicks the "Sell Item" button if visible.
 * @param {import('playwright').Page} page
 */
export async function clickSellButton(page) {
    const sellBtn = SELECTORS.HEADER.SELL_BUTTON;
    console.log("🖱️ Attempting to click 'Sell Item'...");

    if (await page.isVisible(sellBtn)) {
        await page.click(sellBtn);
        console.log("🎯 'Sell Item' clicked.");
        
        // Wait for potential navigation or modal
        await page.waitForTimeout(CONFIG.TIMEOUTS.ACTION_DELAY);
        
        // Take proof screenshot
        await page.screenshot({ path: "after_click_sell.png" });
        return true;
    } else {
        console.error("⚠️ 'Sell Item' button not visible.");
        return false;
    }
}

/**
 * Searches for a game in the search input.
 * @param {import('playwright').Page} page
 * @param {string} gameName
 */
export async function searchGame(page, gameName) {
    const searchInput = SELECTORS.SEARCH.INPUT;
    console.log(`🔍 Searching for game: "${gameName}"...`);

    try {
        await page.waitForSelector(searchInput, { state: 'visible', timeout: CONFIG.TIMEOUTS.SELECTOR });
        await page.fill(searchInput, gameName);
        console.log(`⌨️ Typed "${gameName}" into search.`);
        
        await page.waitForTimeout(2000); // Wait for results to filter
        await page.screenshot({ path: `after_search_${gameName}.png` });
        return true;
    } catch (error) {
        console.error("⚠️ Search input not found or interactable:", error.message);
        return false;
    }
}

/**
 * Selects a game from the search results.
 * @param {import('playwright').Page} page
 * @param {string} gameName
 */
export async function selectGame(page, gameName) {
    const resultSelector = SELECTORS.SEARCH.RESULT_ITEM;
    console.log(`🖱️ Selecting game: "${gameName}"...`);
    
    try {
        // Find the specific game item that contains the text
        const gameItem = page.locator(resultSelector).filter({ hasText: gameName }).first();
        
        await gameItem.waitFor({ state: 'visible', timeout: CONFIG.TIMEOUTS.SELECTOR });
        await gameItem.click();
        console.log(`✅ Selected "${gameName}".`);
        
        await page.waitForTimeout(CONFIG.TIMEOUTS.ACTION_DELAY);
        return true;
    } catch (error) {
        console.error(`⚠️ Could not select game "${gameName}":`, error.message);
        return false;
    }
}

/**
 * Fills the product details form.
 * @param {import('playwright').Page} page
 * @param {Object} data
 */
export async function fillProductDetails(page, data) {
    console.log("📝 Filling product details...");
    
    try {
        // 1. Title
        if (data.listingTitle) {
            console.log("Typing title...");
            await page.fill(SELECTORS.PRODUCT_FORM.TITLE_INPUT, data.listingTitle);
            await page.waitForTimeout(500); 
        }

        // 2. Price
        if (data.price) {
            console.log("Typing price...");
            await page.fill(SELECTORS.PRODUCT_FORM.PRICE_INPUT, data.price);
            await page.waitForTimeout(500);
        }

        // 3. Description (CKEditor)
        if (data.description) {
            console.log("Typing description...");
            // Click to focus first
            await page.click(SELECTORS.PRODUCT_FORM.DESCRIPTION_EDITOR);
            await page.waitForTimeout(200);
            await page.keyboard.type(data.description, { delay: 50 }); // Human-like typing
            await page.waitForTimeout(500);
        }

        // 4. Delivery Time
        if (data.deliveryDays) {
            console.log("Setting delivery days...");
            await page.fill(SELECTORS.PRODUCT_FORM.DELIVERY_DAYS_CONTAINER, data.deliveryDays);
        }
        if (data.deliveryHours) {
            console.log("Setting delivery hours...");
            await page.fill(SELECTORS.PRODUCT_FORM.DELIVERY_HOURS_CONTAINER, data.deliveryHours);
        }

        await page.screenshot({ path: "after_form_filing.png" });
        console.log("✅ Product form filled.");
        return true;

    } catch (error) {
        console.error("⚠️ Error filling form:", error.message);
        return false;
    }
}

/**
 * Uploads images to the product listing.
 * @param {import('playwright').Page} page
 * @param {string[]} imagePaths
 */
export async function uploadImages(page, imagePaths) {
    console.log(`🖼️ Uploading ${imagePaths.length} image(s)...`);
    const fileInput = SELECTORS.PRODUCT_FORM.IMAGE_UPLOAD;

    try {
        // Playwright handles hidden inputs automatically with setInputFiles
        await page.setInputFiles(fileInput, imagePaths);
        
        console.log("✅ Images set on input.");
        // Wait for potential upload processing
        await page.waitForTimeout(CONFIG.TIMEOUTS.ACTION_DELAY);
        
        await page.screenshot({ path: "after_image_upload.png" });
        return true;
    } catch (error) {
        console.error("⚠️ Error uploading images:", error.message);
        return false;
    }
}
