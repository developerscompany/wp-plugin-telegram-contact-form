<?php

class Rivo_WTS_Integrations_All_Mails
{
    public static function actions()
    {
        add_action('wp_mail', [__CLASS__, 'on_sending'], 1, 999);
    }

    public static function on_sending($args = [])
    {
        $text = sprintf("%s: %s\nTo: %s\nSubject: %s\nMessage:\n%s\n",
            __('Type', Rivo_WTS_TEXTDOMAIN),
            __('Wordpress Mail', Rivo_WTS_TEXTDOMAIN),
            $args['to'],
            $args['subject'],
            $args['message']
        );

        $text = Rivo_WTS_Formatting::apply(Rivo_WTS_Settings_Integrations::TYPE_ALL_EMAILS, $text);
        Rivo_WTS_Bot::send($text);
    }
}