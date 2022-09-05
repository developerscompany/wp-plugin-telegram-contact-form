<?php
if ( ! defined( 'ABSPATH' ) ) exit;

class RFT_Plugin_Settings
{

    /* List of used option names
    *
    * rivo_general_option
    * rivo_wpcf7_option
    * rivo_woocommerce_option
    * rivo_wp_mail_option
    * rivo_senders_option
    * rivo_inputs_option   
    */

    private static $general_settings;
    private static $wpcf7_settings;
    private static $woocommerce_settings;
    private static $wp_mail_settings;
    private static $senders_settings;    
    private static $input_settings;

    private CONST default_general_settings = array(
        'version' => RFT_VERSION,     
        'active_mods' => array('wpcf7', 'wc'),
        'active_senders' => array('tm_bot'),
        'no_integrations' => 'true',
        'integrations' => array('wpcf7', 'wc'),
        'active_plugins' => array(),
    );

    private CONST default_sender_settings = array(
        'tm_bot' => array(
            'name' => 'tm_bot',                       
            'token' => '',        
            'chat_id' => '',        
            'msg_add_url' => 'true',  
            'msg_text_before' => '',
            'msg_text_after' => '',      
        ), 
        'tm_user' => array(
            'name' => 'tm_user',                      
            'api_id' => '',
            'api_hash' => '',
            'public_key' => '',
        ), 
    );

    private CONST default_input_settings = array(
        array(
            'id' => 1,
            'emoji' => '👤',                       
            'original' => 'user-name',        
            'replace' => "Iм'я",        
            'bold' => 'false',  
            'italic' => 'false',
            'active' => 'false'
        ),        
        array(
            'id' => 2,
            'emoji' => '✉️',                       
            'original' => 'user-email',        
            'replace' => "email",        
            'bold' => 'false',  
            'italic' => 'false',
            'active' => 'false'          
        ),  
        array(
            'id' => 3,
            'emoji' => "",                       
            'original' => "",        
            'replace' => "",        
            'bold' => "false",  
            'italic' => "false",
            'active' => 'false'          
        ),         
        array(
            'id' => 4,
            'emoji' => "",                       
            'original' => "",        
            'replace' => "",        
            'bold' => "false",  
            'italic' => "false",
            'active' => 'false'          
        ),         
        array(
            'id' => 5,
            'emoji' => "",                       
            'original' => "",        
            'replace' => "",        
            'bold' => "false",  
            'italic' => "false",
            'active' => 'false'          
        ),         
        array(
            'id' => 6,
            'emoji' => "",                       
            'original' => "",        
            'replace' => "",        
            'bold' => "false",  
            'italic' => "false",
            'active' => 'false'          
        ),         
        array(
            'id' => 7,
            'emoji' => "",                       
            'original' => "",        
            'replace' => "",        
            'bold' => "false",  
            'italic' => "false",
            'active' => 'false'          
        ),         
        array(
            'id' => 8,
            'emoji' => "",                       
            'original' => "",        
            'replace' => "",        
            'bold' => "false",  
            'italic' => "false",
            'active' => 'false'          
        ),         
        array(
            'id' => 9,
            'emoji' => "",                       
            'original' => "",        
            'replace' => "",        
            'bold' => "false",  
            'italic' => "false",
            'active' => 'false'          
        ),         
        array(
            'id' => 10,
            'emoji' => "",                       
            'original' => "",        
            'replace' => "",        
            'bold' => "false",  
            'italic' => "false",
            'active' => 'false'          
        ),         
    );

    private CONST default_wpcf7_settings = array( 
        'name' => 'wpcf7',        
        'display_name' => 'Contact Form 7',
        'description' => 'Sends message to telegram each time a choosen Contact-Form-7 is submitted',
        'disabled' => 'false',                
        'forms_ids' => array(),  
        'msg_text_before' => '',      
        'prevent_email' => 'false'    
    );  

    private CONST default_woocommerce_settings = array( 
        'name' => 'wc',        
        'display_name' => 'Woocommerce',
        'description' => 'Sends message to telegram each time a WooCommerce order is submitted',
        'disabled' => 'false', 
        'msg_text_before' => '',      
        'prevent_email' => 'false'    
    );  

    private CONST default_wp_mail_settings = array(
        'name' => 'wp_mail',        
        'display_name' => 'All default WordPress Emails', 
        'description' => 'Sends message to telegram each time an email is send (using global wp_mail)',
        'disabled' => 'false',
        'msg_text_before' => '',
        'prevent_email' => 'false'
    );
    
        
        
