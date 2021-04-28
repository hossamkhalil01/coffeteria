<template>
  <div class="form-container">
    <div class="row registration-form">
      <form @submit.prevent="updateUser">
        <div class="form-group">
          <lable>Name</lable>
          <input
            type="text"
            class="form-control item"
            name="name"
            v-model="user.name"
          />
          <span class="text-danger" v-if="errors.name">
            {{ errors.name[0] }}
          </span>
        </div>

        <div class="form-group">
          <lable>email</lable>
          <input
            type="email"
            class="form-control item"
            name="email"
            v-model="user.email"
          />
        </div>

        <div class="form-group">
          <lable>Room number</lable>
          <select
            name="room_id"
            class="form-control item"
            v-model="user.room_id"
          >
            <option v-for="room in rooms" :value="room.id">
              {{ room["number"] }}
            </option>
          </select>

          <span class="text-danger" v-if="errors.room_id">
            {{ errors.room_id[0] }}
          </span>
        </div>

        <div class="form-group">
          <label for="Image">Your Profile</label>
          <div
            class="imagePreviewWrapper"
            :style="{ 'background-image': `url(${previewImage})` }"
            @click="selectImage"
          ></div>
          <input
            type="file"
            name="avatar"
            class="custom-file-input"
            v-on:change="onChange"
            id="validatedCustomFile"
            accept="image/*"
          />
        </div>

        <button type="submit" class="btn btn-block create-account">
          Update
        </button>
      </form>
    </div>
  </div>
</template>

<script>
import { apiBase, imgBase } from "@helpers/urls.js";
export default {
  data() {
    return {
      apiBase: apiBase,
      imgBase: imgBase,
      previewImage: null,
      user: {
        name: "",
        email: "",
        password: "",
        avatar: "",
        room_id: "",
      },
      rooms: [],
      errors: [],
      success: "",
    };
  },
  methods: {
    updateUser() {
      const formData = new FormData();
      formData.append("_method", "patch");
      formData.append("avatar", this.user.avatar);
      formData.append("name", this.user.name);
      formData.append("email", this.user.email);
      formData.append("password", this.user.password);
      formData.append("room_id", this.user.room_id);
      axios
        .post(apiBase + `admin/edituser/${this.$route.params.id}`, formData)
        .then((res) => {
          this.$router.push({
            name: "AdminUsers",
          });
          //  this.user = res.data;
        })
        .catch((e) => {
          if (e.response.status === 422) {
            this.errors = e.response.data.errors;
          }
        });
    },
    onChange(e) {
      this.user.avatar = e.target.files[0];
      this.imageName = e.target.files[0].name;
      this.url = URL.createObjectURL(this.user.avatar);
    },
    selectImage() {
      this.$refs.fileInput.click();
    },
    getrooms() {
      axios
        .get(apiBase + "rooms")
        .then((data) => (this.rooms = data.data))
        .catch(() => {});
    },
  },
  created() {
    axios
      .get(apiBase + `admin/getusers/${this.$route.params.id}`)
      .then((res) => {
        // this.$router.push({name:'adminUsers'});
        this.user.name = res.data.name;
        this.user.email = res.data.email;
        this.user.password = res.data.password;
        this.user.avatar = res.data.avatar;
        this.user.room_id = res.data.room_id;
      });
    this.getrooms();
  },
};
</script>


<style>
body {
}
.form-container {
  background-color: #dee9ff;
}
.registration-form {
  height: 700px;

  padding: 50px 0;
}

.registration-form form {
  background-color: #fff;
  max-width: 600px;
  margin: auto;
  padding: 50px 70px;
  border-radius: 30px;

  box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.075);
}

.registration-form .form-icon {
  text-align: center;
  background-color: #5891ff;
  border-radius: 50%;
  font-size: 40px;
  color: white;
  width: 100px;
  height: 100px;
  margin: auto;
  margin-bottom: 50px;
  line-height: 100px;
}

.registration-form .item {
  border-radius: 20px;
  margin-bottom: 25px;
  padding: 10px 20px;
}

.registration-form .create-account {
  border-radius: 30px;
  padding: 10px 20px;
  font-size: 18px;
  font-weight: bold;
  background-color: #5791ff;
  border: none;
  color: white;
  margin-top: 20px;
}

.registration-form .social-media {
  max-width: 600px;
  background-color: #fff;
  margin: auto;
  padding: 35px 0;
  text-align: center;
  border-bottom-left-radius: 30px;
  border-bottom-right-radius: 30px;
  color: #9fadca;
  border-top: 1px solid #dee9ff;
  box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.075);
}

.registration-form .social-icons {
  margin-top: 30px;
  margin-bottom: 16px;
}

.registration-form .social-icons a {
  font-size: 23px;
  margin: 0 3px;
  color: #5691ff;
  border: 1px solid;
  border-radius: 50%;
  width: 45px;
  display: inline-block;
  height: 45px;
  text-align: center;
  background-color: #fff;
  line-height: 45px;
}

.registration-form .social-icons a:hover {
  text-decoration: none;
  opacity: 0.6;
}

@media (max-width: 576px) {
  .registration-form form {
    padding: 50px 20px;
  }

  .registration-form .form-icon {
    width: 70px;
    height: 70px;
    font-size: 30px;
    line-height: 70px;
  }
}
</style>
