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
div {
    display: flex;
    align-items: center;
    justify-content: center;
    justify-self: center;
    padding-left: 16px;
    padding-right: 16px;
    min-width: 42px;
    border: 1px solid var(--color-main);
    border-radius: var(--border-radius);
    background-color: white;
    color: var(--color-main);
    font-weight: 600;
    cursor: pointer;
    transition: var(--transition);

    &.italic {
        font-style: italic;
    }

    &.checked {
        background-color: var(--color-border);
    }
}

</style>