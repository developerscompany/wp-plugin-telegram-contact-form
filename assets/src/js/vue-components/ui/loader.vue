<script>
export default {
    name: "loader",
    props: {
        color: {
            type: String,
            default: 'main'
        },
        enabled: {
            type: Boolean,
            default: false
        }
    }
}
</script>

<template>
    <div :class="{loader: true, [color]: true}" v-if="enabled"></div>
</template>

<style scoped lang="scss">
    .loader {
        width: 20px;
        height: 20px;
        animation: spin .8s infinite linear;
        background-image: url(~images/icons/icon-loader.svg);
        background-size: 100%;

        &.white {
            background-image: url(~images/icons/icon-loader-white.svg);
        }
    }

    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }

</style>