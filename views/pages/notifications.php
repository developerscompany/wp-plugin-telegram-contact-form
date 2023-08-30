<div class="rivo-wts-plugin-tm">
    <div class="container">
        <h1>Notification settings</h1>

        <div class="content">
            <div class="select-global-form">
                <label for="global-form">Choose form</label>

                <select name="global-form" id="global-form">
                    <option value="mercedes">Mercedes</option>
                    <option value="audi">Audi</option>
                </select>
            </div>

            <div class="global-form-settings">
                <div class="form-message">
                    <label for="form-message">Message before successful submission of the form</label>
                    <input type="text" id="form-message" name="form-message">
                </div>

                <div class="modify-inputs">
                    <div class="rivo-wts-rename-group">
                        <select class="">
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

                        <input type="text" class="ml-1" name="input_original_name" value="777777" placeholder="Input Name">
                        <input type="text" class="ml-1" name="input_replace_name" value="88888888" placeholder="Display Name">

                        <button class="btn-format rivo-wts-bold-format <?php if($input['bold'] == "true"){ echo 'selected'; } ?>" style="font-weight:bold;">
                            B
                        </button>
                        <button class="btn-format rivo-wts-italic-format <?php if($input['italic'] == "true"){ echo 'selected'; } ?>" style="font-style: italic;">
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


                <div class="form-message-after-successful">
                    <label for="form-message-after-successful">Message after successful submission of the form</label>
                    <input type="text" id="form-message-after-successful" name="form-message-after-successful">
                </div>

            </div>
        </div>

        <?php var_dump(Rivo_WTS_Settings_Notifications::get()); ?>

        <div class="footer">
            <a href="<?= Rivo_WTS_Admin_Pages::get_link(Rivo_WTS_Admin_Pages_Integrations::SLUG) ?>" class="btn rivo-rate"><?=  __('Previous Step', Rivo_WTS_TEXTDOMAIN) ?></a>
            <a href="#" id="four_step_button" class="btn rivo-start"><?=  __('Save settings', Rivo_WTS_TEXTDOMAIN) ?></a>
        </div>
    </div>
</div>
