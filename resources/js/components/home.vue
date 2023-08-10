<template>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1>Today's Overview
              <span class="float-right text-success" style="font-size: 16px">Today: {{currentDate()}}</span>
            </h1>
          </div><!-- /.col -->
       
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>{{today_sell}}</h3>

                <p>Total Sell</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <router-link to="/order" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></router-link>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>{{today_orders}}</h3>

                <p>Total Order</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <router-link to="/order" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></router-link>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>{{today_expense}}</h3>

                <p>Today's Expense</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <router-link to="/all-expense" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></router-link>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>{{stockin}}</h3>

                <p>Product Stock In</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <router-link to="/stocks" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></router-link>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->
        <div class="row">
          <div class="col-md-12">
             <div class="card">
              <div class="card-header">
                <h3 class="card-title">Stock Out Products</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
               
                <div class="table-responsive">
                  <table class="table table-bordered table-striped ">
                    <thead>
                    <tr>
                      <th>Product Name</th>
                      <th>Photo</th>
                      <th>Product Code</th>
                      <th>Buying Price</th>
                      <th>Stocks Status</th>
                      <th>Quantity</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="stocksout in stockout" :key="stocksout.id">
                      <td>{{stocksout.product_name}}</td>
                      <td><img :src="stocksout.image" id="pro_image"></td>
                      <td>{{stocksout.product_code}}</td>
                      <td>{{stocksout.buying_price}}</td>
                      <td v-if="stocksout.product_quantity >= 1"> <span class="badge badge-success" >Available</span></td>
                      <td v-else> <span class="badge badge-danger" >Stockout</span></td>
                      <td>{{stocksout.product_quantity}}</td>
                    </tr>
                  
                    </tbody>
                    
                  </table>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
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
      axios.get('/api/today-sell/')
      .then(({data}) => (this.today_sell = data))
      .catch()

      axios.get('/api/today-orders/')
      .then(({data}) => (this.today_orders = data))
      .catch()

      axios.get('/api/today-expense/')
      .then(({data}) => (this.today_expense = data))
      .catch()

      axios.get('/api/today-stockin/')
      .then(({data}) => (this.stockin = data))
      .catch()

      axios.get('/api/stockout/')
      .then(({data}) => (this.stockout = data))
      .catch()



  },

  data(){
    return{
      today_sell: {},
      today_orders: {},
      today_expense: {},
      stockout: {},
      stockin: {}
    }
  },

  methods: {
    currentDate() {
      const current = new Date();
      const date = `${current.getDate()}/${current.getMonth()+1}/${current.getFullYear()}`;
      return date;
    }
  }

}
</script>

<style scoped>
#pro_image{
  width: 70px;
  height: auto;
}
</style>