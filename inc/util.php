<?php
require_once BSA_PATH . '/inc/constants.php';

class BsaUtil {
    // The option value when it's turned on
    const ON = 'on';
   
    static function add_field($option_name, $display_name, $display_func) {
        // Setting field of Replace Google Fonts 
        add_settings_field($option_name,
                           $display_name,
                           $display_func,
                           BsaConst::OPTIONS_PAGE,
                           BsaConst::OPTIONS_SECTION);
    
    }
    
    // Utility method to add setting of checkbox
    static function add_checkbox($option_name) {
        global $bsa_options;
        echo '<input name="' . BsaConst::OPTIONS_GROUP . '[' . $option_name . ']" ';
        // Add 'checked="checked' if the two arguments identity
        checked(self::ON, $bsa_options[$option_name]);
        echo ' type="checkbox" id="'. $option_name . '" /><br />';
    }

    // Turn on option
    static function enable($option_name) {
        global $bsa_options;
        $bsa_options[$option_name] = self::ON;
    }

    // Utility to set the value of a single option
    static function set_value($option_name, $option_value) {
        global $bsa_options;
        $bsa_options[$option_name] = $option_value;
    }

    // Utility to check if the option is turned on
    static function is_enabled($option_name) {
        $options = get_option(BsaConst::OPTIONS_GROUP);
        return ($options[$option_name] == self::ON);
    }

    // Utility to get the value of a single option
    static function get_value($option_name) {
        $options = get_option(BsaConst::OPTIONS_GROUP);
        return $options[$option_name];
    }

    // Utility to get the url of plugin path
    static function get_plugin_url() {
        $root_url = get_bloginfo('wpurl');
        $plugin_name = strrchr(BSA_PATH, DIRECTORY_SEPARATOR);
        return $root_url . '/wp-content/plugins/' . $plugin_name;
    }
}
?>