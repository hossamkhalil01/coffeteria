<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <div class="card-body table-responsive p-0">
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
                                                :src="`img/profile/${item.photo}`"
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
                                        <td>
                                            <a
                                                href="#"
                                                @click="editPhotoModal(item)"
                                            >
                                                Edit
                                            </a>
                                            |
                                            <a
                                                href="#"
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

                        <div
                            class="modal fade"
                            id="addNew"
                            tabindex="-1"
                            role="dialog"
                            aria-labelledby="addNewLabel"
                            aria-hidden="true"
                        >
                            <div
                                class="modal-dialog modal-dialog-centered"
                                role="document"
                            >
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5
                                            class="modal-title"
                                            id="addNewLabel"
                                        >
                                            Update Photo
                                        </h5>

                                        <button
                                            type="button"
                                            class="close"
                                            data-dismiss="modal"
                                            aria-label="Close"
                                        >
                                            <span aria-hidden="true"
                                                >&times;</span
                                            >
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Pagination from 'v-pagination-3';
export default {
    data() {
        return {
            tabledata: {},
            // form: new Form({
            //         id: '',
            //         name : '',
            //         photo: ''
            //     })
          
        };
    },
    methods: {
        //get Table data
        loadTableData() {
            this.$http
                .get("api/products")
                .then(({ data }) => (this.tabledata = data))
                .catch(() => {
                    console.log("Error...");
                });
        },

        //Pagination
        getResults(page = 1) {
            this.$http.get("api/products?page=" + page).then((response) => {
                this.tabledata = response.data;
            });
        },
        //Delete photo
            deletePhoto(id){
                this.$swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
              }).then((result) => {
                      
              if (result.value) {
                //Send Request to server
                this.$http.delete('api/products/'+id)
                    .then((response)=> {
                            this.$swal.fire(
                              'Deleted!',
                              'Product is deleted successfully',
                              'success'
                            )
                    this.loadTableData();

                    }).catch(() => {
                        this.$swal.fire({
                          icon: 'error',
                          title: 'Oops...',
                          text: 'Something went wrong!',
                          footer: '<a href>Why do I have this issue?</a>'
                        })
                    })
                }

            })
            }
    },
  

    created() {
        //LoadTableData
        this.loadTableData();
    },
   
};
</script>
