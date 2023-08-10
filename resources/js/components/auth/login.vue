 <template>
  <div class="login-page">
       <div class="cotainer">
          <div class="row justify-content-center">
            <div class="col-md-10">
          <div class="login-box">
            <!-- /.login-logo -->
            <div class="card">
              <div class="card-body login-card-body">
                <p class="login-box-msg">Log in to start your session</p>

                <form @submit.prevent="login">
                  <div class="input-group">
                    <input type="email" class="form-control" placeholder="Email" v-model="form.email">
                    <div class="input-group-append">
                      <div class="input-group-text">
                        <span class="fas fa-envelope"></span>
                      </div>
                    </div>
                    
                  </div>
                  <small class="text-danger" v-if="errors.email">{{errors.email[0]}}</small> <br>
                  <div class="input-group">
                    <input type="password" class="form-control" placeholder="Password" v-model="form.password">
                    <div class="input-group-append">
                      <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                      </div>
                    </div>
                  </div>
                  <small class="text-danger" v-if="errors.password">{{errors.password[0]}}</small> <br> 
                  <div class="row">
                    <div class="col-8">
                   
                    </div>
                    <!-- /.col -->
                    <div class="col-4">
                      <button type="submit" class="btn btn-primary btn-block">Log In</button>
                    </div>
                    <!-- /.col -->
                  </div>
                </form>



                <p class="mb-1">
                  <router-link to="/forget">I forgot my password.</router-link>
                <p class="mb-0">
                   <router-link to="/register">Register a new account?</router-link>
                </p>
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
        password: null
      }
    }
  },

  methods: {
    login(){
      axios.post('/api/auth/login', this.form)
      .then( 
       res => {
        User.responseAfterLogin(res)
        new Noty({
            type: 'success',
            text: 'You are logged in successfully!',
            layout: 'topRight',
            timeout: 3000
            }).show()

        this.$router.push({name: 'home'})
         }
      )
      .catch(error => {
         this.errors = error.response.data.errors

         new Noty({
            type: 'error',
            text: 'Invalid Email or Password!',
            layout: 'topRight',
            timeout: 3000
            }).show()
         
      })
     
    }
  }
}
</script>
