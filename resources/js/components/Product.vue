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
                                        <th>Photo</th>
                                        <th>Modify</th>
                                    </tr>
                                    <tr
                                        v-for="item in tabledata.data"
                                        :key="item.id"
                                    >
                                        <td>{{ item.id }}</td>
                                        <td>{{ item.name }}</td>
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

                                        <td>
                                            <a
                                                href="#"
                                                @click="editPhotoModal(item)"
                                            >
                                                <i class="fa fa-edit blue"></i>
                                            </a>
                                            |
                                            <a
                                                href="#"
                                                @click="deletePhoto(item.id)"
                                            >
                                                <i class="fa fa-trash red"></i>
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
export default {
    data() {
        return {
            tabledata: [],
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
    },

    created() {
        //LoadTableData
        this.loadTableData();
    },
};
</script>
