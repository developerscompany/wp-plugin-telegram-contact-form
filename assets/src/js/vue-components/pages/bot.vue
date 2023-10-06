<script>

export default {
    name:     "wts-page-bot",
    data:     function () {
        return {
            loading_settings:     false,
            loading_test_message: false,
            saving_token:         false,
            saving_settings:      false,
            token:                '',
            bot_info:             null,
            chat_list:            [],
            chat_id:              false,
            for_update_chat_list: '',
            error:                '',
            error_apply_token:    '',
            error_test_message:   '',
            settings:             {
                token:    '',
                chat_ids: []
            }
        }
    },
    computed: {
        i18n() {
            return rivo_wts.i18n
        }
    },
    methods:  {
        save_token() {
            this.saving_token      = true;
            this.error_apply_token = '';

            jQuery.ajax({
                url:  rivo_wts.ajax_url,
                type: 'POST',
                data: {action: 'rivo_wts_bot_save_token', payload: JSON.stringify({'token': this.token})}
            })
                .done(() => this.load_settings())
                .fail(jqXHR => this.error_apply_token = JSON.parse(jqXHR.responseText).data.message)
                .always(() => this.saving_token = false)
        },
        load_settings() {
            this.loading_settings = true;
            this.error = '';

            jQuery.ajax({
                url:  rivo_wts.ajax_url,
                type: 'POST',
                data: {action: 'rivo_wts_bot_load_settings'}
            })
                .done(response => {
                    this.settings             = response.data.settings
                    this.bot_info             = response.data.bot_info;
                    this.chat_list            = response.data.chat_list;
                    this.for_update_chat_list = response.data.for_update_chat_list;
                    this.chat_id              = this.settings.chat_ids.length ? this.settings.chat_ids[0] : ''
                    this.token                = this.settings.token;
                })
                .fail(jqXHR => this.error = JSON.parse(jqXHR.responseText).data.message)
                .always(() => this.loading_settings = false)

        },
        send_test_message() {
            this.loading_test_message = true;
            this.error_test_message   = '';

            jQuery.ajax({
                url:  rivo_wts.ajax_url,
                type: 'POST',
                data: {action: 'rivo_wts_bot_send_test_message', chat_id: this.chat_id}
            })
                .fail(jqXHR => this.error_test_message = JSON.parse(jqXHR.responseText).data.message)
                .always(() => this.loading_test_message = false)

        },
        save_and_continue(e) {
            e.preventDefault();
            this.saving_settings = true;

            jQuery.ajax({
                url:  rivo_wts.ajax_url,
                type: 'POST',
                data: {action: 'rivo_wts_bot_save_settings', chat_id: this.chat_id}
            })
                .done(() => location = e.target.href)
                .fail(jqXHR => alert(JSON.parse(jqXHR.responseText).data.message))
                .always(() => this.saving_settings = false)
        }
    },
    mounted() {
        this.load_settings();
    }
}
</script>

<template>
    <div>
        <h1>{{ i18n.tm_bot_settings }}
            <wts-loader :enabled="loading_settings"></wts-loader>
        </h1>
        <div class="inner">
            <div class="info">
                <p><strong>Please, provide correct info <a href="https://core.telegram.org/bots/api" target="_blank">Get
                    Token</a></strong></p>
                <p><strong>Obtaining a token is as simple as contacting <a href="https://t.me/botfather"
                                                                           target="_blank">@BotFather</a>,
                    issuing the <code>/newbot</code> command and following the steps until you're given a new token. You
                    can find a step-by-step guide <a href="https://core.telegram.org/bots/features#creating-a-new-bot"
                                                     target="_blank">here</a>.</strong>
                </p>
            </div>
            <div class="token-settings">
                <div class="form">
                    <wts-input :placeholder="i18n.token" v-model="token"></wts-input>
                    <div class="btn outline-main" @click="save_token">
                        {{ i18n.apply_token }}
                        <wts-loader :enabled="saving_token"></wts-loader>
                    </div>
                </div>
                <div class="error" v-if="error_apply_token.length"> {{ error_apply_token }}</div>
            </div>
            <template v-if="settings.token.length && bot_info">
                <div class="bot-info highlighted-block">
                    <div class="title" v-if="bot_info.first_name">
                        <strong>{{ i18n.active_bot }}:</strong>
                        <span>{{ bot_info.first_name }}</span>
                        <span v-if="bot_info.first_name"> @{{ bot_info.username }}</span>
                    </div>
                </div>
                <div class="highlighted-block" v-html="for_update_chat_list"></div>
                <div class="hr"></div>
                <div class="chat-id-selector">
                    <div class="choose">
                        <div class="title"><strong>{{ i18n.choose_chat }}:</strong></div>
                        <div class="error" v-if="settings.token.length && !Object.keys(chat_list).length">
                            {{ i18n.no_chats }}
                        </div>
                        <div class="chats">
                            <div class="radio-wrapper" v-for="(name, id) in chat_list">
                                <input type="radio" :value="id" :id="'chat_id' + id" v-model="chat_id">
                                <label :for="'chat_id' + id">{{ name }}</label>
                            </div>
                        </div>
                    </div>
                    <div style="text-align: right">
                        <div class="btn outline-main" @click="send_test_message" v-if="chat_id">
                            {{ i18n.send_test_message }}
                            <wts-loader :enabled="loading_test_message"></wts-loader>
                        </div>
                        <div class="error" v-if="error_test_message.length"> {{ error_test_message }}</div>
                    </div>
                </div>
            </template>
            <div class="error" v-if="error.length">{{ error }}</div>
        </div>
        <div class="hr"></div>
        <div class="footer">
            <a :href="i18n.link_about" class="btn outline-black">{{ i18n.previous_step }}</a>
            <a :href="i18n.link_integrations" class="btn filled" @click="save_and_continue"
               :class="{disabled: !chat_id.length}">
                {{ i18n.save_and_continue }}
                <wts-loader color="white" :enabled="saving_settings"></wts-loader>
            </a>
        </div>
    </div>
</template>

<style lang="scss" scoped>
h1 {
    display: flex;
    align-items: center;
}

.inner {
    display: grid;
    gap: var(--gap);
}

.token-settings {
    .form {
        display: flex;
        align-items: stretch;
        gap: 10px;
    }
}

.chats {
    display: grid;
    gap: 10px;
}

.chat-id-selector {
    display: flex;
    gap: 10px;
    align-items: flex-start;

    .choose {
        display: grid;
        gap: 10px;
        flex-basis: 100%;
    }
}
</style>