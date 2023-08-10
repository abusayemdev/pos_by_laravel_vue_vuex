<template>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Order Details</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><router-link to="/home">Home</router-link></li>
              <li class="breadcrumb-item active">Order Details</li>
            </ol>
        
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Main content -->
        <div class="invoice p-3 mb-3">
          <!-- title row -->
          <div class="row">
            <div class="col-12">
              <h4>
                <i class="fas fa-globe"></i> {{shop_details.shop_name}}
                <small class="float-right">Date: {{new Date().toLocaleDateString().split(",")[0]}}</small>
              </h4>
            </div>
            <!-- /.col -->
          </div>
          <!-- info row -->
          <div class="row invoice-info">
            <div class="col-sm-4 invoice-col">
              From
              <address>
                <strong>{{shop_details.shop_name}}</strong><br>
                {{shop_details.address}} <br>
                Phone: {{shop_details.phone}}<br>
                Email: {{shop_details.email}}
              </address>
            </div>
            <!-- /.col -->
            <div class="col-sm-4 invoice-col">
              To
              <address>
                <strong>{{order.name}}</strong><br>
                {{order.address}}<br>
                Phone: {{order.phone}}<br>
              </address>
            </div>
            <!-- /.col -->
            <div class="col-sm-4 invoice-col">
              <b>Order ID:</b> {{order.id}}<br>
              <b>Order Date:</b> {{order.order_date}}
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->

          <!-- Table row -->
          <div class="row">
            <div class="col-12 table-responsive">
              <table class="table table-striped table-bordered">
                <thead>
                <tr>
                  <th>Product Name</th>
                  <th>Code</th>
                  <th>Qty</th>
                  <th>Unit Price</th>
                  <th>Total</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="order_detail in order_details" :key="order_detail.id">
                  <td>{{order_detail.product_name}}</td>
                  <td>{{order_detail.product_code}}</td>
                  <td>{{order_detail.pro_quantity}}</td>
                  <td>{{order_detail.pro_price}}</td>
                  <td>{{order_detail.sub_total}}</td>
                </tr>
                
                </tbody>
              </table>
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->

          <div class="row">
            <!-- accepted payments column -->
            <div class="col-6">
              
            </div>
            <!-- /.col -->
            <div class="col-6">

              <div class="table-responsive">
                <table class="table border-bottom" >
                  <tr>
                    <th style="width:50%">Subtotal:</th>
                    <td>{{order.sub_total}}</td>
                  </tr>
                  <tr>
                    <th>Tax ({{order.vat}}%)</th>
                    <td>{{order.vat*order.sub_total/100}}</td>
                  </tr>
                
                  <tr>
                    <th>Total:</th>
                    <td>{{order.total}}</td>
                  </tr>

                  <tr>
                    <th>Due:</th>
                    <td>{{order.due || 0}}</td>
                  </tr>

                  <tr>
                    <th>Paid:</th>
                    <td>{{order.pay || 0}}</td>
                  </tr>

                  <tr>
                    <th>Pay Through:</th>
                    <td>{{order.payby}}</td>
                  </tr>
                </table>

              </div>
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->

        </div>
        <!-- /.invoice -->
        
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
      axios.get('/api/order-details/'+id)
      .then(({data}) => (this.order = data))
      .catch()

      axios.get('/api/order-details-all/'+id)
      .then(({data}) => (this.order_details = data))
      .catch()

      axios.get('/api/shop-details/')
      .then(({data}) => (this.shop_details = data))
      .catch()



  },

  data(){
    return{
      errors: {},      
      order: {},
      order_details: {},
      shop_details: {}
    }
  }


}
</script>
