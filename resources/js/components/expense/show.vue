<template>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Expense Details</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><router-link to="/home">Home</router-link></li>
              <li class="breadcrumb-item active">Expense Details</li>
            </ol>
            <router-link class="btn btn-sm btn-primary float-right mr-3" to="/all-expense">All Expenses</router-link>
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
               

                <dl class="row">
                    <dt class="col-sm-4">Expense Date <span class="float-right">:</span></dt>
                    <dd class="col-sm-8">{{form.expense_date}}</dd>
                    <dt class="col-sm-4">Expense Amount <span class="float-right">:</span></dt>
                    <dd class="col-sm-8">{{form.expense_amount}}</dd>
                    <dt class="col-sm-4">Expense Details <span class="float-right">:</span></dt>
                    <dd class="col-sm-8">{{form.expense_details}}</dd>

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
      axios.get('/api/expense/'+id)
      .then(({data}) => (this.form = data))
      .catch(console.log('error'))

  },

  data(){
    return{
      errors: {},      
      form: {
        expense_date: '',
        expense_details: '',
        expense_amount: '',
      }
    }
  }


}
</script>
