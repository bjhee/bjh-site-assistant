<?php
require_once BSA_PATH . '/inc/util.php';

class BsaBaiduSubmit {
    // Option name
    const OPTION_NAME = 'bsa_baidu_submit';
    const OPTION_BAIDU_APILINK = 'http://data.zz.baidu.com/urls?site=%s&token=%s&type=original';

    // Be called when the plugin is installed
    static function install() {
        BsaUtil::enable(self::OPTION_NAME);
    }

    // Add field to setting menu
    static function setting_init() {
        // Setting field of Replace Gravatar Images
        BsaUtil::add_field(self::OPTION_NAME,
                           __('Baidu Link Submit', 'bjh-site-assistant'),
                           array(__CLASS__, 'add_field'));
    }

    // Generate HTML element for replace avatar option
    static function add_field() {
        BsaUtil::add_checkbox(self::OPTION_NAME);
    }

    // Add Baidu active link submit function
    static function baidu_submit($post_id) {

        // Prevent submitting the same post multi-times
        if (BsaUtil::is_enabled(self::OPTION_NAME) && get_post_meta($post_id,'_baidu_submitted', true) != 1) {
            $url = get_permalink($post_ID);
            $token = 'zwIk1yGwfOwLQWAz';
            // Compose API URL
            $api = sprintf(self::OPTION_BAIDU_APILINK, home_url(), $token);
            $ch = curl_init();
            $options =  array(
                CURLOPT_URL => $api,
                CURLOPT_POST => true,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_POSTFIELDS => $url,
                CURLOPT_HTTPHEADER => array('Content-Type: text/plain'),
            );
            curl_setopt_array($ch, $options);

            // Get JSON formatted response
            $result = json_decode(curl_exec($ch),true);
            // There will be 'success' field if it is succeeded.
            if (array_key_exists('success',$result)) {
                add_post_meta($post_ID, '_baidu_submitted', 1, true);
            }
        }
    }
}

// Add option to setting page
add_action('admin_init', 'BsaBaiduSubmit::setting_init');

// Add Baidu link auto submit when a post is published
add_action('publish_post', 'BsaBaiduSubmit::baidu_submit');
