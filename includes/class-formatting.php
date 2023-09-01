<?php

class Rivo_WTS_Formatting
{
    public static function get_settings_for($type)
    {
        return [
            [
                'text_before' => 'Siimme',
                'text_after'  => 'Siimme2',
                'bold'        => 1,
                'italic'      => 1,
                'icon'        => '😁'
            ],
            [
                'text_before' => 'Type',
                'text_after'  => '',
                'bold'        => 0,
                'italic'      => 1,
                'icon'        => '😁'
            ]
        ];

        return Rivo_WTS_Settings_Notifications::exampleFormData();
    }

    public static function apply($type, $text)
    {
        if(is_array($settings = self::get_settings_for($type))) {
            foreach ($settings as $setting) {
                if(empty($setting['text_before'])) {
                    continue;
                }

                $text_replace_to = !empty($setting['text_after']) ? $setting['text_after'] : $setting['text_before'];

                !empty($setting['bold']) && $text_replace_to = sprintf('<b>%s</b>', $text_replace_to);
                !empty($setting['italic']) && $text_replace_to = sprintf('<i>%s</i>', $text_replace_to);
                !empty($setting['icon']) && $text_replace_to = $setting['icon'] . $text_replace_to;

                $text = str_replace($setting['text_before'], $text_replace_to, $text);
            }
        }

        return $text;
    }
}