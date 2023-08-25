<?php

class RFT_Settings_Bot extends RFT_Setting_Base
{
    const OPTION_KEY = RFT_Main::PREFIX . 'settings-bot';
    const DEFAULTS   = [
        "token"    => '',
        "chat_ids" => []
    ];
}