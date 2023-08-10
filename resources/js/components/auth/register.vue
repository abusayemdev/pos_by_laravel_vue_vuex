<template>
  <div class="register-page">
     <div class="cotainer">
        <div class="row justify-content-center">
          <div class="col-md-10">
            <div class="register-box">
              <div class="card">
                <div class="card-body register-card-body">
                  <p class="login-box-msg">Register a new account</p>

                  <form @submit.prevent="signup">
                    
                    <div class="input-group">
                      <input type="text" class="form-control" placeholder="Full name" v-model="form.name">
                       
                      <div class="input-group-append">
                        <div class="input-group-text">
                          <span class="fas fa-user"></span>
                        </div>
                      </div>
                    </div>
                    <small class="text-danger" v-if="errors.name">{{errors.name[0]}}</small> <br>
            
                    
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
                    <div class="input-group mb-3">
                      <input type="password" class="form-control" placeholder="Retype password" v-model="form.password_confirmation">
                      <div class="input-group-append">
                        <div class="input-group-text">
                          <span class="fas fa-lock"></span>
                        </div>
                      </div>
                    </div>
                    <div class="row justify-content-end">
                    
                      <div class="col-4">
                        <button type="submit" class="btn btn-primary btn-block">Register</button>
                      </div>
                      <!-- /.col -->
                    </div>
                  </form>
                  <router-link to="/">I already have an account.</router-link>
                </div>
                <!-- /.form-box -->
              </div><!-- /.card -->
            </div>
            <!-- /.register-box -->
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
        name: null,
        email: null,
        password: null,
        password_confirmation: null
      }
    }
  },

  methods: {
    signup(){
      axios.post('/api/auth/signup', this.form)
      .then( 
       res => {
        User.responseAfterLogin(res)

        new Noty({
          type: 'success',
          text: 'You are registered successfully!',
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
