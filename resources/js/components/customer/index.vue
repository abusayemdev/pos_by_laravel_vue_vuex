<template>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">All Customers</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><router-link to="/home">Home</router-link></li>
              <li class="breadcrumb-item active">All Customers</li>
            </ol>
            <router-link class="btn btn-sm btn-primary float-right mr-3" to="/add-customer">Add Customer</router-link>
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

                 <div class="card">
              <div class="card-header">
                <h3 class="card-title">Customer List</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <!--custom search -->
                <div class="float-right row mb-1" style="width:300px;">
                  <div class="col-md-3">Search:</div> 
                  <input class="col-md-9 form-control" type="text" v-model="searchTerm" placeholder="Search by Phone Number"> 
                </div>
                <div class="table-responsive">
                  <table class="table table-bordered table-striped">
                    <thead>
                    <tr>
                      <th>customer Name</th>
                      <th>Photo</th>
                      <th>Phone</th>
                      <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="customer in filterSearch" :key="customer.id">
                      <td>{{customer.name}}</td>
                      <td><img :src="customer.photo" id="cus_photo"></td>
                      <td>{{customer.phone}}</td>
                      <td>
                        <router-link :to="{name:'show-customer', params:{id:customer.id}}" class="btn btn-sm btn-primary  mb-1">View</router-link>
                        <router-link :to="{name:'edit-customer', params:{id:customer.id}}" class="btn btn-sm btn-info  mb-1">Edit</router-link>
                        <a @click="deletecustomer(customer.id)" class="btn btn-sm btn-danger  mb-1">Delete</a>
                      </td>
                    </tr>
                  
                    </tbody>
                    
                  </table>
                </div>
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

  data(){
    return {
      customers: [],
      searchTerm: ''
    }
  },

  computed:{
   filterSearch(){
      return this.customers.filter(customer => {
      return customer.phone.match(this.searchTerm)
    })
   }
  },

  methods: {
    allcustomer(){
      axios.get('/api/customer')
      .then(({data}) => (this.customers = data))
      .catch()
    },

    deletecustomer(id){
      swal({
            title: "Are you sure?",
            text: "Once deleted, this will be deleted permanently!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                axios.delete('/api/customer/'+id)
                .then(()=>{
                  this.customers = this.customers.filter(customer => {
                    return customer.id != id
                  })
                })
                .catch(()=>{
                  Notification.error()
                  this.$router.push({name: 'all-customer'})
                });

                swal("File has been deleted!", {
                icon: "success",
                });
            } else {
                swal("File is safe!");
            }
        }); 

    }
  },

  created() {
    this.allcustomer();
  },

}
</script>

<style scoped>
#cus_photo{
  width: 40px;
  height: 40px;
}

</style>