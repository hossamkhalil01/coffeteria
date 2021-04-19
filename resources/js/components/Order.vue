<template>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <h3 class="fw-bold text-center mt-3">My Orders</h3>
            <!-- start of date pickers -->
            <div class="col-md-3 mt-3">
                <label for="date-from" class="me-3">Date From: </label>
                <input type="date" name="date-from" id="date-from" />
            </div>
            <div class="col-md-3 mt-3">
                <label for="date-to" class="me-3">Date To: </label>
                <input type="date" name="date-to" id="date-to" />
            </div>
        </div>
        <!-- end of date pickers -->
        <!-- start of orders table -->
        <div class="row justify-content-center mt-5">
            <div class="col-md-6">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">First</th>
                            <th scope="col">Last</th>
                            <th scope="col">Handle</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">1</th>
                            <td>Mark</td>
                            <td>Otto</td>
                            <td>@mdo</td>
                        </tr>
                        <tr>
                            <th scope="row">2</th>
                            <td>Jacob</td>
                            <td>Thornton</td>
                            <td>@fat</td>
                        </tr>
                        <tr>
                            <th scope="row">3</th>
                            <td colspan="2">Larry the Bird</td>
                            <td>@twitter</td>
                        </tr>
                    </tbody>
                </table>
                <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-center">
                        <li class="page-item">
                            <a class="page-link" href="#" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="#">1</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="#">2</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="#">3</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="#" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
        <!-- end of orders table -->
    </div>
</template>

<script>
import { csrf, user } from "../main.js";

export default {
    mounted() {
        console.log("Order component mounted.");
    },
    data() {
        return {
            csrf: csrf,
            user: user,
        };
    },

    methods: {
        getAvatar() {
            return "storage/avatars/" + this.user.id + "_" + this.user.avatar;
        },
    },
};
</script>
<style scoped>
@import url("https://fonts.googleapis.com/css2?family=Source+Sans+Pro:ital,wght@0,300;0,400;0,700;1,600;0,200&display=swap");

.container-fluid {
    font-family: "Source Sans Pro", sans-serif;
    font-weight: 600;
}
</style>
