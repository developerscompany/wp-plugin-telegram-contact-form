<div id="message-tab" class="tab-pane" role="tabpanel">
    <div id="message-tab-wrapper">                              
        <div class="tab-header">
            <h2> <?php _e('Notification Message Options', 'rivoforms'); ?> </h2>                    
        </div>

        <div class="rft-inner-tab-content">
            <div id="message-tab-1" class="tab-pane-inner">
                
                <form class="rft-form" > 
                    
                    <p class="description"><?php _e('Message before form data', 'rivoforms'); ?></p>
                    <div class="form-group">
                        <div class="rft-input-group textarea-input-group">
                            <textarea  class="" id="tm_bot_msg_before" name="tm_bot_msg_before" value="<?php echo self::$tm_bot_settings['msg_text_before'] ?>"><?php echo self::$tm_bot_settings['msg_text_before'] ?></textarea>                            
                        </div>  
                    </div>                     

                    <p class="description"><?php _e('Modify input names output', 'rivoforms'); ?></p>
                    <div class="form-group">

                    <?php
                    // self::$settings->delete_all_options();
                    $inputs = self::$settings->get_input_settings();
                    // echo '<pre>';
                    // var_dump($inputs);
                    // echo '</pre>';
                    foreach ($inputs as $input) {                                              
                    ?>  
                        <div class="rft-rename-group" id="rft-input-id-<?php echo $input['id'] ?>">
                            <div class="id"><?php echo $input['id'] ?>.</div>
                           
                            <div class="text-format">
                                <button class="btn-format rft-active-format <?php if($input['active'] == "true"){ echo 'selected'; } ?>" >
                                    0
                                </button>
                                <input type="hidden" name="rft-active-format-value" value="<?php echo $input['active']; ?>">  
                            </div>
                            
                            <select class="">
                                <option> </option>                                
                                <option value="🔘" <?php if($input['emoji'] == '🔘'){ echo 'selected'; } ?> >🔘</option>
                                <option value="✅" <?php if($input['emoji'] == '✅'){ echo 'selected'; } ?> >✅</option>
                                <option value="👤" <?php if($input['emoji'] == '👤'){ echo 'selected'; } ?> >👤</option>
                                <option value="📱" <?php if($input['emoji'] == '📱'){ echo 'selected'; } ?> >📱</option>
                                <option value="✉️" <?php if($input['emoji'] == '✉️'){ echo 'selected'; } ?> >✉️</option>
                                <option value="🕒" <?php if($input['emoji'] == '🕒'){ echo 'selected'; } ?> >🕒</option>
                                <option value="🗓" <?php if($input['emoji'] == '🗓'){ echo 'selected'; } ?> >🗓</option>
                                <option value="💵" <?php if($input['emoji'] == '💵'){ echo 'selected'; } ?> >💵</option>
                                <option value="🛒" <?php if($input['emoji'] == '🛒'){ echo 'selected'; } ?> >🛒</option>                                
                            </select>
                            <input type="text" class="ml-1" name="input_original_name" value="<?php echo $input['original']; ?>" placeholder="Input Name">
                            <input type="text" class="ml-1" name="input_replace_name" value="<?php echo RFT_Utility::clean_input_string( $input['replace'] ); ?>" placeholder="Display Name">
                            <div class="text-format">
                                <button 
                                    class="btn-format rft-bold-format <?php if($input['bold'] == "true"){ echo 'selected'; } ?>" 
                                    style="font-weight:bold;">
                                    B
                                </button>
                                <button 
                                    class="btn-format rft-italic-format <?php if($input['italic'] == "true"){ echo 'selected'; } ?>" 
                                    style="font-style: italic;">
                                    I
                                </button>
                                <input type="hidden" name="rft-bold-format-value" value="<?php echo $input['bold']; ?>">                           
                                <input type="hidden" name="rft-italic-format-value" value="<?php echo $input['italic']; ?>">
                            </div>
                        </div>                    
                    <?php } ?>                        
                    </div> 

                    <!-- <div class="spacer"></div> -->

                    <p class="description"><?php _e('Message after form data', 'rivoforms'); ?></p>
                    <div class="form-group">
                        <div class="rft-input-group textarea-input-group">
                            <textarea  class="" id="tm_bot_msg_after" name="tm_bot_msg_after" value="<?php echo self::$tm_bot_settings['msg_text_after'] ?>"><?php echo self::$tm_bot_settings['msg_text_after'] ?></textarea>                            
                        </div>  
                    </div>  

                    <!-- <div class="spacer"></div>    -->

                    <p class="description"><?php _e('Other options', 'rivoforms'); ?></p>
                    <div class="form-group">                       
                        <div class="rft-input-group"> 
                            <?php $tm_bot_add_form_url = self::$tm_bot_settings['msg_add_url'] == "true" ? 'checked' : ''; ?>
                            <input type="checkbox" class="" id="tm_bot_add_form_url" name="tm_bot_add_form_url" <?php echo $tm_bot_add_form_url; ?> >
                            <label for="tm_bot_add_form_url"><?php _e('add form submition url to message', 'rivoforms'); ?></label>
                        </div> 
                    </div> 

                    <div class="rft-submit-wrap">
                        <button class="rft-submit button button-primary" style="margin-right:6px">Save Settings</button>
                    </div>
                </form>

            </div>
        </div>

    </div>
</div>