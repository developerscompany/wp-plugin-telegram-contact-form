<?php

abstract class RFT_Setting_Base
{
    const OPTION_KEY = RFT_Main::PREFIX . 'settings-base';
    const DEFAULTS   = [];

    final public static function get()
    {
        $settings = get_option(static::OPTION_KEY);

        if(!$settings) {
            self::set(static::DEFAULTS);
            $settings = get_option(static::OPTION_KEY);
        }

        return $settings;
    }

    public static function set($settings = [])
    {
        return update_option(static::OPTION_KEY, $settings);
    }
}