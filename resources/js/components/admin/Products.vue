<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <router-link
                            :to="{ name: 'AdminCreateProduct' }"
                            class="nav-item nav-link coding mb-5"
                        >
                        </router-link>

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
                                            <div v-if="item.image != null">
                                                <img
                                                    :src="`http://localhost:8000/storage/img/${item.image}`"
                                                    class="profile-user-img img-fluid img-circle"
                                                    style="
                                                        height: 40px;
                                                        width: 40px;
                                                    "
                                                />
                                            </div>
                                        </td>
                                        <td v-if="item.is_available == 1">
                                            Available😃
                                        </td>
                                        <td v-else>Not Available😢</td>
                                        <td>
                                            <router-link
                                                :to="{
                                                    name: 'AdminEditProduct',
                                                    params: { id: item.id },
                                                }"
                                                class="btn btn-warning"
                                                >Edit</router-link
                                            >

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

                            <!-- start of pagination links -->
                            <nav
                                v-if="pagination_links.length > 0"
                                aria-label="Page navigation example"
                            >
                                <ul
                                    class="pagination justify-content-center cube"
                                >
                                    <li
                                        :class="[
                                            pagination_links[0].url == null
                                                ? 'disabled'
                                                : '',
                                        ]"
                                        class="page-item"
                                    >
                                        <a
                                            class="page-link"
                                            href="#"
                                            @click.prevent="
                                                paginate(
                                                    pagination_links[0].url
                                                )
                                            "
                                            aria-label="Previous"
                                        >
                                            <span aria-hidden="true"
                                                >&laquo;</span
                                            >
                                        </a>
                                    </li>
                                    <li
                                        v-for="(
                                            link, index
                                        ) in pagination_links.slice(
                                            1,
                                            pagination_links.length - 1
                                        )"
                                        :key="index"
                                        :class="[
                                            link.active == true ? 'active' : '',
                                        ]"
                                        class="page-item"
                                    >
                                        <a
                                            class="page-link"
                                            @click.prevent="paginate(link.url)"
                                            >{{ link.label }}</a
                                        >
                                    </li>
                                    <li
                                        :class="[
                                            pagination_links[
                                                pagination_links.length - 1
                                            ].url == null
                                                ? 'disabled'
                                                : '',
                                        ]"
                                        class="page-item"
                                    >
                                        <a
                                            class="page-link"
                                            href="#"
                                            @click.prevent="
                                                paginate(
                                                    pagination_links[
                                                        pagination_links.length -
                                                            1
                                                    ].url
                                                )
                                            "
                                            aria-label="Next"
                                        >
                                            <span aria-hidden="true"
                                                >&raquo;</span
                                            >
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                            <!-- end of pagination links -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";
export default {
    data() {
        return {
            previewImage: null,
            tabledata: {},
            pagination_links: {},
            form: {
                id: null,
                name: "",
                price: "",
                is_available: "",
                image: "",
                category_id: "",
            },
        };
    },
    methods: {
        //get Table data
        loadTableData() {
            axios.get("http://localhost:8000/api/products").then(({ data }) => {
                this.tabledata = data;
                this.pagination_links = data.links;
            });
        },

        paginate(new_url) {
            axios(new_url).then((response) => {
                this.tabledata = response.data;
                this.pagination_links = response.data.links;
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
                        axios
                            .delete("http://localhost:8000/api/products/" + id)
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
<style scoped>
a.coding {
    text-transform: uppercase;
    color: #171717;
    text-decoration: none;
    font-size: 25px;
}
a.coding:before {
    content: "ADD PRODUCT";
    color: #1763aa;
    position: absolute;
    text-shadow: 0 0 3px #525717;
    animation: encode 1s 1;
}

a.coding:hover:before {
    animation: decode 1s 1;
}

@keyframes encode {
    0% {
        content: "\20B9 \03DE \20BE \03BE \2126 \2000 \03EA \03A3";
        text-shadow: 0 0 6px #69320e;
    }
    10% {
        content: "\03BE \03F4 \03DE \03D1 \03A3 \2000 \03DE \03EA";
    }
    20% {
        content: "\20BE \03BE \03DE \03EA \03D1 \2000 \2202 \03D1";
    }
    30% {
        content: "\03DE \20BA \03A3 \03D1 \20BE \2000 \20BE \2202";
    }
    40% {
        content: " A\0394 \20BA \03F4 \20BE \2000 \03A3 \20B9";
    }
    50% {
        content: " AD\03F4 \03BE \03DE \2000 \03DE \20BA";
    }
    60% {
        content: "ADD\03A3 \03D1 \0020 \20BE \2202";
    }
    70% {
        content: "ADD P\0394 \0020 \03D1 \03EA";
    }
    80% {
        content: "ADD PR \0020 \03EA \20BE";
    }
    90% {
        content: "ADD PRO\03DE";
        text-shadow: 0 0 6px #e84900;
    }
    100% {
        content: "ADD PRODUCT";
        text-shadow: 0 0 3px #0023e8;
    }
}

@keyframes decode {
    0% {
        content: "\20B9 \03DE \20BE \03BE \2126 \2000 \03EA \03A3";
        text-shadow: 0 0 6px #27741d;
    }
    10% {
        content: "\03BE \03F4 \03DE \03D1 \03A3 \2000 \03DE \03EA";
    }
    20% {
        content: "\20BE \03BE \03DE \03EA \03D1 \2000 \2202 \03D1";
    }
    30% {
        content: "\03DE \20BA \03A3 \03D1 \20BE \2000 \20BE \2202";
    }
    40% {
        content: "A\0394 \20BA \03F4 \20BE \2000 \03A3 \20B9";
    }
    50% {
        content: "AD\03F4 \03BE \03DE \2000 \03DE \20BA";
    }
    60% {
        content: "ADD\03A3 \03D1 \0020 \20BE \2202";
    }
    70% {
        content: "ADD P\0394 \0020 \03D1 \03EA";
    }
    80% {
        content: "ADD PR \0020 \03EA \20BE";
    }
    90% {
        content: "ADD PRO\03DE";
        text-shadow: 0 0 6px #e85d00;
    }
    100% {
        content: "ADD PRODUCT";
        text-shadow: 0 0 3px #00a6e8;
    }
}
</style>
