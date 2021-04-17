<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Upload Profile</div>

                    <div class="card-body">

           <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle" :src="getPhoto()" alt="User profile picture">
                </div>
              </div>
            </div>


  <div class="tab-pane active" id="settings">
      <form class="form-horizontal">
        <div class="form-group row">
          <label for="inputName" class="col-sm-2 col-form-label">Name</label>
          <div class="col-sm-10">
            <input type="email" v-model="form.name" class="form-control" :class="{ 'is-invalid': form.errors.has('name') }">
          <has-error :form="form" field="name"></has-error> 
          </div>
        </div>

        <div class="form-group row">
          <label for="inputSkills" class="col-sm-2 col-form-label">Avatar</label>
          <div class="col-sm-10">
            <input type="file" @change='uploadPhoto' name="photo" class="form-control" :class="{ 'is-invalid': form.errors.has('photo') }">
            <has-error :form="form" field="photo"></has-error> 
          </div>
        </div>
       
        <div class="form-group row">
          <div class="offset-sm-2 col-sm-10">
            <button type="submit" @click.prevent="SubmitPhoto" class="btn btn-danger">Submit</button>
          </div>
        </div>
      </form>
      </div>

  <div class="card-body table-responsive p-0">
    <table class="table table-hover">
      <tbody>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Photo</th>
            <th>Modify</th>
      </tr> 

      <tr v-for="item in tabledata.data" :key="item.id">
        <td>{{ item.id }}</td>
        <td>{{ item.name }}</td>
        <td><img :src="`img/profile/${item.photo}`" class="profile-user-img img-fluid img-circle" style="height:40px; width:40px;"></td>
  
        <td>
            <a href="#" @click="editPhotoModal(item)">
                <i class="fa fa-edit blue"></i>
            </a>
            |
            <a href="#" @click="deletePhoto(item.id)">
                <i class="fa fa-trash red"></i>
            </a>

        </td>
      </tr>
    </tbody></table>
    <pagination :data="tabledata" @pagination-change-page="getResults"></pagination>
  </div>

    <div class="modal fade" id="addNew" tabindex="-1" role="dialog" aria-labelledby="addNewLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                <div class="modal-header">

                    <h5 class="modal-title" id="addNewLabel">Update Photo</h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>

<form @submit.prevent="UpdatePhoto">
<div class="modal-body">

     <div class="form-group">
        <input v-model="form.name" type="text" name="name"
            placeholder="Name"
            class="form-control" :class="{ 'is-invalid': form.errors.has('name') }">
        <has-error :form="form" field="name"></has-error>
    </div>

      <div class="form-group row">
        <label for="inputSkills" class="col-sm-2 col-form-label">Avatar</label>
          <div class="col-sm-10">
            <input type="file" @change='uploadPhoto' name="photo" class="form-control" :class="{ 'is-invalid': form.errors.has('photo') }">
            <has-error :form="form" field="photo"></has-error> 
        </div>
      </div>
      <img class="profile-user-img img-fluid img-circle" :src="getPhoto()" alt="User profile picture">
    
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
    <button type="submit" class="btn btn-primary">Update</button>
</div>

       </form>
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

        data(){
            return {
                tabledata: {},
                form: new Form({
                    id: '',
                    name : '',
                    photo: ''
                })
            }
        },
        methods: {

            uploadPhoto(e){
              let file = e.target.files[0];
                let reader = new FileReader();  

                if(file['size'] < 2111775)
                {
                    reader.onloadend = (file) => {
                    //console.log('RESULT', reader.result)
                     this.form.photo = reader.result;
                    }              
                     reader.readAsDataURL(file);
                }else{
                    alert('File size can not be bigger than 2 MB')
                }
            },

            //For getting Instant Uploaded Photo
            getPhoto(){
               let photo = (this.form.photo.length > 100) ? this.form.photo : "img/profile/"+ this.form.photo;
                return photo;
            },

            //Insert Photo
            SubmitPhoto(){

            this.form.post('api/photo')
               .then(()=>{

                   Toast.fire({
                      icon: 'success',
                      title: 'File uploaded successfully'
                    })
                   this.loadTableData()
               })
               .catch(()=>{
                  console.log("Error.....")
               })

            },

            //get Table data
            loadTableData(){

                axios.get('api/photo')
                   .then(({ data }) =>( this.tabledata = data))
                   .catch(()=>{
                      console.log("Error...")
                   })
            },

            //Pagination
            getResults(page = 1) {
                  axios.get('api/photo?page=' + page)
                    .then(response => {
                      this.tabledata = response.data;
                  });
            },

            //Edit Option
            editPhotoModal(item){
               this.form.clear();
               this.form.reset();
               $('#addNew').modal('show');
               this.form.fill(item)
            },

            UpdatePhoto(){
              this.form.put('api/photo/'+this.form.id)
               .then(()=>{

                   Toast.fire({
                      icon: 'success',
                      title: 'Photo updated successfully'
                    })

                    this.loadTableData()

                    $('#addNew').modal('hide');
               })
               .catch(()=>{
                  console.log("Error.....")
               })
            },

            //Delete photo
            deletePhoto(id){
                Swal.fire({
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
                this.form.delete('api/photo/'+id)
                    .then((response)=> {
                            Swal.fire(
                              'Deleted!',
                              'Photo deleted successfully',
                              'success'
                            )
                    this.loadTableData();

                    }).catch(() => {
                        Swal.fire({
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
          this.loadTableData()
            
        }
        
    }
</script>