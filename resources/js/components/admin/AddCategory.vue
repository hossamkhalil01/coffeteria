<template>
  <h2>Add Category</h2>
  <form v-on:submit.prevent="addCategory">
    <div class="form-group">
      <label for="Name">Category</label>
      <input
        type="text"
        name="label"
        class="form-control"
        id="Name"
        aria-describedby="emailHelp"
        placeholder="Enter Categoryname"
        v-model="form.label"
      />
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
    <button type="Reset" class="btn btn-primary">Reset</button>
  </form>
</template>

<script>
import axios from "axios";
import { apiBase, imgBase } from "@helpers/urls.js";
export default {
  mounted() {},
  data() {
    return {
      apiBase: apiBase,
      imgBase: imgBase,
      form: {
        label: "",
      },
    };
  },
  methods: {
    addCategory() {
      console.log("f", this.form);
      axios
        .post(apiBase + "addCategory", this.form)
        .then((resp) => {
          console.log(resp);
          //reset form
          this.form.label = "";
        })
        .catch((e) => {
          console.log(e);
        });
    },
  },
  created() {},
};
</script>

<style scoped lang="scss">
.imagePreviewWrapper {
  width: 250px;
  height: 250px;
  display: block;
  cursor: pointer;
  margin: 0 auto 30px;
  background-size: cover;
  background-position: center center;
}
</style>
