<template>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Stocks</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><router-link to="/home">Home</router-link></li>
              <li class="breadcrumb-item active">Stocks</li>
            </ol>
        
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
                <h3 class="card-title">Product List</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <!--custom search -->
                <div class="float-right row mb-1" style="width:300px;">
                  <div class="col-md-3">Search:</div> 
                  <input class="col-md-9 form-control" type="text" v-model="searchTerm" placeholder="Search by Product Code"> 
                </div>
              
                <div class="table-responsive">
                  <table class="table table-bordered table-striped">
                    <thead>
                    <tr>
                      <th>product Name</th>
                      <th>Photo</th>
                      <th>Product Code</th>
                      <th>Buying Price</th>
                      <th>Quantity</th>
                      <th>Stocks Status</th>
                      <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="product in filterSearch" :key="product.id">
                      <td>{{product.product_name}}</td>
                      <td><img :src="product.image" id="pro_image"></td>
                      <td>{{product.product_code}}</td>
                      <td>{{product.buying_price}}</td>
                      <td>{{product.product_quantity}}</td>
                      <td v-if="product.product_quantity >= 1"> <span class="badge badge-success" >Available</span></td>
                      <td v-else> <span class="badge badge-danger" >Stockout</span></td>
                      <td>
                        <router-link :to="{name:'edit-stocks', params:{id:product.id}}" class="btn btn-sm btn-info  mb-1">Edit</router-link>
                      
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
      products: [],
      searchTerm: ''
    }
  },

  computed:{
   filterSearch(){
      return this.products.filter(product => {
        return product.product_code.match(this.searchTerm)
    })
   }
  },

  methods: {
    allProduct(){
      axios.get('/api/product')
      .then(({data}) => (this.products = data))
      .catch()
    },

    deleteProduct(id){
      swal({
            title: "Are you sure?",
            text: "Once deleted, this will be deleted permanently!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })

    }
  },

  created() {
    this.allProduct();
  },

}
</script>

<style scoped>
#pro_image{
  width: 40px;
  height: 40px;
}

</style>