<template>

<div class="container">
    <div class="row">
        <form @submit.prevent="adduser">
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
                <select name="room_id" class="form-control " v-model="user.room_id">

                    <option v-for="room in rooms" :value="room.id">{{room['number']}}</option>
                </select>

            </div>

          
            <button type="submit" class="btn btn-primary">create</button>
        </form>
    </div>
</div>
</template>

<script>
import axios from "axios";

    export default {

    data() {
        return {
            previewImage: null,
            user: [],
            rooms: []
        }

    },
    methods: {

        adduser() {
        

            axios
                .post("http://localhost:8000/api/admin/create",this.user)
                .then((res) => {
                    this.$router.push({
                        name: 'adminUsers'
                    });
                    //  this.user = res.data;
                })

        },
        onImageChange(e) {
            var filereader = new FileReader();

			filereader.readAsDataURL(e.target.files[0]);

			filereader.onload = (e) => {

				this.user.avatar  = e.target.result;
                            // this.user.avatar = e.target.files[0].name;

			}

            // console.log(e.target.files[0]);
            // this.user.avatar = e.target.files[0].name;
            // this.image = e.target.files[0];

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
                .get("http://localhost:8000/api/rooms")
                .then((data) => (this.rooms = data.data))
                .catch(() => {
                    console.log("Error...");
                });

        }
    },
    created() {
       

        this.getrooms();
    }
}
</script>
