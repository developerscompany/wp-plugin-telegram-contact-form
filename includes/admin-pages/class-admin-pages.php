<?php

class Rivo_WTS_Admin_Pages
{
    const CAPABILITY = 'manage_options';

    public static function init()
    {
        Rivo_WTS_Admin_Pages_About::init();
        Rivo_WTS_Admin_Pages_Bot::init();
        Rivo_WTS_Admin_Pages_Integrations::init();
        Rivo_WTS_Admin_Pages_Notifications::init();
    }

    public static function get_current_slug()
    {
        return $_GET['page'] ?? '';
    }

    public static function get_link($slug = '')
    {
        return admin_url('admin.php?page=' . $slug);
    }

    public static function nav()
    {
        $current = self::get_current_slug();

        $about_classes        = [];
        $bot_classes          = [];
        $intergations_classes = [];
        $notification_classes = [];

        $current == Rivo_WTS_Admin_Pages_About::SLUG && $about_classes[] = 'active';
        $current == Rivo_WTS_Admin_Pages_Bot::SLUG && $bot_classes[] = 'active';
        $current == Rivo_WTS_Admin_Pages_Integrations::SLUG && $intergations_classes[] = 'active';
        $current == Rivo_WTS_Admin_Pages_Notifications::SLUG && $notification_classes[] = 'active';

        $bot_settings           = Rivo_WTS_Settings_Bot::get();
        $integrations_settings  = Rivo_WTS_Settings_Integrations::get();
        $notifications_settings = Rivo_WTS_Settings_Notifications::get();


        !empty(Rivo_WTS_Admin_Pages_About::is_done()) && $about_classes[] = 'done';
        !empty($bot_settings['chat_ids']) && $bot_classes[] = 'done';
        !empty($integrations_settings['type']) && $intergations_classes[] = 'done';

        return [
            [
                'title'   => __(Rivo_WTS_Admin_Pages_About::TITLE, Rivo_WTS_TEXTDOMAIN),
                'link'    => self::get_link(Rivo_WTS_Admin_Pages_About::SLUG),
                'classes' => $about_classes
            ],
            [
                'title'   => __(Rivo_WTS_Admin_Pages_Bot::TITLE, Rivo_WTS_TEXTDOMAIN),
                'link'    => self::get_link(Rivo_WTS_Admin_Pages_Bot::SLUG),
                'classes' => $bot_classes
            ],
            [
                'title'   => __(Rivo_WTS_Admin_Pages_Integrations::TITLE, Rivo_WTS_TEXTDOMAIN),
                'link'    => self::get_link(Rivo_WTS_Admin_Pages_Integrations::SLUG),
                'classes' => $intergations_classes
            ],
            [
                'title'   => __(Rivo_WTS_Admin_Pages_Notifications::TITLE, Rivo_WTS_TEXTDOMAIN),
                'link'    => self::get_link(Rivo_WTS_Admin_Pages_Notifications::SLUG),
                'classes' => $notification_classes
            ]
        ];

    }
}