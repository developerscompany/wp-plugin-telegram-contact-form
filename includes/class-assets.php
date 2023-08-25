<?php

class RFT_Assets
{
    public static function init()
    {
        add_action('admin_enqueue_scripts', [__CLASS__, 'enqueue']);
    }

    public static function enqueue()
    {
        if (in_array(RFT_Admin_Pages::get_current(), RFT_Admin_Pages::$all_slugs))  {
            wp_enqueue_style( RFT_Main::PREFIX . 'style-admin', self::getUrlWithVersion('/css/admin.css'));
            wp_enqueue_script( RFT_Main::PREFIX . 'script-admin', self::getUrlWithVersion('/js/admin.js') , ['jquery'], false, true );
            wp_localize_script( RFT_Main::PREFIX . 'script-admin', 'frontend_ajax_object', ['ajaxurl' => admin_url( 'admin-ajax.php' )] );
        }


        if(RFT_Admin_Pages::get_current() === RFT_Admin_Pages_Bot::SLUG) {
            wp_enqueue_script( RFT_Main::PREFIX . 'script-admin-bot', self::getUrlWithVersion('/js/admin-bot.js') , ['jquery'], false, true );
            wp_localize_script( RFT_Main::PREFIX . 'script-admin-bot', 'frontend_ajax_object', ['ajaxurl' => admin_url( 'admin-ajax.php' )] );
        }

        if(RFT_Admin_Pages::get_current() === RFT_Admin_Pages_Integrations::SLUG) {
            wp_enqueue_script( RFT_Main::PREFIX . 'script-admin-integrations', self::getUrlWithVersion('/js/admin-integrations.js') , ['jquery'], false, true );
            wp_localize_script( RFT_Main::PREFIX . 'script-admin-integrations', 'frontend_ajax_object', ['ajaxurl' => admin_url( 'admin-ajax.php' )] );
        }

        if(RFT_Admin_Pages::get_current() === RFT_Admin_Pages_Notifications::SLUG) {
            wp_enqueue_script( RFT_Main::PREFIX . 'script-admin-notifications', self::getUrlWithVersion('/js/admin-notifications.js') , ['jquery'], false, true );
            wp_localize_script( RFT_Main::PREFIX . 'script-admin-notifications', 'frontend_ajax_object', ['ajaxurl' => admin_url( 'admin-ajax.php' )] );
        }
    }

    public static function getUrlWithVersion($file = '')
    {
        $assetsMap = json_decode( file_get_contents( RFT_PLUGIN_DIR . '/assets/dist/mix-manifest.json' ), true );

        if(isset($assetsMap[$file])) {
            return sprintf('%s/assets/dist/%s', RFT_URL, $assetsMap[$file]);
        }

        return $file;
    }
}