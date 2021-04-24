<template>
  <div class="row justify-content-center">
    <div class="col-8 justify-content-center border border-dark">
      <h2 class="fw-bold text-center mt-4">Order Details</h2>

      <!-- start of order products -->
      <div
        class="col-2 mt-3 border border-success"
        v-for="product in products"
        :key="product.id"
      >
        <a href="">
          <img :src="product.image" :alt="product.name" />
          <span class="badge rounded-pill bg-info text-dark">{{
            getPrice(product.price)
          }}</span>
        </a>
        <p class="product-name text-center">
          <span>{{ product.pivot.quantity }}</span>
          <span> x {{ product.name }} </span>
        </p>
        <p class="text-center">
          Total:
          {{ getPrice(product.price * product.pivot.quantity) }}
        </p>
      </div>
      <!-- end of order products -->

      <!-- Start of total section -->
      <div class="row justify-content-center mt-5">
        <h4 class="col-3 alert alert-success text-center">
          {{ getPrice(order.total_price) }}
        </h4>
      </div>
    </div>
  </div>
</template>

<script>
import { priceFormatter } from "@helpers/formatters.js";
export default {
  mounted() {},
  data() {
    return {};
  },
  props: {
    order: {
      type: Object,
      required: true,
    },
    products: {
      type: Array,
      required: true,
    },
  },
  methods: {
    getPrice(price) {
      return priceFormatter(price);
    },
  },
};
</script>

<style scoped>
</style>
