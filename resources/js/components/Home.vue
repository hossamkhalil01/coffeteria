<template>
  <div>
    <h1>Home Component</h1>
    <h3>Welcome: {{ user.name }}</h3>

    <img :src="getAvatar()" />
  </div>
</template>

<script>
import { csrf, user } from "../main.js";

export default {
  mounted() {
    console.log("Home component mounted.");
  },
  data() {
    return {
      csrf: csrf,
      user: user,
    };
  },

  methods: {
    getAvatar() {
      return "storage/avatars/" + this.user.id + "_" + this.user.avatar;
    },
  },
};
</script>
