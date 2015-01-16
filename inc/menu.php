<?php
require_once BSA_PATH . '/inc/constants.php';

class BsaSettingMenu {

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
        echo '
        <div class="wrap">
            <h2>BJH Website Assistant Settings</h2>
            <div class="narrow">
                <form action="options.php" method="post">
                    <p>Start Settings</p>';
                    settings_fields(BsaConst::OPTIONS_GROUP);       // The option to be submitted by form
                    do_settings_sections(BsaConst::OPTIONS_PAGE);   // List the registered settings to page
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
        // Setting field of Replace Google Fonts 
        add_settings_field(BsaConst::OPTION_FONTS,
                           'Replace Google Fonts',
                           array(__CLASS__, 'setting_fonts'),
                           BsaConst::OPTIONS_PAGE,
                           BsaConst::OPTIONS_SECTION);
        // Setting field of Replace Gravatar Images
        add_settings_field(BsaConst::OPTION_GRAVATAR,
                           'Replace Gravatar Images',
                           array(__CLASS__, 'setting_gravatar'),
                           BsaConst::OPTIONS_PAGE,
                           BsaConst::OPTIONS_SECTION);
        // Setting field of Add Meta Keywords
        add_settings_field(BsaConst::OPTION_KEYWORDS,
                           'Add Meta Keywords',
                           array(__CLASS__, 'setting_keywords'),
                           BsaConst::OPTIONS_PAGE,
                           BsaConst::OPTIONS_SECTION);
        // Setting field of Add Meta Description
        add_settings_field(BsaConst::OPTION_DESCRIPTION,
                           'Add Meta Description',
                           array(__CLASS__, 'setting_description'),
                           BsaConst::OPTIONS_PAGE,
                           BsaConst::OPTIONS_SECTION);
    }

    // The message to be displayed on top of setting section
    static function setting_section() {
        echo '<p>Please input the setting.</p>';
    }
    
    static function setting_fonts() {
        self::add_checkbox(BsaConst::OPTION_FONTS);
    }
    
    static function setting_gravatar() {
        self::add_checkbox(BsaConst::OPTION_GRAVATAR);
    }
    
    static function setting_keywords() {
        self::add_checkbox(BsaConst::OPTION_KEYWORDS);
    }
    
    static function setting_description() {
        self::add_checkbox(BsaConst::OPTION_DESCRIPTION);
    }
    
    // Common method to add setting of checkbox
    static function add_checkbox($option_name) {
        $options = get_option(BsaConst::OPTIONS_GROUP, false);
        echo '<input type="checkbox" name="' . BsaConst::OPTIONS_GROUP . '[' . $option_name . ']" id="'. $option_name . '" ';
        if ($options) {
            // Add 'checked="checked' if the two arguments identity
            checked('on', $options[$option_name]);
        }
        echo ' /><br />';
    }
}
?>