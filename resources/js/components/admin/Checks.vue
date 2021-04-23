<template>
  <div class="">
    <h3>Checks</h3>

    <!-- Start of selection section -->
    <div class="row justify-content-center">
      <!-- Start date picker section -->
      <div class="container-fluid col-3 row justify-content-around">
        <div class="col-6">
          <label for="from" class="me-2">From</label>
          <input
            id="fromDate"
            class="btn btn-primary"
            name="from"
            type="date"
            :onChange="handleFromDateSelection"
          />
        </div>
        <div class="col-6">
          <label for="from" class="me-2">To</label>
          <input
            id="toDate"
            class="btn btn-primary"
            name="to"
            type="date"
            :onChange="handleToDateSelection"
          />
        </div>
      </div>
      <!-- End date picker section -->

      <!-- Start User selection section -->
      <div class="row justify-content-center mt-5">
        <div class="container-fluid col-3">
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
    <div>
      <!-- Start of checks table -->

      <!-- End of checks table -->

      <!-- Start of pagination section -->
      <paginator @paginate="paginate" :links="paginationLinks"></paginator>
      <!-- End of pagination section -->
    </div>
    <!-- End of checks display  -->
  </div>
</template>

<script>
// configure datepickers
// $("#fromDate").max = new Date().toISOString().split("T")[0];
import Paginator from "@layouts/Paginator";
import { getChecksResource } from "@services/adminChecksService";
import { getUsersResource } from "@services/usersService";

export default {
  mounted() {
    this.updateChecks();
    getUsersResource().then((res) => (this.users = res.data.data));
  },
  data() {
    return {
      currentChecks: [],
      serverError: "",
      users: [],
      selectedUserId: null,
      toDate: null,
      fromDate: null,
      paginationLinks: [],
    };
  },
  components: {
    Paginator,
  },
  methods: {
    getChecks: function (params, url) {
      getChecksResource(params, url)
        .then((res) => {
          this.currentChecks = res.data.data;
          this.paginationLinks = res.data.meta.links;
        })
        .catch((err) => {
          this.serverError = err.message;
        });
    },

    handleUserSelection: function (event) {
      this.selectedUserId = event.target.value;
      this.updateChecks();
    },

    handleFromDateSelection: function (event) {
      const fromDate = event.target.value;
      this.fromDate = event.target.value;
      if (this.toDate) this.updateChecks();
    },
    handleToDateSelection: function (event) {
      const toDate = new Date(event.target.value);

      this.toDate = event.target.value;

      if (this.fromDate) this.updateChecks();
    },

    updateChecks: function () {
      const params = {
        owner_id: this.selectedUserId,
        to: this.toDate,
        from: this.fromDate,
      };
      this.getChecks(params);
    },

    paginate: function (url) {
      this.getChecks({}, url);
    },
  },
  props: {},
};
</script>
