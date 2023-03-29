<template>
    <v-row>
        <v-col cols="12" md="6">
            <v-card>
                <v-card-text>
                    <v-form ref="clientSettingsForm">
                        <v-text-field
                            outlined
                            dense
                            v-model="appealId"
                            :label="$vuetify.lang.t('$vuetify.page.Camunda.AppealsTest.id')"
                        ></v-text-field>
                    </v-form>
                </v-card-text>
                <v-card-actions>
                    <v-btn
                        @click="testStartProcess"
                    >
                        Старт
                    </v-btn>
                </v-card-actions>
            </v-card>
        </v-col>
    </v-row>
</template>

<script>
import {actionType as actionType} from "../../store/camunda";

export default {
    name: "AppealsTest",
    data(){
        return{
            appealId: null,
        }
    },
    methods:{
        testStartProcess(){
            this.$store.dispatch(actionType.startProcess, {id: this.appealId})
        }
    }
}
</script>

<style scoped>

</style>
