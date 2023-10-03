<script>
export default {
    name: "wts-checkbox",
    props: ['value', 'label', 'caption'],
    data: function(){
        return {
            random_id: 'checkbox' + Math.round(Math.random(5) * 100 * Math.random(5) * 100)
        }
    },
    methods: {
        onChange(value) {
            this.$emit('input', value);
        }
    }
}
</script>

<template>
    <div class="checkbox-wrapper">
        <input type="checkbox" :checked="value" :id="random_id" @input="event => onChange(event.target.checked)">
        <label :for="random_id">{{ label }}</label>
        <div class="caption text-color-gray" v-if="caption && caption.length">{{ caption }}</div>
    </div>

</template>

<style scoped lang="scss">
@import "~scss/_variables.scss";
@import "~scss/_misc";

    input {
        display: none;

        & + label {
            position: relative;
            padding-left: 28px;
            font-size: 14px;

            &::before,
            &::after {
               position: absolute;
                top: 50%;
                transform: translateY(-50%);
                content: '';
            }

            &::before {
                left: 0;
                width: 16px;
                height: 16px;
                border: 1px solid $color-gray;
                border-radius: 2px;
            }

            &::after {
                left: 2px;
                width: 14px;
                height: 11px;
                margin-top: -1px;
                background-size: 100%;
            }
        }

        &:checked + label {
            &::before {
                border-color: $color-main;
            }

            &::after {
                background-image: url(~images/icons/icon-checkbox.svg);
            }
        }
    }

.caption {
    margin-top: 6px;
    font-size: 13px;
}


</style>