<?php
if ( ! defined( 'ABSPATH' ) ) exit;


class RFT_Admin_Page
{

    private static $settings;
    private static $settings_args;

    public function __construct( $settings = false ){
        if ($settings && $settings instanceof RFT_Plugin_Settings) {
            self::$settings = $settings;
        } else {
            self::$settings = RFT_Plugin_Settings::get_instance();
        }        
    }


    public function admin_menu(){
        add_menu_page(
            __( 'Telegram Forms Notifications Settings', 'rivoforms' ), 
            __( 'Telegram Forms Notifications', 'rivoforms' ), 
            'manage_options',
            'rivoforms_plugin_page',
            array($this, 'rivoforms_plugin_page'), 
            '', 
            99 );

        // add_submenu_page( 
        //     'rivoforms_plugin_page',
        //     __( 'Telegram Forms Notifications Settings', 'rivoforms' ), 
        //     __( 'Integrations', 'rivoforms' ),
        //     'manage_options',
        //     'rivoforms_integrations_page', 
        //     array($this, 'rivoforms_plugin_page'),  
        //     );
     
    }


    public function enqueue_scripts(){
        global $pagenow;
        if ( $pagenow == 'admin.php' && ($_GET['page'] == 'rivoforms_plugin_page') )  {
            // wp_enqueue_script( 'smart-tabs', RFT_URL . 'vendor/jQuerySmartTab/dist/js/jquery.smartTab.min.js' , array('jquery'), RFT_VERSION, true );           
            wp_enqueue_script( 'tabbis-master', RFT_URL . 'vendor/tabbis-master/assets/js/dist/tabbis.es5.min.js' , array(), RFT_VERSION, true );           
            wp_enqueue_script( 'rft-admin', RFT_URL . 'assets/js/admin.js' , array('jquery', 'tabbis-master'), RFT_VERSION, true );           
        }
    }


    public function enqueue_styles( $hook_suffix ){
        global $pagenow;
        if ( $pagenow == 'admin.php' && ($_GET['page'] == 'rivoforms_plugin_page') )  {
            wp_enqueue_style( 'tabbis-master', RFT_URL . 'vendor/tabbis-master/assets/css/dist/style-default.min.css', null, RFT_VERSION );
            wp_enqueue_style( 'rft-admin', RFT_URL . 'assets/css/admin.css', null, RFT_VERSION );
        }
    }


    public function rivoforms_plugin_page(){

        $View = RFT_View::get_instance( self::$settings );

        // self::$settings->delete_all_options();
        ?> 
        <div class="rft-wrapper">

            <h1 class="" style="margin-bottom:40px;" ><?php _e('Rivo Telegram Plugin Settings', 'rivoforms'); ?></h1>
            <?php wp_nonce_field( 'rft_adm_nonce_action', 'rft_adm_nonce' ); ?>

            <div class="rft-menu-tabs-wrapper">

                <?php $View->navbar(); ?>                

                <div class="rft-tab-content" data-panes>
                    <?php $View->general_tab(); ?>
                    <?php $View->integrations_tab(); ?>
                    <?php $View->wp_mail_intergration_tab(); ?>
                    <?php $View->wpcf7_intergration_tab(); ?>
                    <?php $View->woocommerce_intergration_tab(); ?>
                    <?php $View->telegram_bot_tab(); ?>
                    <?php $View->message_tab(); ?>
                </div>

            </div>

        </div>


            <?php

            // echo '<pre>';
            // var_dump(self::$settings->get_wpcf7_settings());
            // echo '</pre>';

            
            // self::$settings->delete_all_options();

    }


}