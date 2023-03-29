<template>
    <v-app>
        <dashboard-core-app-bar v-if="isLogged"/>

        <dashboard-core-drawer v-if="isLogged" @drawerUpdate="handleDrawerUpdate"></dashboard-core-drawer>

        <dashboard-core-view :drawerV="drawerV"></dashboard-core-view>
    </v-app>
</template>

<script>
export default {
    name: 'App',
    components: {
        DashboardCoreAppBar: () => import('./components/core/AppBar'),
        DashboardCoreDrawer: () => import('./components/core/Drawer'),
        // DashboardCoreSettings: () => import('./components/core/Settings'),
        DashboardCoreView: () => import('./components/core/View'),
    },
    computed: {
        isLogged() {
            return this.$store.getters.loggedIn
        }
    },
    data: () => ({
        expandOnHover: true,
        drawerV: true,
    }),
    methods: {
        handleDrawerUpdate(event) {
            this.drawerV = event;
        }
    }
}

</script>
