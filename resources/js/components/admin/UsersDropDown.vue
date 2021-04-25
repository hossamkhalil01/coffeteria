<template>
  <div class="row justify-content-center mb-3">
    <h3 class="fw-bold text-center mt-3">Users</h3>
    <div class="col-sm-8">
      <select
        class="form-select"
        id="users"
        required
        v-model="user_id"
        @change="userChoosen"
      >
        <option selected disabled>Select A User</option>
        <option v-for="user in users" :key="user.id" :value="user.id">
          {{ user.name }}
        </option>
      </select>
      <div class="alert alert-danger p-1 mt-2" v-if="user_error">
        Please select a user.
      </div>
    </div>
  </div>
</template>
<script>
import * as user from "@helpers/currentUser.js";
import { apiBase, imgBase } from "@helpers/urls.js";

export default {
  mounted() {},
  data() {
    return {
      apiBase: apiBase,
      imgBase: imgBase,
      user: user,
      user_id: null,
    };
  },
  props: {
    users: Array,
    user_error: Boolean,
  },
  created() {},
  methods: {
    userChoosen() {
      console.log("hello");
      console.log(this.user_id);
      this.$emit("userChoosen", this.user_id);
    },
  },
};
</script>
<style scoped>
@import url("https://fonts.googleapis.com/css2?family=Source+Sans+Pro:ital,wght@0,300;0,400;0,700;1,200&display=swap");

.container-fluid {
  font-family: "Source Sans Pro", sans-serif;
}

img {
  width: 100px;
  height: 100px;
  object-fit: cover;
  display: block;
  margin: auto;
}
.badge {
  position: relative;
  top: -65%;
  right: -60%;
  font-size: 15px;
}

.product-name {
  font-family: "Source Sans Pro", sans-serif;
  font-weight: 300;
}

.bg-info {
  background-color: #1edaff !important;
}
</style>
