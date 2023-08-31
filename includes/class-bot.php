<?php

class Rivo_WTS_Bot
{
    const LAST_CHATS_OPTION_KEY = Rivo_WTS_Main::PREFIX . 'last-chats';

    const ERROR_INVALID_TOKEN   = 'Invalid Token';
    const ERROR_REQUEST         = 'Request Error';

    public static function send_message($chat_ids = [], $text = null)
    {
        !$chat_ids && $chat_ids = Rivo_WTS_Settings_Bot::get()['chat_ids'];

        $result = [];
        $parse_mode = 'html';

        foreach ($chat_ids as $chat_id) {
            try {
                $result[] = self::request('sendMessage', compact('chat_id', 'text', 'parse_mode', 'disable_web_page_preview'));
            } catch (Exception $e) {
                //TODO: log to errors
            }
        }

        return $result;
    }

    public static function get_chats_list()
    {
        $chats    = [];
        $chat_ids = [];
        $json     = self::request('getUpdates');

        if(!$json) {
            return [];
        }

        foreach ($json['result'] as $update) {
            if(isset($update['message'])) {
                $chat_ids[] = $update['message']['chat']['id'];
            }

            if(isset($update['my_chat_member'])) {
                $chat_ids[] = $update['my_chat_member']['chat']['id'];
            }
        }

        $chat_ids = array_filter($chat_ids);

        foreach ($chat_ids as $chat_id) {
            if($chat_name = self::get_chat_name($chat_id)) {
                $chats[(string)$chat_id] = $chat_name;
            }
        }

        //prevent disappearing selected chat
        return array_replace_recursive(get_option(self::LAST_CHATS_OPTION_KEY) ?: [], $chats);
    }

    public static function get_chat_name($chat_id = null)
    {
        if(!$chat_id) {
            return null;
        }

        $json = self::request('getChat', ['chat_id' => $chat_id]);

        if(isset($json['result']['title'])) {
            return $json['result']['title'];
        }

        if(isset($json['result']['first_name'])) {
            return sprintf('%s %s', $json['result']['username'], $json['result']['first_name']);
        }

        return null;
    }

    public static function get_token_from_settings()
    {
        return Rivo_WTS_Settings_Bot::get()['token'];
    }

    public static function get_me($forceToken = null)
    {
        return self::request('getMe', [], $forceToken);
    }

    public static function request($telegramAction = null, $data = [], $forceToken = null)
    {
        $token = $forceToken ?? self::get_token_from_settings();

        if(!$token) {
            throw new Exception(__(self::ERROR_INVALID_TOKEN, Rivo_WTS_TEXTDOMAIN));
        }

        $url = sprintf('https://api.telegram.org/bot%s/%s', $token, $telegramAction);
        $data && $url .= sprintf('?%s', http_build_query($data));

        $answer = wp_remote_post($url, [
            'method'      => 'GET',
            'timeout'     => 2,
            'redirection' => 5,
            'sslverify'   => false
        ]);

        $json = json_decode(wp_remote_retrieve_body($answer), 1);

        if(is_wp_error($answer)) {
            throw new Exception(sprintf('%s (%s)', __(self::ERROR_REQUEST, Rivo_WTS_TEXTDOMAIN), $answer->get_error_message()));
        }

        if(!isset($json['ok']) || !$json['ok']) {
            if(isset($json['description'])) {
                throw new Exception($json['description']);
            } else {
                throw new Exception(__(self::ERROR_INVALID_TOKEN, Rivo_WTS_TEXTDOMAIN));
            }
        }

        return $json;
    }
}