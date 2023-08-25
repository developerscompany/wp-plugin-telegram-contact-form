<?php

class RFT_Main
{
    const PREFIX = 'rft-';

    public static function init()
    {
        RFT_Assets::init();
        RFT_Admin_Pages::init();
        RFT_Settings::init();

//        var_dump(RFT_Bot::get_me('2050004397:AAFxofedHlELG_uQ8YLvGDEJcI29zfmgzqI'));

//        try {
//            $a = RFT_Bot::send_message('-214862049', '777');
//            $b = RFT_Bot::get_chats_list();
//            $r = 9;
//        } catch (Exception $e) {
//            $a = 9;
//        }
    }
}