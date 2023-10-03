<?php

class Rivo_WTS_Admin_Pages_Notifications
{
    const SLUG  = Rivo_WTS_Main::PREFIX . 'notifications';
    const TITLE = 'Notification Settings';
    public static function init()
    {
        add_action('admin_menu', [__CLASS__, 'add_menu'], 10000);
        add_action('wp_ajax_notifications_load_settings', [__CLASS__, 'load_settings']);
        add_action('wp_ajax_notifications_save_settings', [__CLASS__, 'save_settings']);
    }

    public static function add_menu()
    {
        add_submenu_page(
            Rivo_WTS_Admin_Pages_About::SLUG,
            sprintf('%s %s', __('Rivo Telegram', Rivo_WTS_TEXTDOMAIN), __(self::TITLE, Rivo_WTS_TEXTDOMAIN)),
            __(self::TITLE, Rivo_WTS_TEXTDOMAIN),
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
    public static function load_settings()
    {
        $forms = Rivo_WTS_Integrations::get_forms_list();

        foreach ($forms as $form_key => &$form_data) {
            $form_data = array_merge(['name' => $form_data], Rivo_WTS_Settings_Notifications::get_form_settings($form_key));
        }

        wp_send_json_success([
            'forms'          =>     $forms,
            'sample_replace' => Rivo_WTS_Settings_Notifications::example_form_data()
        ]);
    }

    public static function save_settings()
    {
        $payload = json_decode(stripslashes($_POST['payload']), ARRAY_A);

        if(empty($payload['forms'])) {
            wp_send_json_error(['message' => 'Error'], 422);
        }

        Rivo_WTS_Settings_Notifications::set(['forms' => $payload['forms']]);

        wp_send_json_success();
    }
}