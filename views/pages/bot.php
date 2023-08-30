<?php $bot_settings = Rivo_WTS_Settings_Bot::get();
if(empty($bot_settings['token'])){
    $nextButtonClass= 'isDisabled';
}
//$bot_settings = Rivo_WTS_Settings_Bot::set(['token'=>'7777777777', 'chat_ids'=>[] ]);
?>
<div class="rivo-wts-plugin-tm">
    <div class="container">
        <h1>Telegram Bot Settings</h1>

        <div class="content">
            <div class="additional-information">
                <p>Please, provide correct info <a href="https://core.telegram.org/bots/api" target="_blank">Get Token</a></p>
                <p>Obtaining a token is as simple as contacting <a href="https://t.me/botfather" target="_blank">@BotFather</a>,
                    issuing the <code>/newbot</code> command and following the steps until you're given a new token. You can find a step-by-step guide <a href="https://core.telegram.org/bots/features#creating-a-new-bot" target="_blank">here</a>.</p>
            </div>
            <div class="token-field">
                <input type="text" class="" id="tm_bot_token" name="tm_bot_token" value="<?php echo $bot_settings['token']; ?>" placeholder="Token">
                <button class="button aply-tocken-button" data-action="getMe">Apply Token</button>
            </div>
            <div class="message-field"></div>

            <div class="chats-list">
                <?php
                    try {
                       echo '<p>Choose chat</p>';
                       foreach (Rivo_WTS_Bot::get_chats_list() as $chat_id => $chat_name){ ?>
                           <div class="check-chat">
                               <input type="radio" id="<?php echo $chat_id; ?>" name="single_chat_id"
                                      value="<?php echo $chat_id; ?>"
                                   <?php echo in_array($chat_id, $bot_settings['chat_ids']) ? "checked": ""?>
                               >
                               <label for="<?php echo $chat_id; ?>"><?php echo $chat_name; ?></label>
                           </div>
                       <?php }
                    } catch (Exception $e) {

                    } ?>
            </div>
        </div>

<!--        --><?php //var_dump($bot_settings['token']); ?>

<!--       --><?php //var_dump(Rivo_WTS_Bot::get_me('6105244384:AAFffAN5GujjrpM34nR9VwIzR2SdYJOBbPE')); ?>

<!--       --><?php //var_dump(Rivo_WTS_Bot::get_me('6695784802:AAEoc3PNbdcm19h8wO8w9cwTM2WxeB22ZV8')); ?>

<!--       --><?php //var_dump(Rivo_WTS_Bot::get_chats_list()); ?>
<!---->
<!--        --><?php //foreach (Rivo_WTS_Bot::get_chats_list() as $chat_list_item){?>
<!--            <input type="radio" id="--><?php //echo $chat_list_item['chat_id']; ?><!--" name="fav_language" value="--><?php //echo $chat_list_item['chat_name']; ?><!--">-->
<!--            <label for="html">--><?php //echo $chat_list_item['chat_name']; ?><!--</label><br>-->
<!--        --><?php //} ?>



        <?php
//        try {
//           $bot_test = Rivo_WTS_Bot::get_chats_list();
//           foreach (Rivo_WTS_Bot::get_chats_list() as $chat_list_item){ ?>
<!--               <input type="radio" id="--><?php //echo $chat_list_item['chat_id']; ?><!--" name="fav_language" value="--><?php //echo $chat_list_item['chat_name']; ?><!--">-->
<!--               <label for="--><?php //echo $chat_list_item['chat_id']; ?><!--">--><?php //echo $chat_list_item['chat_name']; ?><!--</label><br>-->
<!--           --><?php //}
//        } catch (Exception $e) {
//          echo '<p>Error of chat lists</p>';
//        }


        ?>

        <div class="footer">
            <a href="<?= Rivo_WTS_Admin_Pages::get_link(Rivo_WTS_Admin_Pages_About::SLUG) ?>" class="btn rivo-rate"><?=  __('Preview step', Rivo_WTS_TEXTDOMAIN) ?></a>
            <a href="<?= Rivo_WTS_Admin_Pages::get_link(Rivo_WTS_Admin_Pages_Integrations::SLUG) ?>" id="second_step_button" class="btn rivo-start <?php echo $nextButtonClass; ?>"><?=  __('Save and continue', Rivo_WTS_TEXTDOMAIN) ?></a>
        </div>
    </div>
</div>
