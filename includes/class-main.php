<?php

class Rivo_WTS_Main
{
    const PREFIX = 'rivo-wts-';

    public static function init()
    {
        Rivo_WTS_Assets::init();
        Rivo_WTS_Admin_Pages::init();
        Rivo_WTS_Settings::init();
        Rivo_WTS_Integrations::init();

//        $token = '6418062577:AAH9GnbK6e55NZ3cznEMWNzxMpXqcmF6pVo';
//        $data['chat_id'] = '-214862049';
    }
}