<?php

class RFT_Admin_Pages_Notifications
{
    const SLUG  = RFT_Main::PREFIX . 'notifications';
    const TITLE = 'Notification Settings';

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
        include_once RFT_PLUGIN_DIR . '/views/pages/notifications.php';
    }
}