<template>
  <div>
    <p>Hello, Test Component!</p>

    <p>Test avatar:</p>
    <img :src="getAvatar()" />

    <p>Test logout</p>
    <form id="logout-form" action="/logout" method="POST">
      <input type="hidden" name="_token" :value="csrf" />
      <button type="submit">Logout</button>
    </form>
  </div>
</template>

<script>
export default {
  mounted() {
    console.log("Test component mounted.");
  },
  data: () => ({
    csrf: document
      .querySelector('meta[name="csrf-token"]')
      .getAttribute("content"),
  }),
  props: ["user"],

  methods: {
    getAvatar() {
      return "storage/avatars/" + this.user.id + "_" + this.user.avatar;
    },
  },
};
</script>
