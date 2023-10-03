<?php
/**
 * Plugin Name: Telegram Form Notifications
 * Description: Easy send notifications about sunmited forms to telegram Bot or User
 * Author: Yevhenii Hordievskyi
 * Author URI: ffeynmann@gmail.com
 * Text Domain: rivo-wts
 * Domain Path: /languages
 * Version: 1.0
 */


if (!defined('ABSPATH')) {
    exit;
};

if (!defined("Rivo_WTS_PLUGIN_DIR")) {
    define("Rivo_WTS_PLUGIN_DIR", __DIR__);
}
if (!defined("Rivo_WTS_URL")) {
    define('Rivo_WTS_URL', plugin_dir_url(__FILE__));
}
if (!defined("Rivo_WTS_TEXTDOMAIN")) {
    define('Rivo_WTS_TEXTDOMAIN', 'rivo-wts');
}
if (!defined("Rivo_WTS_VERSION")) {
    define('Rivo_WTS_VERSION', "1.0");
}

require __DIR__ . '/lib/autoload.php';
Rivo_WTS_Main::init();
