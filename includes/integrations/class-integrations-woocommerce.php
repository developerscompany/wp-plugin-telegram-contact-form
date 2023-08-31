<?php

class Rivo_WTS_Integrations_Woocommerce
{
    const PREFIX_LIST = 'woocommerce-';

    public static function actions()
    {
//        add_action('woocommerce_new_order', [__CLASS__, 'new_order']);
    }

    public static function new_order($order_id)
    {


        if($order = new WC_Order($order_id)) {
            $a = 9;

            sprintf("%s\n%s: %s", __( 'New order', 'woocommerce' ), __('Order ID', Rivo_WTS_TEXTDOMAIN), get_permalink(1));

            //$order->get_edit_order_url()
        }

    }

    public static function get_forms_list()
    {
        if (!class_exists(WooCommerce::class)) {
            return [
                self::PREFIX_LIST . 'new-order'           => __('WooCommerce New Order', Rivo_WTS_TEXTDOMAIN),
                self::PREFIX_LIST . 'order-change-status' => __('WooCommerce Order Change Status', Rivo_WTS_TEXTDOMAIN)
            ];
        }

        return [];
    }
}