<?php

class Rivo_WTS_Admin_Pages_Bot
{
    const SLUG  = Rivo_WTS_Main::PREFIX . 'bot';
    const TITLE = 'Telegram Bot Settings';

    public static function init()
    {
        add_action('admin_menu', [__CLASS__, 'add_menu'], 10000);
        add_action('wp_ajax_rivo_wts_bot_save_token', [__CLASS__, 'ajax_save_token']);
        add_action('wp_ajax_rivo_wts_bot_load_settings', [__CLASS__, 'ajax_load_settings']);
        add_action('wp_ajax_rivo_wts_bot_save_settings', [__CLASS__, 'ajax_save_settings']);
        add_action('wp_ajax_rivo_wts_bot_send_test_message', [__CLASS__, 'ajax_send_test_message']);
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
        include_once Rivo_WTS_PLUGIN_DIR . '/views/pages/bot.php';
    }

    public static function ajax_save_token()
    {
        $payload = json_decode(stripslashes($_POST['payload']), ARRAY_A);

        if (empty($payload['token'])) {
            return wp_send_json_error(['message' => 'Empty token'], 422);
        }

        try {
            Rivo_WTS_Bot::get_me($payload['token']);
            Rivo_WTS_Settings_Bot::set_token($payload['token']);
        } catch (Exception $e) {
            wp_send_json_error(['message' => $e->getMessage()], 422);
        }

        wp_send_json_success();
    }

    public static function ajax_load_settings()
    {
        $bot_info  = null;
        $chat_list = [];

        try {
            $bot_info  = Rivo_WTS_Bot::get_me();
            $chat_list = Rivo_WTS_Bot::get_chats_list();
        } catch (Exception $e) {
            wp_send_json_error(['message' => $e->getMessage()], 422);
        }

        wp_send_json_success([
            'bot_info'             => $bot_info,
            'chat_list'            => $chat_list,
            'for_update_chat_list' => sprintf("%s<br /><strong>%s</strong>",
                Rivo_WTS_i18n::texts()['for_update_chat_list'],
                '/start @' . $bot_info['username']
            ),
            'settings'             => Rivo_WTS_Settings_Bot::get()
        ]);
    }

    public static function ajax_save_settings()
    {
        $chat_id = filter_input(INPUT_POST, 'chat_id', FILTER_SANITIZE_STRING);

        if (!$chat_id) {
            wp_send_json_error(['message' => 'Wrong chat id'], 404);
        }

        $settings             = Rivo_WTS_Settings_Bot::get();
        $settings['chat_ids'] = [$chat_id];
        Rivo_WTS_Settings_Bot::set($settings);

        try {
            if ($chat_name = Rivo_WTS_Bot::get_chat_name($chat_id)) {
                update_option(Rivo_WTS_Bot::LAST_CHATS_OPTION_KEY, [$chat_id => $chat_name]);
            }
        } catch (Exception $e) {
        }

        wp_send_json_success();
    }

    public static function ajax_send_test_message()
    {
        $chat_id = filter_input(INPUT_POST, 'chat_id', FILTER_SANITIZE_STRING);

        if (!$chat_id) {
            wp_send_json_error(['message' => 'Wrong chat id'], 404);
        }

        try {
            $text = 'Test message';
            Rivo_WTS_Bot::send($text, [$chat_id]);
        } catch (Exception $e) {
            wp_send_json_error(['message' => $e->getMessage()], 422);

        }

        wp_send_json_success();
    }
}