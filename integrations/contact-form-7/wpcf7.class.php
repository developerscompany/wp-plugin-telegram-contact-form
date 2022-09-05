<?php
if ( ! defined( 'ABSPATH' ) ) exit;

class RFT_WPCF7 {

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
    
    
    public function set_options( $settings ){ 
        self::$settings = $settings;
     }


    public function get_registered_forms( $only_ids = false ) {
        $wpcf_forms = array();
        $wpcf_query = new WP_Query( array( 
            'post_type' => 'wpcf7_contact_form',
            'per_page' => -1, 
            'fields' => 'ids' ) 
        ); 
        if ( $wpcf_query->have_posts() ) {                     
            foreach ($wpcf_query->get_posts() as $form_id) {
                if (!$only_ids) {
                    array_push( $wpcf_forms, array(
                        'id' => $form_id,
                        'title' => get_the_title($form_id)
                    ));
                } else {
                    array_push( $wpcf_forms, $form_id );
                }
            }
        } 
        wp_reset_postdata();
    
        return $wpcf_forms;
     }


    public function get_used_forms() {
        return self::$settings->get_wpcf7_option( 'forms_ids' );
    }


    public function get_forms() {
        $wpcf_registered_forms = $this->get_registered_forms();
        $wpcf_used_forms = $this->get_used_forms();
        $wpcf_forms = array();
        foreach ($wpcf_registered_forms as $form) {
            if ( in_array($form['id'], $wpcf_used_forms ) ){
                array_merge( $form, ['is_used' => true] );               
                array_push( $wpcf_forms, $form );               
            }
        }
        return $wpcf_forms;
    }


    public function fake_update_used_forms() {
        $form_ids = $this->get_registered_forms( true );
        self::$settings->update_wpcf7_option('forms_ids', $form_ids);
    }


    public function before_send_mail( &$WPCF7_ContactForm ){

        $form_id = $WPCF7_ContactForm->id();

        if ( ! in_array( $form_id, self::$settings->get_wpcf7_option('forms_ids') ) ) {
            return;            
        }

        if ( ! in_array('tm_bot', self::$settings->get_active_senders()) ){
            return;  
        }
        
        $tm_bot = RFT_Bot_Sender::get_instance( self::$settings );
        $tm_bot->send( $_POST, 'wpcf7' );
    }

}
