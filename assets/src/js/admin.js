import Vue from "vue";

import "./vue-components";

document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.vue-inst').forEach(el => new Vue({el}));
})

