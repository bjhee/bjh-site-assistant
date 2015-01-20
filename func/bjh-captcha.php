<?php
require_once BSA_PATH . '/inc/util.php';

class BsaCaptcha {
    // Option name
    const OPTION_NAME = 'bsa_captcha';
    
    // Validate field
    const FIELD_VALID = 'valid_field';
    
    // Difference between captcha code and validation code
    const CODE_DIFF = 2;
    
    
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
    
    // Add a simple captcha of random 3 digits number for anonymous comments
    static function add_captcha_field($fields) {
        // Only add for article and page
        if (BsaUtil::is_enabled(self::OPTION_NAME) && is_singular() && !is_user_logged_in()) {
            // 3 digits of validation code
            global $number;
            $number = vsprintf('%03d',rand(0, 999));
            
            // reuse the style of "url" field
            $captcha_field = str_replace('"url"', self::OPTION_NAME, $fields['url']);
            
            // replace the url label by validation code
            $label_start = strpos($captcha_field, '>', strpos($captcha_field, '<label ')) + 1;
            $label_length = strpos($captcha_field, '</label>', $name_start) - $label_start;
            $captcha_field = substr_replace($captcha_field, 
                                            'Code:<em>' . $number . '</em>', 
                                            $label_start, 
                                            $label_length);
            
            // Add placeholder to remind user
            $label_start = strpos($captcha_field, '<input ') + 6;
            $placeholder = ' placeholder="' . 'Please input the code aside' . '" alt="' . $number . '" ';
            $captcha_field = substr_replace($captcha_field, $placeholder, $label_start, 1);
            
            $fields[self::OPTION_NAME] = $captcha_field;
            
            // Add a hidden field to valid the captcha at backend
            $fields[self::FIELD_VALID] = '<input type="hidden" id="' . self::FIELD_VALID 
                                       . '" name="' . self::FIELD_VALID . '" value="1">';
        }
        
        return $fields;
    }
    
    // Add JS to validate the captcha
    static function validate_captcha() {
        // Only add for article and page
        if (BsaUtil::is_enabled(self::OPTION_NAME) && is_singular() && !is_user_logged_in()) {
?>
<script type="text/javascript">
var submitBtn = document.getElementById("submit");
submitBtn.disabled = true;

var codeField = document.getElementById("<?php echo self::OPTION_NAME; ?>");
var validField = document.getElementById("<?php echo self::FIELD_VALID; ?>");
codeField.onkeyup = function() {
    if (codeField.value == codeField.alt) {
        submitBtn.disabled = false;
        validField.value = Number(codeField.value) + <?php echo self::CODE_DIFF; ?>;
    } else {
        submitBtn.disabled = true;
    }
}
</script>
<?php
        }
    }
    
    // Add the number posted to backend
    static function validate_post_number($comment_data) {
        $validation = $_POST[self::FIELD_VALID];
        if ($validation) {
            $code = $_POST[self::OPTION_NAME];
            if ($code && ((intval($validation) - intval($code)) == self::CODE_DIFF)) {
                return $comment_data;
            }
        }
        
        wp_die('Error: Code is not valid!');
    }
    
}

// Add option to setting page
add_action('admin_init', 'BsaCaptcha::setting_init');

// Add field to comment form
add_filter('comment_form_default_fields', 'BsaCaptcha::add_captcha_field');

// Add validate JS to the end of comment form.
add_action('comment_form', 'BsaCaptcha::validate_captcha');

// Backend validation for the code
add_filter('pre_comment_on_post', 'BsaCaptcha::validate_post_number');
?>