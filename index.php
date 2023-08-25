<?php
/**
 * Plugin Name: Telegram Form Notifications
 * Description: Easy send notifications about sunmited forms to telegram Bot or User
 * Author: Alexey Geyvan, RivoAgency
 * Text Domain: rivoforms
 * Domain Path: /languages
 * Version: 1.0
 */


if (!defined('ABSPATH')) {
    exit;
};

if (!defined("RFT_PLUGIN_DIR")) {
    define("RFT_PLUGIN_DIR", __DIR__);
}
if (!defined("RFT_URL")) {
    define('RFT_URL', plugin_dir_url(__FILE__));
}
if (!defined("RFT_TEXTDOMAIN")) {
    define('RFT_TEXTDOMAIN', 'rivoforms');
}
if (!defined("RFT_VERSION")) {
    define('RFT_VERSION', "1.0");
}

require __DIR__ . '/lib/autoload.php';
RFT_Main::init();
