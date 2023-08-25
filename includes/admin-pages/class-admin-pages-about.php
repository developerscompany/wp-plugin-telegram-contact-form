<?php

class RFT_Admin_Pages_About
{
    const SLUG  = RFT_Main::PREFIX . 'about';
    const TITLE = 'About Plugin';

    public static function init()
    {
        add_action('admin_menu', [__CLASS__, 'add_menu'], 10000);
        RFT_Admin_Pages::$all_slugs[] = self::SLUG;
    }

    public static function add_menu()
    {
        add_menu_page(
            __( 'Rivo Telegram', RFT_TEXTDOMAIN ),
            __( 'Rivo Telegram', RFT_TEXTDOMAIN ),
            RFT_Admin_Pages::CAPABILITY,
            self::SLUG,
            [__CLASS__, 'screen'],
            RFT_URL . '/assets/dist/images/menu-icon.svg',
            99);

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
        include_once RFT_PLUGIN_DIR . '/views/pages/about.php';
    }
}