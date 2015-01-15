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

function add_keywords() {
    if (is_single()) {
        echo '<meta name="keywords" content="';
        $postTags = get_the_tags();
        $toJoin = false;
        
        if ($postTags) {
            foreach($postTags as $tag) {
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

function add_description() {
    if (is_single()) {
        echo '<meta name="description" content="' . get_the_excerpt() . '" />';
    }
}

add_action('wp_head', 'add_keywords');
add_action('wp_head', 'add_description');
?>
