<template>
  <div>
    
  </div>

</template>

<script>

export default {
  created(){
    User.logout();
    new Noty({
          type: 'success',
          text: 'You are logged out!',
          layout: 'topRight',
          timeout: 3000
          }).show()

    this.$router.push({name: '/'})
  }

}

</script>