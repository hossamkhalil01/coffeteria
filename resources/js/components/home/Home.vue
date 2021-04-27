<template>
  <div class="container-fluid">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <!-- start of latest order section -->
        <latestOrderComponent
          v-if="!checkUserIsAdmin()"
          v-bind:latest_order="latest_order"
        />
        <!-- end latest order section -->
        <!-- start of users dropdwon section -->
        <users-drop-down
          v-if="checkUserIsAdmin()"
          v-bind:users="users"
          v-bind:user_error="user_error"
          @userChoosen="addUser"
        />
        <!-- end of users dropdown section -->
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
              <img :src="productsImgBase + product.image" :alt="product.name" />
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
        <newordercomponent
          v-bind:orderedproducts="orderedProducts"
          v-bind:user_id="user_id"
          @userError="userError"
        />
      </div>
      <!-- end of order section -->
    </div>
  </div>
</template>

<script>
import * as user from "@helpers/currentUser.js";
import { apiBase, productsImgBase } from "@helpers/urls.js";
import newordercomponent from "@components/user/newOrder";
import latestOrderComponent from "@components/user/LatestOrder";
import { priceFormatter } from "@helpers/formatters.js";
import UsersDropDown from "@components/admin/UsersDropDown";

export default {
  mounted() {},
  data() {
    return {
      apiBase: apiBase,
      productsImgBase: productsImgBase,
      currencyFormatter: priceFormatter,
      user: user,
      products: [],
      latest_order: [],
      orderedProducts: [],
      users: [],
      user_id: null,
      user_error: false,
    };
  },
  components: {
    newordercomponent,
    latestOrderComponent,
    UsersDropDown,
  },
  created() {
    if (this.user.role !== "admin") {
      axios.get(apiBase + this.user.id).then((response) => {
        this.products = response.data.products;
        this.latest_order = response.data.latest_order;
      });
    } else {
      axios.get(apiBase + "admin/index").then((response) => {
        console.log(apiBase)
        this.products = response.data.products;
        this.users = response.data.users;
      });
    }
  },
  methods: {
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
    checkUserIsAdmin() {
      if (this.user.role !== "admin") return false;
      return true;
    },
    addUser(user_id) {
      this.user_error = false;
      this.user_id = user_id;
    },
    userError() {
      this.user_error = true;
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
