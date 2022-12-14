<div id="telegram-tab" class="tab-pane" role="tabpanel">
    <div id="telegram-tab-wrapper">
        <div class="tab-header">
            <h2> <?php esc_html_e(' Telegram Bot Settings', 'rivoforms'); ?> </h2>                    
        </div>       

        <div class="rft-inner-tab-content">
            <div id="tm-bot" class="tab-pane-inner">                        
                <form class="rft-form tm-bot-form" action="">                
                    <div id="tm-bot-notices"></div>
                    <p class="description"><?php esc_html_e('Please, provide correct info', 'rivoforms'); ?></p>
                    <div class="form-group">
                        <div class="rft-input-group"> 
                            <label for="tm_bot_token">Token</label>
                            <input type="text" class="" id="tm_bot_token" name="tm_bot_token" value="<?php echo self::$tm_bot_settings['token'] ?>">
                            <button class="button button-secondary tm_bot_test" data-action="getMe"><?php esc_html_e('Test Token', 'rivoforms'); ?></button>
                            <span class="small gray">.../getMe<span>
                        </div> 
                        <div class="rft-input-group"> 
                            <label for="tm_bot_chat_id">Chat_id</label>
                            <input type="text" class="" id="tm_bot_chat_id" name="tm_bot_chat_id" value="<?php echo self::$tm_bot_settings['chat_id'] ?>">
                            <button class="button button-secondary tm_bot_test" data-action="getUpdates"><?php esc_html_e('Get', 'rivoforms'); ?></button>
                            <span class="small gray">.../getUpdates<span>
                        </div>                     
                        <div class="rft-input-group textarea-input-group mt-20">                           
                            <button class="button button-secondary tm_bot_test" data-action="sendMessage"><?php esc_html_e('Test Message', 'rivoforms'); ?></button>
                        </div>  
                    </div>

                    <div class="rft-submit-wrap mt-0">
                        <button class="rft-submit button button-primary" style="margin-right:6px"><?php esc_html_e('Save Settings', 'rivoforms'); ?></button>
                    </div>                                       
                    
                    
                </form>
            </div>

            <!-- <div id="tm-user" class="tab-pane-inner" role="tabpanel">
                <h2>Telegram User settings</h2>
                <form class="rft-form" > 
                    <p class="description">Comming Soon</p>
                </form>
            </div> -->

        </div>
    </div>

</div>