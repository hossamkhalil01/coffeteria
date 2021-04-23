<template>
    <div class="container">
      
            <div class="bg_move">
                <i class="fas fa-palette"></i>
                <h1>ADD PRODUCT</h1>
            </div>

          
            <form v-on:submit.prevent="create_product">
              <div class="row">
                <div :class="['form-group', allerros.name ? 'has-error' : '']">
                    <label for="Name" class="col-3">Product</label>
                    <input
                        type="text"
                        name=" name"
                        class="form-control col-9"
                        id="Name"
                        aria-describedby="emailHelp"
                        placeholder="Enter Productname"
                        v-model="form.name"
                    />
                </div>
                </div>

                <div :class="['form-group', allerros.price ? 'has-error' : '']">
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

                <div
                    :class="[
                        'form-group',
                        allerros.category_id ? 'has-error' : '',
                    ]"
                >
                    <label for="Category">category</label>
                    <select name="category_id" v-model="form.category_id">
                        <option
                            v-for="i in tabledata"
                            :value="i.id"
                            :key="i.id"
                        >
                            {{ i.label }}
                        </option>
                    </select>
                    <router-link
                        :to="{ name: 'AdminAddCategory' }"
                        class="nav-item nav-link"
                    >
                        add Category
                    </router-link>
                </div>

                <div >
                    <label for="Image">Product Picture</label>
                    <div
                        class="imagePreviewWrapper"
                        :style="{ 'background-image': `url(${previewImage})` }"
                        @click="selectImage"
                    ></div>

                    <input
                        name="image"
                        ref="fileInput"
                        type="file"
                        @input="pickFile"
                    />
                </div>
                <span v-if="success" :class="['label label-success']"
                    >Record submitted successfully!</span
                >
                <button type="submit" class="btn btn-primary">Submit</button>
                <button type="Reset" class="btn btn-primary">Reset</button>
                <br />
                <span v-if="allerros.name" :class="[' alert alert-danger']"
                    >{{ allerros.name[0] }}</span
                >
                <span v-if="allerros.price" :class="[' alert alert-danger']"
                    >{{ allerros.price[0] }}</span
                >
              
                
                <span
                    v-if="allerros.category_id"
                    :class="[' alert alert-danger']"
                    >{{ allerros.category_id[0] }}</span
                >
            </form>
          
        </div>
       
    
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
            success: false,
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

                    if (resp.status === 200) {
                        this.$router.push({ name: "AdminProducts" });
                    }
                })

                .catch((e) => {
                    console.log(e);

                    this.onFailure(e.response.data);
                });
        },
        onFailure(errorData) {
            this.allerros = errorData.errors;
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
//********************start of heading style**************************************
* {
    margin: 0;
    padding: 0;
    -webkit-box-sizing: border-box;
    box-sizing: border-box;
}

html {
    font-size: 16px;
}

body {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-pack: center;
    -ms-flex-pack: center;
    justify-content: center;
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
    min-height: 100vh;
    background: #111;
}

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
</style>
