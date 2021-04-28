<template>
  <!-- start of latest order section -->
  <div class="row justify-content-center">
    <h3 class="fw-bold text-center mt-3">Latest Order</h3>
    <div
      class="col-lg-2 mt-3"
      v-for="order_product in latest_order"
      :key="order_product.id"
    >
      <img
        :src="productsImgBase + order_product.image"
        :alt="order_product.name"
      />
      <p class="product-name text-center">
        {{ order_product.name }}
      </p>
    </div>
  </div>
  <!-- end latest order section -->
</template>
<script>
import * as user from "@helpers/currentUser.js";
import { apiBase, productsImgBase } from "@helpers/urls.js";

export default {
  mounted() {},
  data() {
    return {
      apiBase: apiBase,
      productsImgBase: productsImgBase,
      user: user,
    };
  },
  props: {
    latest_order: Array,
  },
  created() {},
  methods: {},
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
