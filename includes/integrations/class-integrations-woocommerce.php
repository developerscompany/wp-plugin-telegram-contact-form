<?php

class Rivo_WTS_Integrations_Woocommerce
{
    const PREFIX_LIST                = 'woocommerce-';
    const PREFIX_NEW_ORDER           = 'new-order';
    const PREFIX_CHANGE_ORDER_STATUS = 'order-change-status';

    public static function actions()
    {
        add_action('woocommerce_new_order', [__CLASS__, 'new_order']);
        add_action('woocommerce_order_status_changed', [__CLASS__, 'order_status_changed'], 3, 999);
    }

    public static function new_order($order_id)
    {
        if($order = new WC_Order($order_id)) {
            $text = sprintf("%s\n%s: %s",
                __( 'New order', 'woocommerce' ),
                __('Order ID', Rivo_WTS_TEXTDOMAIN),
                '<a href="' . $order->get_edit_order_url() . '">' . $order_id . '</a>'

            );

            $text = Rivo_WTS_Formatting::apply(self::PREFIX_LIST . self::PREFIX_NEW_ORDER, $text);
            Rivo_WTS_Bot::send_message([], $text);
        }
    }

    public static function order_status_changed($order_id, $old_status, $new_status)
    {
        if($order = new WC_Order($order_id)) {
            $text = sprintf("%s\n%s: %s\n%s: %s",
                __( 'New Order Status', 'woocommerce' ),
                __('Order ID', Rivo_WTS_TEXTDOMAIN),
                '<a href="' . $order->get_edit_order_url() . '">' . $order_id . '</a>',
                __( 'New Status', 'woocommerce' ),
                '<b>' . ucfirst($new_status) . '</b>'
            );

            $text = Rivo_WTS_Formatting::apply(self::PREFIX_LIST . self::PREFIX_CHANGE_ORDER_STATUS, $text);
            Rivo_WTS_Bot::send_message([], $text);
        }
    }

    public static function get_forms_list()
    {
        if (!class_exists(WooCommerce::class)) {
            return [
                self::PREFIX_LIST . self::PREFIX_NEW_ORDER           => __('WooCommerce New Order', Rivo_WTS_TEXTDOMAIN),
                self::PREFIX_LIST . self::PREFIX_CHANGE_ORDER_STATUS => __('WooCommerce Order Change Status', Rivo_WTS_TEXTDOMAIN)
            ];
        }

        return [];
    }
}