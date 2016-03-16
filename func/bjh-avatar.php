<?php
require_once BSA_PATH . 'inc/util.php';

class BsaAvatar {
    // Option name
    const OPTION_NAME = 'bsa_avatar';

    // Be called when the plugin is installed
    static function install() {
        // Do nothing
    }

    // Add field to setting menu
    static function setting_init() {
        // Setting field of Replace Gravatar Images
        BsaUtil::add_field(self::OPTION_NAME,
                           __('Replace Gravatar Images', 'bjh-site-assistant'),
                           array(__CLASS__, 'add_field'));
    }

    // Generate HTML element for replace avatar option
    static function add_field() {
        BsaUtil::add_checkbox(self::OPTION_NAME);
    }

    // Replace all avatars from *.gravatar.com to local default image
    static function replace_avatar($avatar) {
        // Only replace *.gravatar.com if the option is turned on
        if (BsaUtil::is_enabled(self::OPTION_NAME) && strpos($avatar, 'gravatar.com') > 0) {
            $avatar = '<img alt="Avatar" src="' . BsaUtil::get_plugin_url() . '/image/default.png" />';
        }

        return $avatar;
    }
}

// Add option to setting page
add_action('admin_init', 'BsaAvatar::setting_init');

// Filter the result from get_avatar() call
add_filter('get_avatar', 'BsaAvatar::replace_avatar');
