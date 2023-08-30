<?php

class Rivo_WTS_Formatting
{
    public static function get_settings_for($type)
    {
        return Rivo_WTS_Settings_Notifications::exampleFormData();

    }

    public static function apply($type, $text)
    {
        $settings = self::get_settings_for($type);
        //text before, after, replaces, icons etc


        return $text;
    }
}