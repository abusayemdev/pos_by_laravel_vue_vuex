<template>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Edit category</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><router-link to="/home">Home</router-link></li>
              <li class="breadcrumb-item active">Edit category</li>
            </ol>
            <router-link class="btn btn-sm btn-primary float-right mr-3" to="/all-category">All categorys</router-link>

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
            <strong>Edit Category</strong>
        </div>

        <div class="card-body card-block">
            <form @submit.prevent="categoryUpdate" class="form-horizontal">
  
                <div class="row form-group">
                    <div class="col col-md-3">
                        <label class=" form-control-label">Category Name <span class="text-danger">*</span></label>
                    </div>
                    <div class="col-12 col-md-9">
                        <input type="text" v-model="form.category_name" placeholder="Category Name" class="form-control" required>
                    </div>
                </div>

              
            
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary btn-md"> Update </button>

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
      let id = this.$route.params.id
      axios.get('/api/category/'+id)
      .then(({data}) => (this.form = data))
      .catch(console.log('error'))

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

     categoryUpdate(){
        let id = this.$route.params.id
        axios.patch('/api/category/'+id, this.form)
  
        .then(() => {
          Notification.update()
          this.$router.push({name: 'all-category'})
        })
        .catch(error => {
          Notification.error()
          this.error = error.response.data.errors
        })
        

     }
  }


}
</script>