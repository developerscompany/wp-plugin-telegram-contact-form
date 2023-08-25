<?php

class RFT_Settings_Integrations extends RFT_Setting_Base
{
    const TYPE_ALL_EMAILS     = 'all-emails';
    const TYPE_FORMS          = 'forms';
    const PLUGIN_CONTACT_FORM = 'contact-form';
    const PLUGIN_WOOCOMMERCE  = 'woocommerce';

    const OPTION_KEY = RFT_Main::PREFIX . 'settings-integrations';
    const DEFAULTS   = [
        'type'    => self::TYPE_ALL_EMAILS,
        'plugins' => [],
//        'plugins' => [self::PLUGIN_CONTACT_FORM, self::PLUGIN_WOOCOMMERCE]
    ];
}