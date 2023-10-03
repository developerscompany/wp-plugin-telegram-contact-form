<script>

export default {
    name:     "wts-page-integrations",
    data:     function () {
        return {
            loading_settings:    false,
            saving_settings:     false,
            error:               '',
            plugin_contact_form: false,
            plugin_wpforms: false,
            plugin_woocommerce:  false,
            settings:            {
                type:    '',
                plugins: []
            }
        }
    },
    computed: {
        i18n() {
            return rivo_wts.i18n
        }
    },
    methods:  {
        load_settings() {
            this.error            = '';
            this.loading_settings = true;

            jQuery.ajax({
                url:  rivo_wts.ajax_url,
                type: 'POST',
                data: {action: 'integrations_load_settings'}
            })
                .done(response => {
                    this.settings = response.data.settings;
                    response.data.settings.plugins.indexOf('contact-form') > -1 && (this.plugin_contact_form = true);
                    response.data.settings.plugins.indexOf('woocommerce') > -1 && (this.plugin_woocommerce = true);
                })
                .fail(jqXHR => this.error = JSON.parse(jqXHR.responseText).data.message)
                .always(() => this.loading_settings = false)
        },
        save_and_continue(e) {
            e.preventDefault();
            this.error           = '';
            this.saving_settings = true;

            jQuery.ajax({
                url:  rivo_wts.ajax_url,
                type: 'POST',
                data: {action: 'integrations_save_settings', payload: JSON.stringify(this.settings)}
            })
                .done(() => location = e.target.href)
                .fail(jqXHR => this.error = JSON.parse(jqXHR.responseText).data.message)
                .always(() => this.saving_settings = false)
        },
        check_plugin_checkboxes() {
            this.settings.plugins = [];
            this.plugin_contact_form && this.settings.plugins.push('contact-form')
            this.plugin_wpforms && this.settings.plugins.push('wpforms')
            this.plugin_woocommerce && this.settings.plugins.push('woocommerce')
        }
    },
    watch:    {
        plugin_contact_form() {
            this.check_plugin_checkboxes();
        },
        plugin_woocommerce() {
            this.check_plugin_checkboxes();
        },
        plugin_wpforms() {
            this.check_plugin_checkboxes();
        },
        'settings.type'() {
            this.error = '';
        }
    },
    mounted() {
        this.load_settings();
    }
}
</script>

<template>
    <div>
        <h1>{{ i18n.choose_integrations }}
            <wts-loader :enabled="loading_settings"></wts-loader>
        </h1>
        <div class="inner">
            <div class="types-selector">
                <div class="radio-wrapper">
                    <input type="radio" id="type_all_emails" value="all-emails" v-model="settings.type">
                    <label for="type_all_emails">{{ i18n.all_emails }}</label>
                    <p class="text-color-gray">{{ i18n.all_emails_sub }}</p>
                </div>
                <div class="radio-wrapper">
                    <input type="radio" id="type_plugins" value="plugins" v-model="settings.type">
                    <label for="type_plugins">{{ i18n.select_forms }}</label>
                    <p class="text-color-gray">{{ i18n.select_forms_sub }}</p>
                </div>
            </div>
            <template v-if="settings.type === 'plugins'">
                <div class="hr"></div>
                <div class="plugins">
                    <wts-checkbox :label="i18n.contact_form" :caption="i18n.contact_form_sub"
                                  v-model="plugin_contact_form"></wts-checkbox>
                    <wts-checkbox :label="i18n.wpforms" :caption="i18n.wpforms_sub"
                                  v-model="plugin_wpforms"></wts-checkbox>
                    <wts-checkbox :label="i18n.woocommerce" :caption="i18n.woocommerce_sub"
                                  v-model="plugin_woocommerce"></wts-checkbox>
                </div>
            </template>
            <div class="hr"></div>
            <div>
                <strong>{{ i18n.also_you_can }}:</strong>
<pre>
if(class_exists('Rivo_WTS_Bot') &&
   method_exists(Rivo_WTS_Bot::class, 'send_message')
) {
    Rivo_WTS_Bot::send_message('Test message');
}
</pre>
            </div>
            <div class="error" v-if="error.length"> {{ error }}</div>
        </div>
        <div class="hr"></div>
        <div class="footer">
            <a :href="i18n.link_bot" class="btn outline-black">{{ i18n.previous_step }}</a>
            <a :href="i18n.link_notifications" class="btn filled" @click="save_and_continue"
               :class="{disabled: !settings.type.length}">
                {{ i18n.save_and_continue }}
                <wts-loader color="white" :enabled="saving_settings"></wts-loader>
            </a>
        </div>
    </div>

</template>

<style lang="scss" scoped>
@import "~scss/_variables.scss";
@import "~scss/_misc";

h1 {
    display: flex;
    align-items: center;
}

.inner {
    display: grid;
    gap: $gap;
}

.types-selector {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 30px;
    align-items: start;
    font-family: "Gilroy Medium";

    label {
        font-size: 14px;
    }

    p {
        font-size: 13px;
        margin-top: 6px;
    }
}

.plugins {
    display: grid;
    gap: $gap;
}

pre {
    padding: $gap;
    white-space: break-spaces;
    border-radius: $border-radius;
    background-color: $color-gray-light;
}

</style>