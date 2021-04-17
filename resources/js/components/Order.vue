<template>
  <div>
    <h1>Order Component</h1>
  </div>
</template>

<script>
import { csrf, user } from "../main.js";

export default {
  mounted() {
    console.log("Order component mounted.");
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
