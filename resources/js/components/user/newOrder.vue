<template>
  <div class="container-fluid mt-3 border">
    <div class="row justify-content-center">
      <h3 class="fw-bold text-center">New Order</h3>
      <form
        @submit.prevent="storeOrder"
        method="POST"
        class="need-validation"
        novalidate
      >
        <div
          class="row mb-3"
          v-for="product in orderedproducts"
          :key="product.id"
        >
          <label :for="'product-' + product.id" class="col-sm-2 col-form-label">
            {{ product.name }}
          </label>
          <div class="col-sm-4">
            <input
              type="text"
              :name="'product-' + product.id"
              :id="'product-' + product.id"
              class="form-control"
              v-model="product.quantity"
              @change="checkProductQuantity(product)"
            />
          </div>
          <div class="col-sm-4">
            <a href="#" @click.prevent="increaseProductQuantity(product)">+</a>
            <a
              href="#"
              @click.prevent="decreaseProductQunatity(product)"
              class="ms-3"
              >-</a
            >
            <p style="display: inline" class="ms-3">
              {{ product.price }}
            </p>
            <a
              href="#"
              @click.prevent="removeFromOrderedProducts(product)"
              class="ms-3"
              >delete</a
            >
          </div>
        </div>
        <div class="row d-flex justify-content-center">
          <div
            class="col-sm-8 alert alert-danger p-1 mt-2"
            v-if="errors.ordered_products"
          >
            Please add products to order.
          </div>
        </div>
        <div class="row mb-3">
          <label for="notes" class="col-sm-2 col-form-label">Notes</label>
          <div class="col-sm-8">
            <textarea
              name="notes"
              id="notes"
              cols="10"
              rows="5"
              class="form-control"
              v-model="notes"
            ></textarea>
          </div>
        </div>
        <div class="row mb-3">
          <label class="col-sm-2 col-form-label" for="rooms">Rooms</label>
          <div class="col-sm-8">
            <select
              class="form-select"
              id="rooms"
              v-model="room_id"
              required
              @change="removeRoomError"
            >
              <option selected disabled>Choose A Room</option>
              <option v-for="room in rooms" :key="room.id" :value="room.id">
                {{ room.land_mark }} - {{ room.number }}
              </option>
            </select>
            <div class="alert alert-danger p-1 mt-2" v-if="errors.room_id">
              Please select a room.
            </div>
          </div>
        </div>
        <div class="row justify-content-center">
          <hr class="text-center" />
        </div>
        <div class="row mb-3 justify-content-end">
          <div class="col-sm-5">
            <p>
              Total Price:
              {{ currencyFormatter(totalOrderPrice) }}
            </p>
          </div>
        </div>
        <div class="row d-flex justify-content-center mb-3">
          <div class="col-sm-3">
            <button type="submit" class="btn btn-primary">Order</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
import { apiBase } from "@helpers/urls.js";
import * as user from "@helpers/currentUser.js";
import { priceFormatter } from "@helpers/formatters.js";

export default {
  mounted() {},
  data() {
    return {
      currencyFormatter: priceFormatter,
      user: user,
      rooms: [],
      totalPrice: 0,
      room_id: null,
      notes: "",
      success: false,
      error: false,
      errors: {},
    };
  },
  props: {
    orderedproducts: Array,
    user_id: Number,
  },
  updated() {
    if (this.orderedproducts.length > 0) {
      delete this.errors.ordered_products;
    }
  },
  created() {
    axios.get(apiBase + "rooms").then((response) => {
      this.rooms = response.data;
    });
  },
  methods: {
    increaseProductQuantity(product) {
      const newQuantity = product.quantity + 1;
      if (newQuantity >= 100) {
        product.quantity = 100;
      } else {
        product.quantity++;
      }
    },
    decreaseProductQunatity(product) {
      const newQuantity = product.quantity - 1;
      if (newQuantity === 0) {
        const removeProductIndex = this.orderedproducts.findIndex(
          (orderedProduct) => {
            return orderedProduct.id === product.id;
          }
        );
        this.orderedproducts.splice(removeProductIndex, 1);
      } else {
        product.quantity = newQuantity;
      }
    },
    checkProductQuantity(product) {
      if (product.quantity <= 0) {
        const removeProductIndex = this.orderedproducts.findIndex(
          (orderedProduct) => {
            return orderedProduct.id === product.id;
          }
        );
        this.orderedproducts.splice(removeProductIndex, 1);
      } else if (product.quantity >= 100) {
        product.quantity = 100;
      }
    },
    removeFromOrderedProducts(product) {
      const removeProductIndex = this.orderedproducts.findIndex(
        (orderedProduct) => {
          return orderedProduct.id === product.id;
        }
      );
      this.orderedproducts.splice(removeProductIndex, 1);
    },
    storeOrder() {
      let ordered_products = [];
      this.orderedproducts.forEach((ordered_product) => {
        let product = {};
        product.product_id = ordered_product.id;
        product.quantity = ordered_product.quantity;
        ordered_products.push(product);
      });

      const formData = {
        room_id: this.room_id,
        notes: this.notes,
        ordered_products: ordered_products,
        total_price: this.totalPrice,
      };
      if (!this.checkUserIsAdmin()) {
        axios
          .post(apiBase + this.user.id + "/orders", formData)
          .then((res) => {
            this.onSuccess(res.data.message);
          })
          .catch((error) => {
            this.onFailure(error.response.data);
          });
      } else {
        if (!this.user_id) {
          this.$emit("userError");
        } else {
          axios
            .post(apiBase + this.user_id + "/orders", formData)
            .then((res) => {
              this.$router.push({ name: "AdminChecks" });
            })
            .catch((error) => {
              this.onFailure(error.response.data);
            });
        }
      }
    },
    onSuccess(message) {
      this.$router.push({ name: "UserOrder" });
    },
    onFailure(errorData) {
      this.errors = errorData.errors;
      this.error = true;
    },
    removeRoomError() {
      delete this.errors.room_id;
    },
    checkUserIsAdmin() {
      if (this.user.role !== "admin") return false;
      return true;
    },
  },
  computed: {
    totalOrderPrice() {
      this.totalPrice = this.orderedproducts.reduce((sum, orderedProduct) => {
        return sum + orderedProduct.price * orderedProduct.quantity;
      }, 0);
      return this.totalPrice;
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

.border {
  border-radius: 2%;
}
</style>
