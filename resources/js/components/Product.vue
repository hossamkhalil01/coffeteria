<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <router-link
                            to="/createProduct"
                            class="nav-item nav-link "
                        >
                            create Product
                        </router-link>

                        <div class="card-body table-responsive p-0" v-if="viewproducts">
                            <table class="table table-hover">
                                <tbody>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Price</th>
                                        <th>Photo</th>
                                        <th>Avaiblity</th>
                                        <th>Actions</th>
                                    </tr>
                                    <tr
                                        v-for="item in tabledata.data"
                                        :key="item.id"
                                    >
                                        <td>{{ item.id }}</td>
                                        <td>{{ item.name }}</td>
                                        <td>{{ item.price }}</td>

                                        <td>
                                            <img
                                                :src="`img/${item.image}`"
                                                class="profile-user-img img-fluid img-circle"
                                                style="
                                                    height: 40px;
                                                    width: 40px;
                                                "
                                            />
                                        </td>
                                        <td v-if="item.is_available == 1">
                                            Avaiblile
                                        </td>
                                        <td v-else>Not Available😢</td>
                                        <!-- <td>
                                            <a
                                                href="#"
                                                @click="editPhotoModal(item)"
                                            >
                                                Edit
                                            </a>
                                            </td> -->
                                        <td>
                                            <a
                                                href="#"
                                                class="btn btn-warning"
                                                @click="
                                                    get_product(
                                                        item.id,
                                                        item.name,
                                                        item.price,
                                                        item.is_available,
                                                        item.image,
                                                        item.category_id
                                                    )
                                                "
                                                >Edit</a
                                            >
                                            <!-- <router-link to="/editProduct" class="nav-item nav-link"> edit </router-link> -->
                                            <!-- <router-link :to="{ name: 'editProduct', params: {id: item.id } }">edit</router-link> -->
                                            <!-- <router-link :to="'/editProduct/'+ item.id">edit </router-link>  -->

                                           
                                            <a
                                                href="#"
                                                class="btn btn-danger m-2"
                                                @click="deletePhoto(item.id)"
                                            >
                                                Delete
                                            </a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                            <pagination
                                :data="tabledata"
                                @pagination-change-page="getResults"
                            ></pagination>
                        </div>
                         </div>
                           </div>
                           </div>
                                   
        </div>
          
        <div v-if="editproduct">
        <h2>Edit Product</h2>
        <form v-on:submit.prevent="update(upd_product.id)">
            <div class="form-group">
                <label for="Name">Product</label>
                <input
                    type="text"
                    name=" name"
                    class="form-control"
                    id="Name"
                    aria-describedby="emailHelp"
                    placeholder="Enter Productname"
                    v-model="upd_product.name"
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
                    v-model="upd_product.price"
                />
            </div>
            <div>
                <label for="is_available">Is Available </label>
                <input
                    class="form-group"
                    name="is_available"
                    type="checkbox"
                    id="is_available"
                    v-model="upd_product.is_available"
                />
                <label for="checkbox">{{ checked }}</label>
            </div>

            <!-- <div class="form-group">
            <label for="Category">category</label>
            <select name="category_id" v-model="upd_product.category_id">
                <option v-for="i in tabledata.data" :value="i.id" :key="i.id">
                    {{ i.label }}
                </option>
            </select>
        </div> -->
            <!-- 
        <div class="form-group">
            <label for="Image">Product Picture</label>
            <div
                class="imagePreviewWrapper"
                :style="{ 'background-image': `url(${previewImage})` }"
                @click="selectImage"
            ></div>

            <input name="image" ref="fileInput" type="file" @input="pickFile" />
        </div> -->

            <button type="submit" class="btn btn-primary">update</button>
            <button type="Reset" class="btn btn-primary">Reset</button>
        </form>
        </div>

    </div>
</template>

<script>
export default {
    data() {
        return {
              editproduct:false,
             viewproducts:true,
            previewImage: null,
            tabledata: {},
            form: {
                name: "",
                price: "",
                is_available: "",
                image: "",
                category_id: "",
            },

            //edit product
            upd_product: {
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
        // //get Table data
        // loadTableData() {
        //     this.$http
        //         .get("api/products")
        //         .then(({ data }) => (this.tabledata = data))
        //         .catch(() => {
        //             console.log("Error...");
        //         });
        // },

        // //Pagination
        // getResults(page = 1) {
        //     this.$http.get("api/products?page=" + page).then((response) => {
        //         this.tabledata = response.data;
        //     });
        // },

        // loadCategoryData() {
        //     this.$http
        //         .get("api/categories")
        //         .then(({ data }) => (this.tabledata = data))
        //         .catch(() => {
        //             console.log("Error...");
        //         });
        // },
        // selectImage() {
        //     this.$refs.fileInput.click();
        // },
        // pickFile() {
        //     let input = this.$refs.fileInput;
        //     let file = input.files;
        //     if (file && file[0]) {
        //         let reader = new FileReader();
        //         reader.onload = (e) => {
        //             this.previewImage = e.target.result;
        //             this.upd_product.image = this.previewImage;
        //         };
        //         reader.readAsDataURL(file[0]);
        //         this.$emit("input", file[0]);
        //     }
        // },
        // //get user dtails to show inside edit form
        // get_product(id, name, price, is_available, image, category_id) {
        //      this.editproduct = true,
        //      this.viewproducts = false
        //     this.upd_product.id = id;
        //     this.upd_product.name = name;
        //     this.upd_product.price = price;
        //     // this.upd_product.is_available = is_available;
        //     // this.upd_product.category_id = category_id;
        //     // this.upd_product.image = image;
        //     // console.log(this.upd_product);
        // },
        // //update user
        // update(id) {
        //     this.editproduct = true,
        //      this.viewproducts = false
        //     console.log(id);
        //     this.$http
        //         .put("api/products/"+id, this.upd_product)
        //         .then((resp) => {
        //             console.log(resp);
        //             this.loadTableData();
        //         })
        //         .catch((e) => {
        //             console.log(e);
        //             console.log("bazeeeeet")
        //         });
        // },

        /////end of ediiiiiiiiit//////////////////////
        //Delete photo
        deletePhoto(id) {
            this.$swal
                .fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, delete it!",
                })
                .then((result) => {
                    if (result.value) {
                        //Send Request to server
                        this.$http
                            .delete("api/products/" + id)
                            .then((response) => {
                                this.$swal.fire(
                                    "Deleted!",
                                    "Product is deleted successfully",
                                    "success"
                                );
                                this.loadTableData();
                            })
                            .catch(() => {
                                this.$swal.fire({
                                    icon: "error",
                                    title: "Oops...",
                                    text: "Something went wrong!",
                                    footer:
                                        "<a href>Why do I have this issue?</a>",
                                });
                            });
                    }
                });
        },
    },

    created() {
        //LoadTableData
        this.loadTableData();
    },
};
</script>
