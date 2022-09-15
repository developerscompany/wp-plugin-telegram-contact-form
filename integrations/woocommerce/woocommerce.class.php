<?php
if ( ! defined( 'ABSPATH' ) ) exit;

class RFT_Woocommerce
{
    public function __construct()
    {

    }

    public function send_new_order_telegram($order_id): void
    {
        $this->send_order_message($order_id, __('Нове замовлення ✅', 'rivoforms'));
    }

    public function send_cancelled_order_telegram($order_id): void
    {
        $this->send_order_message($order_id, __('Скасоване замовлення ❌', 'rivoforms'));
    }

    public function send_order_message($order_id, $subject): void
    {
        $order = new WC_Order( $order_id );
        $currency_code = $order->get_currency();
        $currency_symbol = get_woocommerce_currency_symbol( $currency_code );
        $message = $subject . ' ' . chr(10) . chr(10);
        $message .= __('🛒 Замовлення № ', 'rivoforms') . $order_id . chr(10);
        $order_date = $order->get_date_created();
        $message .= __('🗓 Дата ', 'rivoforms') . $order_date->date('d-m-Y') . chr(10);
        $message .= __('🕒 Час ', 'rivoforms') . $order_date->date('h:m') . chr(10);
        $message .= __('👤 Ім`я клієнта ', 'rivoforms') . $order->get_shipping_first_name() . ' ' . $order->get_shipping_last_name() .  chr(10);
        $message .= __('✉️ Email: ', 'rivoforms') . $order->get_billing_email() . chr(10);
        $message .= __('📱 Телефон ', 'rivoforms') . $order->get_billing_phone() . chr(10);

        // Products info
        foreach ( $order->get_items() as $item ) {
            $message .= '_____________________________________' . chr(10);
            $message .= __('🔘 Назва товару: ', 'rivoforms') . $item->get_name() . chr(10);
            $message .= __('🔘 Кількість: ', 'rivoforms') . $item->get_quantity() . chr(10);
            $message .= __('💵 Вартість: ', 'rivoforms') . $item->get_total() . $currency_symbol .  chr(10);
        }

        $message .= '_____________________________________' . chr(10);

        $message .= __('💵 Сума покупки: ', 'rivoforms') . $order->get_total() . $currency_symbol . chr(10);
        $tm_bot = RFT_Bot_Sender::get_instance();
        $tm_bot->sendPlain( $message, 'WooCommerce' );
    }
}