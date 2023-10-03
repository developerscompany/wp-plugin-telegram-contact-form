<?php

class Rivo_WTS_Settings_Notifications extends Rivo_WTS_Setting_Base
{
    const OPTION_KEY = Rivo_WTS_Main::PREFIX . 'settings-notifications';
    const DEFAULTS   = [
        "forms" => []
    ];

    public static function get_form_settings($key = '')
    {
        $settings = self::get();

        if (isset($settings['forms'][$key])) {
            return $settings['forms'][$key];
        }

        return self::example_form_data();
    }

    public static function example_form_data()
    {
        return [
            'text_before' => '',
            'replaces'    => [self::example_replace()],
            'text_after'  => '',
            'add_url'     => false
        ];
    }

    public static function example_replace()
    {
        return [
            'text_before' => '',
            'text_after'  => '',
            'bold'        => false,
            'italic'      => false,
            'emoji'       => false
        ];
    }


}