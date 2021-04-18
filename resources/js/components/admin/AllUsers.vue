<template>
    <div class="container">
        <h2>All users</h2>
        <a type="button" class="btn btn-success" style="float:right">Add user</a>
       <br/>
       <br/>
        <table class="table table-hover " style="border:1px solid">
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
                <tr v-for="user in tabledata">
                    <td>{{ user.name }}</td>
                    <td>{{ user.room_id }}</td>
                    <td>
                        <img
                            :src="`${user.avatar}`"
                            class="profile-user-img img-fluid img-circle"
                            style="height: 40px; width: 40px"
                        />
                    </td>
                    <td>{{user.room_id}}</td>

                    <td>
                        <a type="button" style="margin-right:50px" class="btn btn-primary"  @click="editPhotoModal(item)"> Edit </a>
                        
                        <a type="button" class="btn btn-danger"  @click="deletePhoto(item.id)"> Delete </a>
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
            tabledata: {},
        };
    },
    methods: {
        getUsers() {
            axios
                .get("http://localhost:8000/api/admin/getusers")
                .then((data) => (this.tabledata = data.data))
                .catch(() => {
                    console.log("Error...");
                });
        },
    },

    created() {
        this.getUsers();
    },
};
</script>
