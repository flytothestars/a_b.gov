<template>
    <v-row>
        <v-col cols="12" md="6">
            <v-card>
                <v-card-text>
                    <v-form ref="clientSettingsForm">
                        <v-text-field
                            outlined
                            dense
                            v-model="workerWebhookUrl"
                            :label="$vuetify.lang.t('$vuetify.page.Camunda.ClientSettings.workerWebhookUrl')"
                        ></v-text-field>
                        <v-text-field
                            outlined
                            dense
                            v-model="workerWebhookSecret"
                            :label="$vuetify.lang.t('$vuetify.page.Camunda.ClientSettings.workerWebhookSecret')"
                        ></v-text-field>
                    </v-form>
                    <v-alert
                        v-if="saved"
                        outlined
                        type="success"
                    >
                        Изменения сохранены
                    </v-alert>
                </v-card-text>
                <v-card-actions>
                    <v-btn
                        @click="save"
                    >
                        Сохранить
                    </v-btn>
                </v-card-actions>
            </v-card>
        </v-col>
    </v-row>

</template>

<script>
import {actionType as actionType} from "../../store/camunda";

export default {
    name: "ClientSettings",
    data(){
        return{
            workerWebhookUrl: null,
            workerWebhookSecret: null,
            saved: false
        }
    },
    created() {
        this.$store.dispatch(actionType.getClientSettings).then(request => {
            this.workerWebhookUrl = request.workerWebhookUrl
            this.workerWebhookSecret = request.workerWebhookSecret
        })
    },
    methods:{
        save(){
            if(this.$refs.clientSettingsForm.validate()){
                this.$store.dispatch(actionType.storeClientSettings, {
                    workerWebhookUrl: this.workerWebhookUrl,
                    workerWebhookSecret: this.workerWebhookSecret,
                }).then(() => {
                    this.saved = true
                }).catch(() => {
                    this.saved = false
                })
            }
        }
    }
}
</script>

<style scoped>

</style>
