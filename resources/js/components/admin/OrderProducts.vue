<template>
  <div class="row justify-content-center">
    <div class="col-8 justify-content-center border border-dark">
      <h3 class="fw-bold text-center mt-4">Order Details</h3>
      <hr />

      <!-- start of order products -->
      <div class="row mt-5 justify-content-evenly">
        <div
          class="card mb-4 col-md-1 me-3 p-2"
          style="width: 15rem"
          v-for="product in products"
          :key="product.id"
        >
          <img
            :src="productsImgBase + product.image"
            class="card-img-top"
            style="height: 50%"
            :alt="product.name"
          />

          <div class="card-body">
            <div class="row justify-content-center">
              <h5
                class="col-6 card-title badge rounded-pill bg-info text-dark mt-2 mb-3"
              >
                {{ getPrice(product.price) }}
              </h5>
            </div>

            <p class="card-text fw-bolder text-center">
              <span>{{ product.pivot.quantity }}</span>
              <span> x {{ product.name }} </span>
            </p>

            <p class="card-text lead fs-6 fw-bolder text-center">
              Total:
              {{ getPrice(product.price * product.pivot.quantity) }}
            </p>
           
          </div>
        </div>
       
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
import { productsImgBase } from "@helpers/urls";
export default {
  mounted() {},
  data() {
    return {
      productsImgBase: productsImgBase,
    };
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
img {
  width: 100%;
  height: 50%;
}
</style>
