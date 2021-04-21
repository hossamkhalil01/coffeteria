<template>
  <!-- <div>
      <div class="col-md-12" v-if="adduser"> -->

  <h2>Add Product</h2>
  <form v-on:submit.prevent="create_product">
    <div class="form-group">
      <label for="Name">Product</label>
      <input
        type="text"
        name=" name"
        class="form-control"
        id="Name"
        aria-describedby="emailHelp"
        placeholder="Enter Productname"
        v-model="form.name"
      />
    </div>
    <div class="form-group">
      <label for="Price">Product Price</label>
      <input
        type="number"
        name="price"
        class="form-control"
        id="Price"
        aria-describedby="emailHelp"
        placeholder="Enter Product price"
        v-model="form.price"
      />
    </div>
    <div>
      <label for="is_available">Is Available </label>
      <input
        class="form-group"
        name="is_available"
        type="checkbox"
        id="is_available"
        v-model="form.is_available"
      />
      <label for="checkbox">{{ checked }}</label>
    </div>

    <div class="form-group">
      <label for="Category">category</label>
      <!-- <select
                class="form-select"
                aria-label="Default select example"
                name="category_id"
                v-model="form.category_id"
            >
                <option v-for="option in tabledata" :value="option.id" :key="option.id"
          > {{ option.label}}</option>
            </select> -->
      <select name="category_id" v-model="form.category_id">
        <option v-for="i in tabledata" :value="i.id" :key="i.id">
          {{ i.label }}
        </option>
      </select>
      <router-link :to="{ name: 'AdminAddCategory' }" class="nav-item nav-link">
        add Category
      </router-link>
    </div>

    <div class="form-group">
      <label for="Image">Product Picture</label>
      <div
        class="imagePreviewWrapper"
        :style="{ 'background-image': `url(${previewImage})` }"
        @click="selectImage"
      ></div>

      <input name="image" ref="fileInput" type="file" @input="pickFile" />
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
    <button type="Reset" class="btn btn-primary">Reset</button>
    <!-- </div> -->
  </form>
  <!-- </div> -->
</template>

<script>
import { apiBase } from "@helpers/urls.js";
export default {
  mounted() {},
  data() {
    return {
      apiBase: apiBase,
      previewImage: null,
      tabledata: {},
      form: {
        name: "",
        price: "",
        is_available: 0,
        image: "",
        category_id: "",
      },
    };
  },
  methods: {
    //get Table data
    loadCategoryData() {
      axios
        .get(apiBase + "categories")
        .then(({ data }) => (this.tabledata = data))
        .catch(() => {
          console.log("Error...");
        });
    },
    selectImage() {
      this.$refs.fileInput.click();
    },
    pickFile() {
      let input = this.$refs.fileInput;
      let file = input.files;
      if (file && file[0]) {
        let reader = new FileReader();
        reader.onload = (e) => {
          this.previewImage = e.target.result;
          this.form.image = this.previewImage;
        };
        reader.readAsDataURL(file[0]);
        this.$emit("input", file[0]);
      }
    },
    //  getPhoto(){
    //            let image = (this.form.image.length > 100) ? this.form.image : "img/profile/"+ this.form.image;
    //             return image;
    //         },

    create_product() {
      console.log("f", this.form);
      axios
        .post(apiBase + "products", this.form)
        .then((resp) => {
          console.log(resp);
          //reset form
          this.form.name = "";
          this.form.price = "";
          this.form.is_available = "";
          this.form.category_id = "";
          this.form.image = "";
        })
        .catch((e) => {
          console.log(e);
        });
    },
  },

  //get user dtails to show inside edit form
  get_user(id, name, email) {
    (this.edituser = true), (this.adduser = false);
    console.log(id, name, email);
    this.upd_user.id = id;
    this.upd_user.name = name;
    this.upd_user.email = email;
  },
  //update user
  update(id) {
    console.log(id);
    axios
      .post("http://localhost:8000/user/update/" + id, this.upd_user)
      .then((resp) => {
        console.log(resp);
        (this.edituser = false), (this.adduser = true);
        this.loadlist();
      })
      .catch((e) => {
        console.log(e);
      });
  },
  created() {
    //LoadTableData
    this.loadCategoryData();
  },
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
