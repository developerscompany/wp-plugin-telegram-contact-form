<script>
export default {
    name: "wts-input-caption",
    props: ['text']
}
</script>

<template>
    <div v-if="text && text.length">{{ text }}</div>

</template>

<style scoped lang="scss">
@import "~scss/_variables.scss";
@import "~scss/_misc";

div {
    position: absolute;
    top: 0;
    left: 16px;
    padding: 1px 5px;
    transform: translateY(-50%);
    background-color: white;
    font-size: 11px;
    color: rgba(#1B2023, .5);
    border-radius: $border-radius;
}

</style>