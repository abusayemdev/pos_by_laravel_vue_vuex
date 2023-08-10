<template>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Pay Salary</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><router-link to="/home">Home</router-link></li>
              <li class="breadcrumb-item active">Pay Salary</li>
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
        <!--card-->
    <div class="card">

        <div class="card-header">
            <strong>Pay Salary</strong>
        </div>

        <div class="card-body card-block">
            <form @submit.prevent="paySalary" class="form-horizontal">
  
                <div class="row form-group">
                    <div class="col col-md-3">
                        <label class=" form-control-label">Full Name <span class="text-danger">*</span></label>
                    </div>
                    <div class="col-12 col-md-9">
                        <input type="text" v-model="form.name" placeholder="Full Name" class="form-control" required>
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col col-md-3">
                        <label class=" form-control-label">Email <span class="text-danger">*</span></label>
                    </div>
                    <div class="col-12 col-md-9">
                        <input type="email"  v-model="form.email" placeholder="Email" class="form-control" required>
                    </div>
                </div>

               
                <div class="row form-group">
                    <div class="col col-md-3">
                        <label class=" form-control-label">Amount <span class="text-danger">*</span></label>
                    </div>
                    <div class="col-12 col-md-9">
                        <input type="text"  v-model="form.salary" placeholder="Salary" class="form-control" required>
                    </div>
                </div>

                <div class="form-group row">
                  <div class="col col-md-3">
                        <label class=" form-control-label">Salay Month <span class="text-danger">*</span></label>
                  </div>
                  <div class="col-12 col-md-9">
                      <select class="form-control" v-model="form.salary_month">
                          <option value="0" disabled>Select Month</option>
                          <option value="January">January</option>
                          <option value="February">February</option>
                          <option value="March">March</option>
                          <option value="April">April</option>
                          <option value="May">May</option>
                          <option value="June">June</option>
                          <option value="July">July</option>
                          <option value="August">August</option>
                          <option value="September">September</option>
                          <option value="October">October</option>
                          <option value="November">November</option>
                          <option value="December">December</option>
                      </select>    
                  </div>
                </div>
             


            
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary btn-md"> Pay Now </button>

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
    this.employeeData();

  },

  data(){
    return{
      errors: {},      
      form: {
        name: '',
        email: '',
        salary: '',
        salary_month: 0
      },
      already_paid: {}

    }
  },

  methods: {

    employeeData(){
       let id = this.$route.params.id
      axios.get('/api/employee/'+id)
      .then(({data}) => (this.form = data))
      .catch(console.log('error'))
    },

     paySalary(){
        let id = this.$route.params.id
        axios.post('/api/pay-salary/'+id, this.form)
  

           .then( res => { 
          this.already_paid = res.data
          if (this.already_paid == "Salary already paid!") {
            Notification.alreadyPaid()
            this.$router.push({name: 'all-employee-salary'})
          } else{
             Notification.paySalary()
             this.$router.push({name: 'all-employee-salary'})
          }
        })
        .catch(error => {
          Notification.error()
          this.error = error.response.data.errors
          })
        

     }
  }


}
</script>