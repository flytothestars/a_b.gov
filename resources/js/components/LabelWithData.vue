<template>
    <div class="mb-3">
        <label><strong>{{label}}</strong></label>
        <template v-if="inline">
            <slot></slot>
        </template>
        <template v-else>
            <div>
                <slot></slot>
            </div>
        </template>
    </div>
</template>

<script>
export default {
    name: "LabelWithData",
    props: {
        label: String,
        inline: {
            type: Boolean,
            default: false
        }
    }
}
</script>

<style scoped>

</style>
