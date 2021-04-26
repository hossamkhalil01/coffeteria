<template>
<div class="  row justify-content-center" style="margin-top:70px">

    <!-- Start of checks table-->
    <div class="col-6 mb-3">
        <h1>Orders</h1>

        <div v-for="order in orders">
        
        <table class="table table-hover" style="border: 1px solid;margin: 2px 0px;" >
            <thead>
                <tr>
                    <th class="table-primary">Order Date</th>
                    <th class="table-primary">Name</th>
                    <th class="table-primary">Room</th>
                    <th class="table-primary">ext</th>
                    <th class="table-primary">Action</th>
                </tr>

            </thead>

            <tbody>
                <tr>
                    <td>{{ getDate(order.created_at) }}</td>
                    <td>
                        {{ order.owner.name }}
                    </td>
                    <td>
                        {{ order.room.number }}
                    </td>
                    <td>
                        {{ order.products.price }}
                    </td>

                    <td>

                        <a type="button" class="btn btn-danger" @click="deleteUser(user.id)">
                            Deliver
                        </a>
                    </td>

                </tr>

               
            </tbody>
        </table>


         <div style="display:inline-block;border:1px solid" class="col-12 mb-3">
                    <div class="product-container">
                        <td  v-for="product in order.products" >
                           <img  :src="`http://localhost:8000/storage/img/${product.image}`" class="product-image" >
                                                     <div class="price"> {{product.price}} LE</div>

                           <p class="productname">  {{product.name}}</p>
                           
                            <p class="productquantity">{{product.pivot.quantity}}</p>


                        </td>

                   

                    </div>
 <h4 style="float:right;margin-right: 37px;">Total: EGP {{order.total_price}}</h4>
                   
                </div>

</div>
    </div>
    <!-- End of checks table -->
</div>
</template>

<script>
import {
    apiBase
} from "@helpers/urls.js";
import {
    priceFormatter,
    dateFormatter
} from "@helpers/formatters";

export default {
    mounted() {},
    data() {
        return {
            orders: {

            }
        };
    },
    props: {
        checks: {
            type: Array,
            required: true,
        },
    },
    methods: {
        getorders() {
            axios
                .get(apiBase + "admin/getorders")
                .then((data) => (this.orders = data.data))
                .catch(() => {
                    console.log("Error...");
                });
        },
        getDate: function (date) {
            return dateFormatter(date);
        },

        getAmount: function (check) {
            return priceFormatter(check.total_price);
        },
    },

    created() {
        this.getorders()
    }
};
</script>


<style>
.product-image{
    width: 100px;
border-radius: 75px;
height: 93px;
margin: 0px 13px;
}

.productname{
   margin-left: 43px;
}

.productquantity{
    margin-left: 53px;
}

.product-container{
   
    margin: 37px;
}

.price{
 width: 56px;
height: 43px;
border: 1px solid;
border-radius: 48%;
text-align: center;
margin: -90px 77px;
position: absolute;
background-color: #eee;
padding: 9px 3px;
font-size: 15px;
}
</style>