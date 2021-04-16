<template>
  <div>
    <p>Hello, Test Component!</p>

    <p>Test avatar:</p>
    <img :src="getAvatar()" />
  </div>
</template>

<script>
export default {
  mounted() {
    console.log("Test component mounted.");
  },

  props: ["user"],

  methods: {
    getAvatar() {
      return "storage/avatars/" + this.user.id + "_" + this.user.avatar;
    },
  },
};
</script>
