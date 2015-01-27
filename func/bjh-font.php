<?php
require_once BSA_PATH . '/inc/util.php';

class BsaFont {
    // Option name
    const OPTION_NAME = 'bsa_font';
    // Resource name and URL
    const CDN_URL = '//fonts.useso.com/css?family=Open+Sans:300italic,400italic,600italic,300,400,600';
    const OPEN_SANS = 'open-sans';
    
    // Be called when the plugin is installed
    static function install() {
        BsaUtil::enable(self::OPTION_NAME);
    }
    
    // Add field to setting menu
    static function setting_init() {
        // Setting field of Replace Google Fonts 
        BsaUtil::add_field(self::OPTION_NAME,
                           __('Replace Google Fonts', 'bjh-site-assistant'),
                           array(__CLASS__, 'add_field'));
    }
    
    // Generate HTML element for replace font option
    static function add_field() {
        BsaUtil::add_checkbox(self::OPTION_NAME);
    }

    // Replace the Google fonts URL to 360 CDN which is fonts.useso.com
    static function replace_font() {
        if (BsaUtil::is_enabled(self::OPTION_NAME)) {
            wp_deregister_style(self::OPEN_SANS);
            wp_register_style(self::OPEN_SANS, self::CDN_URL);
            wp_enqueue_style(self::OPEN_SANS);
        }
    }
}

// Add option to setting page
add_action('admin_init', 'BsaFont::setting_init');

// Add action when open the front site or admin console
add_action('init', 'BsaFont::replace_font');

// Add action when open the front site only
//add_action('wp_enqueue_scripts', 'BsaFont::replace_font');
// Add action when open the admin console only
//add_action('admin_enqueue_scripts', 'BsaFont::replace_font');
?>