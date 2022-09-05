<?php 
if ( ! defined( 'ABSPATH' ) ) exit;

class RFT_View
{
    private static $settings;

    private static $wpcf7_settings;
    private static $wp_mail_settings;
    private static $tm_bot_settings;
    private static $wc_settings;
    
    private static $instance = null;
    
    private function __construct() {} 
    
    public static function get_instance( $settings = false )
    {
        if (null === self::$instance) {
            self::$instance = new self();
            if ($settings != false) {
                self::$settings = $settings;
            } else {
                self::$settings = RFT_Plugin_Settings::get_instance();
            }
            self::$wpcf7_settings = self::$settings->get_wpcf7_settings();        
            self::$wp_mail_settings = self::$settings->get_wp_mail_settings();        
            self::$wc_settings = self::$settings->get_wc_settings();        
            self::$tm_bot_settings = self::$settings->get_sender_settings('tm_bot');
        }
    
        return self::$instance;
    }

    
    public function navbar() {
        require_once 'navbar.php';
        return;
    }

    public function general_tab() {       
        require_once 'general_tab.php';
        return;
    }

    public function integrations_tab() {    
        require_once 'integrations_tab.php';
        return;
    }

    public function wp_mail_intergration_tab() {    
        require_once 'wp_mail_intergration_tab.php';
        return;
    }

    public function wpcf7_intergration_tab() {    
        require_once 'wpcf7_intergration_tab.php';
        return;
    }

    public function woocommerce_intergration_tab() {    
        require_once 'woocommerce_intergration_tab.php';
        return;
    }
    
    public function telegram_bot_tab(){
        require_once 'telegram_bot_tab.php';
        return;
    }

    public function message_tab() {
        require_once 'message_tab.php';        
        return;
    }
    
    
}