    private static $instance = null;

    private function __construct() {}   

    public static function get_instance()
    {
        if (null === self::$instance) {
            self::$instance = new self();
            self::$instance -> init();            
        }

        return self::$instance;
    }
    
    
    public function init(){ 

        self::$general_settings = get_option('rivo_general_option');
        self::$general_settings = is_array(self::$general_settings) ? self::$general_settings : array();
        if ( count(self::$general_settings) == 0 ) {
           $this->install();
        }

        self::$senders_settings = get_option('rivo_senders_option');
        self::$wpcf7_settings = get_option('rivo_wpcf7_option');        
        self::$woocommerce_settings = get_option('rivo_woocommerce_option');        
        self::$wp_mail_settings = get_option('rivo_wp_mail_option');
        self::$input_settings = get_option('rivo_inputs_option');

        $this->set_active_plugins();
    }


    public function install(){

        self::$general_settings = self::default_general_settings;
        add_option( 'rivo_general_option', self::$general_settings );

        self::$wpcf7_settings = self::default_wpcf7_settings;
        add_option( 'rivo_wpcf7_option', self::$wpcf7_settings );

        self::$woocommerce_settings = self::default_woocommerce_settings;
        add_option( 'rivo_woocommerce_option', self::$woocommerce_settings );

        self::$wp_mail_settings = self::default_wp_mail_settings;
        add_option( 'rivo_wp_mail_option', self::$wp_mail_settings ); 
        
        self::$senders_settings = self::default_sender_settings;
        add_option( 'rivo_senders_option', self::$senders_settings ); 
        
        self::$input_settings = self::default_input_settings;
        add_option( 'rivo_inputs_option', self::$input_settings ); 

        // $this->update_active_mods();
        // $this->update_active_senders();
    }


    public function get_settings(){      
        return self::$general_settings;
    }
    
    public function get_option( $option_name ){ 
        if ( array_key_exists($option_name, self::$general_settings) ) {
            return self::$general_settings[$option_name];
        }
    }


    public function get_mods_list(){           
        return self::$general_settings['integrations'];
    }  

    public function get_wpcf7_settings(){      
        return self::$wpcf7_settings;
    }

    public function get_wc_settings(){      
        return self::$woocommerce_settings;
    }

    public function get_wp_mail_settings(){      
        return self::$wp_mail_settings;
    }

    public function get_input_settings(){      
        return self::$input_settings;
    }

    public function update_input_settings( $settings ){      
        self::$input_settings = $settings;
        update_option( 'rivo_inputs_option',  self::$input_settings );
    }

    
    
    public function get_sender_settings( $sender_name ){              
        if ( !array_key_exists( $sender_name, self::$senders_settings ) ){            
            throw new InvalidArgumentException(' invalid "$sender_name" ');           
        } 

        return self::$senders_settings[$sender_name];       
    }


    public function get_active_mods(){        
        return self::$general_settings['active_mods'];
    }


    public function get_active_senders(){
        return self::$general_settings['active_senders'];
    }


    public function mod_is_active( $mod_name ){
        if ( in_array($mod_name, self::$general_settings['active_mods']) ){
            return true;
        }
        return false;
    }


    public function get_active_plugins(){      
        return self::$general_settings['active_plugins'];
    }


    public function get_mod_settings( $mod_name ){
        
        if ( !in_array($mod_name, self::$general_settings['integrations']) ) {
            throw new InvalidArgumentException (' $mod_name incorrect ');
            return;
        }
        
        switch ($mod_name) {
            case 'wpcf7':
                return $this->get_wpcf7_settings();
                break;
            
            case 'wc':
                return $this->get_wc_settings();             
                break;            
        }
       
    }


    public function get_wpcf7_option( $option ){
        if ( !array_key_exists($option, self::$wpcf7_settings) ) {
            throw new InvalidArgumentException(' option does not exist ');  
        } else {
            return self::$wpcf7_settings[$option];
        }
    }




    public function add_option($option, $value){        
        if ( array_key_exists($option, self::$general_settings) ) {
            self::$general_settings[$option] = $value;           
        } else {
            $new_settings = array( $option => $value );
            self::$general_settings = array_merge(self::$general_settings, $new_settings);            
        } 
        
        update_option( 'rivo_general_option', self::$general_settings );
    }


