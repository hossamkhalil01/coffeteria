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
             <label for="is_available">Product Price</label>
            <input  class="form-group" name="is_available" type="checkbox" id="is_available" v-model="form.is_available" />
<label for="checkbox">{{ checked }}</label>
        </div>
        <!-- <div class="form-group">
    <label for="Category">category</label>
     <select class="form-select" aria-label="Default select example" v-for="item in tabledata.data" :key="item.name" v-model="form.category_id">
        <select class="form-select" aria-label="Default select example">  

   <option>{{ item.category_id }}</option>
 
</select>
    </div> -->

        <!-- <div class="form-group">
            <label for="Image">Product Picture</label>
            <br />
            <input
                name="image"
                ref="fileInput"
                type="file"
                @input="pickFile"
               
            />
            <div
                class="imagePreviewWrapper"
                :style="{ 'background-image': `url(${image})` }"
                @click="selectImage"
            ></div>
        </div> -->

        <button type="submit" class="btn btn-primary">Submit</button>
        <button type="Reset" class="btn btn-primary">Reset</button>
        <!-- </div> -->
    </form>
    <!-- </div> -->
</template>

<script>
export default {
    mounted() {
    },
    data() {
        return {
            // previewImage: null,
            form: {
                name: "",
                price: "",
                is_available: "",
                // image: ""
                // category_id:''
            },
        };
    },
    methods: {
        selectImage() {
            this.$refs.fileInput.click();
        },
        pickFile() {
            let input = this.$refs.fileInput;
            let file = input.files;
            if (file && file[0]) {
                let reader = new FileReader();
                reader.onload = (e) => {
                    this.form.image = e.target.result;
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
            this.$http
                .post("api/products", this.form)
                .then((resp) => {
                    console.log(resp);
                    this.loadTableData();
                    //reset form
                    this.form.name = "";
                    this.form.price = "";
                    // this.form.image = "";
                })
                .catch((e) => {
                    console.log(e);
                });
        },
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
