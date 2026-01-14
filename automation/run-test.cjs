// automation/run-persistent.cjs
const { chromium } = require("playwright");

const PROFILE_PATH = "/home/tanbir/.config/chromium/Default";

(async () => {
    console.log("🚀 Launching Chromium with existing profile");

    const context = await chromium.launchPersistentContext(PROFILE_PATH, {
        headless: false,
        viewport: null,
        args: [
            "--disable-blink-features=AutomationControlled",
            "--start-maximized",
        ],
    });

    const page = await context.newPage();

    await page.goto("https://zeusx.com", { waitUntil: "networkidle" });
    await page.waitForTimeout(4000);

    // LOGIN CHECK
    try {
        await page.waitForSelector(".header_users-wrapper__i2wvj", {
            timeout: 15000,
        });
        console.log("✅ Logged in successfully (profile session reused)");
    } catch {
        console.log("❌ Not logged in — login expired in this profile");
        await page.screenshot({ path: "not_logged_in.png" });
        return;
    }

    // Example action
    const sellBtn = 'button:has-text("Sell Item")';
    if (await page.isVisible(sellBtn)) {
        await page.click(sellBtn);
        await page.waitForTimeout(3000);
        await page.screenshot({ path: "after_click_sell.png" });
        console.log("🎯 Sell Item clicked");
    }

    console.log("🧠 Automation running with real browser session");
})();
