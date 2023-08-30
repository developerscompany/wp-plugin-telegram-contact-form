<?php

class RFT_Admin_Pages_Integrations
{
    const SLUG  = RFT_Main::PREFIX . 'integrations';
    const TITLE = 'Integrations';

    public static function init()
    {
        add_action('admin_menu', [__CLASS__, 'add_menu'], 10000);
        RFT_Admin_Pages::$all_slugs[] = self::SLUG;
    }

    public static function add_menu()
    {
        add_submenu_page(
            RFT_Admin_Pages_About::SLUG,
            sprintf('%s %s', __( 'Rivo Telegram', RFT_TEXTDOMAIN ), __(self::TITLE, RFT_TEXTDOMAIN )),
            __( self::TITLE, RFT_TEXTDOMAIN ),
            RFT_Admin_Pages::CAPABILITY,
            self::SLUG,
            [__CLASS__, 'screen']
        );
    }

    public static function screen()
    {
        include_once RFT_PLUGIN_DIR . '/views/nav.php';
        include_once RFT_PLUGIN_DIR . '/views/pages/integrations.php';
    }

   function __construct() {
      add_action( 'wp_ajax_third_step_save', [ $this, 'third_step_save' ] );
      add_action( 'wp_ajax_nopriv_third_step_save', [ $this, 'third_step_save' ] );
   }

   static function third_step_save(){
       $integration_type = $_POST['integration_type'];
       $plugins_list = $_POST['plugins_list'];
      if($plugins_list){
         $plugins_to_add = $plugins_list;
      } else {
         $plugins_to_add = array();
      }

      RFT_Settings_Integrations::set(['type' => $integration_type, 'plugins' => $plugins_to_add]);
   }
}

$var = new RFT_Admin_Pages_Integrations();