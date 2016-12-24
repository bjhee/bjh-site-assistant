=== BJH Website Assistant ===

Contributors:      bjhee
Tags:              Google Font, Gravatar, copyright, SEO, Anti-spam, Baidu Submit
Donate link:       https://github.com/bjhee/bjh-site-assistant
Plugin URI:        http://www.bjhee.com/bjh-site-assistant
Requires at least: 3.5
Tested up to:      4.7
Stable tag:        1.3.1
License:           The MIT License
License URL:       http://mit-license.org/

The WordPress plugin that provides small functions to help your website working better.

== Description ==
该WordPress插件提供的小功能将有助你的网站运行的更好。

The WordPress plugin that provides small functions to help your website working better, especially in "some countries". The functions this plugin currently provides:

= Replace Google fonts by Qihoo 360 mirror =
Google fonts (such as Open Sans) are blocked in "some countries". Replace the font URL from Google fonts (fonts.googleapi.com) to Qihoo 360 mirror (fonts.useso.com).

= Replace Gravatar images by local default image =
Gravatar images are blocked in "some countries". Replace the image URL from Gravatar (*.gravatar.com) to local default image.

= Add page meta keywords and description =
This function is for SEO (Search Engine Optimization). Meta keywords and description on page are more easily to be categorized by search engine. The function will add the tags of articles to page meta keywords, and add summary of articles to page meta description.

= Prevent spam with validation code =
The anonymous reader must input a 3-digits number of validation code before submit a comment. The number is random and will be verified by both front end and back end. This won't bring much inconvenient to user, but can be easily prevent most of the spam comments. It definitely has the hole for hackers to attack. However I believe for most of the websites, it is not worth for hackers to spent much time to break it.

= Allow user to add "Back-to-Top" button on blogs and pages =
When the user scoll down the screen of blogs and pages, a "Back-to-Top" will appear at bottom-right of the screen. When you can click it, the page will go back to the top. This is a convenient function that let users quickly go to the page head.

= Allow user to add code to page head =
When using analytics tool like Baidu Analytics, it will ask you to add a piece of script in HTML head tag. The plugin allow you to save the content of script on configuration, and it will automatically put it to page.

= Enable post link actively submitted to Baidu =
Baidu Zhanzhang platform published the active link submission function in 2015. Compare to Baidu Sitemap, it can submit the link of your article immediately when you post it, so that Baidu can archive it at once. It can also prevent the 3rd party site reposting your article and submit to Baidu beforehand. Note that you should request for a token on Baidu Zhanzhang, and enter the token in option page before enabling it. Also, make sure you have php5-curl module installed on your web server.

= Add article copyright =
Add a simple claim at the end of the article to announce the copyright. Also, it provides a link for others to include when copying the article to other website.


== Installation ==
1. Uncompress the downloaded package
2. Upload folder including all files to the "/wp-content/plugins/" directory
3. Activate the plugin through the 'Plugins' menu in WordPress


== Screenshots ==

1. Enable or disable the functions by settings


== Frequently Asked Questions ==
<b>Q: Where can I get the newest version of the plugin</b><br />
* Chinese plugin URL: http://www.bjhee.com/bjh-site-assistant
* WordPress plugin URL: https://wordpress.org/plugins/bjh-site-assistant/
* Github project URL: https://github.com/bjhee/bjh-site-assistant

= Support =
Contact me at http://www.bjhee.com/ or junhe0526@hotmail.com

== Changelog ==
= 12/24/2016 v1.3.1 =
Do not enable Google font URL replacement by default since Google font is accessible in China after Sep. 2016

= 3/16/2016 v1.3 =
* Allow user to add "Back-to-Top" button on blogs and pages.
* Include JS and CSS of this site assistant plugin when enabling it.
* Fix the bug of wrong url returned by get_plugin_url in util.php.

= 2/23/2016 v1.2 =
Add function that allow user to add script to HTML head tag. It is usually used to add utility code like Baidu Analytics.

= 1/9/2016 v1.1.2 =
Fix the 'self' variable case sensitive issue

= 12/25/2015 v1.1.1 =
Fix the issue that copyright info and baidu token will be lost when the option is disabled.

= 12/24/2015 v1.1 =
Add the function to enable Baidu post link active submission

= 01/31/2015 v1.0 =
Initial release. Include the functions of:
* Replace Google fonts by Qihoo 360 mirror
* Replace Gravatar images by local default image
* Add page meta keywords and description
* Prevent spam with validation code
* Add article copyright.


== Upgrade Notice ==
Nothing
