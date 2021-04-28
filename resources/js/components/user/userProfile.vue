<template>
  <div class="conatiner">
    <div class="row justify-content-center">
      <div class="col-md-3">
        <div class="card d-flex shadow-lg" style="width: 28rem">
          <div class="images-div">
            <img
              :src="coffeeBeansImage"
              alt=""
              class="card-img-top image-cover"
            />
            <img
              :src="getUserAvatar(currentUser)"
              class="card-img-overlay profile-img"
              alt=""
            />
          </div>
          <div class="card-body">
            <h4 class="card-title text-center card-user-name">
              {{ currentUser.name }}
            </h4>
            <p class="text-muted text-center">{{ currentUser.email }}</p>
            <div class="container-fluid">
              <div class="row justify-content-center">
                <div class="col-md-2">
                  <span class="badge rounded-pill">{{ currentUser.role }}</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import * as currentUser from "@helpers/currentUser.js";
import { getUserAvatar } from "@services/usersService.js";
import { publicBase } from "@helpers/urls.js";
import { csrf } from "@services/authenticationService.js";
import coffeeBeansImage from "../../images/coffee-beans.jpg";

export default {
  data() {
    return {
      csrf: csrf,
      getUserAvatar: getUserAvatar,
      currentUser: currentUser,
      publicBase: publicBase,
      coffeeBeansImage: coffeeBeansImage,
    };
  },
  created() {},
};
</script>
<style scoped>
.profile-img {
  border-radius: 50%;
  width: 30%;
  top: 80%;
  left: 35%;
}

.image-cover {
  opacity: 0.6;
  border-top-left-radius: 5%;
  border-top-right-radius: 5%;
}

.images-div {
  position: relative;
  background: black;
  border-top-left-radius: 5%;
  border-top-right-radius: 5%;
}

.card {
  border-radius: 5%;
}

.card-user-name {
  margin-top: 15%;
}

.rounded-pill {
  font-size: 15px;
  background-color: rgb(163, 104, 63);
}
</style>
