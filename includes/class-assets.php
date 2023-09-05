<?php

class Rivo_WTS_Assets
{
    public static function init()
    {
        add_action('admin_enqueue_scripts', [__CLASS__, 'enqueue']);
    }

    public static function enqueue()
    {
        if (in_array(Rivo_WTS_Admin_Pages::get_current(), Rivo_WTS_Admin_Pages::$all_slugs))  {
            wp_enqueue_style( Rivo_WTS_Main::PREFIX . 'style-admin', self::getUrlWithVersion('/css/admin.css'));
            wp_enqueue_script( Rivo_WTS_Main::PREFIX . 'script-admin', self::getUrlWithVersion('/js/admin.js') , ['jquery'], false, true );
            wp_localize_script( Rivo_WTS_Main::PREFIX . 'script-admin', 'frontend_ajax_object', ['ajaxurl' => admin_url( 'admin-ajax.php' )] );
        }


        if(Rivo_WTS_Admin_Pages::get_current() === Rivo_WTS_Admin_Pages_Bot::SLUG) {
            wp_enqueue_script( Rivo_WTS_Main::PREFIX . 'script-admin-bot', self::getUrlWithVersion('/js/admin-bot.js') , ['jquery'], false, true );
            wp_localize_script( Rivo_WTS_Main::PREFIX . 'script-admin-bot', 'frontend_ajax_object', ['ajaxurl' => admin_url( 'admin-ajax.php' )] );
        }

        if(Rivo_WTS_Admin_Pages::get_current() === Rivo_WTS_Admin_Pages_Integrations::SLUG) {
            wp_enqueue_script( Rivo_WTS_Main::PREFIX . 'script-admin-integrations', self::getUrlWithVersion('/js/admin-integrations.js') , ['jquery'], false, true );
            wp_localize_script( Rivo_WTS_Main::PREFIX . 'script-admin-integrations', 'frontend_ajax_object', ['ajaxurl' => admin_url( 'admin-ajax.php' )] );
        }

        if(Rivo_WTS_Admin_Pages::get_current() === Rivo_WTS_Admin_Pages_Notifications::SLUG) {
           wp_enqueue_style( Rivo_WTS_Main::PREFIX . 'style-select2', plugins_url('wp-plugin-telegram-contact-form/assets/dist/css/select2.min.css' ));
           wp_enqueue_script( Rivo_WTS_Main::PREFIX . 'script-select2', plugins_url('wp-plugin-telegram-contact-form/assets/dist/js/select2.min.js') , ['jquery'], false, true );

            wp_enqueue_script( Rivo_WTS_Main::PREFIX . 'script-admin-notifications', self::getUrlWithVersion('/js/admin-notifications.js') , ['jquery'], false, true );
            wp_localize_script( Rivo_WTS_Main::PREFIX . 'script-admin-notifications', 'frontend_ajax_object', ['ajaxurl' => admin_url( 'admin-ajax.php' )] );
        }
    }

    public static function getUrlWithVersion($file = '')
    {
        $assetsMap = json_decode( file_get_contents( Rivo_WTS_PLUGIN_DIR . '/assets/dist/mix-manifest.json' ), true );

        if(isset($assetsMap[$file])) {
            return sprintf('%s/assets/dist/%s', Rivo_WTS_URL, $assetsMap[$file]);
        }

        return $file;
    }
}