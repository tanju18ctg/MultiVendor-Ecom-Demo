<template >
    <div>
       <section class="user-form-part">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-12 col-sm-10 col-md-12 col-lg-12 col-xl-6">
            <!-- <div class="user-form-logo">
              <a href="index.html"><img src="/website/images/logo.png" alt="logo" /></a>
            </div> -->
            <div class="user-form-card">
              <div class="user-form-title">
                <h2>Forgot Password</h2>
                <p>Type Your Email to Forgot Password</p>
              </div>
              <div class="user-form-group">
               
                <form class="user-form">
                  <div class="form-group">
                    <input
                      type="email"
                      class="form-control"
                      placeholder="Enter your email"
                    />
                  </div>
                 
                  <div class="form-button">
                    <button type="submit">Submit</button>
                  </div>
                </form>
              </div>
            </div>
            <div class="user-form-remind">
              <p>
                Don't have any account?<router-link :to="{name: 'Login'}" >login here</router-link>
              </p>
            </div>
            <div class="user-form-footer">
             
            </div>
          </div>
        </div>
      </div>
    </section>
    </div>
</template>
<script>
export default {

     mounted() {  
    document.title = "Forogot Password";  
  }, 
    
}
</script>
<style lang="">
    
</style>