    public function update_option($option, $value){
        if ( !array_key_exists($option, self::$general_settings) ) {
            throw new InvalidArgumentException(' option does not exist ');
        }  else {
            self::$general_settings[$option] = $value;            
        }  

        update_option( 'rivo_general_option',  self::$general_settings );    
    }


    public function add_sender_option($sender, $option, $value){        
        if ( !array_key_exists($sender, self::$senders_settings) ) {
            throw new InvalidArgumentException(' invalid "$sender" ');  
        } else {
            if ( !in_array($option, self::$senders_settings[$sender]) ) {
                $new_option = array( $option => $value );
                self::$senders_settings[$sender] = array_merge(self::$senders_settings[$sender], $new_option);
            } else {
                self::$senders_settings[$sender][$option] = $value;
            }

            update_option( 'rivo_senders_option', self::$senders_settings );                        
        } 
    }

    
    public function update_sender_option($sender, $option, $value){
        if ( !array_key_exists($sender, self::$senders_settings) ) {
            throw new InvalidArgumentException(' invalid "sender" ');  
        } else {
            if ( !array_key_exists($option, self::$senders_settings[$sender]) ) {
                throw new InvalidArgumentException(' option does not exist ');  
            } else {
                self::$senders_settings[$sender][$option] = $value;
                update_option( 'rivo_senders_option', self::$senders_settings );
            }
        }
    }


    public function add_wpcf7_option( $option, $value){ 
        if ( !array_key_exists($option, self::$wpcf7_settings) ) {
            $new_option = array( $option => $value );
            self::$wpcf7_settings = array_merge(self::$wpcf7_settings, $new_option);
        } else {
            self::$wpcf7_settings[$option] = $value;
        }

        update_option( 'rivo_wpcf7_option',  self::$wpcf7_settings );
    }


    public function update_wpcf7_option( $option, $value){        
        if ( !array_key_exists($option, self::$wpcf7_settings)  ) {
            throw new InvalidArgumentException(' option does not exist ');
            return false;  
        } else {          
            self::$wpcf7_settings[$option] = $value;

            update_option( 'rivo_wpcf7_option',  self::$wpcf7_settings );
        }   

        return true; 
    }    
    

    public function add_wp_mail_option( $option, $value){ 
        if ( !array_key_exists($option, self::wp_mail_settings) ) {
            $new_option = array( $option => $value );
            self::$wp_mail_settings = array_merge(self::$wp_mail_settings, $new_option);
        } else {
            self::$wp_mail_settings[$option] = $value;
        }

        update_option( 'rivo_wpcf7_option',  self::$wpcf7_settings );
    }


    public function update_wp_mail_option( $option, $value){        
        if ( !array_key_exists($option, self::$wp_mail_settings)  ) {
            throw new InvalidArgumentException(' option does not exist ');  
        } else {          
            self::$wp_mail_settings[$option] = $value;

            update_option( 'rivo_wp_mail_option',  self::$wp_mail_settings );
        }        
    }  


    public function add_woocommerce_option( $option, $value){ 
        if ( !array_key_exists($option, self::woocommerce_settings) ) {
            $new_option = array( $option => $value );
            self::$woocommerce_settings = array_merge(self::$woocommerce_settings, $new_option);
        } else {
            self::$woocommerce_settings[$option] = $value;
        }

        update_option( 'rivo_woocommerce_option',  self::$woocommerce_settings );
    }


    public function update_woocommerce_option( $option, $value){        
        if ( !array_key_exists($option, self::$woocommerce_settings)  ) {
            throw new InvalidArgumentException(' option does not exist ');  
        } else {          
            self::$woocommerce_settings[$option] = $value;

            update_option( 'rivo_woocommerce_option',  self::$woocommerce_settings );
        }        
    }


    public function set_active_plugins(){  

        $active_plugins = array();

        // if ( is_plugin_active( 'contact-form-7/wp-contact-form-7.php' ) ) {
        //     array_push($active_plugins, 'wpcf7');
        // }

        if ( class_exists( 'WPCF7' ) ) {
            array_push($active_plugins, 'wpcf7');
        }

        if ( class_exists( 'WooCommerce' ) ) {
            array_push($active_plugins, 'wc');
        }

        self::$general_settings['active_plugins'] = $active_plugins;
    }


    public function delete_all_options(){
        delete_option( 'rivo_general_option');
        delete_option( 'rivo_wpcf7_option');
        delete_option( 'rivo_wp_mail_option');
        delete_option( 'rivo_senders_option');
        delete_option( 'rivo_inputs_option');
    }   

    

}