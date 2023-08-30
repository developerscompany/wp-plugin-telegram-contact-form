<?php

class Rivo_WTS_Admin_Pages_Bot
{
    const SLUG  = Rivo_WTS_Main::PREFIX . 'bot';
    const TITLE = 'Telegram Bot Settings';

    public static function init()
    {
        add_action('admin_menu', [__CLASS__, 'add_menu'], 10000);
        Rivo_WTS_Admin_Pages::$all_slugs[] = self::SLUG;

        add_action('wp_ajax_token_apply', [__CLASS__, 'getStuffDone']);
        add_action('wp_ajax_second_step_save', [__CLASS__, 'second_step_save_changes']);
    }

    public static function add_menu()
    {
        add_submenu_page(
            Rivo_WTS_Admin_Pages_About::SLUG,
            sprintf('%s %s', __( 'Rivo Telegram', Rivo_WTS_TEXTDOMAIN ), __(self::TITLE, Rivo_WTS_TEXTDOMAIN )),
            __( self::TITLE, Rivo_WTS_TEXTDOMAIN ),
            Rivo_WTS_Admin_Pages::CAPABILITY,
            self::SLUG,
            [__CLASS__, 'screen']
        );
    }

    public static function screen()
    {
        include_once Rivo_WTS_PLUGIN_DIR . '/views/nav.php';
        include_once Rivo_WTS_PLUGIN_DIR . '/views/pages/bot.php';
    }

   public static function getStuffDone() {
       $token_id = $_POST['token_id'];
       $search_results_content = array();

         try {
            Rivo_WTS_Bot::get_me($token_id);
            $search_results_content['request'] = 'token_successfull';
            Rivo_WTS_Settings_Bot::set_token($token_id);

            try {
               $search_results_content['request_chat_list'] = 'true';
               $search_results_content['chats_list'] .= '<p>Choose chat</p>';
               foreach (Rivo_WTS_Bot::get_chats_list() as $chat_id => $chat_name){
                  $search_results_content['chats_list'] .= '<div class="check-chat">';
                  $search_results_content['chats_list'] .= '<input type="radio" id="'.$chat_id.'" name="fav_language" value="'.$chat_name.'">';
                  $search_results_content['chats_list'] .= ' <label for="'.$chat_id.'">'.$chat_name.'</label>';
                  $search_results_content['chats_list'] .= '</div>';
               }
            } catch (Exception $e) {
               $search_results_content['request_chat_list'] = 'false';
            }

         } catch (Exception $e) {
            $search_results_content['request'] = 'token_error';
            Rivo_WTS_Settings_Bot::set_token('');
         }

      echo json_encode($search_results_content);
      wp_die();
   }

   public static function second_step_save_changes(){
      $token_id = $_POST['token_id'];
      $chat_id = $_POST['chat_id'];

       Rivo_WTS_Settings_Bot::set(['token'=>$token_id, 'chat_ids' => [$chat_id] ]);

      try{
          if($chat_name = Rivo_WTS_Bot::get_chat_name($chat_id)) {
              update_option(Rivo_WTS_Bot::LAST_CHATS_OPTION_KEY, [$chat_id => $chat_name]);
   }
      } catch(Exception $e) {

      }
   }
}


//add_action( 'wp_ajax_search_results', 'getStuffDone' );
//add_action( 'wp_ajax_nopriv_search_results', 'getStuffDone' );
//
//function getStuffDone() {
//   $search_results_content = array('9999999999999999');
//   echo json_encode($search_results_content);
//      wp_die();
//}