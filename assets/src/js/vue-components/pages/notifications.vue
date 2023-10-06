<script>

export default {
    name:     "wts-page-notifications",
    data:     function () {
        return {
            loading_settings:    false,
            saving_settings:     false,
            error: '',
            selected_form_key: '',
            forms: {},
            sample_replace: false
        }
    },
    computed: {
        forms_count() {
            return Object.keys(this.forms).length
        },
        i18n() {
            return rivo_wts.i18n
        }
    },
    methods:  {
        load_settings() {
            this.error            = '';
            this.selected_form_key = '';
            this.loading_settings = true;

            jQuery.ajax({
                url:  rivo_wts.ajax_url,
                type: 'POST',
                data: {action: 'rivo_wts_notifications_load_settings'}
            })
                .done(response => {
                    this.forms = response.data.forms;
                    this.sample_replace = response.data.sample_replace;

                    if(Object.keys(response.data.forms).length) {
                        this.selected_form_key = Object.keys(response.data.forms)[0]
                    }
                })
                .fail(jqXHR => this.error = JSON.parse(jqXHR.responseText).data.message)
                .always(() => this.loading_settings = false)
        },
        add_replace() {
            this.forms[this.selected_form_key]['replaces'].push(this.sample_replace);
        },
        delete_replace(index) {
            if(confirm('Are you sure?')) {
                this.forms[this.selected_form_key]['replaces'].splice(index, 1);
            }
        },
        save_settings(e) {
            e.preventDefault();
            this.error           = '';
            this.saving_settings = true;

            jQuery.ajax({
                url:  rivo_wts.ajax_url,
                type: 'POST',
                data: {action: 'rivo_wts_notifications_save_settings', payload: JSON.stringify({forms: {...this.forms}})}
            })
                .done(() => this.saved())
                .fail(jqXHR => this.error = JSON.parse(jqXHR.responseText).data.message)
                .always(() => this.saving_settings = false)
        },
        saved() {
            this.$refs.save_button.innerText = this.i18n.saved;

            setTimeout(() => this.$refs.save_button.innerText = this.i18n.save_settings, 2000);
        }
    },
    mounted() {
        this.load_settings();
    }
}
</script>

<template>
    <div>
        <h1>{{ i18n.notification_settings }}
            <wts-loader :enabled="loading_settings"></wts-loader>
        </h1>
        <div class="inner">
            <div v-if="!forms_count && !loading_settings">{{ i18n.no_forms }}</div>
            <wts-form-select :forms="forms" v-model="selected_form_key" v-if="forms_count"></wts-form-select>
            <div class="form-settings" v-if="forms_count">
                <div class="hr"></div>
                <div class="text_before">
                    <wts-input v-model="forms[selected_form_key]['text_before']" :caption="i18n.message_before"></wts-input>
                </div>
                <div class="info">{{ i18n.modify_input }}</div>
                <div class="replaces" v-if="forms[selected_form_key]['replaces'].length">
                    <div class="replace" v-for="(replace, index) in forms[selected_form_key]['replaces']">
                        <wts-emoji-select v-model="replace.emoji"></wts-emoji-select>
                        <wts-input v-model="replace.text_before" :placeholder="i18n.text_before"></wts-input>
                        <wts-input v-model="replace.text_after" :placeholder="i18n.text_after"></wts-input>
                        <wts-checkbox-button v-model="replace.bold" label="B"></wts-checkbox-button>
                        <wts-checkbox-button v-model="replace.italic" label="|" italic="italic"></wts-checkbox-button>
                        <div class="trash"><div class="icon" @click="delete_replace(index)"></div></div>
                    </div>
                </div>
                <div class="add-new-replace" @click="add_replace">{{ '+ ' + i18n.add_new_input}}</div>
                <div class="after">
                    <wts-input v-model="forms[selected_form_key]['text_after']" :caption="i18n.message_after"></wts-input>
                </div>
                <wts-checkbox v-model="forms[selected_form_key]['add_url']" :label="i18n.label_add_url"></wts-checkbox>
            </div>
        </div>
        <div class="error" v-if="error.length"> {{ error }}</div>
        <div class="hr"></div>
        <div class="footer">
            <a :href="i18n.link_integrations" class="btn outline-black">{{ i18n.previous_step }}</a>
            <a :href="i18n.link_notifications" class="btn filled" @click="save_settings"
               :class="{disabled: false}">
                <span ref="save_button">{{ i18n.save_settings }}</span>
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

.form-settings {
    display: grid;
    gap: var(--gap);
}

.replaces {
    display: grid;
    gap: var(--gap);
}

.replace {
    display: grid;
    grid-template-columns: auto 1fr 1fr auto auto auto;
    gap: 10px;
    align-items: stretch;

    > input {
        width: 100%;
    }
}

.trash {
    display: flex;
    align-items: center;
    cursor: pointer;
    opacity: .7;

    &:hover {
        opacity: 1;
    }

    > .icon {
        width: 24px;
        height: 24px;
        background-image: url(~images/icons/icon-trash.svg);
        background-size: 100%;
    }
}

.add-new-replace {
    border: 1px dashed #cdcdcd;
    padding: 15px;
    border-radius: var(--border-radius);
    font-family: "Gilroy SemiBold";
    font-size: 14px;
    text-align:center;
    cursor: pointer;
}

.error {
    margin-bottom: 24px;
}

</style>