<?php

class Rivo_WTS_Integrations_Contact_Form
{
    const PREFIX_LIST = 'contact-form-';
    const POST_TYPE   = 'wpcf7_contact_form';

    public static function actions()
    {
        add_action('wpcf7_before_send_mail', [__CLASS__, 'before_send_mail'],3, 999);
    }

    public static function before_send_mail($contact_form)
    {
        //get mail template body
        $body = $contact_form->prop('mail')['body'];

        //remove default last line
        $body = str_replace(sprintf(__( 'This e-mail was sent from a contact form on %1$s (%2$s)', 'contact-form-7' ), '[_site_title]', '[_site_url]'), '', $body);

        //remove last line breaks
        $body = str_replace("\n\n-- \n", '', $body);

        //fill template with actual data
        $text = sprintf("%s: %s\n%s", __('Form Name', Rivo_WTS_TEXTDOMAIN), $contact_form->title, wpcf7_mail_replace_tags($body));

        //apply formatting
        $text = Rivo_WTS_Formatting::apply(Rivo_WTS_Settings_Integrations::TYPE_ALL_EMAILS, $text);

        //send
        Rivo_WTS_Bot::send_message([], $text);
    }

    public static function get_forms_list()
    {
        $list  = [];
        $posts = get_posts([
            'post_type'      => self::POST_TYPE,
            'post_status'    => 'publish',
            'posts_per_page' => 1
        ]);

        foreach ($posts as $post) {
            $list[self::PREFIX_LIST . $post->ID] = get_the_title($post);
        }

        return $list;
    }
}