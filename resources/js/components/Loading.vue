<template>
  <v-container>
    <v-layout row>
      <v-flex xs12 class="text-center mt-12">
        <v-progress-circular
          indeterminate
          color="primary"
        ></v-progress-circular>
      </v-flex>
    </v-layout>
  </v-container>
</template>
<script>
export default {
  name: "LoadData"
};
</script>
