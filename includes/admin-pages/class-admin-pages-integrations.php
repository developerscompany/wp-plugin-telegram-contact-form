<?php

class Rivo_WTS_Admin_Pages_Integrations
{
    const SLUG  = Rivo_WTS_Main::PREFIX . 'integrations';
    const TITLE = 'Integrations';

    public static function init()
    {
        add_action('admin_menu', [__CLASS__, 'add_menu'], 10000);
        Rivo_WTS_Admin_Pages::$all_slugs[] = self::SLUG;

        add_action( 'wp_ajax_third_step_save', [ __CLASS__, 'third_step_save' ] );
    }

    public static function add_menu()
    {
        add_submenu_page(
            Rivo_WTS_Admin_Pages_About::SLUG,
            sprintf('%s %s', __( 'Rivo Telegram', Rivo_WTS_TEXTDOMAIN ), __(self::TITLE, Rivo_WTS_TEXTDOMAIN )),
            __( self::TITLE, Rivo_WTS_TEXTDOMAIN ),
            Rivo_WTS_Admin_Pages::CAPABILITY,
            self::SLUG,
            [__CLASS__, 'screen']
        );
    }

    public static function screen()
    {
        include_once Rivo_WTS_PLUGIN_DIR . '/views/nav.php';
        include_once Rivo_WTS_PLUGIN_DIR . '/views/pages/integrations.php';
    }

   public static function third_step_save(){
       $integration_type = $_POST['integration_type'];
       $plugins_list = $_POST['plugins_list'];
      if($plugins_list){
         $plugins_to_add = $plugins_list;
      } else {
         $plugins_to_add = array();
      }

       Rivo_WTS_Settings_Integrations::set(['type' => $integration_type, 'plugins' => $plugins_to_add]);
   }
}