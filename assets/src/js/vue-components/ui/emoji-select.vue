<script>
export default {
    name: "wts-emoji-select",
    props: ['value'],
    data(){
        return {
            opened: false
        }
    },
    computed: {
        i18n() {
            return rivo_wts.i18n
        }
    },
    methods: {
        click_outside() {
            this.opened = false;
        },
        on_select(emoji) {
            this.opened = false
            this.$emit('input', emoji);
        }
    }
}
</script>

<template>
    <div class="select-wrapper" v-click-outside="click_outside">
        <div class="current" @click="() => this.opened = true">{{ value ? value : ' '}}</div>
        <div class="list" v-if="opened">
            <div class="list-wrapper">
                <div class="list-inner">
                    <div class="item" v-for="emoji in i18n.emoji_array" @click="on_select(emoji)">{{ emoji }}</div>
                </div>
            </div>
        </div>
    </div>

</template>

<style scoped lang="scss">
@import "~scss/_variables.scss";
@import "~scss/_misc";

.select-wrapper {
    position: relative;
    display: flex;
    align-items: stretch;
    cursor: pointer;
    font-size: 18px;
}

.current {
    position: relative;
    display: flex;
    align-items: center;
    padding-left: 16px;
    padding-right: 36px;
    border: 1px solid $color-border;
    border-radius: $border-radius;
    min-width: 72px;

    &::after {
        position: absolute;
        top: 50%;
        right: 16px;
        transform: translateY(-50%);
        border-top: 4px solid $color-gray;
        border-left: 4px solid white;
        border-right: 4px solid white;
        content: '';
    }
}

.list {
    position: absolute;
    top: 100%;
    left: 0;
    width: auto;
    padding-top: 10px;
    background-color: white;
    border-radius: $border-radius;
    z-index: 5;
}

.list-wrapper {
    padding: 5px;
    border-radius: $border-radius;
    border: 1px solid #efefef;
}

.list-inner {
    display: grid;
    grid-template-columns: repeat(7, 1fr);
    gap: 2px;
    padding: 10px;
    max-height: 190px;
    overflow: auto;
}

</style>