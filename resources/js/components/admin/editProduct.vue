<template >

    <div class="container" >
       <div class="bg_move mb-4">
                <i class="fas fa-palette"></i>
                <h1>EDIT PRODUCT</h1>
            </div>

        <div class="row ">
             <div class="col-6">
           
            <div class="row col-6">
            <form v-on:submit.prevent="update(product.id)">
                <div :class="['form-group', allerros.name ? 'has-error' : '']">
                  <div class="row mb-4">
                    <div class="col-3" ms-4 >
                    <label for="Name">Name</label>
                    </div>
                    <div class="col-8">
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
                  </div>
                </div>
                
                <div :class="['form-group', allerros.price ? 'has-error' : '']">
                   <div class="row mb-4">
                    <div class="col-3" ms-4>
                    <label for="Price">Price</label>
                    </div>
                         <div class="col-8">
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
                   </div>
                </div>
                <div
                    :class="[
                        'form-group',
                        allerros.category_id ? 'has-error' : '',
                    ]"
                >     <div class="row mb-4">
                         <div class="col-3" ms-2>
                    <label for="Category">Category</label>
                         </div>
                         <div class="col-8">
                    <select name="category_id" v-model="product.category_id">
                        <option
                            v-for="i in tabledata"
                            :value="i.id"
                            :key="i.id"
                        >
                            {{ i.label }}
                        </option>
                    </select>
                         </div>
                         </div>
                </div>

                <div class="form-group">
                    <div class="row mb-4">
                         <div class="col-3" ms-2>
                    <label for="Image">Photo</label>
                         </div>
                      <div class="col-8">
                    <input
                        name="image"
                        ref="fileInput"
                        type="file"
                        @input="pickFile"
                    />
                      </div>
                </div>
                </div>
                 <div class="row mb-4">
                        <div class="col-3" >
                    <label for="is_available">Available </label>
                        </div>
                        <div class="col-8">
                    <input
                        style="height: 20px;width:30px"
                        class="form-group"
                        name="is_available"
                        type="checkbox"
                        id="is_available"
                        v-model="product.is_available"
                        :checked="product.is_available"
                    />
                    <label for="checkbox">{{ checked }}</label>
                </div>
                </div>
                
                   <div class="row  mb-4 ms-5 mt-5">
                         <div class="col-4">
                 
              <button type="submit" class="btn btn-info " style="height: 50px;" >Submit</button>
                         </div>
                         <div class="col-3" >
                <button type="Reset" class=" btn btn-danger" style="height: 50px;" >Reset</button>
                         </div>
                   </div>
                   
                    
         
            </form>
        </div>
        </div>

                      <div class="col-6">

                      <div

                       
                        class="imagePreviewWrapper"
                        :style="{
                            'background-image': `url(http://localhost:8000/storage/img/${product.image})`,
                        }"
                        @click="selectImage"
                    ></div>
                       </div>






        </div>
                       
                <span v-if="allerros.name" :class="[' alert alert-danger']">{{
                    allerros.name[0]
                    
                }}</span>
                 <br/>
                 <br/>
                 <br/>
                <span v-if="allerros.price" :class="[' alert alert-danger']">{{
                    allerros.price[0]
                }}</span>
                 <br/>
                 <br/>
                 <br/>
                          
                <span
                    v-if="allerros.category_id"
                    :class="[' alert alert-danger']"
                    >{{ allerros.category_id[0] }}</span
                >
                <br/>
                 <br/>
                 <br/>
                 
                          
        
    </div>
    
</template>

