<script>
export default {
    name: "wts-input",
    props: ['placeholder', 'value', 'caption'],
    methods: {
        onChange(value) {
            this.$emit('input', value);
        }
    }
}
</script>

<template>
    <div class="input-wrapper">
        <input type="text" :placeholder="placeholder" :value="value" @input="event => onChange(event.target.value)">
        <wts-input-caption :text="caption"></wts-input-caption>
    </div>
</template>

<style scoped lang="scss">
.input-wrapper {
    display: flex;
    align-items: stretch;
    position: relative;
    flex-basis: 100%;
}

input {
    flex-basis: 100%;
    border-radius: var(--border-radius);
    border: 1px solid var(--color-border);
    outline: none !important;
    box-shadow: none !important;
    padding: 10px 16px;
    transition: var(--transition);

    &:focus {
        border-color: var(--color-gray-focused);
    }
}

</style>