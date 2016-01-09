<?php
require_once BSA_PATH . '/inc/util.php';
require_once BSA_PATH . '/inc/constants.php';

class BsaCopyright {
    // Option name
    const OPTION_NAME = 'bsa_copyright';
    const OPTION_INFO = 'bsa_copyright_info';

    // Reserved variable to be replaced
    const VAR_LINK = '%link%';

    // Be called when the plugin is installed
    static function install() {
        // Sample copy right info
        $sample_info =  '<p><span style="color:#878686">'
                      . __('Please include the original link when you copy it', 'bjh-site-assistant')
                      . ': </span>' . self::VAR_LINK . '</p>';
        BsaUtil::set_value(self::OPTION_INFO, $sample_info);
    }

    // Add field to setting menu
    static function setting_init() {
        // Setting field of Add Copyright Information
        BsaUtil::add_field(self::OPTION_NAME,
                           __('Add Copyright Information', 'bjh-site-assistant'),
                            array(__CLASS__, 'add_field'));
    }

    // Generate HTML element for enable copyright
    static function add_field() {
        echo '<fieldset><p>';
        // Add check box for enabling
        BsaUtil::add_checkbox(self::OPTION_NAME);
        // Add description
        echo '</p><p>' .
             __('Please input the content to be displayed as copyright at the end of articles. '
              . '%link% is reserved as the link of the article.', 'bjh-site-assistant');
        // Add text area, name OPTIONS_GROUP[OPTION_INFO] will let form submit to save to the right option
        // Enable to input the copyright info only if the option is checked
        $txtArea = '</p><p><textarea class="large-text" id="%s" name="%s[%s]" %s rows="3">%s</textarea>'
                 . '</p></fieldset><br />';
        echo sprintf($txtArea,
                     self::OPTION_INFO,
                     BsaConst::OPTIONS_GROUP,
                     self::OPTION_INFO,
                     (BsaUtil::is_enabled(self::OPTION_NAME) ? '' : 'readonly'),
                     BsaUtil::get_value(self::OPTION_INFO, ''));
        // echo '</p><p><textarea class="large-text" id="'. self::OPTION_INFO . '" '
        //    . (BsaUtil::is_enabled(self::OPTION_NAME) ? '' : 'disabled')
        //    . ' name="' . BsaConst::OPTIONS_GROUP . '[' . self::OPTION_INFO . ']" rows="3">'
        //    . BsaUtil::get_value(self::OPTION_INFO, '')
        //    . '</textarea></p></fieldset><br />';
        BsaUtil::control_field(self::OPTION_NAME, self::OPTION_INFO);
    }

    // Add copyright info at the end of the article
    function display_copyright($content) {
        if (BsaUtil::is_enabled(self::OPTION_NAME) && is_single()) {
            $copyright = BsaUtil::get_value(self::OPTION_INFO, '');
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
