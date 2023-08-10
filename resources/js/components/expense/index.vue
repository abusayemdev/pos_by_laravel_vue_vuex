<template>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">All Expenses</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><router-link to="/home">Home</router-link></li>
              <li class="breadcrumb-item active">All Expenses</li>
            </ol>
            <router-link class="btn btn-sm btn-primary float-right mr-3" to="/add-expense">Add Expense</router-link>
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
                <h3 class="card-title">Expense List</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <!--custom search -->
                <div class="float-right row mb-1" style="width:300px;">
                  <div class="col-md-3">Search:</div> 
                  <input class="col-md-9 form-control" type="text" v-model="searchTerm" placeholder="Search by Expense Date"> 
                </div>
                
                <div class="table-responsive">
                  <table class="table table-bordered table-striped">
                    <thead>
                    <tr>
                      <th>Expense Date</th>
                      <th>Expense Amount</th>
                      <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                      <tr v-for="expense in filterSearch" :key="expense.id">
                        <td>{{expense.expense_date}}</td>
                        <td>{{expense.expense_amount}}</td>
                        <td>
                          <router-link :to="{name:'show-expense', params:{id:expense.id}}" class="btn btn-sm btn-primary  mb-1">View</router-link>
                          <router-link :to="{name:'edit-expense', params:{id:expense.id}}" class="btn btn-sm btn-info  mb-1">Edit</router-link>
                          <a @click="deleteExpense(expense.id)" class="btn btn-sm btn-danger  mb-1">Delete</a>
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
      expenses: [],
      searchTerm: ''
    }
  },

  computed:{
   filterSearch(){
      return this.expenses.filter(expense => {
        return expense.expense_date.match(this.searchTerm)
    })
   }
  },

  methods: {
    allExpenses(){
      axios.get('/api/expense')
      .then(({data}) => (this.expenses = data))
      .catch()
    },

    deleteExpense(id){
      swal({
            title: "Are you sure?",
            text: "Once deleted, this will be deleted permanently!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                axios.delete('/api/expense/'+id)
                .then(()=>{
                  this.expenses = this.expenses.filter(expense => {
                    return expense.id != id
                  })
                })
                .catch(()=>{
                  Notification.error()
                  this.$router.push({name: 'all-expense'})
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
    this.allExpenses();
  },

}
</script>
