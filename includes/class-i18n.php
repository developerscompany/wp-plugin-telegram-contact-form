<?php

class Rivo_WTS_i18n
{
    public static function texts()
    {
        return [
            'link_about'            => Rivo_WTS_Admin_Pages::get_link(Rivo_WTS_Admin_Pages_About::SLUG),
            'link_bot'              => Rivo_WTS_Admin_Pages::get_link(Rivo_WTS_Admin_Pages_Bot::SLUG),
            'link_integrations'     => Rivo_WTS_Admin_Pages::get_link(Rivo_WTS_Admin_Pages_Integrations::SLUG),
            'link_notifications'    => Rivo_WTS_Admin_Pages::get_link(Rivo_WTS_Admin_Pages_Notifications::SLUG),
            'tm_bot_settings'       => 'Telegram Bot Settings',
            'choose_integrations'   => 'Choose integrations',
            'notification_settings' => __('Notification Settings', Rivo_WTS_TEXTDOMAIN),
            'also_you_can'          => __('Also, you can send messages programmatically:', Rivo_WTS_TEXTDOMAIN),
            'active_bot'            => __('Active bot', Rivo_WTS_TEXTDOMAIN),
            'no_forms'              => __('You have no forms fo customization', Rivo_WTS_TEXTDOMAIN),
            'text_before'           => __('Text before', Rivo_WTS_TEXTDOMAIN),
            'text_after'            => __('Text after', Rivo_WTS_TEXTDOMAIN),
            'choose_form'           => __('Choose form', Rivo_WTS_TEXTDOMAIN),
            'previous_step'         => __('Previous step', Rivo_WTS_TEXTDOMAIN),
            'save_settings'         => __('Save settings', Rivo_WTS_TEXTDOMAIN),
            'save_and_continue'     => __('Save and continue', Rivo_WTS_TEXTDOMAIN),
            'saved'                 => __('Saved', Rivo_WTS_TEXTDOMAIN),
            'add_new_input'         => __('Add new input', Rivo_WTS_TEXTDOMAIN),
            'apply_token'           => __('Apply Token', Rivo_WTS_TEXTDOMAIN),
            'token'                 => __('Token', Rivo_WTS_TEXTDOMAIN),
            'send_test_message'     => __('Send test Message', Rivo_WTS_TEXTDOMAIN),
            'modify_input'          => __('Modify input names output', Rivo_WTS_TEXTDOMAIN),
            'label_add_url'         => __('Add form submition URL to message', Rivo_WTS_TEXTDOMAIN),
            'message_before'        => __('Message before successful submission of the form', Rivo_WTS_TEXTDOMAIN),
            'message_after'         => __('Message after successful submission of the form', Rivo_WTS_TEXTDOMAIN),
            'no_chats'              => __("Can't find available chats. Please type text below to group with bot and reload this page.", Rivo_WTS_TEXTDOMAIN),
            'choose_chat'           => __("Choose chat", Rivo_WTS_TEXTDOMAIN),
            'all_emails'            => __("All WordPress Emails", Rivo_WTS_TEXTDOMAIN),
            'all_emails_sub'        => __("Send telegram notice when any kind of wordpress email is sent.", Rivo_WTS_TEXTDOMAIN),
            'select_forms'          => __("Select Forms Integrations", Rivo_WTS_TEXTDOMAIN),
            'select_forms_sub'      => __("Send telegram notice when any kind of wordpress email is sent.", Rivo_WTS_TEXTDOMAIN),
            'contact_form'          => __("Contact Form 7", Rivo_WTS_TEXTDOMAIN),
            'contact_form_sub'      => __("Send message to telegram each time a choosen Contact-Form-7 in submitted", Rivo_WTS_TEXTDOMAIN),
            'wpforms'               => __("WPForms", Rivo_WTS_TEXTDOMAIN),
            'wpforms_sub'           => __("Send message to telegram each time a choosen WPForms in submitted", Rivo_WTS_TEXTDOMAIN),
            'woocommerce'           => __("Woocommerce", Rivo_WTS_TEXTDOMAIN),
            'woocommerce_sub'       => __("Send message to telegram each time a WooCommerce order is submitted", Rivo_WTS_TEXTDOMAIN),
            'emoji_array'           => array_merge([' '], \Spatie\Emoji\Emoji::all())
        ];
    }
}
