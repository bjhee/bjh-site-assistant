<?php
require_once BSA_PATH . '/inc/util.php';
require_once BSA_PATH . '/inc/constants.php';

class BsaCopyright {
    // Option name
    const OPTION_COPYRIGHT = 'bsa_copyright';
    const OPTION_INFO = 'bsa_copyright_info';
    
    // Reserved variable to be replaced
    const VAR_LINK = '%link%';
    
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
        echo '<fieldset><p>';
        BsaUtil::add_checkbox(self::OPTION_COPYRIGHT);
        echo '</p><p>Pls input the content to be displayed as copy right information. %link% is reserved as the link of the article.';
        echo '</p><p><textarea class="large-text" name="' . BsaConst::OPTIONS_GROUP . '[' . self::OPTION_INFO . ']" '
           // Enable to input the copyright info only if the option is checked
           . (BsaUtil::is_enabled(self::OPTION_COPYRIGHT) ? '' : 'disabled')
           . ' id="'. self::OPTION_INFO . '" placeholder="Please input the copy right info..." rows="3">'
           . BsaUtil::get_value(self::OPTION_INFO)
           . '</textarea></p></fieldset><br />';
?>
<script type="text/javascript">
var chkbox = document.getElementById("<?php echo self::OPTION_COPYRIGHT; ?>");

chkbox.onclick = function() {
    var infoArea = document.getElementById("<?php echo self::OPTION_INFO; ?>");
    if (chkbox.checked) {
        infoArea.disabled = false;
    } else {
        infoArea.disabled = true;
    }
}
</script>
<?php
    }
    
    // Add copyright info at the end of the article
    function display_copyright($content) {
        if (BsaUtil::is_enabled(self::OPTION_COPYRIGHT) && is_single()) {
            $copyright = BsaUtil::get_value(self::OPTION_INFO);
            if (strpos($copyright, self::VAR_LINK)) {
                // Replace the reserved viarable with blog name and article link
                $blog_link = '<a href="' . get_permalink() . '">' . get_bloginfo('name') . '</a>';
                $copyright = str_replace(self::VAR_LINK, $blog_link, $copyright);
                
            }
            
            $content = $content . $copyright;
        }
        
        return $content;
    }
}

// Add option to setting page
add_action('admin_init', 'BsaCopyright::setting_init');

// Update the content
add_filter('the_content',  'BsaCopyright::display_copyright');
?>