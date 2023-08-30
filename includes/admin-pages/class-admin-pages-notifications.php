<?php

class Rivo_WTS_Admin_Pages_Notifications
{
    const SLUG  = Rivo_WTS_Main::PREFIX . 'notifications';
    const TITLE = 'Notification Settings';

    public static function init()
    {
        add_action('admin_menu', [__CLASS__, 'add_menu'], 10000);
        Rivo_WTS_Admin_Pages::$all_slugs[] = self::SLUG;
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
        include_once Rivo_WTS_PLUGIN_DIR . '/views/pages/notifications.php';
    }
}