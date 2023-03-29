<template>
  <v-container class="fill-height" fluid>
    <v-row align="center" justify="center">
      <v-col cols="12" sm="8" md="6" lg="4">
        <v-card class="elevation-12">
          <v-toolbar color="primary" dark flat>
            <v-toolbar-title>Registration form</v-toolbar-title>
            <v-spacer />
          </v-toolbar>
          <v-card-text>
            <v-form v-model="valid" ref="form" lazy-validation>
              <v-text-field
                label="Name"
                name="Name"
                prepend-icon="mdi-account"
                type="text"
                v-model="username"
                :rules="[fieldValidationRules.required]"
              />
              <v-text-field
                label="Email"
                name="Email"
                prepend-icon="mdi-email-outline"
                type="email"
                v-model="email"
                :rules="[fieldValidationRules.required, fieldValidationRules.email]"
              />

              <v-text-field
                id="password"
                label="Password"
                name="password"
                prepend-icon="mdi-lock"
                type="password"
                v-model="password"
                :rules="[fieldValidationRules.required, fieldValidationRules.newPassword]"
              />

              <v-text-field
                id="confirm_password"
                label="Confirm Password"
                name="confirm_password"
                prepend-icon="mdi-lock"
                type="password"
                v-model="confirm_password"
                :rules="[fieldValidationRules.required, fieldValidationRules.newPassword, fieldValidationRules.confirmPassword(this.password)]"
              />
            </v-form>
          </v-card-text>
          <v-card-actions>
            <v-spacer />
            <v-btn color="primary" @click="register" :disabled="!valid">Create account</v-btn>
          </v-card-actions>
        </v-card>
      </v-col>
    </v-row>
    <v-row v-if="showRegisterNotification">
      <v-col>
        <p>We are send you email to continue see instruction</p>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
// @ is an alias to /src

export default {
  name: "Registration",
  data() {
    return {          
      valid: false,
      username: '',
      email: '',
      password: '',
      confirm_password: '',
      showRegisterNotification: false
    };
  },
  methods:{
    register(){
      if(this.$refs.form.validate()){
       const newUser = {
         username: this.username,
         email: this.email,
         password: this.password,
         callback: '/confirm_mail'
       }
        this.$store.dispatch('retrieveRegister', newUser)
                .then(() => {
                  this.showRegisterNotification = true
                })
      }      
    }
  }
};
</script>
