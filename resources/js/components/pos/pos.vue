<template>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Point Of Sale (POS)</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><router-link to="/home">Home</router-link></li>
              <li class="breadcrumb-item active">POS</li>
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
          <div class="col-lg-6">
            
            <div class="card">
             

              <div class="card-body card-block">
                <div class="text-center py-3 ">
                  <div class="table-responsive">
                    <table class="table table-striped table-bordered" >
                      <thead>
                        <th>Name</th>
                        <th>Qty</th>
                        <th>Unit Price</th>
                        <th>Sub Total</th>
                        <th>Action</th>
                      </thead>
                      <tbody>
                        <tr v-for="cart in carts" :key="cart.id">
                          <td>{{cart.pro_name}}</td>
                          <td>
                            <input type="text" readonly style="width:20px;" :value="cart.pro_quantity" > <br>
                            <div class="btn-group my-1" role="group" aria-label="Basic example">
                              <button type="button" @click.prevent="increment(cart.id)" class="btn btn-sm btn-primary">+</button> 
                              <button type="button" @click.prevent="decrement(cart.id)" v-if="cart.pro_quantity > 1" class="btn btn-sm btn-primary">-</button>
                              <button type="button" v-else disabled class="btn btn-sm btn-primary">-</button>
                            </div>
                            
                          </td>
                          <td>{{cart.pro_price}}</td>
                          <td>{{cart.sub_total}}</td>
                          <td><a @click.prevent="removeItem(cart.id)"><i class="far fa-trash-alt"></i></a></td>
                        </tr>

                      </tbody>
                    </table>
                  </div>
                </div>
                        
                <div class="price-card table-responsive">
                  <table class="table ">
                    <tr>
                      <th style="width:50%">Total Quantity:</th>
                      <td>{{qty}}</td>
                    </tr>

                    <tr>
                      <th style="width:50%">Subtotal:</th>
                      <td>{{subtotal}} Tk</td>
                    </tr>
                    <tr>
                      <th>Tax:</th>
                      <td>{{vats.vat}}%</td>
                    </tr>
                    <tr>
                      <th>Total:</th>
                      <td>{{subtotal + vats.vat*subtotal /100}}</td>
                    </tr>
                  </table>
                </div>

              </div>

              <hr>

              <div class="card-body">

                <h4>Customer 
                  <button type="button" class="btn btn-sm btn-primary  float-right" data-toggle="modal" data-target="#mediumModal">
                      Add New
                  </button>
                </h4>

                <hr>
              
                <form @submit.prevent="orderDone">

                  <div class="form-group row">
                    <div class="col col-md-3">
                          <label class=" form-control-label">Customer</label>
                    </div>
                   
                    <div class="col-12 col-md-9 ">
                        <select class="form-control" v-model="customer_id">
                          <option value="0" disabled>Select Customer</option>
                          <option v-for="(customer, index) in customers" :key="index"  :value="customer.id">{{customer.name}}</option>
                            
                        </select>    
                    </div>
                  </div>

                  <div class="row form-group">
                      <div class="col col-md-3">
                          <label class=" form-control-label">Pay </label>
                      </div>
                      <div class="col-12 col-md-9">
                          <input type="text" v-model="pay" placeholder="Pay" class="form-control">
                          
                      </div>
                  </div>

                  <div class="row form-group">
                      <div class="col col-md-3">
                          <label class=" form-control-label">Due</label>
                      </div>
                      <div class="col-12 col-md-9">
                          <input type="text" v-model="due" placeholder="Due" class="form-control">
                          
                      </div>
                  </div>


                  <div class="form-group row">
                    <div class="col col-md-3">
                          <label class=" form-control-label">Pay By</label>
                    </div>
                    
                    <div class="col-12 col-md-9">
                        <select class="form-control" v-model="payby">
                            <option value="0" disabled>Select Payment Method</option>
                            <option value="Handcash">Hand Cash</option>
                            <option value="Check">Check</option>
                            <option value="Giftcard">Giftcard</option>
                        </select>    
                    </div>
                  </div>
                    
                  <br>
                
                  <button type="submit" class="btn btn-md btn-primary btn-block">Order Now</button>

                </form>
              </div>

            </div><!--./card-->

          
          </div>
    
          <div class="col-lg-6">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Products</h3>
              </div>

              <div class="card-body">
                <!--custom search -->
                <div class="row mb-3">
                  <input class="col-md-12 form-control" type="text" v-model="searchTerm" placeholder="Search by Product Name"> 
                </div>
                <!-- /.row -->
                

                
                <div class="row">
                  <div class="col-sm-6" v-for="product in filterSearch" :key="product.id">
                    
                      <div class="card text-center" style="overflow:hidden;">
                        <img class="m-auto" :src="product.image" id="pro_image">
                        <div class="card-body">
                          
                          <p class="text-center product_text">{{product.product_name}}</p> 
                         
                          <span v-if="product.product_quantity >= 1" class="badge badge-success" >Available ({{product.product_quantity}})</span>
                          <span v-else class="badge badge-danger" >Stockout</span> <br>
                          <button class="btn btn-sm btn-primary mt-3" v-if="product.product_quantity >= 1" @click.prevent="addToCart(product.id)"> Add Cart </button> 
                          <button class="btn btn-sm btn-primary mt-3" v-else disabled @click.prevent="addToCart(product.id)"> Add Cart </button> 

                        </div>
                      </div><!-- /.card -->
                    
                  </div>
                </div><!-- /.row -->

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



    <!-- modal medium -->
    <div class="modal fade" id="mediumModal" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true" data-backdrop="false" style="background-color: rgba(0, 0, 0, 0.5);">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <form @submit.prevent="customerInsert"  enctype="multipart/form-data" class="form-horizontal">
            <div class="modal-header">
              <h5 class="modal-title" id="mediumModalLabel">Create Customer</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="closeModel">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <div class="modal-body">

              <div class="row form-group">
                  <div class="col col-md-3">
                      <label class=" form-control-label">Full Name <span class="text-danger">*</span></label>
                  </div>
                  <div class="col-12 col-md-9">
                      <input type="text" v-model="form.name" placeholder="Full Name" class="form-control" required>
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
                      <input type="text"  v-model="form.phone" placeholder="Phone Number" class="form-control" required>
                      <small class="text-danger" v-if="errors.phone">{{errors.phone[0]}}</small> 
                  </div>
              </div>
              

              <div class="row form-group">
                  <div class="col col-md-3">
                      <label class=" form-control-label">Address</label>
                  </div>
                  <div class="col-12 col-md-9">
                      <input type="text"  v-model="form.address" placeholder="Address" class="form-control" required>
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

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary"> Submit </button>
            </div>

          </form>

        </div>
      </div>
    </div>
    <!-- end modal medium -->

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

  created() {
    this.allProduct();
    this.allCustomer();
    this.cartProduct();
    this.vat();
    Reload.$on('afterCart', ()=> {
      this.cartProduct();
    })
  },

  data(){
    return {

      products: [],
      customers: [],
      searchTerm: '',
      form: {
        name: '',
        email: '',
        phone: '',
        address: '',
        photo: ''
      },
      customer_id: 0,
      pay: '',
      due: '',
      payby: 0,
      carts: [],
      vats: [],
      errors: {}
    }
  },

  computed:{
   filterSearch(){
      return this.products.filter(product => {
      return product.product_name.match(this.searchTerm)
    })
   },

   qty(){
     let qsum = 0;

     for (let i = 0; i < this.carts.length; i++) {
       qsum += (parseFloat(this.carts[i].pro_quantity)); 
     }

     return qsum;
    },

    subtotal(){
      let subtotal = 0;

     for (let i = 0; i < this.carts.length; i++) {
       subtotal += (parseFloat(this.carts[i].pro_quantity) * parseFloat(this.carts[i].pro_price)); 
     }

     return subtotal;
    }
  },

  methods: {
    //cart method
    addToCart(id){
       axios.post('/api/add-to-cart/'+id)
      .then(() =>{
        Reload.$emit('afterCart');
        Notification.add_to_cart();
      })
      .catch(error => {
        Notification.error()
        this.errors = error.response.data.errors
        })
    },

    cartProduct(){
       axios.get('/api/cart-product')
      .then(({data}) => (this.carts = data))
      .catch()
    },

    removeItem(id){
      axios.get('/api/remove-cart/'+id)
      .then(() =>{
        Reload.$emit('afterCart');
        Notification.remove_cart();
      })
    },

    increment(id){
      axios.get('/api/increment-cart/'+id)
      .then(() =>{
        Reload.$emit('afterCart');
        Notification.add_to_cart();
      })

    },

    decrement(id){
      axios.get('/api/decrement-cart/'+id)
      .then(() =>{
        Reload.$emit('afterCart');
        Notification.remove_cart();
      })

    },

    vat(){
      axios.get('/api/vat')
      .then(({data}) => (this.vats = data))
      .catch()
    },

    orderDone(){
      let total = this.subtotal + this.vats.vat*this.subtotal /100;
      let data = {qty:this.qty, subtotal:this.subtotal,
                  customer_id:this.customer_id, pay:this.pay, 
                  due:this.due, payby:this.payby, vat:this.vats.vat, total:total};
      
      axios.post('/api/order-done', data)
      .then(() => {
        this.$router.push({name: 'home'})
        Notification.order_done();
      })
    },

    //cart method end

    allProduct(){
      axios.get('/api/product')
      .then(({data}) => (this.products = data))
      .catch()
    },
    allCustomer(){
      axios.get('/api/customer')
      .then(({data}) => (this.customers = data))
      .catch()
    },

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

    customerInsert(){
      axios.post('/api/customer', this.form)
      .then(() =>{
        $('#closeModel').click();

        axios.get('/api/customer')
        .then(({data}) => (this.customers = data))

        Notification.insert()
      })
      .catch(error => {
        Notification.error()
        this.errors = error.response.data.errors
        })

    },

    deleteProduct(id){
      swal({
            title: "Are you sure?",
            text: "Once deleted, this will be deleted permanently!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                axios.delete('/api/product/'+id)
                .then(()=>{
                  this.products = this.products.filter(product => {
                    return product.id != id
                  })
                })
                .catch(()=>{
                  Notification.error()
                  this.$router.push({name: 'all-product'})
                });

                swal("File has been deleted!", {
                icon: "success",
                });
            } else {
                swal("File is safe!");
            }
        }); 

    }
  }

}
</script>

<style scoped>
#pro_image{
  width: 80px;
  height: 80px;
}

.product_text{
white-space: nowrap;
overflow: hidden;
text-overflow: ellipsis;
}

</style>