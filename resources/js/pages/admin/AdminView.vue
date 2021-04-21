<template>
  <Navigation />
  <router-view />
</template>

<script>
import Navigation from "@layouts/admin/Navigation";

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

  methods: {},
};
</script>

