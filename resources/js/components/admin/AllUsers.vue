<template>

<h2>All users</h2>
<div class="container">
<table class="table">
<thead>
<tr>
<th>Name</th>
<th>Room</th>
<th>image</th>
<th>ext</th>
<th>Action</th>
</tr>
</thead>

<tbody>

<tr v-for="user in users" :key="user.id" >
<td>{{user.name}}</td>
<td>{{user.email}}</td>

</tr>
</tbody>
</table>
</div>

</template>

<script>
import axios from 'axios'

export default{

    
    data(){
        return{
            users:[]
        }
    },
    mounted(){
        axios.get('http://localhost:8000/api/admin/getusers').then(
            response=>{
                this.users=response.data;
            }
        );
    }
}    
</script>