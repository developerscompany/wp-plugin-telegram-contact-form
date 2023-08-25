<?php

class RFT_Settings_Notifications extends RFT_Setting_Base
{
    const OPTION_KEY = RFT_Main::PREFIX . 'settings-notifications';
    const DEFAULTS   = [
        "forms" => []
    ];


    public static function exampleFormsArray()
    {
        return [
            'forms' => [
                '2234' => self::exampleFormData()
            ]
        ];
    }

    public static function exampleFormData()
    {
        return [
            'text_before' => '',
            'replaces'    => [
                [
                    'text_before' => '',
                    'text_after'  => '',
                    'bold'        => false,
                    'italic'      => false,
                    'icon'        => false
                ]
            ],
            'text_after'  => [],
            'add_url'     => false
        ];
    }


}