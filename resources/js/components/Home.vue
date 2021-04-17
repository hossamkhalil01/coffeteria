<template>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-7">
                <!-- start of latest order section -->
                <div class="row justify-content-center">
                    <h3 class="fw-bold text-center">Latest Order</h3>
                    <div
                        class="col-lg-2 mt-3"
                        v-for="order_product in latest_order"
                        :key="order_product.id"
                    >
                        <img
                            src="https://www.telegraph.co.uk/content/dam/health-fitness/2020/01/09/TELEMMGLPICT000169578515_trans_NvBQzQNjv4BqbTl4D02iCM3NuMfK2RT0HTjsyN2j3JnAYXPi059mk8g.jpeg"
                            alt=""
                        />
                        <p class="product-name text-center">
                            {{ order_product.name }}
                        </p>
                    </div>
                </div>
                <!-- end latest order section -->
                <div class="row justify-content-center">
                    <hr class="text-center w-50" />
                </div>

                <!-- start of products section -->
                <div class="row justify-content-center">
                    <h3 class="fw-bold text-center">Products</h3>
                    <div
                        class="col-lg-2 mt-3"
                        v-for="product in products"
                        :key="product.id"
                    >
                        <a href="#">
                            <img
                                src="https://upload.wikimedia.org/wikipedia/commons/thumb/4/45/A_small_cup_of_coffee.JPG/1200px-A_small_cup_of_coffee.JPG"
                                alt=""
                            />
                            <span
                                class="badge rounded-pill bg-info text-dark"
                                >{{ currencyFormatter(product.price) }}</span
                            >
                        </a>
                        <p class="product-name text-center">
                            {{ product.name }}
                        </p>
                    </div>
                </div>
                <!-- end of products section -->
            </div>
            <!-- start of order section -->
            <div class="col-md-5">
                <p>Order section</p>
            </div>
            <!-- end of order section -->
        </div>
    </div>
</template>

<script>
import { csrf, user } from "../main.js";
import axios from "axios";

export default {
    mounted() {
        console.log("Home component mounted.");
    },
    data() {
        return {
            csrf: csrf,
            user: user,
            products: [],
            latest_order: [],
        };
    },
    created() {
        axios.get("http://127.0.0.1:8000/api/").then((response) => {
            this.products = response.data.products;
            this.latest_order = response.data.latest_order;
            console.log(this.products);
            console.log(this.latest_order);
        });
    },
    methods: {
        getAvatar() {
            return this.user.avatar;
        },
        currencyFormatter(price) {
            let formatter = Intl.NumberFormat("eg-US", {
                style: "currency",
                currency: "USD",
                minimumFractionDigits: 0,
            });
            return formatter.format(price);
        },
    },
};
</script>
<style scoped>
@import url("https://fonts.googleapis.com/css2?family=Source+Sans+Pro:ital,wght@0,300;0,400;0,700;1,200&display=swap");

.container-fluid {
    font-family: "Source Sans Pro", sans-serif;
}

img {
    width: 100px;
    height: 100px;
    object-fit: cover;
    display: block;
    margin: auto;
}
.badge {
    position: relative;
    top: -65%;
    right: -60%;
    font-size: 15px;
}

.product-name {
    font-family: "Source Sans Pro", sans-serif;
    font-weight: 300;
}
</style>
