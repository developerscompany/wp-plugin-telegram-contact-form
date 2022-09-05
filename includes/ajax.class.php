<?php
if ( ! defined( 'ABSPATH' ) ) exit;

class RFT_Ajax
{

    private static $settings;

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
        }

        return self::$instance;
    }

    public function rft_save_settings_admin_page() {

        if ( !isset( $_POST['nonce'] ) || !wp_verify_nonce( $_POST['nonce'], 'rft_adm_nonce_action' ) ) {
            wp_die('nonce error');
        } 

        $msg = array();
        $errors = array();

        if ( isset( $_POST['watchedForms']) && !empty($_POST['watchedForms']) ){ 
            $watchedForms = $_POST['watchedForms'] != 'none' ? $_POST['watchedForms'] : array();                     
            self::$settings->update_wpcf7_option( 'forms_ids', $watchedForms );
        } else { 
            array_push( $errors, 'Please, select at least one form');
        }


        if ( isset( $_POST['integrations']) && !empty($_POST['integrations']) ){
            if ($_POST['integrations'] === "none") {
                self::$settings->update_option( 'active_mods', array() );
                self::$settings->update_option( 'no_integrations', true );
            } 
            else {
                self::$settings->update_option( 'active_mods', $_POST['integrations'] );
                self::$settings->update_option( 'no_integrations', false );
            }                            
        } 


        if ( isset( $_POST['preventEmails']) && is_array($_POST['preventEmails']) && 0 < count($_POST['preventEmails']) ){
            if( in_array('wp_mail', $_POST['preventEmails']) ){        
                self::$settings->update_wp_mail_option('prevent_email', 'true');              
            }
            if( in_array('wpcf7', $_POST['preventEmails']) ){        
               self::$settings->update_wpcf7_option('prevent_email', 'true');               
            }
            if( in_array('wc', $_POST['preventEmails']) ){        
               self::$settings->update_woocommerce_option('prevent_email', 'true');               
            }
        }
        

        if ( isset( $_POST['botToken']) && !empty($_POST['botToken']) ){
            $botToken = trim( strval($_POST['botToken']) );
            if ( RFT_Validate::bot_token($botToken) ) {
                $botSettings = self::$settings->get_sender_settings('tm_bot');              
                $currentToken =  strval($botSettings['token']);          
                if (  $currentToken != $botToken ) {               
                    self::$settings->update_sender_option('tm_bot', 'token', $botToken);              
                }
            } else {
                array_push( $errors, 'Bot Token incorect');
            }
        }


        if ( isset($_POST['chatId']) && !empty($_POST['chatId']) ){            
            $chatId = $_POST['chatId']; 
            if ( RFT_Validate::chat_id($chatId) ){
                self::$settings->update_sender_option('tm_bot', 'chat_id', $chatId );
            } else {
                array_push( $errors, "Chat id is incorrect"); 
            }
        }

        
        if ( isset( $_POST['beforeMsgTxt']) ){             
            $beforeMsgTxt = $_POST['beforeMsgTxt'];           
            self::$settings->update_sender_option( 'tm_bot', 'msg_text_before', $beforeMsgTxt );                           
        }
        

        if ( isset( $_POST['inputFormat']) ){ 
            self::$settings->update_input_settings( $_POST['inputFormat'] );                           
        }


        if ( isset( $_POST['botAddUrl']) ){
            $botAddUrl = $_POST['botAddUrl'];           
            self::$settings->update_sender_option('tm_bot', 'msg_add_url', $botAddUrl);
        }
        
        if ( count($errors) > 0 ) {
            wp_die( json_encode($errors) );
        }

        wp_die( 'ok' );
    }
    
}

