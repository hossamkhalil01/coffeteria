<template>
  <div class="row justify-content-center">
    <!-- Start of checks table-->
    <div class="col-6 mb-3">
      <p
        class="m-auto col-6 alert alert-info text-center"
        v-if="checks.length == 0"
      >
        No checks available yet!
      </p>

      <table class="table table-striped table-hover" v-else>
        <thead>
          <tr>
            <th scope="col">Date</th>
            <th scope="col">Amount</th>
          </tr>
        </thead>
        <tbody>
          <tr
            v-for="check in checks"
            :key="check.id"
            :v-if="selectedCheckId == check.id"
          >
            <td>
              <div id="dateDiv" @click="checkSelected(check)">
                <p class="fw-normal">{{ getDate(check.created_at) }}</p>
              </div>
            </td>

            <td>
              <p class="fst-italic">
                {{ getAmount(check) }}
              </p>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    <!-- End of checks table -->
  </div>
</template>

<script>
import { priceFormatter, dateFormatter } from "@helpers/formatters";

export default {
  mounted() {},
  data() {
    return {
      selectedCheckId: null,
    };
  },
  props: {
    checks: {
      type: Array,
      required: true,
    },
  },
  methods: {
    checkSelected: function (check) {
      this.$emit("checkSelected", check);
    },
    getDate: function (date) {
      return dateFormatter(date);
    },

    getAmount: function (check) {
      return priceFormatter(check.total_price);
    },
  },
};
</script>

<style scoped>
#dateDiv {
  cursor: pointer;
}
</style>
