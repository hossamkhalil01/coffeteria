<template>
<div class="container">
    <h2>All users</h2>
    <router-link :to="{ name: 'AdminCreateUser' }" style="margin-right: 50px; float: right" class="btn btn-success">Add user</router-link>
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
                    {{ user.room.number }}
                </td>
                <td>
                    <img :src="`http://localhost:8000/${user.avatar}`" class="profile-user-img img-fluid img-circle" style="height: 40px; width: 40px" />
                </td>
                <td>
                    {{ user.room.land_mark }}
                </td>

                <td>
                    <router-link :to="{
                name: 'AdminEditUser',
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
import {
    apiBase
} from "@helpers/urls.js";
export default {
    data() {
        return {
            apiBase: apiBase,
            users: {},
            rooms: [],
        };
    },
    methods: {
        getUsers() {
            axios
                .get(apiBase + "admin/getusers")
                .then((data) => (this.users = data.data))
                .catch(() => {
                    console.log("Error...");
                });
        },
        deleteUser(id) {

           this.$swal
        .fire({
          title: "Are you sure?",
          text: "You won't be able to revert this!",
          icon: "warning",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          confirmButtonText: "Yes, delete it!",
        })
        .then((result) => {
          if (result.value) {
            axios.delete(apiBase + `admin/deleteuser/${id}`).then((response) => {
                let i = this.users.map((data) => data.id).indexOf(id);
                this.users.splice(i, 1);
                 this.$swal.fire(
                  "Deleted!",
                  "Product is deleted successfully",
                  "success"
                );
            });
          };
        });
        
        },
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
        this.getUsers();
    },
};
</script>
