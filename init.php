<?php
require_once BSA_PATH . '/inc/constants.php';
require_once BSA_PATH . '/func/bjh-font.php';
require_once BSA_PATH . '/func/bjh-avatar.php';
require_once BSA_PATH . '/func/bjh-meta.php';
require_once BSA_PATH . '/func/bjh-captcha.php';
require_once BSA_PATH . '/func/bjh-baidu-submit.php';
require_once BSA_PATH . '/func/bjh-head-script.php';
require_once BSA_PATH . '/func/bjh-copyright.php';

// Initialize the option in WordPress database when enabling the plugin
function bjh_site_assistant_install() {
    global $bsa_options;
    $bsa_options = array();

    BsaFont::install();
    BsaAvatar::install();
    BsaMeta::install();
    BsaCaptcha::install();
    BsaBaiduSubmit::install();
    BsaHeadScript::install();
    BsaCopyright::install();

    add_option(BsaConst::OPTIONS_GROUP, $bsa_options);
}

// Remove the option in WordPress database when disabling the plugin
function bjh_site_assistant_remove() {
    delete_option(BsaConst::OPTIONS_GROUP);
}
