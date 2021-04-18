<template>
    <div class="container">
        <h2>All users</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Room</th>
                    <th>image</th>
                    <th>ext</th>
                    <th>Action</th>
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
                    <td></td>

                    <td>
                        <a type="button" class="btn btn-primary"  @click="editPhotoModal(item)"> Edit </a>
                        
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
