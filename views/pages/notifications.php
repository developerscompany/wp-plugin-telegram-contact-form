<?php
//Rivo_WTS_Settings_Notifications::set('');
$forms_list = Rivo_WTS_Integrations::get_forms_list();
global $form_settings;
global $first_form;
global $emoji_arr;
$form_settings = Rivo_WTS_Settings_Notifications::get();
$first_form = array_key_first($forms_list);

$emoji = "👤|✉|😍|😃|😀|😀|😃|😄|😁|😆|🥹|😅|😇|😊|☺|🥲|🤣|😀|😂|😃|😀|😄|😁|😆|🥹|😅|😇|😊|☺|😍|🥰|😘|😗|🤪|😜|🥰|😍|😌|😉|🙃|😙|😚|😋|😛|🥰|😜|🥳|🤩|😎|😏|😒|😞|😔|😟|😕";
$emoji_arr = explode("|", $emoji);


if(array_key_exists ('contact-form-7', $form_settings['forms'])){
//   $form_settings['forms']['contact-form-8']['replaces'];
//   var_dump($form_settings['forms']['contact-form-8']['replaces']);
}

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

            <div class="global-form-settings">
                <?php
                global $form;
                $form = Rivo_WTS_Settings_Notifications::get();
                require_once Rivo_WTS_PLUGIN_DIR.'/views/parts/forms_fields_info.php'; ?>
            </div>
        </div>

        <?php print_r(Rivo_WTS_Settings_Notifications::get()); ?>

        <div class="footer">
            <a href="<?= Rivo_WTS_Admin_Pages::get_link(Rivo_WTS_Admin_Pages_Integrations::SLUG) ?>" class="btn rivo-rate"><?=  __('Previous Step', Rivo_WTS_TEXTDOMAIN) ?></a>
            <a href="#" id="four_step_button" class="btn rivo-start"><?=  __('Save settings', Rivo_WTS_TEXTDOMAIN) ?></a>
        </div>
    </div>
</div>
