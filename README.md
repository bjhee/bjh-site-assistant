# BJH Website Assistant
The **WordPress plugin** that provides small functions to help your website working better.

>Contributors:      Billy.J.Hee

>Tags:              Google Font, Gravatar, copyright, SEO, Anti-spam

>Donate link:       https://github.com/bjhee/bjh-site-assistant

>Plugin URI:        http://www.bjhee.com/bjh-site-assistant

>Requires at least: 3.5

>Tested up to:      4.4

>Stable tag:        1.1.1

>License:           The MIT License

>License URL:       http://mit-license.org/

## Description
The WordPress plugin that provides small functions to help your website working better, especially in "some countries". The functions this plugin currently provides:

#### Replace Google fonts by Qihoo 360 mirror
Google fonts (such as Open Sans) are blocked in "some countries". Replace the font URL from Google fonts (fonts.googleapi.com) to Qihoo 360 mirror (fonts.useso.com).

#### Replace Gravatar images by local default image
Gravatar images are blocked in "some countries". Replace the image URL from Gravatar (*.gravatar.com) to local default image.

#### Add page meta keywords and description
This function is for SEO (Search Engine Optimization). Meta keywords and description on page are more easily to be categorized by search engine. The function will add the tags of articles to page meta keywords, and add summary of articles to page meta description.

#### Prevent spam with validation code
The anonymous reader must input a 3-digits number of validation code before submit a comment. The number is random and will be verified by both front end and back end. This won't bring much inconvenient to user, but can be easily prevent most of the spam comments. It definitely has the hole for hackers to attack. However I believe for most of the websites, it is not worth for hackers to spent much time to break it.

#### Enable post link actively submitted to Baidu
Baidu Zhanzhang platform published the active link submission function in 2015. Compare to Baidu Sitemap, it can submit the link of your article immediately when you post it, so that Baidu can archive it at once. It can also prevent the 3rd party site reposting your article and submit to Baidu beforehand. Note that you should request for a token on Baidu Zhanzhang, and enter the token in option page before enabling it. Also, make sure you have php5-curl module installed on your web server.

#### Add article copyright
Add a simple claim at the end of the article to announce the copyright. Also, it provides a link for others to include when copying the article to other website.

## Installation
1. Uncompress the downloaded package
2. Upload folder including all files to the "/wp-content/plugins/" directory
3. Activate the plugin through the 'Plugins' menu in WordPress

## Screenshots
1. Enable or disable the functions by settings
![Function Settings](/screenshot-1.png "BJH Website Assistant Settings")

## Frequently Asked Questions
**Q: Where can I get the newest version of the plugin**

Chinese plugin URL: http://www.bjhee.com/bjh-site-assistant

Github project URL: https://github.com/bjhee/bjh-site-assistant

#### Support
Contact me at http://www.bjhee.com/ or junhe0526@hotmail.com

## Changelog
#### 1/9/2016 v1.1.2
Fix the 'self' variable case sensitive issue

#### 12/25/2015 v1.1.1
Fix the issue that copyright info and baidu token will be lost when the option is disabled

#### 12/24/2015 v1.1
Add the function to enable Baidu post link active submission

#### 01/31/2015 v1.0
Initial release. Include the functions of:
* Replace Google fonts by Qihoo 360 mirror
* Replace Gravatar images by local default image
* Add page meta keywords and description
* Prevent spam with validation code
* Add article copyright.
