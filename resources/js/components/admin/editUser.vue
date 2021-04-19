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
                <select name="room_id" class="form-control " v-model="user.room_id">

                    <option v-for="room in rooms" :value="room.id">{{room['number']}}</option>
                </select>

            </div>

            <div class="form-group">
                <lable>Image</lable>
                <input type="file" class="form-control" name="image"  @input="onImageChange" />
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</div>
</template>

<script>
export default {
    data() {
        return {
            user: [],
            rooms: []
        }

    },
    methods: {

        updateUser() {
            axios
                .patch(`http://localhost:8000/api/admin/edituser/${this.$route.params.id}`, this.user)
                .then((res) => {
                    this.$router.push({
                        name: 'adminUsers'
                    });
                    //  this.user = res.data;
                })

        },
        onImageChange(e) {
            //  let reader = new FileReader();
            //  let file = input.files;
            // reader.onload = (e) => {
                this.avatar = e.target.files[0]
            this.user.avatar = `storage/avatars/${this.user.id}/` + this.avatar.name
            // };
            
            // reader.readAsDataURL(file[0]);
            // this.$emit("input", file[0]);
           

            // console.log(e.target.files[0]);

            // this.user.avatar = e.target.files[0];

        },
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
        axios
            .get(`http://localhost:8000/api/admin/getusers/${this.$route.params.id}`)
            .then((res) => {
                // this.$router.push({name:'adminUsers'});
                this.user = res.data;
            })

        this.getrooms();
    }
}
</script>
