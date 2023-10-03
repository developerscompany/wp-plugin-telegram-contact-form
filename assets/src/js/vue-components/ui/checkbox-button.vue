<script>
export default {
    name: "wts-checkbox-button",
    props: ['value', 'label', 'italic'],
    methods: {
        onChange(value) {
            this.$emit('input', value);
        }
    }
}
</script>

<template>
    <div :class="{checked: value, italic}" @click="onChange(!value)">{{ label }}</div>

</template>

<style scoped lang="scss">
@import "~scss/_variables.scss";
@import "~scss/_misc";

div {
    display: flex;
    align-items: center;
    justify-content: center;
    justify-self: center;
    padding-left: 16px;
    padding-right: 16px;
    min-width: 42px;
    border: 1px solid $color-main;
    border-radius: $border-radius;
    background-color: white;
    color: $color-main;
    font-weight: 600;
    cursor: pointer;

    @extend .trans;

    &.italic {
        font-style: italic;
    }

    &.checked {
        background-color: $color-border;
    }
}

</style>