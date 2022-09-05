<?php
/*
* Plugin Name: Telegram Form Notifications
* Description: Easy send notifications about sunmited forms to telegram Bot or User
* Author: Alexey Geyvan, RivoAgency
* Text Domain: rivoforms
* Domain Path: /languages
* Version: 1.0
*/


  if ( ! defined( 'ABSPATH' ) ) exit;

  if(!defined("RFT_PLUGIN_FILE")) {
      define('RFT_PLUGIN_FILE', __FILE__);
  }
  if(!defined("RFT_PLUGIN_BASE")) {
      define('RFT_PLUGIN_BASE', plugin_basename(RFT_PLUGIN_FILE));
  } 
  if(!defined("RFT_DS")) {
      define("RFT_DS", DIRECTORY_SEPARATOR);
  }
  if(!defined("RFT_URL")) {
      define('RFT_URL', plugin_dir_url(__FILE__));
  }
  if(!defined("RFT_TEXTDOMAIN")) {
      define('RFT_TEXTDOMAIN', 'rivoforms');
  }
  if(!defined("RFT_VERSION")) {
      define('RFT_VERSION', "1.0");
  }


include_once plugin_dir_path(__FILE__)."includes/plugin.class.php";

$RFT_Plugin = RFT_Plugin::get_instance();
