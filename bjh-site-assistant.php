<?php
/*
Plugin Name: BJH Website Assistant
Version:     1.0
Author:      Billy.J.Hee 
Author URI:  http://www.bjhee.com/
Plugin URI:  https://github.com/bjhee/bjh-site-assistant
Description: The WordPress plugin that assists your web site to work better (especially in China).
License:     The MIT License - http://mit-license.org/
*/

define('BSA_PATH', dirname(__FILE__));
require_once BSA_PATH . '/inc/menu.php';
require_once BSA_PATH . '/inc/constants.php';

// Initialize the option in WordPress database when enabling the plugin
function bjh_site_assistant_install() {
    add_option(BsaConst::OPTIONS_GROUP, '');
}

// Remove the option in WordPress database when disabling the plugin
function bjh_site_assistant_remove() {
    delete_option(BsaConst::OPTIONS_GROUP);
}

function is_checked($option) {
    return ($option == 'on');
}

// Replace the Google fonts URL to 360 CDN which is fonts.useso.com
function bjh1_replace_font() {
    $options = get_option(BsaConst::OPTIONS_GROUP, false);
    // Only replace when the option is turned on
    if ($options && is_checked($options[BsaConst::OPTION_FONTS])) {
        wp_deregister_style(BsaConst::FONT_OPEN_SANS);
        wp_register_style(BsaConst::FONT_OPEN_SANS, BsaConst::FONTS_CDN_URL);
        wp_enqueue_style(BsaConst::FONT_OPEN_SANS);
    }
}

// Replace all avatars from *.gravatar.com to local default image
function bjh_replace_gravatar($avatar) {
    $options = get_option(BsaConst::OPTIONS_GROUP, false);
    // Only replace *.gravatar.com if the option is turned on
    if ($options && is_checked($options[BsaConst::OPTION_GRAVATAR]) && strpos($avatar, 'gravatar.com') > 0) {
        $rootUrl = get_bloginfo('wpurl');
        $avatar = '<img alt="" src="'.$rootUrl.'/wp-content/plugins/bjh-gravatar-to-default/image/default.png" />';
    }
    
    return $avatar;
}

// Add the tags of the article to HTML meta keywords and separate them by comma
function bjh_add_keywords() {
    $options = get_option(BsaConst::OPTIONS_GROUP, false);
    // Only add for article page if option is turned on
    if ($options && is_checked($options[BsaConst::OPTION_KEYWORDS]) && (is_single() || is_page())) {
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
function bjh_add_description() {
    $options = get_option(BsaConst::OPTIONS_GROUP, false);
    // Only add for article page if option is turned on
    if ($options && is_checked($options[BsaConst::OPTION_DESCRIPTION]) && (is_single() || is_page())) {
        echo '<meta name="description" content="' . get_the_excerpt() . '" />';
    }
}

/* 这个函数在日志正文结尾处添加一段版权信息，并且只在 首页 页面才添加 */ 
function display_copyright( $content ) {  
    $content = $content . get_option('display_copyright_text'); 
 
    return $content;  
}

// Register the function to be called when the plugin is enabled
register_activation_hook( __FILE__, 'bjh_site_assistant_install');

// Register the function to be called when the plugin is disabled
register_deactivation_hook( __FILE__, 'bjh_site_assistant_remove');

// Add action when open the front site or admin console
add_action('init', 'bjh1_replace_font');

// Filter the result from get_avatar() call
add_filter('get_avatar', 'bjh_replace_gravatar');

// Add action to page head
add_action('wp_head', 'bjh_add_keywords');
add_action('wp_head', 'bjh_add_description');

// Init the admin option field
add_action('admin_init', array('BsaSettingMenu', 'setting_init'));

// Add the admin option menu
add_action('admin_menu', array('BsaSettingMenu', 'setting_menu'));

// Update the content
//add_filter('the_content',  'display_copyright');

// Add action when open the front site only
//add_action('wp_enqueue_scripts', 'bjh_replace_font');
// Add action when open the admin console only
//add_action('admin_enqueue_scripts', 'bjh_replace_font');
?>
