<template>
  <v-main class="main" :style="{paddingLeft: drawerV === false ? '260px' : '55px' }">
    <router-view/>
<!--    <dashboard-core-footer/>-->
  </v-main>
</template>

<script>
  export default {
    name: 'DashboardCoreView',
    props: {
        drawerV: Boolean
    },
    components: {
      DashboardCoreFooter: () => import('./Footer'),
    },
  }
</script>

<style>
    .main {
      background: #E5E5E5;
    }
</style>
