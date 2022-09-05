<?php
if ( ! defined( 'ABSPATH' ) ) exit;

class RFT_Bot_Sender
{
    private static $instance = null;

    private static $settings;   

    private static $bot_settings;   
    
    private function __construct() {}   

    public static function get_instance( $settings = false )
    {
        if (null === self::$instance) {
            self::$instance = new self(); 
            if ($settings && $settings instanceof RFT_Plugin_Settings) {
                self::$settings = $settings;
                self::$bot_settings = self::$settings->get_sender_settings('tm_bot');
            } else {
                self::$settings = RFT_Plugin_Settings::get_instance();
                self::$bot_settings = self::$settings->get_sender_settings('tm_bot');
            }
        }

        return self::$instance;
    }

    public function send( $post_data, $sender ){

        if ( !isset($post_data) || !is_array($post_data) ){
            throw new InvalidArgumentException(' wrong $post_data, array expected ');
            return;
        }

        $message = "";

        if ( $sender == 'wp_mail' ) {             
            $message = self::parse_message_text( $post_data, $sender );              
        } 
        else {
            $filtered_data = self::filter_post_data( $post_data );
            $filtered_data = self::filter_post_data( $post_data );
            $message = self::parse_message_text( $filtered_data, $sender );
        }
     

        $apiToken = self::$bot_settings['token'];
        $data = [
            'chat_id' => self::$bot_settings['chat_id'],
            'text' => $message,
            'parse_mode' => 'html',
            'disable_web_page_preview' => true
        ];        

        $response = file_get_contents("https://api.telegram.org/bot$apiToken/sendMessage?" . http_build_query($data) );
        
    }
    

    public static function parse_message_text( $data ){

        $msg = '';

        if ( self::$bot_settings['msg_text_before'] ){
            $msg .= self::$bot_settings['msg_text_before'] . chr(10) . chr(10);
        }
        
        foreach ($data as $field => $value) {
            $field = self::pretify_field_name($field);
            $msg .= $field . ": " . $value . chr(10);
        }      

        if( self::$bot_settings['msg_add_url'] ) {
            $msg .= chr(10) . 'form url: ' . $_SERVER['HTTP_REFERER'] . chr(10);
        }

        if ( self::$bot_settings['msg_text_after'] ){
            $msg .= self::$bot_settings['msg_text_after'];
        }

        return $msg;        
    }


    public static function filter_post_data( $post_data ){
 
        $filtered_post_data = array_filter( $post_data, function($key) {
            if (  str_contains( $key, '_' ) && strpos($key, '_') === 0 )  {
                //do nothing
            } else {
                return $key;
            }
        }, ARRAY_FILTER_USE_KEY);

        // $filtered_post_data = $post_data;

        // foreach ($post_data as $key => $value) {

        //     $filtered_post_data[$key] = urlencode($value);
            
        //     if (  str_contains( $key, '_' ) && strpos($key, '_') === 0 )  {
        //         unset( $filtered_post_data[$key] );
        //     } 
            
        // }
        

        return $filtered_post_data;
    }


    
    public static function pretify_field_name( $fieldName ){
        if( !$fieldName || !is_string($fieldName) ){
            return;
        }

        $input_settings = self::$settings->get_input_settings();

        $new_fieldName = $fieldName;

        foreach ($input_settings as $option) {

            if ( $option['original'] == $fieldName  ) 
            { 
                if ( array_key_exists('replace', $option) && !empty($option['replace']) ){
                   $new_fieldName = RFT_Utility::clean_input_string( $option['replace'] );
                }
                
                if ( array_key_exists('bold', $option) && $option['bold'] === 'true' ){
                   $new_fieldName = "<b>" . $new_fieldName . "</b>";
                }
                
                if ( array_key_exists('italic', $option) && $option['italic'] === 'true' ){
                   $new_fieldName = "<i>" . $new_fieldName . "</i>";
                }
                
                if ( array_key_exists('emoji', $option) && !empty($option['emoji']) ){
                   $new_fieldName = $option['emoji'] . " " . $new_fieldName;
                }
            }


        }
        
        return $new_fieldName;        
    }


}