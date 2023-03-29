<template>
    <div class="side-filter">
        <v-navigation-drawer v-model="filterDrawer" fixed temporary stateless right width="472" class="pa-6">

            <div class=" mb-6">
                Фильтр
            </div>

            <slot></slot>
            <template v-slot:append>
                <v-row>
                    <v-col cols="6">
                        <v-btn color="primary" block large outlined @click="cancel">
                            Очистить
                        </v-btn>
                    </v-col>
                    <v-col cols="6">
                        <v-btn color="primary" block large @click="confirm">
                            {{ $vuetify.lang.t('$vuetify.page.action.apply') }}
                        </v-btn>
                    </v-col>
                </v-row>
            </template>
        </v-navigation-drawer>
    </div>
</template>

<script>

export default {
    name: "SideFilter",
    props: {
        value: {
            type: Boolean,
            default: false,
        }
    },
    mounted() {

    },
    data() {
        return {
        }
    },
    computed: {
        filterDrawer: {
            get() {
                return this.value
            },
            set(value) {
                this.$emit('input', value)
            },
        },
    },
    methods: {
        cancel() {
            this.key += 1
            this.filterDrawer = false
            this.$emit('cancel')
            this.$emit('confirm')
        },
        confirm() {
            this.filterDrawer = false
            this.$emit('confirm')
        },

    }
}
</script>

<style scoped>

</style>
