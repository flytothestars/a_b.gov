<template>
  <v-container class="fill-height" fluid>
  </v-container>
</template>

<script>
// @ is an alias to /src

export default {
  name: "Registration",
  props: {
    userName: String,
    verificationToken: String
  },
  created() {
    this.register()
  },
  methods:{
    register(){
        const verifyData = {
          userName: this.userName,
          verificationToken: this.verificationToken
        }
        this.$store.dispatch('retrieveVerifyEmail', verifyData)
                .then(() => {
                  this.$router.push('Login')
                })
      }
    }
};
</script>
