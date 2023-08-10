<template>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Add Category</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><router-link to="/home">Home</router-link></li>
              <li class="breadcrumb-item active">Add Category</li>
            </ol>
            <router-link class="btn btn-sm btn-primary float-right mr-3" to="/all-category">All Categories</router-link>
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
            <strong>Add Category</strong>
        </div>

        <div class="card-body card-block">
            <form @submit.prevent="categoryInsert" class="form-horizontal">
  
                <div class="row form-group">
                    <div class="col col-md-3">
                        <label class=" form-control-label">Category Name <span class="text-danger">*</span></label>
                    </div>
                    <div class="col-12 col-md-9">
                        <input type="text" v-model="form.category_name" placeholder="Category Name" class="form-control" required >
                       
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
        category_name: ''
      }
    }
  },

  methods: {
     categoryInsert(){
       axios.post('/api/category', this.form)
       .then(() =>{
         Notification.insert()
         this.$router.push({ name: 'all-category' })
       })
       .catch(error => {
         Notification.error()
         this.errors = error.response.data.errors
         })

    }
  }


}
</script>