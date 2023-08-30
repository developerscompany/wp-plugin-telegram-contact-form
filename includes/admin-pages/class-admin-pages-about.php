<?php

class Rivo_WTS_Admin_Pages_About
{
    const SLUG  = Rivo_WTS_Main::PREFIX . 'about';
    const TITLE = 'About Plugin';

    public static function init()
    {
        add_action('admin_menu', [__CLASS__, 'add_menu'], 10000);
        Rivo_WTS_Admin_Pages::$all_slugs[] = self::SLUG;
    }

    public static function add_menu()
    {
        add_menu_page(
            __( 'Rivo Telegram', Rivo_WTS_TEXTDOMAIN ),
            __( 'Rivo Telegram', Rivo_WTS_TEXTDOMAIN ),
            Rivo_WTS_Admin_Pages::CAPABILITY,
            self::SLUG,
            [__CLASS__, 'screen'],
            Rivo_WTS_URL . '/assets/dist/images/menu-icon.svg',
            99);

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
        include_once Rivo_WTS_PLUGIN_DIR . '/views/pages/about.php';
    }
}