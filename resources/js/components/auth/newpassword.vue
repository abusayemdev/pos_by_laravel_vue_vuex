 <template>
  <div class="register-page">
       <div class="cotainer">
          <div class="row justify-content-center">
            <div class="col-md-10">
          <div class="login-box">
            <!-- /.login-logo -->
            <div class="card">
              <div class="card-body login-card-body">
                <p class="login-box-msg">Reset Password</p>

                <form @submit.prevent="newpassword">
                  <div class="input-group">
                    <input type="password" class="form-control" placeholder="New Password" v-model="form.password">
                    <div class="input-group-append">
                      <div class="input-group-text">
                        <span class="fas fa-envelope"></span>
                      </div>
                    </div>
                  </div>
                  <small style="color:red;" v-if="errors.password">{{errors.password[0]}}</small> <br> 


                  <div class="input-group mb-3">
                    <input type="password" class="form-control" placeholder="Retype New Password" v-model="form.password_confirmation">
                    <div class="input-group-append">
                      <div class="input-group-text">
                        <span class="fas fa-envelope"></span>
                      </div>
                    </div>
                  </div>
                
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
        password: null,
        password_confirmation: null
      }
    }
  },

  methods: {
    newpassword(){
      axios.post('/api/newpassword', this.form)
      .then( 
       res => {
        new Noty({
            type: 'success',
            text: 'You got new password!',
            layout: 'topRight',
            timeout: 3000
            }).show()

        this.$router.push({name: 'resetsuccess', params:{id:this.form.password}})
         }
      )
      .catch(error => { 
        this.errors = error.response.data.errors
          new Noty({
            type: 'error',
            text: 'ERROR!',
            layout: 'topRight',
            timeout: 3000
            }).show()
            }
      )
    }
  }
}
</script>
