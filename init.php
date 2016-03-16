<?php
require_once BSA_PATH . 'inc/constants.php';
require_once BSA_PATH . 'func/bjh-font.php';
require_once BSA_PATH . 'func/bjh-avatar.php';
require_once BSA_PATH . 'func/bjh-meta.php';
require_once BSA_PATH . 'func/bjh-captcha.php';
require_once BSA_PATH . 'func/bjh-backtop.php';
require_once BSA_PATH . 'func/bjh-baidu-submit.php';
require_once BSA_PATH . 'func/bjh-head-script.php';
require_once BSA_PATH . 'func/bjh-copyright.php';

// Initialize the option in WordPress database when enabling the plugin
function bjh_site_assistant_install() {
    global $bsa_options;
    $bsa_options = array();

    BsaFont::install();
    BsaAvatar::install();
    BsaMeta::install();
    BsaCaptcha::install();
    BsaBackTop::install();
    BsaBaiduSubmit::install();
    BsaHeadScript::install();
    BsaCopyright::install();

    add_option(BsaConst::OPTIONS_GROUP, $bsa_options);
}

// Remove the option in WordPress database when disabling the plugin
function bjh_site_assistant_remove() {
    delete_option(BsaConst::OPTIONS_GROUP);
}

// Register and include JS script when enabling the plugin
function add_bsa_scripts() {
    $bsaJs = BSA_URL . '/js/bsa.js';
    // Register the JS, the first arg "bsa.js" will be used in wp_enqueue_script()
    wp_register_script('bsa.js', $bsaJs);
    // Safely add JS to wordpress pages
    wp_enqueue_script( 'bsa.js');
}

// Register and include CSS style when enabling the plugin
function add_bsa_styles() {
    $bsaCss = BSA_URL . '/css/bsa.css';
    wp_register_style('bsa.css', $bsaCss);
    wp_enqueue_style('bsa.css');
}

// Include JS script to site
add_action('wp_print_scripts', 'add_bsa_scripts');
// Include CSS style to site
add_action('wp_print_styles', 'add_bsa_styles');
