<template>
  <div class="container-fluid">
    <div>
      <h2>Edit Product</h2>
      <form v-on:submit.prevent="update(product.id)">
        <div class="form-group">
          <label for="Name">Product</label>
          <input
            type="text"
            name=" name"
            class="form-control"
            id="Name"
            aria-describedby="emailHelp"
            placeholder="Enter Productname"
            v-model="product.name"
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
            v-model="product.price"
          />
        </div>
        <div>
          <label for="is_available">Is Available </label>
          <input
            class="form-group"
            name="is_available"
            type="checkbox"
            id="is_available"
            v-model="product.is_available"
            :checked="product.is_available"
          />
          <label for="checkbox">{{ checked }}</label>
        </div>

       
    <div class="form-group">
      <label for="Category">category</label>
      <select name="category_id" v-model="product.category_id">
        <option v-for="i in tabledata" :value="i.id" :key="i.id">
          {{ i.label }}
                 </option>
            </select>
        </div>  

    
       <div class="form-group">
            <label for="Image">Product Picture</label>
            <!-- {{product.image}} -->
                   <!-- <input type="file" name="image" ref="fileInput" id="img" style="display:none;" @input="pickFile"  />
            <label for="img">{{product.image}}</label> -->
            <div
                class="imagePreviewWrapper"
              
               :style="{ 'background-image': `url(${previewImage})` }"
              
                @click="selectImage"
            ></div>
      
            <!-- <input name="image" ref="fileInput"  type="file" @input="pickFile" /> -->
            <input type="file" id="files" class="hidden" name="image" ref="fileInput"   @input="pickFile"/>
             <label for="files">{{product.image}} </label>
            
        </div>  

        <button type="submit" class="btn btn-primary">update</button>
        <button type="Reset" class="btn btn-primary">Reset</button>
      </form>
    </div>
  </div>
</template>

<script>
import axios from "axios";
export default {
  data() {
    return {
     
      previewImage: null,

      //edit product
      product: {
        id: null,
        name: "",
        price: "",
        is_available: "",
        image: "",
        category_id: "",
      },
      //end of edit product
    };
  },
  methods: {
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
      this.hide =true;
      let input = this.$refs.fileInput;
      let file = input.files;
      if (file && file[0]) {
        let reader = new FileReader();
        reader.onload = (e) => {
          this.previewImage = e.target.result;
          this.product.image = this.previewImage;
        };
        reader.readAsDataURL(file[0]);
        this.$emit("input", file[0]);
      }
    },
    // //get user dtails to show inside edit form
    // get_product(id, name, price, is_available, image, category_id) {
    //   (this.editproduct = true), (this.viewproducts = false);
    //   this.product.id = id;
    //   this.product.name = name;
    //   this.upd_product.price = price;
    //   this.upd_product.is_available = is_available;
    //   this.upd_product.category_id = category_id;
    //   this.upd_product.image = image;
    //   console.log(this.upd_product);
    // },
    //update product
    update(id) {
      (this.editproduct = true), (this.viewproducts = false);
      console.log(id);
      axios
        .put("http://localhost:8000/api/products/" + id, this.product)
        
        .then((resp) => {
          console.log(resp);
          console.log("sha8alaaa");
            if(resp.status === 200) {
         
               this.$router.push({ name: "AdminProducts" });
            }
          // this.loadTableData();
        })
        .catch((e) => {
          console.log(e);
          console.log("bazeeeeet");
        });
    },
       loadCategoryData() {
     axios
        .get("http://localhost:8000/api/categories")
        .then(({ data }) => (this.tabledata = data))
        .catch(() => {
          console.log("Error...");
        });
        
    },
  } , 
   created() {
                this.loadCategoryData();
            axios
                .get(`http://localhost:8000/api/products/${this.$route.params.id}`)
                .then((res) => {
                    this.product = res.data;
                  
                });
        },

}
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
input[type='file'] {
  color: rgba(0, 0, 0, 0)
}

</style>

              