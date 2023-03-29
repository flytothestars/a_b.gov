<template>
  <v-app-bar id="app-bar" absolute app color="transparent" flat height="55" class="appbar-line">
    <!-- <v-btn
      class="mr-3"
      elevation="1"
      fab
      small
      @click="setDrawer(!drawer)"
    >
      <v-icon v-if="value">
        mdi-view-quilt
      </v-icon>

      <v-icon v-else>
        mdi-dots-vertical
      </v-icon>
    </v-btn> -->

    <div class="breadcrumb-title">
      <!-- <v-breadcrumbs
        :items="navItems"
        divider="/"
      ></v-breadcrumbs> -->

      <v-toolbar-title class="hidden-sm-and-down font-weight-light"
        v-text="$vuetify.lang.t('$vuetify.page.' + $route.name + '.name')" />
    </div>

    <v-spacer />

    <v-menu class="profile">
      <template class="top-line__right" v-slot:activator="{ on }">
        <div class="top-line__profile" dense v-on="on">
          <div class="profile__info">
            <span class="profile__info-name">{{userProfile.firstName + ' ' + userProfile.lastName}}</span>
            <div class="profile__info-img">
              <img src="/images/avatar.png" alt="Proifle name" />
            </div>
          </div>
        </div>
      </template>
      <v-list dense>
        <v-list-item @click="switchToProfileInfo">
          <v-list-item-content>
            <v-list-item-title>{{
            $vuetify.lang.t("$vuetify.menu.account")
            }}</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
        <v-divider></v-divider>
        <v-list-item @click="logout">
          <v-list-item-content>
            <v-list-item-title>{{
            $vuetify.lang.t("$vuetify.menu.logout")
            }}</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
      </v-list>
    </v-menu>

    <!-- <v-menu
      bottom
      left
      offset-y
      origin="top right"
      transition="scale-transition"
    >
      <template v-slot:activator="{ attrs, on }">
        <v-btn
          class="ml-2"
          min-width="0"
          text
          v-bind="attrs"
          v-on="on"
        >
          <v-badge
            color="red"
            overlap
            v-if="notifications.length > 0"
            bordered
          >
            <template v-slot:badge>
              <span>{{notifications.length}}</span>
            </template>

            <v-icon>mdi-bell</v-icon>
          </v-badge>
        </v-btn>
      </template>
      <v-list
        :tile="false"
        nav
      >
        <div>
          <app-bar-item
            v-for="(n, i) in notifications"
            :key="`item-${i}`"
          >
            <v-list-item-title v-text="n"/>
          </app-bar-item>
        </div>
      </v-list>
    </v-menu> -->

    <!--    <v-btn-->
    <!--      class="ml-2"-->
    <!--      min-width="0"-->
    <!--      text-->
    <!--      to="/pages/user"-->
    <!--    >-->
    <!--      <v-icon>mdi-account</v-icon>-->
    <!--    </v-btn>-->

    <!-- <v-menu
          bottom
          left
          offset-y
          open-on-hover
          origin="top right"
          transition="scale-transition"
      >
          <template v-slot:activator="{ attrs, on }">
              <v-btn
                  text
                  v-bind="attrs"
                  v-on="on"
              >
                  <v-icon>
                      mdi-translate
                  </v-icon>
                  <v-icon small>
                      mdi-chevron-down
                  </v-icon>
              </v-btn>
          </template>
          <v-list
              nav
              dense
          >
              <v-list-item @click="changeLanguage('kk')">
                  <v-list-item-title>Қазақ</v-list-item-title>
              </v-list-item>
              <v-list-item @click="changeLanguage('ru')">
                  <v-list-item-title>Русский</v-list-item-title>
              </v-list-item>
              <v-list-item @click="changeLanguage('en')">
                  <v-list-item-title>English</v-list-item-title>
              </v-list-item>
          </v-list>
      </v-menu> -->

    <!-- <v-menu>
      <template v-slot:activator="{ on }">
        <v-btn text dense v-on="on">
          <v-icon>mdi-cog-outline</v-icon>
        </v-btn>
      </template>
      <v-list dense>
        <v-list-item to="/profile">
          <v-list-item-content>
            <v-list-item-title>{{
              $vuetify.lang.t("$vuetify.menu.account")
            }}</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
        <v-divider></v-divider>
        <v-list-item @click="logout">
          <v-list-item-content>
            <v-list-item-title>{{
              $vuetify.lang.t("$vuetify.menu.logout")
            }}</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
      </v-list>
    </v-menu> -->
  </v-app-bar>
</template>

<script>
// Components
import { VHover, VListItem } from "vuetify/lib";

// Utilities
import { mapState, mapMutations } from "vuex";

export default {
  name: "DashboardCoreAppBar",

  components: {
    AppBarItem: {
      render(h) {
        return h(VHover, {
          scopedSlots: {
            default: ({ hover }) => {
              return h(
                VListItem,
                {
                  attrs: this.$attrs,
                  class: {
                    "black--text": !hover,
                    "white--text secondary elevation-12": hover,
                  },
                  props: {
                    activeClass: "",
                    dark: hover,
                    link: true,
                    ...this.$attrs,
                  },
                },
                this.$slots.default
              );
            },
          },
        });
      },
    },
  },

  created() {
  },

  props: {
    value: {
      type: Boolean,
      default: false,
    },
  },

  data: () => ({
    notifications: [],
    navItems: [
      {
        text: "Dashboard",
        disabled: false,
        href: "",
      },
      {
        text: "Link 1",
        disabled: false,
        href: "",
      },
      {
        text: "Link 2",
        disabled: true,
        href: "breadcrumbs_link_2",
      },
    ],
  }),

  computed: {
    ...mapState(["drawer"]),
    userProfile() {
      return this.$store.getters.user
    }

  },

  methods: {
    ...mapMutations({
      setDrawer: "SET_DRAWER",
    }),
    logout() {
      this.$store.dispatch("logoff").then(() => {
        this.$router.push({ name: "Login" });
      });
    },
    switchToProfileInfo() {
      // this.$router.push({name: 'InnerReportsView'})
      this.$router.push({ name: 'ProfileAdmin' });
      // location.reload()
    },
    changeLanguage(lang) {
      this.$cookie.set("yupi_lang", lang);
      this.$router.go(0);
    },
  },
};
</script>
