<template>
  <div>
    <h1>Welcome:</h1>
    <span> {{ user.name }}</span>

    <h3>Test logout</h3>
    <form id="logout-form" action="/logout" method="POST">
      <input type="hidden" name="_token" :value="csrf" />
      <button type="submit" class="btn btn-primary">Logout</button>
    </form>

    <h3>Test avatar:</h3>
    <img :src="getAvatar()" />
  </div>
</template>

<script>
import { csrf, user } from "../main.js";

export default {
  mounted() {
    console.log("App main component mounted.");
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
