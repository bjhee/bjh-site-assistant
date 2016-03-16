<?php
require_once BSA_PATH . 'inc/util.php';

class BsaBackTop {
    // Option name
    const OPTION_NAME = 'bsa_backtop';

    // Be called when the plugin is installed
    static function install() {
        BsaUtil::enable(self::OPTION_NAME);
    }

    // Add field to setting menu
    static function setting_init() {
        // Setting field of add back to top button
        BsaUtil::add_field(self::OPTION_NAME,
                           __('Add Back-to-Top Button', 'bjh-site-assistant'),
                           array(__CLASS__, 'add_field'));
    }

    // Generate HTML element for add back to to button option
    static function add_field() {
        BsaUtil::add_checkbox(self::OPTION_NAME);
    }

    // Add the button of back to top to blog and page
    static function back_to_top() {
        // Only add for article and page
        if (BsaUtil::is_enabled(self::OPTION_NAME) && is_singular()) {
            $topImg = BsaUtil::get_plugin_url() . '/image/top.png';
            echo '<div style="display: none; background: url('
                . $topImg
                .') no-repeat;" id="backtop"></div>';
            echo '
            <script type="text/javascript">
                backtoTop("backtop");
            </script>';
        }
    }
}

// Add option to setting page
add_action('admin_init', 'BsaBackTop::setting_init');

// Add the button of back to top to footer
add_action('wp_footer', 'BsaBackTop::back_to_top');