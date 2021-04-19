<template>
<div class="container">
    <h2>All users</h2>
    <a type="button" class="btn btn-success" style="float: right">Add user</a>
    <br />
    <br />
    <table class="table table-hover" style="border: 1px solid">
        <thead>
            <tr>
                <th class="table-primary">Name</th>
                <th class="table-primary">Room</th>
                <th class="table-primary">image</th>
                <th class="table-primary">ext</th>
                <th class="table-primary">Action</th>
            </tr>
        </thead>

        <tbody>
            <tr v-for="user in users">
                <td>{{ user.name }}</td>
                <td>

                    {{ user.room_id }}</td>
                <td>
                    <img :src="`../${user.avatar}`" class="profile-user-img img-fluid img-circle" style="height: 40px; width: 40px" />
                </td>
                <td >
                {{ user.room_id }}</td>

                <td>
                    <router-link :to="{
                                name: 'adminEditUser',
                                params: { id: user.id },
                            }" style="margin-right: 50px" class="btn btn-primary">Edit</router-link>

                    <a type="button" class="btn btn-danger" @click="deleteUser(user.id)">
                        Delete
                    </a>
                </td>
            </tr>
        </tbody>
    </table>
</div>
</template>

<script>
import axios from "axios";
export default {
    data() {
        return {

            users: {},
            rooms: []
        }

    },
    methods: {
        getUsers() {
            axios
                .get("http://localhost:8000/api/admin/getusers")
                .then((data) => (this.users = data.data))
                .catch(() => {
                    console.log("Error...");
                });
        },
        deleteUser(id) {
            axios
                .delete(`http://localhost:8000/api/admin/deleteuser/${id}`)
                .then((response) => {
                    let i = this.users.map((data) => data.id).indexOf(id);
                    this.users.splice(i, 1);
                });
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
        this.getrooms();
        this.getUsers();
    },
};
</script>
