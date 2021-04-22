<template>
  <div class="">
    <h3>Checks</h3>

    <!-- Start of selection section -->
    <div class="row justify-content-center">
      <!-- Start date picker section -->
      <div class="container-fluid col-3 row justify-content-around">
        <div class="col-6">
          <label for="from" class="me-2">From</label>
          <input class="btn btn-primary" name="from" type="date" />
        </div>
        <div class="col-6">
          <label for="from" class="me-2">To</label>
          <input class="btn btn-primary" name="to" type="date" />
        </div>
      </div>
      <!-- End date picker section -->

      <!-- Start User selection section -->
      <div class="row justify-content-center mt-5">
        <div class="container-fluid col-3">
          <select
            class="form-select"
            name="user"
            aria-label="Default select example"
          >
            <option selected>Select a user</option>

            <option v-for="user in users" :key="user.id" :value="user.id">
              {{ user.id }}
            </option>
          </select>
        </div>
      </div>
      <!-- End User selection section -->
    </div>
    <!-- End of selection section -->
  </div>
</template>

<script>
import { getAllChecks } from "@services/adminChecksService";
import { getAllUsers } from "@services/usersService";

export default {
  mounted() {
    getAllChecks()
      .then((res) => (this.selectedChecks = res.data.data))
      .catch((err) => {
        this.serverError = err.message;
      });

    getAllUsers().then((res) => console.log(res.data));
  },
  data() {
    return {
      selectedChecks: [],
      serverError: "",
    };
  },
  props: {},
};
</script>
