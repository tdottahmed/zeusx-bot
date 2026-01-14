export const CONFIG = {
    // Path to the Chrome/Chromium user profile to persist login state
    PROFILE_PATH: "/home/tanbir/.config/chromium/Default",
    
    // Base URL of the website
    BASE_URL: "https://zeusx.com",
    
    // Browser launch options
    LAUNCH_OPTIONS: {
        headless: false,
        viewport: null, // Uses the actual window size
        args: [
            "--disable-blink-features=AutomationControlled", // Hides automation flag
            "--start-maximized", // Start browser maximized
        ],
    },
    
    // Timeouts (in ms)
    TIMEOUTS: {
        PAGE_LOAD: 60000,
        SELECTOR: 15000,
        ACTION_DELAY: 3000,
    }
};
