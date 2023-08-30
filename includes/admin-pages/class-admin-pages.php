<?php

class Rivo_WTS_Admin_Pages
{
    const CAPABILITY = 'manage_options';

    public static $all_slugs = [];

    public static function init()
    {
        Rivo_WTS_Admin_Pages_About::init();
        Rivo_WTS_Admin_Pages_Bot::init();
        Rivo_WTS_Admin_Pages_Integrations::init();
        Rivo_WTS_Admin_Pages_Notifications::init();
    }

    public static function get_current()
    {
        return $_GET['page'] ?? '';
    }

    public static function get_link($slug = '')
    {
        return admin_url('admin.php?page=' . $slug);
    }
}