 <template>
  <div class="register-page">
       <div class="cotainer">
          <div class="row justify-content-center">
            <div class="col-md-10">
          <div class="login-box">
            <!-- /.login-logo -->
            <div class="card">
              <div class="card-body login-card-body">
                <p class="login-box-msg">Forget Password</p>

                <form @submit.prevent="forget">
                  <div class="input-group">
                    <input type="email" class="form-control" placeholder="Existing Email" v-model="form.email">
                    <div class="input-group-append">
                      <div class="input-group-text">
                        <span class="fas fa-envelope"></span>
                      </div>
                    </div>
                  </div>
                  <small style="color:red;" v-if="errors.email">{{errors.email[0]}}</small> <br>
                
                  <div class="row">
                    <div class="col-6">
                      <router-link to="/">Back to Login</router-link>
                    </div>
                    <div class="col-6">
                      <button type="submit" class="btn btn-primary float-right">Submit</button>
                    </div>
                    <!-- /.col -->
                  </div>
                </form>
                
              </div>
              <!-- /.login-card-body -->
            </div>
          </div>
          <!-- /.login-box -->
        </div>
      </div>
    </div>

  </div>

</template>

<script>
import axios from 'axios'

export default {
  created(){
    if (User.loggedIn()) {
      this.$router.push({name: 'home'})
      
    }

  },

  data(){
    return {
      errors: {},
      form: {
        email: null,
      }
    }
  },

  methods: {
    forget(){
      axios.post('/api/forgetuser', this.form)
       .then(
          
         res =>{

         if (res.data.email === this.form.email) {
            new Noty({
            type: 'success',
            text: 'Email matched!',
            layout: 'topRight',
            timeout: 3000
            }).show();

           this.$router.push({name: 'newpassword',params:{id:res.data.email}})
         }  

       })

        .catch(error => {
          new Noty({
            type: 'error',
            text: 'Email not found!',
            layout: 'topRight',
            timeout: 3000
            }).show()

           this.errors = error.response.data.errors
           })
    }
  }
}
</script>
