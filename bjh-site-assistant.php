<?php
// Multi language suppoort
load_plugin_textdomain('bjh-site-assistant', false, '/bjh-site-assistant/lang/');

/*
Plugin Name: BJH Website Assistant
Version:     1.1
Author:      Billy.J.Hee
Author URI:  http://www.bjhee.com/
Plugin URI:  http://www.bjhee.com/bjh-site-assistant
Description: The WordPress plugin that provides small functions to help your website working better.
License:     The MIT License - http://mit-license.org/
*/

define('BSA_PATH', plugin_dir_path(__FILE__));
define('BSA_URL', plugins_url('', __FILE__));
require_once BSA_PATH . '/init.php';
require_once BSA_PATH . '/settings.php';

// Register the function to be called when the plugin is enabled
register_activation_hook(__FILE__, 'bjh_site_assistant_install');

// Register the function to be called when the plugin is disabled
register_deactivation_hook(__FILE__, 'bjh_site_assistant_remove');
