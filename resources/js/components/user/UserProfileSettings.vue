<template>
  <div class="container rounded bg-white mb-3">
    <div class="row p-5 pb-3">
      <h4 class="mt-1">Profile Settings</h4>

      <div class="row justify-content-center text-center">
        <img
          class="rounded-circle profile-img mt-3"
          :src="getUserAvatar(currentUser)"
        /><span class="font-weight-bold">{{ currentUser.name }}</span
        ><span class="text-black-50">{{ currentUser.email }}</span
        ><span> </span>
      </div>
    </div>
    <div class="row justify-content-center border-right">
      <div class="row col-md-5 justify-content-center" v-if="message">
        <li v-if="success" class="alert alert-info mt-1">
          {{ message[0] }}
        </li>
        <li
          v-else
          class="alert alert-danger mt-1"
          v-for="error in message"
          :key="error"
        >
          {{ error[0] }}
        </li>
      </div>

      <div class="row justify-content-center row border-right">
        <div class="row justify-content-center col-md-5 border-right">
          <div class="p-1 py-2">
            <div class="row mt-2">
              <div class="col-md-12">
                <label class="labels">Name</label
                ><input
                  type="text"
                  class="form-control"
                  placeholder="Enter your name"
                  v-model="updatedUserData.name"
                />
              </div>
            </div>
            <div class="row mt-3">
              <div class="col-md-12">
                <label class="labels">Phone Number</label
                ><input
                  type="text"
                  class="form-control"
                  placeholder="Enter your phone number"
                  v-model="updatedUserData.phone"
                />
              </div>

              <div class="col-md-12 mt-3">
                <label class="labels">Room</label
                ><select class="form-select" v-model="updatedUserData.room_id">
                  <option selected>Select your room</option>
                  <option
                    v-for="room in rooms"
                    :value="room.id"
                    :key="room.id"
                    :selected="room.id == updatedUserData.room_id"
                  >
                    {{ room.number }}
                  </option>
                </select>
              </div>
              <div class="col-md-12 mt-3">
                <label class="labels">Branch</label
                ><input
                  type="text"
                  class="form-control"
                  placeholder="Enter yoru branch"
                  v-model="updatedUserData.branch"
                />
              </div>
              <div class="col-md-12 mt-3">
                <label class="labels">Track</label
                ><input
                  type="text"
                  class="form-control"
                  placeholder="Enter your track"
                  v-model="updatedUserData.track"
                />
              </div>
            </div>
            <div class="mt-5 text-center">
              <button
                class="btn btn-primary profile-button"
                type="submit"
                @click="submitupdatedUserData()"
              >
                Save Profile
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import * as currentUser from "@helpers/currentUser.js";
import { getUserAvatar, updateUser } from "@services/usersService.js";
import { getRoomsResource } from "@services/roomsService.js";
export default {
  data() {
    return {
      getUserAvatar: getUserAvatar,
      currentUser: currentUser,
      updateUser: updateUser,
      updatedUserData: {},
      rooms: [],
      message: null,
      success: false,
    };
  },
  created() {
    // get all rooms
    getRoomsResource().then((res) => {
      this.rooms = res.data;
    });
    this.updatedUserData.name = currentUser.name;
    this.updatedUserData.branch = currentUser.branch;
    this.updatedUserData.track = currentUser.track;
    this.updatedUserData.phone = currentUser.phone;
    this.updatedUserData.room_id = currentUser.roomId;
    this.updatedUserData.id = currentUser.id;
  },
  methods: {
    submitupdatedUserData() {
      this.updateUser(this.updatedUserData)
        .then((res) => {
          this.success = true;
          this.message = ["Updated Successfully"];
        })
        .catch((err) => {
          this.success = false;
          this.message = err.response.data.errors;
          console.log(this.message);
        });
    },
  },
};
</script>
<style scoped>
.profile-button {
  background: rgb(14, 144, 144);
  box-shadow: none;
  border: none;
}
.profile-button:hover {
  background: #0a8605;
}
.labels {
  font-size: 15px;
}
.profile-img {
  max-width: 20%;
  max-height: 50%;
}
</style>
