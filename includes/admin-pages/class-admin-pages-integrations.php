<?php

class Rivo_WTS_Admin_Pages_Integrations
{
    const SLUG  = Rivo_WTS_Main::PREFIX . 'integrations';
    const TITLE = 'Integrations';

    public static function init()
    {
        add_action('admin_menu', [__CLASS__, 'add_menu'], 10000);

        add_action('wp_ajax_rivo_wts_integrations_load_settings', [__CLASS__, 'ajax_load_settings']);
        add_action('wp_ajax_rivo_wts_integrations_save_settings', [__CLASS__, 'ajax_save_settings']);
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
        include_once Rivo_WTS_PLUGIN_DIR . '/views/pages/integrations.php';
    }

    public static function ajax_load_settings()
    {
        wp_send_json_success(['settings' => Rivo_WTS_Settings_Integrations::get()]);
    }

    public static function ajax_save_settings()
    {
        $payload = json_decode(stripslashes($_POST['payload']), ARRAY_A);

        if (empty($payload['type'])) {
            wp_send_json_error(['message' => __('Please select type', Rivo_WTS_TEXTDOMAIN)], 422);
        }

        if ($payload['type'] === Rivo_WTS_Settings_Integrations::TYPE_PLUGINS && empty($payload['plugins'])) {
            wp_send_json_error(['message' => __('Please select any form integration', Rivo_WTS_TEXTDOMAIN)], 422);
        }

        Rivo_WTS_Settings_Integrations::set([
            'type'    => $payload['type'],
            'plugins' => $payload['plugins']
        ]);

        wp_send_json_success();
    }
}