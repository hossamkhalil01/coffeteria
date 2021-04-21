<template>
<div class="container">
    <div class="row">
        <form v-on:submit.prevent="adduser">
            <div class="form-group">
                <lable>Name</lable>
                <input type="text" class="form-control" name="name" v-model="user.name" />
            </div>

            <div class="form-group">
                <lable>Email</lable>
                <input type="email" class="form-control" name="email" v-model="user.email" />
            </div>
            <div class="form-group">
                <lable>password</lable>
                <input type="password" class="form-control" name="email" v-model="user.password" />
            </div>

            <div class="form-group">
                <lable>Room number</lable>
                <select name="room_id" class="form-control" v-model="user.room_id">
                    <option v-for="room in rooms" :value="room.id" >
                        {{ room["number"] }}
                    </option>
                </select>
            </div>

            <div class="custom-file mb-3">
                <input type="file" class="custom-file-input" v-on:change="onChange" id="validatedCustomFile" accept="image/*" >
                <label class="custom-file-label" for="validatedCustomFile">Choose Cover Image ...</label>
                <div class="invalid-feedback"></div>
            </div>

            <button type="submit" name="submit" class="btn btn-primary">
                create
            </button>
        </form>
    </div>
</div>
</template>

<script>
import {
    apiBase,
    imgBase
} from "@helpers/urls.js";
import {
    csrf
} from "@services/authenticationService.js";
export default {
    data() {
        return {
            previewImage: null,
            user: {
                name: "",
                email: "",
                password: "",
                image: null,
                room_id:"",
            },
            rooms: [],
        };
    },
    methods: {
        adduser(e) {
          e.preventDefault();
                const existingObj = this;
                const config = {
                    headers: {
                        'content-type': 'multipart/form-data'
                    }
                }
                const formData = new FormData()
                formData.append('image', this.user.image)
                formData.append('name', this.user.name)
                formData.append('email', this.user.email)
                formData.append('password', this.user.password)
                formData.append('room_id', this.user.room_id)
            axios.post(apiBase + "admin/create", formData, config).then((res) => {
                this.$router.push({
                    name: "AdminUsers",
                });
                //  this.user = res.data;
            });
        },
        onChange(e) {
            this.user.image = e.target.files[0];
            // console.log(this.form);
        },

        // console.log(e.target.files[0]);
        // this.user.avatar = e.target.files[0].name;
        // this.image = e.target.files[0];

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
        this.getrooms();
    },
};
</script>
