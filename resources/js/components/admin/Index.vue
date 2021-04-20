<template>
  <Navigation />
  <router-view />
</template>

<script>
import Navigation from "./layouts/Navigation";

export default {
  components: {
    Navigation,
  },

  data() {
    return {
      //   csrf: csrf,
      //   user: user,
    };
  },

  methods: {
    getAvatar() {
      //   return "storage/avatars/" + this.user.id + "_" + this.user.avatar;
    },
  },
};
</script>

