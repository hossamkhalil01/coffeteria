<template>
  <div>
    <button class="btn btn-success">test strap</button>
    Hello!
    {{ user.name }}
    {{ csrf }}
  </div>
</template>

<script>
import { csrf, user } from "../main.js";

export default {
  mounted() {
    console.log("Test component mounted.");
  },
  data() {
    return {
      csrf: csrf,
      user: user,
    };
  },
};
</script>
