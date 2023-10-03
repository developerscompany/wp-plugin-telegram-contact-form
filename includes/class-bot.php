<?php

class Rivo_WTS_Bot
{
    const LAST_CHATS_OPTION_KEY = Rivo_WTS_Main::PREFIX . 'last-chats';
    const ERROR_INVALID_TOKEN   = 'Invalid Token';
    const ERROR_REQUEST         = 'Request Error';

    public static function send($value, $chat_ids = [], $type = 'text')
    {
        !$chat_ids && $chat_ids = Rivo_WTS_Settings_Bot::get()['chat_ids'];

        $result = [];

        foreach ($chat_ids as $chat_id) {
            try {
                switch ($type) {
                    case 'audio':
                        $result[] = self::request('sendAudio', ['chat_id' => $chat_id, 'audio' => $value]);
                        break;
                    case 'image':
                        $result[] = self::request('sendPhoto', ['chat_id' => $chat_id, 'photo' => $value]);
                        break;
                    case 'video':
                        $result[] = self::request('sendVideo', ['chat_id' => $chat_id, 'video' => $value]);
                        break;
                    case 'document':
                        $result[] = self::request('sendDocument', ['chat_id' => $chat_id, 'document' => $value]);
                        break;
                    default:
                        $result[] = self::request('sendMessage', ['chat_id' => $chat_id, 'parse_mode' => 'html', 'text' => $value]);
                }
            } catch (Exception $e) {
                //TODO: log to errors
            }
        }

        return $result;
    }

    public static function send_document($document, $chat_ids = [])
    {
        !$chat_ids && $chat_ids = Rivo_WTS_Settings_Bot::get()['chat_ids'];

        $result = [];

        foreach ($chat_ids as $chat_id) {
            try {
                $result[] = self::request('sendDocument', compact('chat_id', 'document'));
            } catch (Exception $e) {
                //TODO: log to errors
            }
        }

        return $result;
    }


    public static function get_chats_list()
    {
        $chats      = [];
        $json       = self::request('getUpdates');
        $last_chats = self::get_last_chats();

        if (!$json) {
            return $last_chats;
        }

        foreach ($json['result'] as $update) {
            if (!empty($update['message'])) {
                $chat_id   = $update['message']['chat']['id'];
                $chat_name = $update['message']['chat']['type'] == 'private'
                    ? $update['message']['chat']['first_name']
                    : $update['message']['chat']['title'];

                !isset($chats[(string)$chat_id]) && $chats[(string)$chat_id] = $chat_name;
            }
        }


        return array_replace_recursive($last_chats, $chats);
    }

    public static function get_chat_name($chat_id = null)
    {
        if (!$chat_id) {
            return null;
        }

        $json = self::request('getChat', ['chat_id' => $chat_id]);

        if (isset($json['result']['title'])) {
            return $json['result']['title'];
        }

        if (isset($json['result']['first_name'])) {
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
        return self::request('getMe', [], $forceToken)['result'];
    }

    public static function get_last_chats()
    {
        return get_option(self::LAST_CHATS_OPTION_KEY) ?: [];
    }

    public static function clear_last_chats()
    {
        update_option(self::LAST_CHATS_OPTION_KEY, []);
    }

    public static function request($telegramAction = null, $data = [], $forceToken = null)
    {
        $token = $forceToken ?? self::get_token_from_settings();

        if (!$token) {
            throw new Exception(__(self::ERROR_INVALID_TOKEN, Rivo_WTS_TEXTDOMAIN));
        }

        $url = sprintf('https://api.telegram.org/bot%s/%s', $token, $telegramAction);
        $data && $url .= sprintf('?%s', http_build_query($data));

        $answer = wp_remote_post($url, [
            'method'      => 'GET',
            'timeout'     => 5,
            'redirection' => 5,
            'sslverify'   => false
        ]);

        $json = json_decode(wp_remote_retrieve_body($answer), 1);

        if (is_wp_error($answer)) {
            throw new Exception(sprintf('%s (%s)', __(self::ERROR_REQUEST, Rivo_WTS_TEXTDOMAIN), $answer->get_error_message()));
        }

        if (!isset($json['ok']) || !$json['ok']) {
            if (isset($json['description'])) {
                $json['error_code'] === 401 && $json['description'] = __(self::ERROR_INVALID_TOKEN, Rivo_WTS_TEXTDOMAIN);

                throw new Exception($json['description']);
            } else {
                throw new Exception(__(self::ERROR_INVALID_TOKEN, Rivo_WTS_TEXTDOMAIN));
            }
        }

        return $json;
    }
}