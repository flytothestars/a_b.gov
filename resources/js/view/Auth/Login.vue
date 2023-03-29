<template>
    <v-container class="fill-height auth-page" fluid>
        <v-row align="center" justify="center">
            <v-col cols="12" sm="8" md="6" lg="4">
                <v-card class="elevation-12 ma-auto rounded-lg py-10 px-12" max-width="555px" width="100%">
                    <v-toolbar white flat align="center">
                        <v-toolbar-title class="auth-form__title">{{ $vuetify.lang.t('$vuetify.auth.login.formTitle') }}</v-toolbar-title>
                    </v-toolbar>
                    <v-card-text>
                        <v-form v-model="valid" ref="form" lazy-validation @keyup.native.enter="valid && login()">
                            <v-text-field
                                :label="$vuetify.lang.t('$vuetify.auth.login.userName')"
                                name="username"
                                prepend-inner-icon="mdi-account"
                                type="text"
                                color="blue"
                                outlined
                                v-model="user"
                                :rules="[fieldValidationRules.required(vue)]"
                            />

                            <v-text-field
                                id="password"
                                :label="$vuetify.lang.t('$vuetify.auth.login.password')"
                                name="password"
                                color="blue"
                                outlined
                                prepend-inner-icon="mdi-lock"
                                type="password"
                                v-model="pass"
                                :rules="[fieldValidationRules.required(vue)]"

                            />
                            <div class="red--text" v-if="$store.getters.error">{{$store.getters.error}}</div>
                        </v-form>
                    </v-card-text>
                    <v-card-actions>
<!--                        <v-btn text color="primary" type="button" to="/registration">-->
<!--                            {{ $vuetify.lang.t('$vuetify.auth.login.registrationBtn') }}-->
<!--                        </v-btn>-->
                        <v-spacer/>
                        <v-btn color="blue" x-large dark block type="submit" @click="login" :loading="axiosLoading" :disabled="!valid">
                            {{ $vuetify.lang.t('$vuetify.auth.login.loginBtn') }}
                        </v-btn>
                    </v-card-actions>
                </v-card>
            </v-col>
        </v-row>
    </v-container>
</template>

<script>
// @ is an alias to /src

export default {
    name: "Login",
    data() {
        return {
            valid: false,
            user: '',
            pass: '',
            vue: this
        };
    },
    methods: {
        login() {
            if (this.$refs.form.validate()) {
                const user = {
                    phone: this.user,
                    password: this.pass
                }

                this.$store.dispatch('login', user)
                    .then(() => {
                        this.$router.push({name: "Home"})
                    })
            }
        }
    }
};
</script>

<style scoped>
    .auth-page {
        background-image: url('/images/BG.png');
        background-position: center;
        background-size: cover;
    }
</style>