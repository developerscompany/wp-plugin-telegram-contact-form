<?php
//Rivo_WTS_Settings_Notifications::set('');
$forms_list = Rivo_WTS_Integrations::get_forms_list();
$form_settings = Rivo_WTS_Settings_Notifications::get();
$first_form = array_key_first($forms_list);

var_dump($form_settings);

?>
<div class="rivo-wts-plugin-tm">
    <div class="container">
        <h1>Notification settings</h1>

<!--        --><?php //var_dump(Rivo_WTS_Integrations::get_forms_list());?>

        <div class="content">
            <div class="select-global-form">
                <label for="global-form">Choose form</label>

                <select name="global-form" id="global-form">
                   <?php foreach ($forms_list as $form_id => $form_name){ ?>
                       <option value="<?php echo $form_id; ?>">
                          <?php echo $form_name; ?>
                       </option>
                   <?php } ?>
                </select>
            </div>

<!--            --><?php //var_dump($first_form, $form_settings['forms']);
//            var_dump(array_key_exists ($first_form, $form_settings['forms']) );
//
//            ?>

            <div class="global-form-settings">
                <?php
                if(array_key_exists ($first_form, $form_settings['forms']) == true){ ?>
                    <div class="form-message">
                        <label for="form-message">Message before successful submission of the form</label>
                        <input type="text" id="form_message_before_successful" name="form-message" value="<?php echo $form_settings[$first_form]['text_before']; ?>">
                    </div>

                    <div class="modify-inputs">
                        <?php foreach ($form_settings['forms'][$first_form]['replaces'] as $form_field){ ?>
                            <div class="rivo-wts-rename-group">
                                <select class="form-options" id="selected_icon">
                                    <option> </option>
                                    <option value="🔘" <?php if($form_field['icon'] == '🔘'){ echo 'selected'; } ?> >🔘</option>
                                    <option value="✅" <?php if($form_field['icon'] == '✅'){ echo 'selected'; } ?> >✅</option>
                                    <option value="👤" <?php if($form_field['icon'] == '👤'){ echo 'selected'; } ?> >👤</option>
                                    <option value="📱" <?php if($form_field['icon'] == '📱'){ echo 'selected'; } ?> >📱</option>
                                    <option value="✉" <?php if($form_field['icon'] == '✉'){ echo 'selected'; } ?> >✉</option>
                                    <option value="🕒" <?php if($form_field['icon'] == '🕒'){ echo 'selected'; } ?> >🕒</option>
                                    <option value="🗓" <?php if($form_field['icon'] == '🗓'){ echo 'selected'; } ?> >🗓</option>
                                    <option value="💵" <?php if($form_field['icon'] == '💵'){ echo 'selected'; } ?> >💵</option>
                                    <option value="🛒" <?php if($form_field['icon'] == '🛒'){ echo 'selected'; } ?> >🛒</option>
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
                        <?php } ?>
                            </div>

                            <div class="add-new-input-field" id="add-new-input-field">
                                + Add new input
                            </div>

                        <div class="form-message-after-successful">
                            <label for="form-message-after-successful">Message after successful submission of the form</label>
                            <input type="text" id="form_message_after_successful" name="form-message-after-successful" value="<?php echo $form_settings[$first_form]['text_after']; ?>">
                        </div>

                        <div class="submition_url_block">
                            <input type="checkbox" id="radio_add_url" name="submition_url" <?php if($form_settings[$first_form]['add_url'] == "true"){ echo 'checked'; } ?>>
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
                        <div class="rivo-wts-rename-group">
                            <select class="form-options" id="selected_icon">
                                <option> </option>
                                <option value="🔘" <?php if($input['emoji'] == '🔘'){ echo 'selected'; } ?> >🔘</option>
                                <option value="✅" <?php if($input['emoji'] == '✅'){ echo 'selected'; } ?> >✅</option>
                                <option value="👤" <?php if($input['emoji'] == '👤'){ echo 'selected'; } ?> >👤</option>
                                <option value="📱" <?php if($input['emoji'] == '📱'){ echo 'selected'; } ?> >📱</option>
                                <option value="✉" <?php if($input['emoji'] == '✉'){ echo 'selected'; } ?> >✉</option>
                                <option value="🕒" <?php if($input['emoji'] == '🕒'){ echo 'selected'; } ?> >🕒</option>
                                <option value="🗓" <?php if($input['emoji'] == '🗓'){ echo 'selected'; } ?> >🗓</option>
                                <option value="💵" <?php if($input['emoji'] == '💵'){ echo 'selected'; } ?> >💵</option>
                                <option value="🛒" <?php if($input['emoji'] == '🛒'){ echo 'selected'; } ?> >🛒</option>
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
                <?php } ?>

            </div>
        </div>

        <?php print_r(Rivo_WTS_Settings_Notifications::get()); ?>

        <div class="footer">
            <a href="<?= Rivo_WTS_Admin_Pages::get_link(Rivo_WTS_Admin_Pages_Integrations::SLUG) ?>" class="btn rivo-rate"><?=  __('Previous Step', Rivo_WTS_TEXTDOMAIN) ?></a>
            <a href="#" id="four_step_button" class="btn rivo-start"><?=  __('Save settings', Rivo_WTS_TEXTDOMAIN) ?></a>
        </div>
    </div>
</div>
