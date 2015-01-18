<?php
require_once BSA_PATH . '/inc/constants.php';

class BsaSetting {

    // Create a setting submenu under option menu of WordPress admin site
    static function setting_menu() {
        add_options_page('BJH Website Assistant Settings',
                         'BJH Site Assistant',
                         'administrator',
                         BsaConst::OPTIONS_PAGE,
                         array(__CLASS__, 'setting_page'));
    }
    
    // The main section of setting page
    static function setting_page() {
        // Reload the option settings
        global $bsa_options;
        $bsa_options = get_option(BsaConst::OPTIONS_GROUP);
        
        // Generate the setting page section
        echo '
        <div class="wrap">
            <h2>BJH Website Assistant Settings</h2>
            <div class="narrow">
                <form action="options.php" method="post">
                    <p>Start Settings</p>';
                    // The option to be submitted by form
                    settings_fields(BsaConst::OPTIONS_GROUP);
                    // List the registered settings to page
                    do_settings_sections(BsaConst::OPTIONS_PAGE);
                    echo '<p class="submit">
                        <input name="submit" type="submit" class="button-primary" value="Save Change" />
                    </p>
                </form>
            </div>
        </div>';
    }

    // Initialize the settings by register setting option and fields
    static function setting_init() {
        register_setting(BsaConst::OPTIONS_GROUP, BsaConst::OPTIONS_GROUP);
        add_settings_section(BsaConst::OPTIONS_SECTION,
                             'Settings',
                             array(__CLASS__, 'setting_section'),
                             BsaConst::OPTIONS_PAGE);
    }

    // The message to be displayed on top of setting section
    static function setting_section() {
        echo '<p>Please input the setting.</p>';
    }
}

// Init the admin option field
add_action('admin_init', 'BsaSetting::setting_init');

// Add the admin option menu section
add_action('admin_menu', 'BsaSetting::setting_menu');
?>