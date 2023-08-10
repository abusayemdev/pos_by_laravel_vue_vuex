<template>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Add Supplier</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><router-link to="/home">Home</router-link></li>
              <li class="breadcrumb-item active">Add Supplier</li>
            </ol>
            <router-link class="btn btn-sm btn-primary float-right mr-3" to="/all-supplier">All Suppliers</router-link>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!--card-->
    <div class="card">

        <div class="card-header">
            <strong>Add Supplier</strong>
        </div>

        <div class="card-body card-block">
            <form @submit.prevent="supplierInsert" enctype="multipart/form-data" class="form-horizontal">
  
                <div class="row form-group">
                    <div class="col col-md-3">
                        <label class=" form-control-label">Full Name <span class="text-danger">*</span></label>
                    </div>
                    <div class="col-12 col-md-9">
                        <input type="text" v-model="form.name" placeholder="Full Name" class="form-control" >
                        <small class="text-danger" v-if="errors.name">{{errors.name[0]}}</small> 
                    </div>
                </div>
                

                <div class="row form-group">
                    <div class="col col-md-3">
                        <label class=" form-control-label">Email <span class="text-danger">*</span></label>
                    </div>
                    <div class="col-12 col-md-9">
                        <input type="email"  v-model="form.email" placeholder="Email" class="form-control">
                        <small class="text-danger" v-if="errors.email">{{errors.email[0]}}</small> 
                    </div>
                </div>
                

                <div class="row form-group">
                    <div class="col col-md-3">
                        <label class=" form-control-label">Phone <span class="text-danger">*</span></label>
                    </div>
                    <div class="col-12 col-md-9">
                        <input type="text"  v-model="form.phone" placeholder="Phone Number" class="form-control" >
                        <small class="text-danger" v-if="errors.phone">{{errors.phone[0]}}</small> 
                    </div>
                </div>         

                <div class="row form-group">
                    <div class="col col-md-3">
                        <label class=" form-control-label">Address</label>
                    </div>
                    <div class="col-12 col-md-9">
                        <input type="text"  v-model="form.address" placeholder="Address" class="form-control">
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col col-md-3">
                        <label class=" form-control-label">Shopname</label>
                    </div>
                    <div class="col-12 col-md-9">
                        <input type="text"  v-model="form.shopname" placeholder="Shopname" class="form-control">
                    </div>
                </div>

       
                <div class="row form-group">
                    <div class="col col-md-3">
                        <label class=" form-control-label">Photo</label>
                    </div>
                    
                    <div class="col-12 col-md-9">
                      <img :src="form.photo" style="width:70px; height:70px;" > <br> <br>
                      <input type="file" @change="onFileSelected" class="form-control-file" accept="image/*">
                      
                    </div>
                </div>


                <div class="card-footer">
                    <button type="submit" class="btn btn-primary btn-md"> Submit </button>

                </div>
            
            </form>
        </div>
        
    </div><!--/card-->
      
      </div>
    </section>
  </div>
</template>

<script>
export default {
  created(){
    if (!User.loggedIn()) {
      this.$router.push({name: '/'})
    }
  },

  data(){
    return{
      errors: {},      
      form: {
        name: '',
        email: '',
        phone: '',
        address: '',
        shopname: '',
        photo: ''
      }
    }
  },

  methods: {
    onFileSelected(event){
      let file= event.target.files[0];
      if (file.size > 2048000) {
        Notification.image_validation()
      }else{
        let reader = new FileReader();
        reader.readAsDataURL(file);
        reader.onload = event => {
          this.form.photo = event.target.result
          console.log(event.target.result)
        }

      }
    },

     supplierInsert(){
       axios.post('/api/supplier', this.form)
       .then(() =>{
         this.$router.push({ name: 'all-supplier' })
         Notification.insert()
       })
       .catch(error => {
         Notification.error()
         this.errors = error.response.data.errors
         })

    }
  }


}
</script>