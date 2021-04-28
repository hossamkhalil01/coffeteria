<template>
  <div class="container-fluid">
    <Navigation />
  </div>
  <div class="container-fluid">
    <router-view />
  </div>
</template>
<script>
import Navigation from "@layouts/user/Navigation";

export default {
  components: {
    Navigation,
  },

  data() {
    return {};
  },

  methods: {},
};
</script>

