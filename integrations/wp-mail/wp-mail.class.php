<?php
if ( ! defined( 'ABSPATH' ) ) exit;

class RFT_WP_Mail
{

    private static $instance = null;
    
    private static $settings;

    private function __construct() {}   

    public static function get_instance( $settings = false )
    {
        if (null === self::$instance) {
            self::$instance = new self();
            if ($settings && $settings instanceof RFT_Plugin_Settings) {
                self::$settings = $settings;
            } else {
                self::$settings = RFT_Plugin_Settings::get_instance();
            }                      
        }

        return self::$instance;
    }


    public function before_send_mail( $args ){

        $post_data = $args;

        if ( !is_array($post_data) ) {            
            return;
        }        

        if ( array_key_exists('headers', $post_data) ){
            unset($post_data['headers']);
        }

        if ( array_key_exists('attachments', $post_data) && is_array($post_data['attachments']) && count($post_data['attachments']) == 0 ){
            unset($post_data['attachments']);
        }

        if ( array_key_exists('subject', $post_data) && empty($post_data['subject']) ){
            unset($post_data['subject']);
        }
        

        if ( in_array('tm_bot', self::$settings->get_active_senders()) ){

            $new_post_data = $post_data;
            foreach ($new_post_data as $key => $value) {
               $new_post_data[$key] = htmlspecialchars($value, null, null, false);
            }
            $tm_bot = RFT_Bot_Sender::get_instance( self::$settings );
            $tm_bot->send( $new_post_data, 'wp_mail' );
        } 

        return $args;
        
    }

}