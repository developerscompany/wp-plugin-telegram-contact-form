<?php
if ( ! defined( 'ABSPATH' ) ) exit;

class RFT_Plugin 
{    
    private static $instance = null;

    public static $settings;  

    private function __construct() {}   

    public static function get_instance(): self
    {
        if (null === self::$instance) {
            self::$instance = new self();
            self::$instance -> init();
        }

        return self::$instance;
    }


    public function init()
    {   
        spl_autoload_register(array($this, 'autoload'));

        self::$settings = RFT_Plugin_Settings::get_instance();      
        
        $admin_page = new RFT_Admin_Page( self::$settings );
        add_action('admin_menu', array($admin_page, 'admin_menu'), 10000); 
        add_action('admin_enqueue_scripts', array($admin_page, 'enqueue_styles'));
        add_action('admin_enqueue_scripts', array($admin_page, 'enqueue_scripts'));

        if ( is_array(self::$settings->get_settings()) 
             && array_key_exists("no_integrations", self::$settings->get_settings())
             && self::$settings->get_settings()['no_integrations']
        ){             
            $WP_Mail = RFT_WP_Mail::get_instance();
            add_filter('wp_mail', array( $WP_Mail, 'before_send_mail' ), 99);           
        }
        else {
            if ( in_array("wpcf7", self::$settings->get_active_mods()) ) {             
                $Wpcf7 = RFT_WPCF7::get_instance();
                add_action("wpcf7_before_send_mail", array($Wpcf7, 'before_send_mail') );            
            }
        }
                

        $rft_ajax = RFT_Ajax::get_instance( self::$settings );
        add_action('wp_ajax_rft_save_settings_admin_page', array($rft_ajax, 'rft_save_settings_admin_page'));

        add_filter( 'plugin_action_links_rivo-form-tm/index.php', array( $this, 'add_settings_link') );
        
    }



    public static function autoload(){  
        $files = array(           
            'RFT_Plugin_Settings' =>    RFT_DS . "includes" . RFT_DS . "settings.class.php",
            'RFT_Admin_Page' =>         RFT_DS . "includes" . RFT_DS . "admin-page.class.php",           
            'RFT_Bot_Sender' =>         RFT_DS . "includes" . RFT_DS . "bot-sender.class.php",           
            'RFT_Validate' =>           RFT_DS . "includes" . RFT_DS . "validate.class.php",           
            'RFT_Utility' =>            RFT_DS . "includes" . RFT_DS . "utility.class.php",           
            'RFT_Ajax' =>               RFT_DS . "includes" . RFT_DS . "ajax.class.php",           
            'RFT_Logger' =>             RFT_DS . "includes" . RFT_DS . "logger.class.php",
            'RFT_DB' =>                 RFT_DS . "includes" . RFT_DS . "db-helper.class.php",   
            'RFT_View' =>               RFT_DS . "view" . RFT_DS . "view.class.php",           
            'RFT_WPCF7' =>              RFT_DS . "integrations" . RFT_DS . "contact-form-7" . RFT_DS . "wpcf7.class.php",   
            'RFT_WP_Mail' =>            RFT_DS . "integrations" . RFT_DS . "wp-mail" . RFT_DS . "wp-mail.class.php", 
        );
        foreach ($files as $file) {            
            if (file_exists(dirname(dirname(__FILE__)) . $file)) {
                include_once dirname(dirname(__FILE__)) . $file;
            }
        }       
    }


    public function add_settings_link( $links ){ 
        $url = esc_url( add_query_arg(
            'page',
            'rivoforms_plugin_page',
            get_admin_url() . 'admin.php'
        ) );        
        $settings_link = "<a href='$url'>" . __( 'Settings' ) . '</a>';        
        array_push( $links, $settings_link );

        return $links;
    }
    

}






