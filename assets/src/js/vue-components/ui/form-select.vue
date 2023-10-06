<script>
export default {
    name: "wts-form-select",
    props: ['value', 'forms'],
    data: function(){
        return {
            opened: false
        }
    },
    computed: {
        current_name () { return Object.keys(this.forms).length ? this.forms[this.value].name : ''},
        i18n() {
            return rivo_wts.i18n
        }
    },
    methods: {
        click_outside() {
            this.opened = false;
        },
        on_select(key) {
            this.opened = false
            this.$emit('input', key);
        }
    }
}
</script>

<template>
    <div class="select-wrapper" v-click-outside="click_outside">
        <div class="current" @click="() => this.opened = true">
            <wts-input-caption :text="i18n.choose_form"></wts-input-caption>
            <div class="value">{{ current_name }}</div>
        </div>
        <div class="list" v-if="opened">
            <div class="list-inner scrollbar">
                <div class="item" v-for="(el, key) in forms" @click="on_select(key)">{{ el.name }}</div>
            </div>
        </div>
    </div>
</template>

<style scoped lang="scss">

.select-wrapper {
    position: relative;
    cursor: pointer;
}

.current {
    position: relative;
    padding: 16px;
    border: 1px solid var(--color-orange);
    border-radius: var(--border-radius);

    &::after {
        position: absolute;
        top: 50%;
        right: 16px;
        transform: translateY(-50%);
        border-top: 4px solid var(--color-gray);
        border-left: 4px solid white;
        border-right: 4px solid white;
        content: '';
    }
}

.list {
    position: absolute;
    top: 100%;
    left: 0;
    width: 100%;
    padding-top: 10px;
    background-color: white;
    border-radius: var(--border-radius);
    z-index: 5;
}

.list-inner {
    border-radius: var(--border-radius);
    border: 1px solid #efefef;
    max-height: 275px;
    overflow: auto;
}

.item {
    padding: 16px;
    background-color: white;
    transition: var(--transition);

    &:hover {
        background-color: #f4f4f4;
    }

    &:not(:first-child) {
        border-top: 1px solid #efefef;
    }
}

</style>