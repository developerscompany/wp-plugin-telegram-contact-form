<?php

class RFT_Admin_Pages_Bot
{
    const SLUG  = RFT_Main::PREFIX . 'bot';
    const TITLE = 'Telegram Bot Settings';

    public static function init()
    {
        add_action('admin_menu', [__CLASS__, 'add_menu'], 10000);
        RFT_Admin_Pages::$all_slugs[] = self::SLUG;
    }

    public static function add_menu()
    {
        add_submenu_page(
            RFT_Admin_Pages_About::SLUG,
            sprintf('%s %s', __( 'Rivo Telegram', RFT_TEXTDOMAIN ), __(self::TITLE, RFT_TEXTDOMAIN )),
            __( self::TITLE, RFT_TEXTDOMAIN ),
            RFT_Admin_Pages::CAPABILITY,
            self::SLUG,
            [__CLASS__, 'screen']
        );
    }

    public static function screen()
    {
        include_once RFT_PLUGIN_DIR . '/views/nav.php';
        include_once RFT_PLUGIN_DIR . '/views/pages/bot.php';
    }

   function __construct() {
      add_action( 'wp_ajax_token_apply', [ $this, 'getStuffDone' ] );
      add_action( 'wp_ajax_nopriv_token_apply', [ $this, 'getStuffDone' ] );

      add_action( 'wp_ajax_second_step_save', [ $this, 'second_step_save_changes' ] );
      add_action( 'wp_ajax_nopriv_second_step_save', [ $this, 'second_step_save_changes' ] );
   }
   public function getStuffDone() {
       $token_id = $_POST['token_id'];
       $search_results_content = array();

         try {
            $bot_test = RFT_Bot::get_me($token_id);
            $search_results_content['request'] = 'token_successfull';
            RFT_Settings_Bot::set(['token'=>$token_id ]); //'chat_ids'=>[]

            try {
               $bot_test = RFT_Bot::get_chats_list();
               $search_results_content['request_chat_list'] = 'true';
               $search_results_content['chats_list'] .= '<p>Choose chat</p>';
               foreach (RFT_Bot::get_chats_list() as $chat_list_item){
                  $search_results_content['chats_list'] .= '<div class="check-chat">';
                  $search_results_content['chats_list'] .= '<input type="radio" id="'.$chat_list_item['chat_id'].'" name="fav_language" value="'.$chat_list_item['chat_name'].'">';
                  $search_results_content['chats_list'] .= ' <label for="'.$chat_list_item['chat_id'].'">'.$chat_list_item['chat_name'].'</label>';
                  $search_results_content['chats_list'] .= '</div>';
               }
            } catch (Exception $e) {
               $search_results_content['request_chat_list'] = 'false';
            }

         } catch (Exception $e) {
            $search_results_content['request'] = 'token_error';
            RFT_Settings_Bot::set(['token'=>'' ]); //'chat_ids'=>[]
         }

      echo json_encode($search_results_content);
      wp_die();
   }

   public function second_step_save_changes(){
      $token_id = $_POST['token_id'];
      $chat_id = $_POST['chat_id'];

      RFT_Settings_Bot::set(['token'=>$token_id, 'chat_ids' => [$chat_id] ]);
   }
}

$var = new RFT_Admin_Pages_Bot();


//add_action( 'wp_ajax_search_results', 'getStuffDone' );
//add_action( 'wp_ajax_nopriv_search_results', 'getStuffDone' );
//
//function getStuffDone() {
//   $search_results_content = array('9999999999999999');
//   echo json_encode($search_results_content);
//      wp_die();
//}