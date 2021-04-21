<template>
  <div class="container-fluid">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <!-- start of latest order section -->
        <div class="row justify-content-center">
          <h3 class="fw-bold text-center mt-3">Latest Order</h3>
          <div
            class="col-lg-2 mt-3"
            v-for="order_product in latest_order"
            :key="order_product.id"
          >
            <img
              :src="'http://localhost:8000/storage/img/' + order_product.image"
              :alt="order_product.name"
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
            <a href="#" @click.prevent="addOrderedProducts(product)">
              <img :src="imgBase + product.image" :alt="product.name" />
              <span class="badge rounded-pill bg-info text-dark">{{
                currencyFormatter(product.price)
              }}</span>
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
        <newordercomponent v-bind:orderedproducts="orderedProducts" />
      </div>
      <!-- end of order section -->
    </div>
  </div>
</template>

<script>
import * as user from "@helpers/currentUser.js";
import { apiBase, imgBase } from "@helpers/urls.js";
import axios from "axios";
import newordercomponent from "@components/user/newOrder";
import { csrf } from "@services/authenticationService.js";

export default {
  mounted() {},
  data() {
    return {
      apiBase: apiBase,
      imgBase: imgBase,
      user: user,
      csrf: csrf,
      products: [],
      latest_order: [],
      orderedProducts: [],
    };
  },
  components: {
    newordercomponent,
  },
  created() {
    axios.defaults.headers.common["X-CSRF-TOKEN"] = this.csrf.content;
    axios.get(apiBase + this.user.id).then((response) => {
      this.products = response.data.products;
      this.latest_order = response.data.latest_order;
    });
  },
  methods: {
    currencyFormatter(price) {
      let formatter = Intl.NumberFormat("eg-US", {
        style: "currency",
        currency: "USD",
        minimumFractionDigits: 0,
      });
      return formatter.format(price);
    },
    addOrderedProducts(product) {
      const foundProduct = this.orderedProducts.find((orderedProduct) => {
        return orderedProduct.id === product.id;
      });
      if (!foundProduct) {
        product.quantity = 1;
        product.product_id = product.id;
        this.orderedProducts.push(product);
      }
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

.bg-info {
  background-color: #1edaff !important;
}
</style>
