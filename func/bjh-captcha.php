<?php
require_once BSA_PATH . '/inc/util.php';

class BsaCaptcha {
    // Option name
    const OPTION_NAME = 'bsa_captcha';
    
    // Be called when the plugin is installed
    static function install() {
        // Do nothing
    }
    
    // Add field to setting menu
    static function setting_init() {
        // Setting field of Prevent Spam Comments
        BsaUtil::add_field(self::OPTION_NAME, 'Prevent Spam Comments', array(__CLASS__, 'add_field'));
    }
    
    static function add_field() {
        BsaUtil::add_checkbox(self::OPTION_NAME);
    }
    
    // Add a simple captcha of random 3 numbers for anonymous comments
    static function add_captcha() {
        if (BsaUtil::is_enabled(self::OPTION_DESC) && is_singular()) {
        }
    }
    
}

// Add option to setting page
add_action('admin_init', 'BsaCaptcha::setting_init');
?>