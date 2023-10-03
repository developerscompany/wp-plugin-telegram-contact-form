<?php

class Rivo_WTS_Integrations
{
    public static function init()
    {
        self::check_settings();
    }

    public static function check_settings()
    {
        $bot_settings = Rivo_WTS_Settings_Bot::get();

        if (empty($bot_settings['token']) || empty($bot_settings['chat_ids'])) {
            return;
        }

        $integration_settings = Rivo_WTS_Settings_Integrations::get();

        if ($integration_settings['type'] === Rivo_WTS_Settings_Integrations::TYPE_ALL_EMAILS) {
            Rivo_WTS_Integrations_All_Mails::actions();
        }

        if ($integration_settings['type'] === Rivo_WTS_Settings_Integrations::TYPE_PLUGINS) {
            if (in_array(Rivo_WTS_Settings_Integrations::PLUGIN_CONTACT_FORM, $integration_settings['plugins'])) {
                Rivo_WTS_Integrations_Contact_Form::actions();
            }

            if (in_array(Rivo_WTS_Settings_Integrations::PLUGIN_WOOCOMMERCE, $integration_settings['plugins'])) {
                Rivo_WTS_Integrations_Woocommerce::actions();
            }

            if (in_array(Rivo_WTS_Settings_Integrations::PLUGIN_WPFORMS, $integration_settings['plugins'])) {
                Rivo_WTS_Intergrations_WPFroms::actions();
            }
        }
    }

    public static function get_forms_list()
    {
        return array_merge(
            Rivo_WTS_Integrations_Contact_Form::get_forms_list(),
            Rivo_WTS_Intergrations_WPFroms::get_forms_list(),
            Rivo_WTS_Integrations_Woocommerce::get_forms_list()
        );
    }
}