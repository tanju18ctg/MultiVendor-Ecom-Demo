<template>
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
                <h2>Customer Login</h2>
                <p>Use your credentials to access</p>
              </div>
              <div class="user-form-group" id="axiosForm">
                <form class="user-form" @submit.prevent="login">
                  <div class="loader" v-if="loading"></div>
                  <div class="form-group">
                    <input
                      type="text"
                      class="form-control"
                      placeholder="phone no"
                      v-model="form.phone"
                    />
                    <span class="text-danger" v-if="errors.phone">{{
                      errors.phone[0]
                    }}</span>
                  </div>
                  <div class="form-group">
                    <input
                      v-if="showPassword"
                      type="text"
                      class="form-control"
                      placeholder="password"
                      v-model="form.password"
                    />

                    <input
                      v-else
                      type="password"
                      class="form-control"
                      placeholder="password"
                      v-model="form.password"
                    />
                    <span class="view-password" @click="toggleShow">
                      <i
                        class="fas text-success"
                        :class="{
                          'fa-eye-slash': showPassword,
                          'fa-eye': !showPassword,
                        }"
                      ></i>
                    </span>
                    <span class="text-danger" v-if="errors.password">{{
                      errors.password[0]
                    }}</span>
                  </div>

                  <div class="form-check mb-3">
                    <input
                      class="form-check-input"
                      type="checkbox"
                      value=""
                      id="check"
                    /><label class="form-check-label" for="check">Remember Me</label>
                  </div>
                  <div class="form-button">
                    <button type="submit">login</button>
                    <p>
                      Forgot your password?<router-link
                        :to="{ name: 'Forgot' }"
                        href="reset-password.html"
                        >reset here</router-link
                      >
                    </p>
                  </div>
                </form>
              </div>
            </div>
            <div class="user-form-remind">
              <p>
                Don't have any account?<router-link :to="{ name: 'Register' }"
                  >register here</router-link
                >
              </p>
            </div>
            <div class="user-form-footer"></div>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>
<script>
import { ElNotification } from "element-plus";

export default {
  name: "Login",

  data() {
    return {
      form: {
        phone: "01722260010",
        password: "password",
      },
      errors: {},
      loading: false,

      showPassword: false,
    };
  },

  computed: {
    buttonLabel() {
      return this.showPassword ? "Hide" : "Show";
    },
  },
  methods: {
    login() {
      this.loading = true;
      this.$store
        .dispatch("auth/LOGIN", this.form)
        .then((res) => {
          this.loading = false;
          console.log(res.data);
          this.$router.push({ name: "Home" });
          ElNotification({
            title: "Success",
            type: "success",
            message: "You are login success",
          });
        })
        .catch((err) => {
          this.loading = false;
          this.errors = err.response.data.errors;
          console.log(err.response.data.errors);
        });
    },

    toggleShow() {
      this.showPassword = !this.showPassword;
    },
  },

  mounted() {
    document.title = "Login";
  },
};
</script>
<style>
#axiosForm {
  position: relative;
}
.loader {
  position: absolute;
  top: 0px;
  right: 0px;
  width: 100%;
  height: 100%;
  background-color: #ffffff;
  background-image: url("/website/loader.gif");
  background-size: 280px;
  background-repeat: no-repeat;
  background-position: center;
  z-index: 10000000;
  opacity: 0.4;
  filter: alpha(opacity=40);
}

.view-password {
  float: right;
  margin-top: -35px;
  margin-right: 10px;
  cursor: pointer;
}
</style>
