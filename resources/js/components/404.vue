<template>
  <div class="conatiner-fluid">
    <userNavigation v-if="is_user" />
    <adminNavigation v-if="is_admin" />
  </div>
  <div class="container">
    <div class="row justify-content-center mt-5">
      <div class="col-md-6">
        <img :src="image" alt="" class="img-fluid" />
      </div>
    </div>
    <div class="row justify-content-center mt-5">
      <div class="col-md-6">
        <p class="text-center text-muted">
          Page not found.
          <router-link :to="{ name: 'AdminHome' }" class=""
            >back to homepage.</router-link
          >
        </p>
      </div>
    </div>
  </div>
</template>

<script>
import image from "../images/404_notfound.png";
import userNavigation from "@layouts/user/Navigation";
import adminNavigation from "@layouts/admin/Navigation";
import * as user from "@helpers/currentUser.js";

export default {
  data() {
    return {
      image: image,
      user: user,
      is_admin: false,
      is_user: false,
    };
  },
  components: {
    userNavigation,
    adminNavigation,
  },
  created() {
    if (this.user.role === "user") {
      this.is_user = true;
      this.is_admin = false;
    } else {
      this.is_user = false;
      this.is_admin = true;
    }
  },
};
</script>
