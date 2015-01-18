<?php
require_once BSA_PATH . '/inc/util.php';

class BsaMeta {
    // Option name
    const OPTION_KEYWORD = 'bsa_keyword';
    const OPTION_DESC = 'bsa_desc';
    
    // Be called when the plugin is installed
    static function install() {
        BsaUtil::enable(self::OPTION_KEYWORD);
        BsaUtil::enable(self::OPTION_DESC);
    }
    // Add fields to setting menu
    static function setting_init() {
        // Setting field of Add Meta Keywords and Add Meta Description
        BsaUtil::add_field(self::OPTION_KEYWORD, 'Add Meta Keywords', array(__CLASS__, 'setting_keyword'));
        BsaUtil::add_field(self::OPTION_DESC, 'Add Meta Description', array(__CLASS__, 'setting_desc'));
    }
    
    // Generate HTML element for add meta keywords option
    static function setting_keyword() {
        BsaUtil::add_checkbox(self::OPTION_KEYWORD);
    }
    
    // Generate HTML element for add meta description option
    static function setting_desc() {
        BsaUtil::add_checkbox(self::OPTION_DESC);
    }

    // Add the tags of the article to HTML meta keywords and separate them by comma
    function add_keyword() {
        // Only add for article page if option is turned on
        if (BsaUtil::is_enabled(self::OPTION_KEYWORD) && is_singular()) {
            echo '<meta name="keywords" content="';
            $postTags = get_the_tags();
            $toJoin = false;
            
            if ($postTags) {
                foreach($postTags as $tag) {
                    // Escape the first comma
                    if ($toJoin)
                        echo ',';
                    else
                        $toJoin = true;
                    
                    echo $tag->name;
                }
            }

            echo '" />';
        }
    }

    // Add the summary of the article to HTML meta description
    function add_desc() {
        // Only add for article page if option is turned on
        if (BsaUtil::is_enabled(self::OPTION_DESC) && is_singular()) {
            echo '<meta name="description" content="' . get_the_excerpt() . '" />';
        }
    }
    
}

// Add options to setting page
add_action('admin_init', 'BsaMeta::setting_init');

// Add action to page head
add_action('wp_head', 'BsaMeta::add_keyword');
add_action('wp_head', 'BsaMeta::add_desc');
?>