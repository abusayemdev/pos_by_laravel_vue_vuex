<template>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Customer Profile</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><router-link to="/home">Home</router-link></li>
              <li class="breadcrumb-item active">Customer Profile</li>
            </ol>
            <router-link class="btn btn-sm btn-primary float-right mr-3" to="/all-customer">All Customers</router-link>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
          <div class="row">
      
            <div class="col-lg-12">

                

                 <!-- Profile Image -->
            <div class="card card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  <img class="profile-user-img" :src="'/'+form.photo" id="cus_photo" >
                </div>


                <dl class="row">
                        <dt class="col-sm-3">Customer Name <span class="float-right">:</span></dt>
                        <dd class="col-sm-9">{{form.name}}</dd>
                        <dt class="col-sm-3" >Email <span class="float-right">:</span></dt>
                        <dd class="col-sm-9">{{form.email}}</dd>
                        <dt class="col-sm-3" >Address <span class="float-right">:</span></dt>
                        <dd class="col-sm-9">{{form.address}}</dd>
                         <dt class="col-sm-3" >Phone <span class="float-right">:</span></dt>
                        <dd class="col-sm-9">{{form.phone}}</dd>

                    
                    </dl>



              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->



               

                
            </div>
            <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
        
      </div>
    </section>
  </div>
</template>

<script>
import axios from 'axios'
export default {
  mounted(){
    if (!User.loggedIn()) {
      this.$router.push({name: '/'})
    }
  },

  created(){
      let id = this.$route.params.id
      axios.get('/api/customer/'+id)
      .then(({data}) => (this.form = data))
      .catch(console.log('error'))

  },

  data(){
    return{
      errors: {},      
      form: {
        name: '',
        email: '',
        phone: '',
        address: '',
        photo: ''
      }
    }
  }


}
</script>

<style scoped>
#cus_photo{
  width: 100px;
  height: 100px;
}

</style>