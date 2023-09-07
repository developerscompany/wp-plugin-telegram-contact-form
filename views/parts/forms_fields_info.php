<?php
global $form_settings;
global $first_form;
global $emoji_arr;
global $ajax_notifications_method;
global $form_name; //from ajax method
global $results_content; //from ajax method
//var_dump($form_settings);


if($ajax_notifications_method == false){
    if(array_key_exists ($first_form, $form_settings['forms']) == true){ ?>
        <div class="form-message">
            <label for="form-message">Message before successful submission of the form</label>
            <input type="text" id="form_message_before_successful" name="form-message" value="<?php echo $form_settings['forms'][$first_form]['text_before']; ?>">
        </div>

        <div class="modify-inputs">
            <div class="rivo-wts-rename-group rivo-wts-rename-group-hidden">
                <div class="rivo-wts-fields">
                    <select class="form-options form-option-cloned" id="">
                       <?php foreach($emoji_arr as $emoji){ ?>
                           <option value="<?php echo $emoji; ?>"><?php echo $emoji; ?></option>
                       <?php } ?>
                    </select>

                    <input type="text" class="ml-1" id="input_original_name" name="input_original_name" value="" placeholder="Input Name">
                    <input type="text" class="ml-1" id="input_replace_name" name="input_replace_name" value="" placeholder="Display Name">

                    <button id="rivo_wts_bold_format" class="btn-format rivo-wts-bold-format" style="font-weight:bold;">
                        B
                    </button>
                    <button id="rivo_wts_italic_format" class="btn-format rivo-wts-italic-format " style="font-style: italic;">
                        I
                    </button>

                    <button class="delete-group" id="delete-group">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M3 6H5H21" stroke="#FF0000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M8 6V4C8 3.46957 8.21071 2.96086 8.58579 2.58579C8.96086 2.21071 9.46957 2 10 2H14C14.5304 2 15.0391 2.21071 15.4142 2.58579C15.7893 2.96086 16 3.46957 16 4V6M19 6V20C19 20.5304 18.7893 21.0391 18.4142 21.4142C18.0391 21.7893 17.5304 22 17 22H7C6.46957 22 5.96086 21.7893 5.58579 21.4142C5.21071 21.0391 5 20.5304 5 20V6H19Z" stroke="#FF0000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </button>
                </div>

                <div class="rivo-wts-are-you-sure sure-hidden">
                    Are you sure?
                    <button class="rivo-wts-are-you-sure-true">Yes</button>
                    <button class="rivo-wts-are-you-sure-false">No</button>
                </div>

            </div>
           <?php foreach ($form_settings['forms'][$first_form]['replaces'] as $form_field){ ?>
               <div class="rivo-wts-rename-group">
                   <div class="rivo-wts-fields">
                       <select class="form-options" id="selected_icon">
                          <?php foreach($emoji_arr as $emoji){ ?>
                              <option value="<?php echo $emoji; ?>" <?php if($form_field['icon'] == $emoji){ echo 'selected'; } ?> ><?php echo $emoji; ?></option>
                          <?php } ?>
                       </select>

                       <input type="text" class="ml-1" id="input_original_name" name="input_original_name" value="<?php echo $form_field['text_before'] !== '' ? $form_field['text_before'] : ''; ?>" placeholder="Input Name">
                       <input type="text" class="ml-1" id="input_replace_name" name="input_replace_name" value="<?php echo $form_field['text_after'] !== '' ? $form_field['text_after'] : ''; ?>" placeholder="Display Name">

                       <button id="rivo_wts_bold_format" class="btn-format rivo-wts-bold-format <?php if($form_field['bold'] == "true"){ echo 'selected'; } ?>" style="font-weight:bold;">
                           B
                       </button>
                       <button id="rivo_wts_italic_format" class="btn-format rivo-wts-italic-format <?php if($form_field['italic'] == "true"){ echo 'selected'; } ?>" style="font-style: italic;">
                           I
                       </button>

                       <button class="delete-group" id="delete-group">
                           <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                               <path d="M3 6H5H21" stroke="#FF0000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                               <path d="M8 6V4C8 3.46957 8.21071 2.96086 8.58579 2.58579C8.96086 2.21071 9.46957 2 10 2H14C14.5304 2 15.0391 2.21071 15.4142 2.58579C15.7893 2.96086 16 3.46957 16 4V6M19 6V20C19 20.5304 18.7893 21.0391 18.4142 21.4142C18.0391 21.7893 17.5304 22 17 22H7C6.46957 22 5.96086 21.7893 5.58579 21.4142C5.21071 21.0391 5 20.5304 5 20V6H19Z" stroke="#FF0000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                           </svg>
                       </button>
                   </div>

                   <div class="rivo-wts-are-you-sure sure-hidden">
                       Are you sure?
                       <button class="rivo-wts-are-you-sure-true">Yes</button>
                       <button class="rivo-wts-are-you-sure-false">No</button>
                   </div>
               </div>
           <?php } ?>
        </div>

        <div class="add-new-input-field" id="add-new-input-field">
            + Add new input
        </div>

        <div class="form-message-after-successful">
            <label for="form-message-after-successful">Message after successful submission of the form</label>
            <input type="text" id="form_message_after_successful" name="form-message-after-successful" value="<?php echo $form_settings['forms'][$first_form]['text_after']; ?>">
        </div>

        <div class="submition_url_block">
            <input type="checkbox" id="radio_add_url" name="submition_url" <?php if($form_settings['forms'][$first_form]['add_url'] == "true"){ echo 'checked'; } ?>>
            <label for="radio_add_url">
                Add form submition URL to message
            </label>
        </div>

    <? } else { ?>

        <div class="form-message">
            <label for="form-message">Message before successful submission of the form</label>
            <input type="text" id="form_message_before_successful" name="form-message">
        </div>

        <div class="modify-inputs">
            <div class="rivo-wts-rename-group rivo-wts-rename-group-hidden">
                <div class="rivo-wts-fields">
                    <select class="form-options form-option-cloned" id="">
                       <?php foreach($emoji_arr as $emoji){ ?>
                           <option value="<?php echo $emoji; ?>"><?php echo $emoji; ?></option>
                       <?php } ?>
                    </select>

                    <input type="text" class="ml-1" id="input_original_name" name="input_original_name" value="" placeholder="Input Name">
                    <input type="text" class="ml-1" id="input_replace_name" name="input_replace_name" value="" placeholder="Display Name">

                    <button id="rivo_wts_bold_format" class="btn-format rivo-wts-bold-format" style="font-weight:bold;">
                        B
                    </button>
                    <button id="rivo_wts_italic_format" class="btn-format rivo-wts-italic-format " style="font-style: italic;">
                        I
                    </button>

                    <button class="delete-group" id="delete-group">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M3 6H5H21" stroke="#FF0000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M8 6V4C8 3.46957 8.21071 2.96086 8.58579 2.58579C8.96086 2.21071 9.46957 2 10 2H14C14.5304 2 15.0391 2.21071 15.4142 2.58579C15.7893 2.96086 16 3.46957 16 4V6M19 6V20C19 20.5304 18.7893 21.0391 18.4142 21.4142C18.0391 21.7893 17.5304 22 17 22H7C6.46957 22 5.96086 21.7893 5.58579 21.4142C5.21071 21.0391 5 20.5304 5 20V6H19Z" stroke="#FF0000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </button>
                </div>

                <div class="rivo-wts-are-you-sure sure-hidden">
                    Are you sure?
                    <button class="rivo-wts-are-you-sure-true">Yes</button>
                    <button class="rivo-wts-are-you-sure-false">No</button>
                </div>
            </div>

            <div class="rivo-wts-rename-group">
                <div class="rivo-wts-fields">
                    <select class="form-options" id="selected_icon">
                       <?php foreach($emoji_arr as $emoji){ ?>
                           <option value="<?php echo $emoji; ?>"><?php echo $emoji; ?></option>
                       <?php } ?>
                    </select>

                    <input type="text" class="ml-1" id="input_original_name" name="input_original_name" value="" placeholder="Input Name">
                    <input type="text" class="ml-1" id="input_replace_name" name="input_replace_name" value="" placeholder="Display Name">

                    <button id="rivo_wts_bold_format" class="btn-format rivo-wts-bold-format <?php if($input['bold'] == "true"){ echo 'selected'; } ?>" style="font-weight:bold;">
                        B
                    </button>
                    <button id="rivo_wts_italic_format" class="btn-format rivo-wts-italic-format <?php if($input['italic'] == "true"){ echo 'selected'; } ?>" style="font-style: italic;">
                        I
                    </button>

                    <button class="delete-group" id="delete-group">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M3 6H5H21" stroke="#FF0000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M8 6V4C8 3.46957 8.21071 2.96086 8.58579 2.58579C8.96086 2.21071 9.46957 2 10 2H14C14.5304 2 15.0391 2.21071 15.4142 2.58579C15.7893 2.96086 16 3.46957 16 4V6M19 6V20C19 20.5304 18.7893 21.0391 18.4142 21.4142C18.0391 21.7893 17.5304 22 17 22H7C6.46957 22 5.96086 21.7893 5.58579 21.4142C5.21071 21.0391 5 20.5304 5 20V6H19Z" stroke="#FF0000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </button>
                </div>
                <div class="rivo-wts-are-you-sure sure-hidden">
                    Are you sure?
                    <button class="rivo-wts-are-you-sure-true">Yes</button>
                    <button class="rivo-wts-are-you-sure-false">No</button>
                </div>
            </div>
        </div>

        <div class="add-new-input-field" id="add-new-input-field">
            + Add new input
        </div>


        <div class="form-message-after-successful">
            <label for="form-message-after-successful">Message after successful submission of the form</label>
            <input type="text" id="form_message_after_successful" name="form-message-after-successful">
        </div>

        <div class="submition_url_block">
            <input type="checkbox" id="radio_add_url" name="submition_url">
            <label for="radio_add_url">
                Add form submition URL to message
            </label>
        </div>
    <?php }
} else if($ajax_notifications_method == true) {
   if (array_key_exists($form_name, $form_settings['forms'])) {
      $results_content['form_info'] .= '<div class="form-message">
                        <label for="form-message">Message before successful submission of the form</label>
                        <input type="text" id="form_message_before_successful" name="form-message" value="' . $form_settings['forms'][$form_name]['text_before'] . '">
                        </div>';
      $results_content['form_info'] .= '<div class="modify-inputs">';

      $results_content['form_info'] .= '<div class="rivo-wts-rename-group rivo-wts-rename-group-hidden">
                <div class="rivo-wts-fields">
                    <select class="form-options form-option-cloned" id="">';
                       foreach($emoji_arr as $emoji){
                          $results_content['form_info'] .= '<option value="'.$emoji.'">'.$emoji.'</option>';
                       }
           $results_content['form_info'] .= '</select>
    
                    <input type="text" class="ml-1" id="input_original_name" name="input_original_name" value="" placeholder="Input Name">
                    <input type="text" class="ml-1" id="input_replace_name" name="input_replace_name" value="" placeholder="Display Name">
    
                    <button id="rivo_wts_bold_format" class="btn-format rivo-wts-bold-format" style="font-weight:bold;">
                        B
                    </button>
                    <button id="rivo_wts_italic_format" class="btn-format rivo-wts-italic-format " style="font-style: italic;">
                        I
                    </button>
    
                    <button class="delete-group" id="delete-group">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M3 6H5H21" stroke="#FF0000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M8 6V4C8 3.46957 8.21071 2.96086 8.58579 2.58579C8.96086 2.21071 9.46957 2 10 2H14C14.5304 2 15.0391 2.21071 15.4142 2.58579C15.7893 2.96086 16 3.46957 16 4V6M19 6V20C19 20.5304 18.7893 21.0391 18.4142 21.4142C18.0391 21.7893 17.5304 22 17 22H7C6.46957 22 5.96086 21.7893 5.58579 21.4142C5.21071 21.0391 5 20.5304 5 20V6H19Z" stroke="#FF0000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </button>
                </div>
                <div class="rivo-wts-are-you-sure sure-hidden">
                    Are you sure?
                    <button class="rivo-wts-are-you-sure-true">Yes</button>
                    <button class="rivo-wts-are-you-sure-false">No</button>
                </div>
            </div>';

      foreach ($form_settings['forms'][$form_name]['replaces'] as $form_field) {
         $results_content['form_info'] .= '<div class="rivo-wts-rename-group">';
         $results_content['form_info'] .= '<div class="rivo-wts-fields">';
         $results_content['form_info'] .= '<select class="form-options" id="selected_icon">'; ?>
         <?php foreach($emoji_arr as $emoji){
            $selected_label = '';
            if($form_field['icon'] == $emoji){ $selected_label = 'selected'; };
            $results_content['form_info'] .= '<option value="'.$emoji.'" '.$selected_label.'>'.$emoji.'</option>';
         }
         $results_content['form_info'] .= '</select>';
         $results_content['form_info'] .= '<input type="text" class="ml-1" id="input_original_name" name="input_original_name" value="'.$form_field['text_before'].'" placeholder="Input Name">';
         $results_content['form_info'] .= '<input type="text" class="ml-1" id="input_replace_name" name="input_replace_name" value="'. $form_field['text_after'].'" placeholder="Display Name">';

         $selected_bold = '';
         $selected_italic = '';
         if($form_field['bold'] == "true"){
             $selected_bold = 'selected';
         }
         if($form_field['italic'] == "true"){
            $selected_italic = 'selected';
         }

         $results_content['form_info'] .= '<button id="rivo_wts_bold_format" class="btn-format rivo-wts-bold-format '.$selected_bold.'" style="font-weight:bold;">B</button>';
         $results_content['form_info'] .= '<button id="rivo_wts_italic_format" class="btn-format rivo-wts-italic-format '.$selected_italic.'" style="font-style: italic;">I</button>';

         $results_content['form_info'] .= '<button class="delete-group" id="delete-group">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M3 6H5H21" stroke="#FF0000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M8 6V4C8 3.46957 8.21071 2.96086 8.58579 2.58579C8.96086 2.21071 9.46957 2 10 2H14C14.5304 2 15.0391 2.21071 15.4142 2.58579C15.7893 2.96086 16 3.46957 16 4V6M19 6V20C19 20.5304 18.7893 21.0391 18.4142 21.4142C18.0391 21.7893 17.5304 22 17 22H7C6.46957 22 5.96086 21.7893 5.58579 21.4142C5.21071 21.0391 5 20.5304 5 20V6H19Z" stroke="#FF0000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </button>';
         $results_content['form_info'] .= '</div>';
         $results_content['form_info'] .= '<div class="rivo-wts-are-you-sure sure-hidden">
                    Are you sure?
                    <button class="rivo-wts-are-you-sure-true">Yes</button>
                    <button class="rivo-wts-are-you-sure-false">No</button>
                </div>';
         $results_content['form_info'] .= '</div>';
      }
      $results_content['form_info'] .= '</div>';
      $results_content['form_info'] .= '<div class="add-new-input-field" id="add-new-input-field">+ Add new input</div>';

      $results_content['form_info'] .= '<div class="form-message-after-successful">
            <label for="form-message-after-successful">Message after successful submission of the form</label>
            <input type="text" id="form_message_after_successful" name="form-message-after-successful" value="'.$form_settings['forms'][$form_name]['text_after'].'">
        </div>';

      $checked = '';
      if($form_settings['forms'][$form_name]['add_url'] == "true"){ $checked = 'checked'; }

      $results_content['form_info'] .= '<div class="submition_url_block">
            <input type="checkbox" id="radio_add_url" name="submition_url" '.$checked.'>
            <label for="radio_add_url">
                Add form submition URL to message
            </label>
        </div>';
   } else {
      $results_content['form_info'] .= '<div class="form-message">
            <label for="form-message">Message before successful submission of the form</label>
            <input type="text" id="form_message_before_successful" name="form-message">
        </div>';

      $results_content['form_info'] .= '<div class="modify-inputs">
            <div class="rivo-wts-rename-group rivo-wts-rename-group-hidden">
                <div class="rivo-wts-fields">
                    <select class="form-options form-option-cloned" id="">';
                       foreach($emoji_arr as $emoji){
                          $results_content['form_info'] .= '<option value="'.$emoji.'">'.$emoji.'</option>';
                        }
                    $results_content['form_info'] .= '</select>
    
                    <input type="text" class="ml-1" id="input_original_name" name="input_original_name" value="" placeholder="Input Name">
                    <input type="text" class="ml-1" id="input_replace_name" name="input_replace_name" value="" placeholder="Display Name">
    
                    <button id="rivo_wts_bold_format" class="btn-format rivo-wts-bold-format" style="font-weight:bold;">
                        B
                    </button>
                    <button id="rivo_wts_italic_format" class="btn-format rivo-wts-italic-format " style="font-style: italic;">
                        I
                    </button>
    
                    <button class="delete-group" id="delete-group">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M3 6H5H21" stroke="#FF0000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M8 6V4C8 3.46957 8.21071 2.96086 8.58579 2.58579C8.96086 2.21071 9.46957 2 10 2H14C14.5304 2 15.0391 2.21071 15.4142 2.58579C15.7893 2.96086 16 3.46957 16 4V6M19 6V20C19 20.5304 18.7893 21.0391 18.4142 21.4142C18.0391 21.7893 17.5304 22 17 22H7C6.46957 22 5.96086 21.7893 5.58579 21.4142C5.21071 21.0391 5 20.5304 5 20V6H19Z" stroke="#FF0000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </button>
                </div>
                <div class="rivo-wts-are-you-sure sure-hidden">
                    Are you sure?
                    <button class="rivo-wts-are-you-sure-true">Yes</button>
                    <button class="rivo-wts-are-you-sure-false">No</button>
                </div>
            </div>

            <div class="rivo-wts-rename-group">
                <div class="rivo-wts-fields">
                    <select class="form-options" id="selected_icon">';
                       foreach($emoji_arr as $emoji){
                          $results_content['form_info'] .= '<option value="'.$emoji.'">'.$emoji.'</option>';
                       }
                    $results_content['form_info'] .= '</select>
    
                    <input type="text" class="ml-1" id="input_original_name" name="input_original_name" value="" placeholder="Input Name">
                    <input type="text" class="ml-1" id="input_replace_name" name="input_replace_name" value="" placeholder="Display Name"> ';

                    $results_content['form_info'] .= '<button id="rivo_wts_bold_format" class="btn-format rivo-wts-bold-format" style="font-weight:bold;">B</button>';
                    $results_content['form_info'] .= '<button id="rivo_wts_italic_format" class="btn-format rivo-wts-italic-format" style="font-style: italic;">I</button>';

              $results_content['form_info'] .= '<button class="delete-group" id="delete-group">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M3 6H5H21" stroke="#FF0000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M8 6V4C8 3.46957 8.21071 2.96086 8.58579 2.58579C8.96086 2.21071 9.46957 2 10 2H14C14.5304 2 15.0391 2.21071 15.4142 2.58579C15.7893 2.96086 16 3.46957 16 4V6M19 6V20C19 20.5304 18.7893 21.0391 18.4142 21.4142C18.0391 21.7893 17.5304 22 17 22H7C6.46957 22 5.96086 21.7893 5.58579 21.4142C5.21071 21.0391 5 20.5304 5 20V6H19Z" stroke="#FF0000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </button>
                </div>
                 <div class="rivo-wts-are-you-sure sure-hidden">
                    Are you sure?
                    <button class="rivo-wts-are-you-sure-true">Yes</button>
                    <button class="rivo-wts-are-you-sure-false">No</button>
                </div>
                </div>
            </div>';
      $results_content['form_info'] .= '<div class="add-new-input-field" id="add-new-input-field">+ Add new input</div>';

      $results_content['form_info'] .= '<div class="form-message-after-successful">
            <label for="form-message-after-successful">Message after successful submission of the form</label>
            <input type="text" id="form_message_after_successful" name="form-message-after-successful" value="">
        </div>';

      $results_content['form_info'] .= '<div class="submition_url_block">
            <input type="checkbox" id="radio_add_url" name="submition_url">
            <label for="radio_add_url">
                Add form submition URL to message
            </label>
        </div>';
   }
}
