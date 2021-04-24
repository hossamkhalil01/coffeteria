<template>
  <div>
    <!-- Start of selection section -->

    <div class="mt-4 row justify-content-center">
      <!-- Start error section -->
      <div
        class="container-fluid row justify-content-center"
        v-if="serverError"
      >
        <div class="alert alert-danger col-3 text-center">
          <li>{{ serverError }}</li>
        </div>
      </div>
      <!-- End errors section -->
      <!-- Start date picker section -->
      <div class="col-6 row justify-content-evenly">
        <div class="col-3">
          <label for="from" class="d-block">From</label>
          <input
            id="fromDatePicker"
            class="btn btn-primary"
            name="from"
            type="date"
            :onChange="handleFromDateSelection"
          />
        </div>
        <div class="col-3">
          <label for="from" class="d-block">To</label>
          <input
            id="toDatePicker"
            class="btn btn-primary"
            name="to"
            type="date"
            :onChange="handleToDateSelection"
          />
        </div>
      </div>
      <!-- End date picker section -->

      <!-- Start User selection section -->
      <div class="row justify-content-center mt-4">
        <div class="col-3">
          <select
            class="form-select"
            name="users"
            aria-label="Default select example"
            :onChange="handleUserSelection"
          >
            <option selected :value="null">Select a user</option>

            <option v-for="user in users" :key="user.id" :value="user.id">
              <img :src="user.avatar" /> {{ user.name }}
            </option>
          </select>
        </div>
      </div>
      <!-- End User selection section -->
    </div>
    <!-- End of selection section -->

    <!-- Start of checks display  -->
    <div class="mt-3">
      <!-- Start of checks table -->
      <Checks
        :selected-check-Id="selectedCheck ? selectedCheck.id : 0"
        :checks="currentChecks"
        @checkSelected="updateSelectedCheck"
      ></Checks>
      <!-- End of checks table -->

      <!-- Start of pagination section -->
      <paginator @paginate="paginate" :links="paginationLinks"></paginator>
      <!-- End of pagination section -->
    </div>
    <!-- End of checks display  -->

    <!-- Start of checks details section-->
    <div class="mt-5 mb-4">
      <order-products
        v-if="selectedCheck"
        :products="checkProducts"
        :order="selectedCheck"
      ></order-products>
    </div>
  </div>
  <!-- End of checks details section -->
</template>

<script>
import { getTodayDateString } from "@helpers/formatters.js";
$("document").ready(() => {
  // configure datepicker
  document.getElementById("toDatePicker").max = getTodayDateString();
});

import Paginator from "@layouts/Paginator";
import Checks from "@components/admin/Checks";
import OrderProducts from "@components/admin/OrderProducts";
import {
  getChecksResource,
  getOrderProducts,
} from "@services/adminChecksService";
import { getUsersResource } from "@services/usersService";

export default {
  mounted() {
    this.updateChecks();
    getUsersResource().then((res) => (this.users = res.data.data));
  },
  data() {
    return {
      currentChecks: [],
      serverError: null,
      users: [],
      selectedUserId: null,
      selectedCheck: null,
      toDate: null,
      fromDate: null,
      checkProducts: [],
      paginationLinks: [],
    };
  },
  components: {
    Paginator,
    Checks,
    OrderProducts,
  },
  methods: {
    getChecks: function (params, url) {
      getChecksResource(params, url)
        .then((res) => {
          this.currentChecks = res.data.data;
          this.paginationLinks = res.data.meta.links;

          // reset the errors
          this.serverError = null;
        })
        .catch((err) => {
          this.serverError = err.response.data.message;
        });
    },

    handleUserSelection: function (event) {
      this.selectedUserId = event.target.value;

      //update checks
      this.updateChecks();
    },

    handleFromDateSelection: function (event) {
      this.fromDate = event.target.value;
      if (this.toDate) this.updateChecks();
    },
    handleToDateSelection: function (event) {
      this.toDate = event.target.value;
      if (this.fromDate) this.updateChecks();
    },
    updateChecks: function () {
      const params = {
        owner_id: this.selectedUserId,
        to: this.toDate,
        from: this.fromDate,
      };

      //clear selected check
      this.selectedCheck = null;

      this.getChecks(params);
    },

    paginate: function (url) {
      //clear selected check
      this.selectedCheck = null;
      this.getChecks({}, url);
    },

    updateSelectedCheck: function (check) {
      this.getCheckDetails(check);
    },

    getCheckDetails: function (order) {
      getOrderProducts(order.id)
        .then((res) => {
          this.selectedCheck = res.data.data;
          this.checkProducts = res.data.data.products;
          // reset the errors
          this.serverError = null;
        })
        .catch((err) => {
          this.serverError = err.response.message;
        });
    },
  },
  props: {},
};
</script>

<style scoped>
select {
  cursor: pointer;
}
</style>
