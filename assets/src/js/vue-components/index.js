import Vue from "vue";
import vClickOutside from 'v-click-outside';

Vue.use(vClickOutside);


Vue.component('wts-loader', require('./ui/loader.vue').default);
Vue.component('wts-checkbox', require('./ui/checkbox.vue').default);
Vue.component('wts-checkbox-button', require('./ui/checkbox-button.vue').default);
Vue.component('wts-input', require('./ui/input.vue').default);
Vue.component('wts-input-caption', require('./ui/input-caption.vue').default);
Vue.component('wts-emoji-select', require('./ui/emoji-select.vue').default);
Vue.component('wts-form-select', require('./ui/form-select.vue').default);
Vue.component('wts-page-bot', require('./pages/bot.vue').default);
Vue.component('wts-page-integrations', require('./pages/integrations.vue').default);
Vue.component('wts-page-notifications', require('./pages/notifications.vue').default);