<script>
import axios from "axios";
export default {
    data() {
        return {
            previewImage: null,

            product: {
                id: null,
                name: "",
                price: "",
                is_available: "",
                image: "",
                category_id: "",
            },

            allerros: [],
            success: false,
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
            this.hide = true;
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

        update(id) {
            (this.editproduct = true), (this.viewproducts = false);
            console.log(id);
            axios
                .put("http://localhost:8000/api/products/" + id, this.product)

                .then((resp) => {
                    console.log(resp);
                    console.log("success");
                    this.allerros = [];
                    this.success = true;
                    if (resp.status === 200) {
                        this.$router.push({ name: "AdminProducts" });
                    }
                })
                .catch((e) => {
                    console.log(e);
                    console.log("error occured");
                    this.onFailure(e.response.data);
                });
        },
        onFailure(errorData) {
            this.allerros = errorData.errors;
            this.success = false;
        },
        loadCategoryData() {
            axios
                .get("http://localhost:8000/api/categories")
                .then(({ data }) => (this.tabledata = data))
                .catch(() => {
                    console.log("Error...");
                });
        },
    },
    created() {
        this.loadCategoryData();
        axios
            .get(`http://localhost:8000/api/products/${this.$route.params.id}`)
            .then((res) => {
                this.product = res.data;
                this.previewImage = this.product.image;
                let input = this.$refs.fileInput;
                this.$emit("input", this.previewImage);
            });
    },
};
</script>
<style scoped lang="scss">
.styling{
    background-color: aliceblue;
}
.imagePreviewWrapper {
    width: 250px;
    height: 250px;
    display: block;
    cursor: pointer;
    margin: 0 auto 30px;
    background-size: cover;
    background-position: center center;
}
//********************start of heading style**************************************

// body {
//     display: -webkit-box;
//     display: -ms-flexbox;
//     display: flex;
//     -webkit-box-pack: center;
//     -ms-flex-pack: center;
//     justify-content: center;
//     -webkit-box-align: center;
//     -ms-flex-align: center;
//     align-items: center;
//     min-height: 100vh;
//     background: #111;
// }

.bg_move {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-orient: vertical;
    -webkit-box-direction: normal;
    -ms-flex-direction: column;
    flex-direction: column;
    -webkit-box-pack: center;
    -ms-flex-pack: center;
    justify-content: center;
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
    background: repeating-radial-gradient(
            circle at 100% 100%,
            rgba(255, 190, 11, 0.5) 4%,
            rgba(255, 190, 11, 0.5) 8%,
            rgba(251, 86, 7, 0.5) 8%,
            rgba(251, 86, 7, 0.5) 12%,
            rgba(255, 0, 110, 0.5) 12%,
            rgba(255, 0, 110, 0.5) 16%,
            rgba(131, 56, 236, 0.5) 16%,
            rgba(131, 56, 236, 0.8) 20%,
            rgba(58, 134, 255, 0.5) 20%,
            rgba(58, 134, 255, 0.5) 24%
        ),
        repeating-radial-gradient(
            circle at 0% 100%,
            rgba(255, 190, 11, 0.7) 4%,
            rgba(255, 190, 11, 0.9) 8%,
            rgba(251, 86, 7, 0.7) 8%,
            rgba(251, 86, 7, 0.9) 12%,
            rgba(255, 0, 110, 0.7) 12%,
            rgba(255, 0, 110, 0.9) 16%,
            rgba(131, 56, 236, 0.8) 16%,
            rgba(131, 56, 236, 0.8) 20%,
            rgba(58, 134, 255, 0.8) 20%,
            rgba(58, 134, 255, 0.8) 24%
        );
    background-size: 250px 250px;
    background-position: 0 0;
    -webkit-animation: stripes 3s linear infinite;
    animation: stripes 3s linear infinite;
    background-clip: text;
    -webkit-background-clip: text;
    color: transparent;
}

.bg_move h1 {
    font-size: 3rem;
    font-family: sans-serif;
}

.bg_move i {
    font-size: 3rem;
}

@media only screen and (max-width: 900px) {
    html {
        font-size: 10px;
    }
}

@media only screen and (max-width: 500px) {
    html {
        font-size: 6px;
    }
}

@-webkit-keyframes stripes {
    100% {
        background-position: 250px 0, 250px 0, 100px 0;
    }
}

@keyframes stripes {
    100% {
        background-position: 250px 0, 250px 0, 100px 0;
    }
}

//********************* end of syling header******************************************


//********************************styling of label******************************* */
label{
  font-weight:bold;
  font-size:15px;color:#b44b4b;}

</style>
