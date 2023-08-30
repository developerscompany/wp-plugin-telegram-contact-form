<?php

class Rivo_WTS_Settings_Bot extends Rivo_WTS_Setting_Base
{
    const OPTION_KEY = Rivo_WTS_Main::PREFIX . 'settings-bot';
    const DEFAULTS   = [
        "token"    => '',
        "chat_ids" => []
    ];

    public static function set_token($token)
    {
        self::set(array_merge(self::DEFAULTS, ['token' => $token]));
    }
}