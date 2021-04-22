<template>
<div class="container">
    <div class="row">
        <form @submit.prevent="updateUser">
            <div class="form-group">
                <lable>Name</lable>
                <input type="text" class="form-control" name="name" v-model="user.name" />
            </div>

            <div class="form-group">
                <lable>email</lable>
                <input type="email" class="form-control" name="email" v-model="user.email" />
            </div>

            <div class="form-group">
                <lable>Room number</lable>
                <select name="room_id" class="form-control" v-model="user.room_id">
                    <option v-for="room in rooms" :value="room.id">
                        {{ room["number"] }}
                    </option>
                </select>
            </div>

            <div class="form-group">
                <label for="Image">Your Profile</label>
                <div class="imagePreviewWrapper" :style="{ 'background-image': `url(${previewImage})` }" @click="selectImage"></div>
                <input type="file" name="avatar" class="custom-file-input" v-on:change="onChange" id="validatedCustomFile" accept="image/*" required>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</div>
</template>

<script>
import {
    apiBase,
    imgBase
} from "@helpers/urls.js";
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
        };
    },
    methods: {
        updateUser() {

            const formData = new FormData()
            formData.append("_method", "patch");
            formData.append('avatar', this.user.avatar)
            formData.append('name', this.user.name)
            formData.append('email', this.user.email)
            formData.append('password', this.user.password)
            formData.append('room_id', this.user.room_id)
            axios
                .post(apiBase + `admin/edituser/${this.$route.params.id}`, formData)
                .then((res) => {
                    this.$router.push({
                        name: "AdminUsers",
                    });
                    //  this.user = res.data;
                });
        },

        onChange(e) {
            this.user.avatar = e.target.files[0];
            this.imageName = e.target.files[0].name;
            this.url = URL.createObjectURL(this.user.avatar);
            console.log(this.user);
        },
        selectImage() {
            this.$refs.fileInput.click();
        },
        // pickFile() {
        //     let input = this.$refs.fileInput;
        //     let file = input.files;
        //     if (file && file[0]) {
        //         let reader = new FileReader();
        //         reader.onload = (e) => {
        //             // this.user.avatar=e.target.file[0].name;
        //             this.previewImage = e.target.result;
        //             this.user.avatar = this.previewImage;
        //         };
        //         reader.readAsDataURL(file[0]);
        //         this.$emit("input", file[0]);
        //     }
        // },
        getrooms() {
            axios
                .get(apiBase + "rooms")
                .then((data) => (this.rooms = data.data))
                .catch(() => {
                    console.log("Error...");
                });
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
