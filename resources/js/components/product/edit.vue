<template>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Edit Product</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><router-link to="/home">Home</router-link></li>
              <li class="breadcrumb-item active">Edit Product</li>
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
        <!--card-->
    <div class="card">

        <div class="card-header">
            <strong>Edit Product</strong>
        </div>

        <div class="card-body card-block">
            <form @submit.prevent="productUpdate" enctype="multipart/form-data" class="form-horizontal">
  
                <div class="row form-group">
                    <div class="col col-md-3">
                        <label class=" form-control-label">Product Name <span class="text-danger">*</span></label>
                    </div>
                    <div class="col-12 col-md-9">
                        <input type="text" v-model="form.product_name" placeholder="Product Name" class="form-control" required>
                        
                    </div>
                </div>
                

               <div class="form-group row">
                  <label for="product" class="col-sm-3 col-form-label">Category <span class="text-danger">*</span></label>
                  <div class="col-sm-9">
                      <select class="form-control" v-model="form.category_id">
                          <option :value="0" disabled>Select Category</option>
                          <option v-for="(category, index) in categories" :key="index"  :value="category.id">{{category.category_name}}</option>
                      </select>    
                  </div>
                </div>

                

                <div class="form-group row">
                  <label for="product" class="col-sm-3 col-form-label">Supplier <span class="text-danger">*</span></label>
                  <div class="col-sm-9">
                      <select class="form-control" v-model="form.supplier_id">
                          <option :value="0" disabled>Select Supplier</option>
                          <option v-for="(supplier, index) in suppliers" :key="index"  :value="supplier.id">{{supplier.name}}</option>
                      </select>    
                  </div>
                </div>
                

                <div class="row form-group">
                    <div class="col col-md-3">
                        <label class=" form-control-label">Product Code <span class="text-danger">*</span></label>
                    </div>
                    <div class="col-12 col-md-9">
                        <input type="text"  v-model="form.product_code" placeholder="Product Code" class="form-control" required>
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col col-md-3">
                        <label class=" form-control-label">Buying Price <span class="text-danger">*</span></label>
                    </div>
                    <div class="col-12 col-md-9">
                        <input type="text"  v-model="form.buying_price" placeholder="Buying Price" class="form-control" required>
                    </div>
                </div>
       
                <div class="row form-group">
                    <div class="col col-md-3">
                        <label class=" form-control-label">Selling Price <span class="text-danger">*</span></label>
                    </div>
                    <div class="col-12 col-md-9">
                        <input type="text"  v-model="form.selling_price" placeholder="Selling Date" class="form-control" required>
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col col-md-3">
                        <label class=" form-control-label">Buying Date <span class="text-danger">*</span></label>
                    </div>
                    <div class="col-12 col-md-9">
                        <input type="date"  v-model="form.buying_date" placeholder="Buying Date" class="form-control" required>
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col col-md-3">
                        <label class=" form-control-label">Root <span class="text-danger">*</span></label>
                    </div>
                    <div class="col-12 col-md-9">
                        <input type="text"  v-model="form.root" placeholder="Root" class="form-control" required>
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col col-md-3">
                        <label class=" form-control-label">Product Quantity <span class="text-danger">*</span></label>
                    </div>
                    <div class="col-12 col-md-9">
                        <input type="text"  v-model="form.product_quantity" placeholder="Product Quantity" class="form-control" required>
                    </div>
                </div>
            
                <div class="row form-group">
                    <div class="col col-md-3">
                        <label class=" form-control-label">Image</label>
                    </div>
                    
                    <div class="col-12 col-md-9">
                      <img :src="'/'+form.image" style="width:70px; height:70px;" > <br> <br>
                      <input type="file" @change="onFileSelected" class="form-control-file" accept="image/*">
                      
                    </div>
                </div>
            
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary btn-md"> Update </button>

                </div>
            
            </form>
        </div>
        
    </div><!--/card-->
      
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
      .then(({data}) => (this.form = data))
      .catch(console.log('error'))

      axios.get('/api/category')
        .then(({data}) =>(this.categories = data))
  
      axios.get('/api/supplier')
        .then(({data}) =>(this.suppliers = data))
  },

  data(){
    return{
       errors: {},      
       form: {
          category_id: 0,
          product_name: '',
          supplier_id: 0,
          product_code: '',
          buying_price: '',
          selling_price: '',
          buying_date: '',
          root: '',
          product_quantity: '',
          image: '',
          newimage: ''
        },
        categories: {},
        suppliers: {}
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
          this.form.newimage = event.target.result
          console.log(event.target.result)
        }

      }
    },

     productUpdate(){
        let id = this.$route.params.id
        axios.patch('/api/product/'+id, this.form)
  
        .then(() => {
          Notification.update()
          this.$router.push({name: 'all-product'})
        })
        .catch(error => {
          Notification.error()
          this.error = error.response.data.errors
          })
        

     }
  }


}
</script>