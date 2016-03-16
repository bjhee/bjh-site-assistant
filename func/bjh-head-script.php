<?php
require_once BSA_PATH . 'inc/util.php';
require_once BSA_PATH . 'inc/constants.php';

class BsaHeadScript {
    // Option name
    const OPTION_NAME = 'bsa_head_script';
    const OPTION_SCRIPT = 'bsa_head_script_code';

    // Be called when the plugin is installed
    static function install() {
        // Sample script for Baidu Analytics
        $baidu_analytics = <<<EOF
<script>
var _hmt = _hmt || [];
(function() {
  var hm = document.createElement("script");
  hm.src = "//hm.baidu.com/hm.js?0f4fc19c9df1256edcd8e4f84e045f78";
  var s = document.getElementsByTagName("script")[0];
  s.parentNode.insertBefore(hm, s);
})();
</script>
EOF;
        BsaUtil::set_value(self::OPTION_SCRIPT, $baidu_analytics);
    }

    // Add field to setting menu
    static function setting_init() {
        // Setting field of adding head script code
        BsaUtil::add_field(self::OPTION_NAME,
                           __('Add Script to Page', 'bjh-site-assistant'),
                            array(__CLASS__, 'add_field'));
    }

    // Generate HTML element for enabling head script
    static function add_field() {
        echo '<fieldset><p>';
        // Add check box for enabling
        BsaUtil::add_checkbox(self::OPTION_NAME);
        // Add description
        echo '</p><p>' .
             __('Add scripts to HTML page head. e.g. add Baidu Analytics script.', 'bjh-site-assistant');
        // Add text area, name OPTIONS_GROUP[OPTION_SCRIPT] will let form submit to save to the right option
        // Enable to input the script code only if the option is checked
        $txtArea = '</p><p><textarea class="large-text" id="%s" name="%s[%s]" %s rows="8">%s</textarea>'
                 . '</p></fieldset><br />';
        echo sprintf($txtArea,
                     self::OPTION_SCRIPT,
                     BsaConst::OPTIONS_GROUP,
                     self::OPTION_SCRIPT,
                     (BsaUtil::is_enabled(self::OPTION_NAME) ? '' : 'readonly'),
                     BsaUtil::get_value(self::OPTION_SCRIPT, ''));

        BsaUtil::control_field(self::OPTION_NAME, self::OPTION_SCRIPT);
    }
    // Add the script to the HTML <head>
    function add_script() {
        // Only add for article page if option is turned on
        if (BsaUtil::is_enabled(self::OPTION_NAME)) {
            echo BsaUtil::get_value(self::OPTION_SCRIPT, '');
        }
    }
}

// Add option to setting page
add_action('admin_init', 'BsaHeadScript::setting_init');

// Add action to page head
add_action('wp_head', 'BsaHeadScript::add_script');
