<template>
<div class="container col-8 mb-3" style="text-align: center;margin-top:5%">
    <h2 style="float: left;margin-bottom: 30px;">All users</h2>
    <router-link :to="{ name: 'AdminCreateUser' }" style="margin-right: 50px; float: right" class="btn btn-success">Add user</router-link>
    <br />
    <br />
    <table class="table table-hover " style="border: 1px solid;text-align: center;">
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
 


 <nav>
    <ul class="pagination" style="margin-left: 45%">
      <li class="page-item">
        <a style="color: #212529" class="page-link" href="javascript:void(0)" @click="prev">
          <strong> Prev </strong>
        </a>
      </li>
      <li class="page-item">
        <a style="color: #212529" class="page-link" href="javascript:void(0)" @click="next">
          <strong> Next </strong>
        </a>
      </li>
    </ul>
  </nav>
</div>
</template>

<script>
import { apiBase } from "@helpers/urls.js";
import { ref, onMounted } from "@vue/runtime-core";
export default {
    data() {
        return {
            apiBase: apiBase,
            users: {},
            rooms: [],
        };
    },
    setup() {
        const users = ref([]);
    const page = ref(1);
    const lastpage = ref(0);
    const load = async () => {
      const response = await axios.get(
        `http://localhost:8000/api/admin/getusers?page=${page.value}`
      );
      users.value = response.data.data;
      lastpage.value = response.data.last_page;
    };
    onMounted(load);
    const next = async () => {
      if (page.value === lastpage.value) return;
      page.value++;
      await load();
    };
    const prev = async () => {
      if (page.value === 1) return;
      page.value--;
      await load();
    };

    return {
      users,
      next,
      prev,
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
