<template>
  <section class="user-form-part">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-12 col-sm-10 col-md-12 col-lg-12 col-xl-10">
          <!-- <div class="user-form-logo">
            <a href="index.html"><img src="images/logo.png" alt="logo" /></a>
          </div> -->
          <div class="user-form-card">
            <div class="user-form-title">
              <h2>Customer Registration</h2>
              <p>Setup A New Account In A Minute</p>
            </div>
            <div class="user-form-group">
              <ul class="user-form-social">
                <li>
                  <a href="#" class="facebook"
                    ><i class="fab fa-facebook-f"></i>Join with facebook</a
                  >
                </li>
                <li>
                  <a href="#" class="twitter"
                    ><i class="fab fa-twitter"></i>Join with twitter</a
                  >
                </li>
                <li>
                  <a href="#" class="google"
                    ><i class="fab fa-google"></i>Join with google</a
                  >
                </li>
                <li>
                  <a href="#" class="instagram"
                    ><i class="fab fa-instagram"></i>Join with instagram</a
                  >
                </li>
              </ul>
              <div class="user-form-divider"><p>or</p></div>
                    <router-view></router-view>
            </div>
          </div>
          <div class="user-form-remind">
            <p>Already Have An Account?<router-link :to="{name: 'Login'}" >login here</router-link></p>
          </div>
          <div class="user-form-footer">
          
          </div>
        </div>
      </div>
    </div>
  </section>
</template>
<script>
export default {};
</script>
<style lang=""></style>
