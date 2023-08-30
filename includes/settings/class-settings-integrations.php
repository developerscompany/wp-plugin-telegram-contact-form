<?php

class Rivo_WTS_Settings_Integrations extends Rivo_WTS_Setting_Base
{
    const TYPE_ALL_EMAILS     = 'all-emails';
    const TYPE_PLUGINS        = 'plugins';
    const PLUGIN_CONTACT_FORM = 'contact-form';
    const PLUGIN_WOOCOMMERCE  = 'woocommerce';

    const OPTION_KEY = Rivo_WTS_Main::PREFIX . 'settings-integrations';
    const DEFAULTS   = [
        'type'    => self::TYPE_ALL_EMAILS,
        'plugins' => [],
//        'plugins' => [self::PLUGIN_CONTACT_FORM, self::PLUGIN_WOOCOMMERCE]
    ];
}