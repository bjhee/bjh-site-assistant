<?php
require_once BSA_PATH . '/inc/util.php';
require_once BSA_PATH . '/inc/constants.php';

class BsaCopyright {
    // Option name
    const OPTION_COPYRIGHT = 'bsa_copyright';
    const OPTION_INFO = 'bsa_copyright_info';
    
    // Be called when the plugin is installed
    static function install() {
        // Do nothing
    }
    
    // Add field to setting menu
    static function setting_init() {
        // Setting field of Add Copyright Information
        BsaUtil::add_field(self::OPTION_COPYRIGHT, 'Add Copyright Information', array(__CLASS__, 'add_field'));
    }
    
    static function add_field() {
        BsaUtil::add_checkbox(self::OPTION_COPYRIGHT);
        // Add the content of copyright info once the option is checked
        echo '<input name="' . BsaConst::OPTIONS_GROUP . '[' . self::OPTION_INFO . ']" '
           . 'id="'. self::OPTION_INFO . '" placeholder="Please input the copy right info..." '
           . 'value="' . BsaUtil::get_value(self::OPTION_INFO) . '" '
           . 'type="textarea" height="200px" width="500px" /><br />';
    }
    
    // Add copyright info at the end of the article
    function display_copyright($content) {
        if (BsaUtil::is_enabled(self::OPTION_COPYRIGHT) && is_singular()) {
            $content = $content . BsaUtil::get_value(self::OPTION_INFO);
        }
        
        return $content;
    }
}

// Add option to setting page
add_action('admin_init', 'BsaCopyright::setting_init');

// Update the content
add_filter('the_content',  'BsaCopyright::display_copyright');
?>