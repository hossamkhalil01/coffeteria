<template>
<div class="container">
<div class="row">
<form>
    <div class="form-group">
    <lable>Name</lable> 
    <input type="text" class="form-control" />
    </div>


    <div class="form-group">
    <lable>email</lable> 
    <input type="email" class="form-control"/>
    </div>

<div class="form-group">
    <lable>Room</lable> 
    <input type="text" class="form-control" />
</div>
 <button type="submit" class="btn btn-primary">Update</button>
</form>
</div>
</div>
</template>

<script>
    export default{
        data(){
            user: []
        }
        ,
        methods:{
            updateUser(){
                
            }
        }
    }
</script>