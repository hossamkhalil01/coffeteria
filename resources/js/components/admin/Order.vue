<template>
<div class="  row justify-content-center" style="margin-top:70px">

    <!-- Start of checks table-->
    <div class="col-6 mb-3">
        <h1>Orders</h1>
        <table class="table table-hover" style="border: 1px solid" v-for="order in orders">
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
                <tr>
                    <td>{{ getDate(order.created_at) }}</td>
                    <td>
                        {{ order.owner.name }}
                    </td>
                    <td>
                        {{ order.room.number }}
                    </td>
                    <td>
                        {{ order.products.price }}
                    </td>

                    <td>

                        <a type="button" class="btn btn-danger" @click="deleteUser(user.id)">
                            Deliver
                        </a>
                    </td>

                </tr>

                <div>
                    {{order.products.name}}
                    <td v-for="product in order.products">
                                    <img :src="`storage/img/${product.image}`">

                        {{ product.price }}
                        {{ product.name }}
                        {{ product.image }}

                    </td>
                </div>

            </tbody>
        </table>

    </div>
    <!-- End of checks table -->
</div>
</template>

<script>
import {
    apiBase
} from "@helpers/urls.js";
import {
    priceFormatter,
    dateFormatter
} from "@helpers/formatters";

export default {
    mounted() {},
    data() {
        return {
            orders: {

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
        getDate: function (date) {
            return dateFormatter(date);
        },

        getAmount: function (check) {
            return priceFormatter(check.total_price);
        },
    },

    created() {
        this.getorders()
    }
};
</script>
