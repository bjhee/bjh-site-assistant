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

// Add the tags of the article to HTML meta keywords and separate them by comma
function add_keywords() {
    // Only add for article page
    if (is_single()) {
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
function add_description() {
    // Only add for article page
    if (is_single()) {
        echo '<meta name="description" content="' . get_the_excerpt() . '" />';
    }
}

// Change the Open Sans fonts URL to 360 CDN which is fonts.useso.com
function replace_fonts() {
    wp_deregister_style('open-sans');
    wp_register_style('open-sans', '//fonts.useso.com/css?family=Open+Sans:300italic,400italic,600italic,300,400,600');
    wp_enqueue_style('open-sans');
}

// Replace all avatars from *.gravatar.com to local default image
function replace_gravatar($avatar) {
    if (strpos($avatar, "gravatar.com") > 0) {
        $rootUrl = get_bloginfo('wpurl');
        $avatar = '<img alt="" src="'.$rootUrl.'/wp-content/plugins/bjh-gravatar-to-default/image/default.png" />';
    }
    
    return $avatar;
}

// For front site replace only
//add_action('wp_enqueue_scripts', 'bjh_replace_font');
// For admin console replace only
//add_action('admin_enqueue_scripts', 'bjh_replace_font');

add_action('wp_head', 'add_keywords');
add_action('wp_head', 'add_description');
add_action('init', 'bjh_replace_font');
add_filter('get_avatar', 'replace_gravatar');
?>
