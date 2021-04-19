<template>
<div class="container">
    <div class="row">
        <form @submit.prevent="updateUser">
            <div class="form-group">
                <lable>Name</lable>
                <input type="text" class="form-control" name="name" v-model="user.name"/>
            </div>

            <div class="form-group">
                <lable>email</lable>
                <input type="email" class="form-control" name="email" v-model="user.email"/>
            </div>

             <div class="form-group">
                <lable>password</lable>
                <input type="password" class="form-control" name="password" v-model="user.password"/>
            </div>

             
            <div class="form-group">
                <select name="room_id" class="form-control " v-model="user.room_id">
                    <lable>Room</lable>
                    <option v-for="room in rooms" :value="room.id" >{{room['number']}}</option>
                </select>

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
            .patch(`http://localhost:8000/api/admin/edituser/${this.$route.params.id}`,this.user)
            .then((res)=>{
                this.$router.push({name:'adminUsers'});
                //  this.user = res.data;
            })

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
            .then((res)=>{
                // this.$router.push({name:'adminUsers'});
                 this.user = res.data;
            })

        this.getrooms();
    }
}
</script>
