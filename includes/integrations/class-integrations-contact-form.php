<?php

class Rivo_WTS_Integrations_Contact_Form
{
    const PREFIX_SETTINGS = 'contact-form-';
    const POST_TYPE       = 'wpcf7_contact_form';

    public static function actions()
    {
        add_action('wpcf7_before_send_mail', [__CLASS__, 'before_send_mail'], 3, 999);
    }
    public static function before_send_mail($contact_form, &$abort, $submission)
    {
        try {
            $text = sprintf("%s: %s\n", __('Form name', Rivo_WTS_TEXTDOMAIN), $contact_form->title);

            foreach ($submission->get_posted_data() as $field_key => $field_value) {
                if (strpos($field_key, 'file') !== false) {
                    continue;
                }

                $text .= sprintf("%s: %s\n", $field_key, $field_value);
            }

            //apply formatting
            $text = Rivo_WTS_Formatting::apply(self::get_form_key($contact_form->id()), $text);

            Rivo_WTS_Bot::send($text);

            foreach ($submission->uploaded_files() as $file_key => $file_data) {
                foreach ($file_data as $file_path) {
                    Rivo_WTS_Attachment::send(Rivo_WTS_Attachment::copy_to_uploads_dir($file_path));
                }
            }
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
            $list[self::get_form_key($post->ID)] = sprintf('%s - %s', __('Contact Form', Rivo_WTS_TEXTDOMAIN), get_the_title($post));
        }

        return $list;
    }

    public static function get_form_key($id = '')
    {
        return self::PREFIX_SETTINGS . $id;

    }
}