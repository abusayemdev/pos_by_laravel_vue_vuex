<template>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Product Details</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><router-link to="/home">Home</router-link></li>
              <li class="breadcrumb-item active">Product Details</li>
            </ol>
            <router-link class="btn btn-sm btn-primary float-right mr-3" to="/all-product">All Products</router-link>
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
                  <img :src="'/'+product.image" id="pro_photo" >
                </div>


                <dl class="row">
                        <dt class="col-sm-3">Product Name <span class="float-right">:</span></dt>
                        <dd class="col-sm-9">{{product.product_name}}</dd>
                        <dt class="col-sm-3" >Product Code <span class="float-right">:</span></dt>
                        <dd class="col-sm-9">{{product.product_code}}</dd>
                        <dt class="col-sm-3" >Category Name <span class="float-right">:</span></dt>
                        <dd class="col-sm-9">{{product.category_name}}</dd>
                         <dt class="col-sm-3" >Supplier Name <span class="float-right">:</span></dt>
                        <dd class="col-sm-9">{{product.name}}</dd>
                         <dt class="col-sm-3" >Product Root <span class="float-right">:</span></dt>
                        <dd class="col-sm-9">{{product.root}}</dd>
                        <dt class="col-sm-3" >Buying Price <span class="float-right">:</span></dt>
                        <dd class="col-sm-9">{{product.buying_price}}</dd>
                        <dt class="col-sm-3" >Selling Price <span class="float-right">:</span></dt>
                        <dd class="col-sm-9">{{product.selling_price}}</dd>
                        <dt class="col-sm-3" >Buying Date <span class="float-right">:</span></dt>
                        <dd class="col-sm-9">{{product.buying_date}}</dd>
                        <dt class="col-sm-3" >Product Quantity <span class="float-right">:</span></dt>
                        <dd class="col-sm-9">{{product.product_quantity}}</dd>

                    
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
      axios.get('/api/product/'+id)
      .then(({data}) => (this.product = data))
      .catch(console.log('error'))

  },

  data(){
    return{
      errors: {},      
      product: {}
    }
  }


}
</script>

<style scoped>
#pro_photo{
  width: 100px;
  height: 100px;
}

</style>