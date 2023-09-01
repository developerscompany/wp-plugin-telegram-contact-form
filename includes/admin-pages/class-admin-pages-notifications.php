<?php

class Rivo_WTS_Admin_Pages_Notifications
{
    const SLUG  = Rivo_WTS_Main::PREFIX . 'notifications';
    const TITLE = 'Notification Settings';

    public static function init()
    {
        add_action('admin_menu', [__CLASS__, 'add_menu'], 10000);
        Rivo_WTS_Admin_Pages::$all_slugs[] = self::SLUG;

       add_action('wp_ajax_add_new_modify_input', [__CLASS__, 'add_new_modify_input']);
       add_action('wp_ajax_four_step_save', [__CLASS__, 'four_step_save']);
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
        include_once Rivo_WTS_PLUGIN_DIR . '/views/pages/notifications.php';
    }

   public static function add_new_modify_input() {
      $search_results_content = array();

      $search_results_content['field_info'] .= '<div class="rivo-wts-rename-group">';
      $search_results_content['field_info'] .= '<select class="form-options" id="selected_icon">
                                                    <option> </option>
                                                    <option value="🔘">🔘</option>
                                                    <option value="✅">✅</option>
                                                    <option value="👤">👤</option>
                                                    <option value="📱">📱</option>
                                                    <option value="✉">✉</option>
                                                    <option value="🕒">🕒</option>
                                                    <option value="🗓">🗓</option>
                                                    <option value="💵">💵</option>
                                                    <option value="🛒">🛒</option>
                                                </select>';
      $search_results_content['field_info'] .= '<input type="text" class="ml-1" id="input_original_name" name="input_original_name" value="" placeholder="Input Name">';
      $search_results_content['field_info'] .= '<input type="text" class="ml-1" id="input_replace_name" name="input_replace_name" value="" placeholder="Display Name">';
      $search_results_content['field_info'] .= '<button id="rivo_wts_bold_format" class="btn-format rivo-wts-bold-format" style="font-weight:bold;"> B </button>';
      $search_results_content['field_info'] .= '<button id="rivo_wts_italic_format" class="btn-format rivo-wts-italic-format" style="font-style: italic;"> I </button>';
      $search_results_content['field_info'] .= '<button class="delete-group" id="delete-group">
                                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M3 6H5H21" stroke="#FF0000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                        <path d="M8 6V4C8 3.46957 8.21071 2.96086 8.58579 2.58579C8.96086 2.21071 9.46957 2 10 2H14C14.5304 2 15.0391 2.21071 15.4142 2.58579C15.7893 2.96086 16 3.46957 16 4V6M19 6V20C19 20.5304 18.7893 21.0391 18.4142 21.4142C18.0391 21.7893 17.5304 22 17 22H7C6.46957 22 5.96086 21.7893 5.58579 21.4142C5.21071 21.0391 5 20.5304 5 20V6H19Z" stroke="#FF0000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                    </svg>
                                                </button>';
      $search_results_content['field_info'] .= '</div>';

      echo json_encode($search_results_content);
      wp_die();
   }




   public static function four_step_save(){
       $form_name = $_POST['form_name'];
       $block_info = $_POST['form_info'];
      $form_settings = Rivo_WTS_Settings_Notifications::get();

      if(array_key_exists ($form_name, $form_settings['forms']) == true){
         $form_settings['forms'][$form_name] = $block_info;
      } else {
         $form_settings['forms'] += array($form_name => $block_info);
      }

      Rivo_WTS_Settings_Notifications::set($form_settings);

      //echo json_encode($search_results_content);
      //wp_die();
   }
}