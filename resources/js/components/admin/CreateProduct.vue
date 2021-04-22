<template>
  <!-- <div>
      <div class="col-md-12" v-if="adduser"> -->

  <h2>Add Product</h2>
  <form v-on:submit.prevent="create_product" >
    <div :class="['form-group', allerros.name ? 'has-error' : '']">
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
    
    <div :class="['form-group', allerros.name ? 'has-error' : '']">
      <label for="Price">Product Price</label>
      <input
        type="number"
        name="price"
        class="form-control"
        min="1"
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

    <div :class="['form-group', allerros.category_id ? 'has-error' : '']">
      <label for="Category">category</label>
      <select name="category_id" v-model="form.category_id">
        <option v-for="i in tabledata" :value="i.id" :key="i.id">
          {{ i.label }}
      
        </option>
      </select>
      <router-link :to="{ name: 'AdminAddCategory' }" class="nav-item nav-link">
        add Category
      </router-link>
    </div>

    <div :class="['form-group', allerros.image ? 'has-error' : '']">
      <label for="Image">Product Picture</label>
      <div
        class="imagePreviewWrapper"
        :style="{ 'background-image': `url(${previewImage})` }"
        @click="selectImage"
      ></div>

      <input name="image" ref="fileInput" type="file" @input="pickFile" />
    </div>
   <span v-if="success" :class="['label label-success']">Record submitted successfully!</span>
    <button type="submit" class="btn btn-primary">Submit</button>
    <button type="Reset" class="btn btn-primary">Reset</button>
   <br/>
      <span v-if="allerros.name" :class="[' alert alert-danger']">@{{ allerros.name[0] }}</span>
       <span v-if="allerros.price" :class="[' alert alert-danger']">@{{ allerros.price[0] }}</span> 
        <span v-if="allerros.image" :class="[' alert alert-danger']">@{{ allerros.image[0] }}</span> 
              <!-- <span v-if="allerros.category_id" :class="[' alert alert-danger']">@{{ allerros.category_id[0] }}</span>   -->
    <!-- </div> -->
  </form>
  <!-- </div> -->
</template>

<script>
import axios from "axios";
export default {
  mounted() {},
  data() {
    return {
      previewImage: null,
      tabledata: {},
      form: {
        name: "",
        price: "",
        is_available: 0,
        image: "",
        category_id: "",
      },
            allerros: [],
            success : false,    
    };
  },
  methods: {
    //get Table data
    loadCategoryData() {
     axios
        .get("http://localhost:8000/api/categories")
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
   

    create_product() {
      console.log("f", this.form);
      axios
        .post("http://localhost:8000/api/products", this.form)
        .then((resp) => {
          console.log(resp);
          //reset form
          this.form.name = "";
          this.form.price = "";
          this.form.is_available = "";
          this.form.category_id = "";
          this.form.image = "";
           this.allerros = [];
            this.success = true;
          
          if(resp.status === 200) {
              
         
               this.$router.push({ name: "AdminProducts" });
            }
         
        })
        
        .catch((e) => {
          console.log(e);
               
                           this.onFailure(e.response.data);
        });
       
         
    },
     onFailure(errorData) {
       this.allerros =errorData.errors;
        this.success = false;
    },
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
