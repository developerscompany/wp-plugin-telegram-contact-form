<?php

class Rivo_WTS_Intergrations_WPFroms
{
    const PREFIX_SETTINGS = 'wpforms-';
    const POST_TYPE       = 'wpforms';

    public static function actions()
    {
        add_action('wpforms_process_complete', [__CLASS__, 'process_complete'], 99, 4);
    }

    public static function process_complete($fields, $entry, $form_data, $entry_id)
    {
        try {
            $text = '';

            $text = sprintf("%s: %s\n%s",
                __('Form Name', Rivo_WTS_TEXTDOMAIN),
                get_the_title($entry['id']),
                $text);

            foreach ($fields as $field) {
                $text .= sprintf("%s: %s\n", $field['name'], $field['value']);
            }

            $text = Rivo_WTS_Formatting::apply(self::get_form_key($entry['id']), $text);
            Rivo_WTS_Bot::send($text);
        } catch (Exception $e) {

        }
    }

    public static function get_forms_list()
    {
        $list  = [];
        $posts = get_posts([
            'post_type'      => self::POST_TYPE,
            'post_status'    => 'publish',
            'posts_per_page' => -1
        ]);

        foreach ($posts as $post) {
            $list[self::get_form_key($post->ID)] = sprintf('%s - %s', __('WPFroms', Rivo_WTS_TEXTDOMAIN), get_the_title($post));
        }

        return $list;
    }

    public static function get_form_key($id = '')
    {
        return self::PREFIX_SETTINGS . $id;

    }
}