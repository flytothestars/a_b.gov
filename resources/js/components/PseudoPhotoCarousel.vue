<template>
    <v-sheet
        max-width="970"
        class="mx-auto pseudo-photo-carousel">

        <v-expand-transition>
            <template
                v-if="selectedImage != null"
            >
                <v-row
                    class="fill-height"
                    align="center"
                    justify="center"
                >
                    <v-card
                        class="ma-4"
                        max-height="510"
                        max-width="970"
                    >
                        <v-img
                            :src="selectedImage.link"
                            max-height="510"
                            contain
                        >
                        </v-img>
                    </v-card>
                </v-row>
            </template>
        </v-expand-transition>

        <v-slide-group
            class="pa-4"
            show-arrows
            v-model="selectedImage"
        >
            <v-slide-item
                v-for="item in value"
                :key="item.id"
            >
                <v-card
                    class="ma-4"
                    @click="toggle(item)"
                    max-width="200"
                >
                    <v-img v-if="item.photo_url"
                        :src="item.photo_url"
                        :gradient="itemSelected ? '' :'rgba(255,255,255,.2)'"
                        max-height="125"
                        contain
                    >
                    </v-img>
                    <v-card-text>{{item.description}}</v-card-text>
                    <v-card-actions v-if="item.link">
                        <a :href="item.link" target="_blank">Скачать</a>
                    </v-card-actions>
                </v-card>
            </v-slide-item>
        </v-slide-group>
    </v-sheet>

</template>

<script>
    export default {
        name: "PseudoPhotoCarousel",
        props: {
            value: {
                type: Array,
                default: [],
            },
        },
        data() {
            return {
                images: [],
                selectedImage: null
            }
        },
        watch: {
            value(val) {
                this.selectedImage = val[0]
            }
        },
        created() {
            this.selectedImage = this.value[0]
        },
        methods: {
            toggle(item) {
                this.selectedImage = item
            },
            itemSelected(item) {
                return this.selectedImage === item
            }
        }
    }
</script>

<style scoped>

</style>
