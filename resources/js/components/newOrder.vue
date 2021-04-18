<template>
    <div class="container-fluid mt-3">
        <div class="row justify-content-center">
            <form>
                <div
                    class="row mb-3"
                    v-for="product in orderedproducts"
                    :key="product.id"
                >
                    <label
                        :for="'product-' + product.id"
                        class="col-sm-2 col-form-label"
                    >
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
                        <a
                            href="#"
                            @click.prevent="increaseProductQuantity(product)"
                            >+</a
                        >
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
                <div class="row mb-3">
                    <label for="notes" class="col-sm-2 col-form-label"
                        >Notes</label
                    >
                    <div class="col-sm-8">
                        <textarea
                            name="notes"
                            id="notes"
                            cols="10"
                            rows="5"
                            class="form-control"
                        ></textarea>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="rooms"
                        >Rooms</label
                    >
                    <div class="col-sm-8">
                        <select class="form-select" id="rooms">
                            <option selected>Choose...</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
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
                <button type="submit" class="btn btn-primary">Order</button>
            </form>
        </div>
    </div>
</template>

<script>
import { csrf, user } from "../main.js";
import axios from "axios";

export default {
    mounted() {
        console.log("newOrder component mounted.");
    },
    data() {
        return {
            csrf: csrf,
            user: user,
            totalPrice: 0,
        };
    },
    props: {
        orderedproducts: Array,
    },
    created() {},
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
    },
    computed: {
        totalOrderPrice() {
            this.totalPrice = this.orderedproducts.reduce(
                (sum, orderedProduct) => {
                    return sum + orderedProduct.price * orderedProduct.quantity;
                },
                0
            );
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
</style>
