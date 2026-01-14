export const SELECTORS = {
    // Authentication related selectors
    LOGIN: {
        // Element that appears only when logged in (User avatar/wrapper)
        LOGGED_IN_INDICATOR: ".header_users-wrapper__i2wvj",
    },

    // Header navigation selectors
    HEADER: {
        // "Sell Item" button. Found by text content or specific attributes.
        // Using playwright's has-text engine is reliable here.
        SELL_BUTTON: 'button:has-text("Sell Item")', 
    },

    // Search related selectors
    SEARCH: {
        INPUT: ".co-select-game_input-search__AqNcm",
        // The game item in the search results list
        RESULT_ITEM: ".co-select-game_game-name__8U6eV", // Generic class for result items
    },

    // Product Listing Form
    PRODUCT_FORM: {
        TITLE_INPUT: 'input[placeholder="Eg: Clash of Clans Account Lv 10"]',
        PRICE_INPUT: '.input_price-input__OANaF input',
        DESCRIPTION_EDITOR: '.ck-editor__editable', // CKEditor content area
        DELIVERY_DAYS: 'input[placeholder="Days"]', // Assuming placeholder or structure based on context (checking snippet closely in next step if needed, but going with robust guess or precise traversal if possible. Snippet showed: <div class="input_label__zMh1l">Days</div>...<input value="">. We might need traversing.)
        // Let's use a more robust selector for delivery inputs based on their labels if possible, or relative layout.
        // Based on snippet: <div class="input_input__N_xjH"> <div class="input_label__zMh1l">Days</div> ... <input>
        DELIVERY_DAYS_CONTAINER: 'div:has(.input_label__zMh1l:has-text("Days")) input',
        DELIVERY_HOURS_CONTAINER: 'div:has(.input_label__zMh1l:has-text("Hours")) input',
        // Generic file input. Usually hidden but Playwright can handle it.
        IMAGE_UPLOAD: 'input[type="file"]',
    },

    // General UI elements
    COMMON: {
        APP_ROOT: "#__next", // Next.js app root usually
    }
};
