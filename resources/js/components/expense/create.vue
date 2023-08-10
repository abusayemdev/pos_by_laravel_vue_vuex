<template>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Add Expense</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><router-link to="/home">Home</router-link></li>
              <li class="breadcrumb-item active">Add Expense</li>
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
        <!--card-->
    <div class="card">

        <div class="card-header">
            <strong>Add Expense</strong>
        </div>

        <div class="card-body card-block">
            <form @submit.prevent="expenseInsert" class="form-horizontal">
  
                <div class="form-group row">
                    <div class="col col-md-3">
                        <label class=" form-control-label">Expense Details <span class="text-danger">*</span></label>
                    </div>
                    <div class="col-12 col-md-9">
                        <textarea row="8" v-model="form.expense_details" class="form-control" placeholder="Expense Details" ></textarea>
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col col-md-3">
                        <label class=" form-control-label">Expense Amount <span class="text-danger">*</span></label>
                    </div>
                    <div class="col-12 col-md-9">
                        <input type="text" v-model="form.expense_amount" placeholder="Expense Amount" class="form-control" required >
                       
                    </div>
                </div>




                <div class="card-footer">
                    <button type="submit" class="btn btn-primary btn-md"> Submit </button>

                </div>
            
            </form>
        </div>
        
    </div><!--/card-->
      
      </div>
    </section>
  </div>
</template>

<script>
export default {
  created(){
    if (!User.loggedIn()) {
      this.$router.push({name: '/'})
    }
  },

  data(){
    return{
      errors: {},      
      form: {
        expense_details: '',
        expense_amount: ''
      }
    }
  },

  methods: {
     expenseInsert(){
       axios.post('/api/expense', this.form)
       .then(() =>{
         Notification.insert()
         this.$router.push({ name: 'all-expense' })
       })
       .catch(error => {
         Notification.error()
         this.errors = error.response.data.errors
         })

    }
  }


}
</script>