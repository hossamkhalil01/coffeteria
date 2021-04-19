<template>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <h3 class="fw-bold text-center mt-3">My Orders</h3>
            <!-- start of date pickers -->
            <div class="col-md-3 mt-3">
                <label for="date-from" class="me-3">Date From: </label>
                <input
                    type="date"
                    name="date-from"
                    id="date-from"
                    v-model="from"
                    @change="getOrdersWithinRange"
                />
            </div>
            <div class="col-md-3 mt-3">
                <label for="date-to" class="me-3">Date To: </label>
                <input
                    type="date"
                    name="date-to"
                    id="date-to"
                    v-model="to"
                    @change="getOrdersWithinRange"
                />
            </div>
        </div>
        <!-- end of date pickers -->
        <!-- start of orders table -->
        <div class="row justify-content-center mt-5">
            <div class="col-md-6">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Order Date</th>
                            <th scope="col">Status</th>
                            <th scope="col">Amount</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="order in orders" :key="order.id">
                            <th scope="row">
                                {{ Date(order.created_at) }}
                            </th>
                            <td>{{ order.status }}</td>
                            <td>{{ order.total_price }}</td>
                            <td v-if="order.status == 'processing'">
                                <a href="#">Cancel</a>
                            </td>
                            <td v-else></td>
                        </tr>
                    </tbody>
                </table>
                <!-- start of pagination links -->
                <nav
                    v-if="pagination_links.length > 0"
                    aria-label="Page navigation example"
                >
                    <ul class="pagination justify-content-center">
                        <li
                            :class="[
                                pagination_links[0].url == null
                                    ? 'disabled'
                                    : '',
                            ]"
                            class="page-item"
                        >
                            <a
                                class="page-link"
                                href="#"
                                @click.prevent="
                                    paginate(pagination_links[0].url)
                                "
                                aria-label="Previous"
                            >
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                        <li
                            v-for="(link, index) in pagination_links.slice(
                                1,
                                pagination_links.length - 1
                            )"
                            :key="index"
                            :class="[link.active == true ? 'active' : '']"
                            class="page-item"
                        >
                            <a
                                class="page-link"
                                @click.prevent="paginate(link.url)"
                                >{{ link.label }}</a
                            >
                        </li>
                        <li
                            :class="[
                                pagination_links[pagination_links.length - 1]
                                    .url == null
                                    ? 'disabled'
                                    : '',
                            ]"
                            class="page-item"
                        >
                            <a
                                class="page-link"
                                href="#"
                                @click.prevent="
                                    paginate(
                                        pagination_links[
                                            pagination_links.length - 1
                                        ].url
                                    )
                                "
                                aria-label="Next"
                            >
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- end of pagination links -->
            </div>
        </div>
        <!-- end of orders table -->
    </div>
</template>

<script>
import { csrf, user } from "../main.js";
import axios from "axios";

export default {
    mounted() {
        console.log("Order component mounted.");
    },
    data() {
        return {
            csrf: csrf,
            user: user,
            orders: [],
            pagination_links: {},
            from: null,
            to: null,
            errors: {},
        };
    },
    created() {
        this.getAllOrders();
    },
    methods: {
        paginate(new_url) {
            axios.get(new_url).then((response) => {
                this.orders = response.data.data;
                this.pagination_links = response.data.meta.links;
            });
        },
        getAllOrders() {
            axios
                .get("http://127.0.0.1:8000/api/" + this.user.id + "/orders")
                .then((response) => {
                    this.orders = response.data.data;
                    this.pagination_links = response.data.meta.links;
                });
        },
        getOrdersWithinRange() {
            if (this.from && this.to) {
                axios
                    .get(
                        "http://127.0.0.1:8000/api/" +
                            this.user.id +
                            "/orders/range",
                        {
                            params: {
                                from: this.from,
                                to: this.to,
                            },
                        }
                    )
                    .then((response) => {
                        this.orders = response.data.data;
                        this.pagination_links = response.data.meta.links;
                    })
                    .catch((error) => {
                        this.errors = error.response.data.errors;
                    });
            }
            if (!this.from && !this.to) {
                this.getAllOrders();
            }
        },
    },
};
</script>
<style scoped>
@import url("https://fonts.googleapis.com/css2?family=Source+Sans+Pro:ital,wght@0,300;0,400;0,700;1,600;0,200&display=swap");

.container-fluid {
    font-family: "Source Sans Pro", sans-serif;
    font-weight: 600;
}

li:hover {
    cursor: pointer;
}
</style>
