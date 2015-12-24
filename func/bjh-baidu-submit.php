<?php
require_once BSA_PATH . '/inc/util.php';

class BsaBaiduSubmit {
    // Option name
    const OPTION_NAME = 'bsa_baidu_submit';
    const OPTION_TOKEN = 'bsa_baidu_token';
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

    // Generate HTML element for enable Baidu link submit
    static function add_field() {
        echo '<fieldset><p>';
        // Add check box for enabling
        BsaUtil::add_checkbox(self::OPTION_NAME);
        // Add description
        echo '</p><p>' . __('Please input token from Baidu Zhanzhang:', 'bjh-site-assistant');
        // Add text field, name OPTIONS_GROUP[OPTION_INFO] will let form submit to save to the right option
        echo '</p><p><input type="text" class="large-text" id="' . self::OPTION_TOKEN . '" '
           . (BsaUtil::is_enabled(self::OPTION_NAME) ? '' : 'disabled')
           . ' name="' . BsaConst::OPTIONS_GROUP . '[' . self::OPTION_TOKEN . ']" value="'
           . BsaUtil::get_value(self::OPTION_TOKEN, '')
           . '"></p></fieldset><br />';
?>
<script type="text/javascript">
var bsCheck = document.getElementById("<?php echo self::OPTION_NAME; ?>");

bsCheck.onclick = function() {
    var tokenField = document.getElementById("<?php echo self::OPTION_TOKEN; ?>");
    if (bsCheck.checked) {
        tokenField.disabled = false;
    } else {
        tokenField.disabled = true;
    }
}
</script>
<?php
    }

    // Add Baidu active link submit function
    static function baidu_submit($post_id) {
        // Prevent submitting the same post multi-times
        if (BsaUtil::is_enabled(self::OPTION_NAME)
          && function_exists('curl_init')    // Need php5-curl installed
          && get_post_meta($post_id,'_baidu_submitted', true) != 1) {  // Check if already submitted
            $url = get_permalink($post_ID);
            $token = BsaUtil::get_value(self::OPTION_TOKEN, '');
            $domain = home_url();

            // Strip http(s):// from the home URL
            $pos = strrpos($domain, '//');
            if($pos != false)
            {
                $domain = substr($domain,$pos + 1);
            }

            // Compose API URL
            $api = sprintf(self::OPTION_BAIDU_APILINK, $domain, $token);
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
            if (array_key_exists('success', $result)) {
                add_post_meta($post_id, '_baidu_submitted', 1, true);
            }
        }
    }
}

// Add option to setting page
add_action('admin_init', 'BsaBaiduSubmit::setting_init');

// Add Baidu link auto submit when a post is published
add_action('publish_post', 'BsaBaiduSubmit::baidu_submit');
