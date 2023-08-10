<template>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Employee Salary: {{$route.params.id}}</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><router-link to="/home">Home</router-link></li>
              <li class="breadcrumb-item active">Employee Salary List</li>
            </ol>
            <router-link class="btn btn-sm btn-primary float-right mr-3" to="/all-salary">All Salaries</router-link>
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
                <h3 class="card-title">Employee Salary List</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <!--custom search -->
                <div class="float-right row mb-1" style="width:300px;">
                  <div class="col-md-3">Search:</div> 
                  <input class="col-md-9 form-control" type="text" v-model="searchTerm" placeholder="Search by Employee Name"> 
                </div>


                <div class="table-responsive">
                  <table class="table table-bordered table-striped">
                    <thead>
                    <tr>
                      <th>salary Name</th>
                      <th>Month</th>
                      <th>Amount</th>
                      <th>Salary Date</th>
                
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="salary in filterSearch" :key="salary.id">
                      <td>{{salary.name}}</td>
                      <td>{{salary.salary_month}}</td>
                      <td>{{salary.amount}}</td>
                      <td>{{salary.salary_date}}</td>
                  
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
      salaries: [],
      searchTerm: ''
    }
  },

  computed:{
   filterSearch(){
      return this.salaries.filter(salary => {
        return salary.name.match(this.searchTerm)
    })
   }
  },

  methods: {
    allEmployeeSalaries(){
        let id = this.$route.params.id
        axios.get('/api/show-salary/'+id)
        .then(({data}) => (this.salaries = data))
         .catch()

    },

    deleteEmployee(id){
      swal({
            title: "Are you sure?",
            text: "Once deleted, this will be deleted permanently!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                axios.delete('/api/salary/'+id)
                .then(()=>{
                  this.salaries = this.salaries.filter(salary => {
                    return salary.id != id
                  })
                })
                .catch(()=>{
                  Notification.error()
                  this.$router.push({name: 'salary'})
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
    this.allEmployeeSalaries();
  },

}
</script>
