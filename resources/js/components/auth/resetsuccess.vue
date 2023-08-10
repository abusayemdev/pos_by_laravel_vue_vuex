
<template>
<div class="register-page">
       <div class="cotainer">
          <div class="row justify-content-center">
            <div class="col-md-10">
          <div class="login-box">
            <!-- /.login-logo -->
            <div class="card">
              <div class="card-body login-card-body">
                 <h5 >Password Reset Successfull!</h5>
                 <router-link to="/">Back to Login</router-link>
                
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

export default {
  created(){
    if (User.loggedIn()) {
      this.$router.push({name: 'home'})
      
    }
  }
}

</script>