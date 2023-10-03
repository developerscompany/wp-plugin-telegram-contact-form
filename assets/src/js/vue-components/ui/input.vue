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
@import "~scss/_variables.scss";
@import "~scss/_misc";

.input-wrapper {
    display: flex;
    align-items: stretch;
    position: relative;
    flex-basis: 100%;
}

input {
    flex-basis: 100%;
    border-radius: $border-radius;
    border: 1px solid $color-border;
    outline: none !important;
    box-shadow: none !important;
    padding: 10px 16px;

    @extend .trans;

    &:focus {
        border-color: $color-gray-focused;
    }
}

</style>