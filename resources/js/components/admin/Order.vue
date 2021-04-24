<template>
<div class="  row justify-content-center" style="margin-top:70px">

    <!-- Start of checks table-->
    <div class="col-6 mb-3">
<h1 >Orders</h1>
        <table class="table table-hover" style="border: 1px solid">
            <thead>
                <tr>
                    <th class="table-primary">Order Date</th>
                    <th class="table-primary">Name</th>
                    <th class="table-primary">Room</th>
                    <th class="table-primary">ext</th>
                    <th class="table-primary">Action</th>
                </tr>
            </thead>

            <tbody>
                <tr v-for="order in orders">
                    <td>{{ order.created_at }}</td>
                    <td>
                        {{ order.room_id }}
                    </td>
                    <td>
                        <img :src="``" class="profile-user-img img-fluid img-circle" style="height: 40px; width: 40px" />
                    </td>
                    <td>
                    </td>

                    <td>
                       
                        <a type="button" class="btn btn-danger" @click="deleteUser(user.id)">
                            Delete
                        </a>
                    </td>

                </tr>
            </tbody>
        </table>

    </div>
    <!-- End of checks table -->
</div>
</template>

<script>
import { apiBase } from "@helpers/urls.js";
export default {
    mounted() {},
    data() {
        return {
          orders:{


          }
        };
    },
    props: {
        checks: {
            type: Array,
            required: true,
        },
    },
    methods: {
       getorders() {
            axios
                .get(apiBase + "admin/getorders")
                .then((data) => (this.orders = data.data))
                .catch(() => {
                    console.log("Error...");
                });
        },
    },
    created(){
      this.getorders()
    }
};
</script>
