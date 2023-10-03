<?php

class Rivo_WTS_Formatting
{
    public static function apply($form_key, $text)
    {
        $form_settings = Rivo_WTS_Settings_Notifications::get_form_settings($form_key);

        if(empty($form_settings)) {
            return $text;
        }

        foreach ($form_settings['replaces'] as $replace) {
            if(empty($replace['text_before'])) {
                continue;
            }

            $text_replace_to = !empty($replace['text_after']) ? $replace['text_after'] : $replace['text_before'];

            !empty($replace['bold'])   && $text_replace_to = sprintf('<b>%s</b>', $text_replace_to);
            !empty($replace['italic']) && $text_replace_to = sprintf('<i>%s</i>', $text_replace_to);
            !empty($replace['emoji'])  && $text_replace_to = $replace['emoji'] . $text_replace_to;

            $text = str_replace($replace['text_before'], $text_replace_to, $text);
        }


        !empty($form_settings['text_before']) && $text = $form_settings['text_before'] . "\n" . $text;
        !empty($form_settings['text_after']) && $text = $text . "\n" . $form_settings['text_after'];

        return $text;
    }
}