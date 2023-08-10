<template>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"> Order List: {{this.$route.params.id}}</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><router-link to="/home">Home</router-link></li>
              <li class="breadcrumb-item active">Order List</li>
            </ol>
            <router-link class="btn btn-sm btn-primary float-right mr-3" to="/order">All Orders</router-link>
           
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
                <h3 class="card-title">Order List</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <!--custom search -->
                <div class="float-right row mb-1" style="width:300px;">
                  <div class="col-md-3">Search:</div> 
                  <input class="col-md-9 form-control" type="text" v-model="searchTerm" placeholder="Search by Customer Name"> 
                </div>
                
                <div class="table-responsive">
                  <table class="table table-bordered table-striped">
                    <thead>
                    <tr>
                      <th>Customer Name</th>
                      <th>Total Amount</th>
                      <th>Paid</th>
                      <th>Due</th>
                      <th>Payby</th>
                      <th>Action</th>
                
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="order in filterSearch" :key="order.id">
                      <td>{{order.name}}</td>
                      <td>{{order.total}}</td>
                      <td>{{order.pay}}</td>
                      <td>{{order.due || 0}}</td>
                      <td>{{order.payby}}</td>
                      <td><router-link :to="{name:'show-order', params:{id:order.id}}" class="btn btn-sm btn-primary  mb-1">View Details</router-link></td>
                    
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
      orders: [],
      searchTerm: ''
    }
  },

  computed:{
   filterSearch(){
      return this.orders.filter(order => {
        return order.name.match(this.searchTerm)
    })
   }
  },

  methods: {
    bydayOrders(){
      let id = this.$route.params.id
      axios.get('/api/day-order/'+id)
      .then(({data}) => (this.orders = data))
      .catch()
    },


  },
  
  created() {
    this.bydayOrders();
  },

}
</script>
