<template>
  <div>
    <v-container fluid>
      <v-layout row>
        <v-flex xs12>

        </v-flex>
      </v-layout>
    </v-container>
  </div>
</template>

<script>
// @ is an alias to /src

export default {
  name: "Home",
  computed: {

  },
  created() {
    this.$router.push({ name: 'AppealsSandbox' })
  }
};
</script>

<style lang="scss" scoped>
  .link {
    position: absolute;
    bottom: 50px;
    left: 50%;
    background: rgba(0, 0, 0, .5);
    transform: translate(-50%, 0);
    padding: 5px 20px;
    border-top-left-radius: 5px;
    border-top-right-radius: 5px;
  }
</style>