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
                <h2>Customer Registration</h2>
                <p>Use your information to create a account</p>
              </div>
              <div class="user-form-group" id="axiosForm">
                <div class="loader" v-if="loading"></div>

                <form
                  class="user-form"
                  @submit.prevent="sendOtp"
                  v-if="!send_otp"
                >
                  <div class="form-group">
                    <input
                      type="text"
                      class="form-control"
                      placeholder="phone no."
                      v-model="phone"
                    />
                    <span class="text-danger" v-if="errors.phone">{{
                      errors.phone[0]
                    }}</span>
                  </div>

                  <div class="form-button">
                    <button type="submit">Submit</button>
                  </div>
                </form>

                <form
                  class="user-form"
                  @submit.prevent="Register"
                  v-else-if="otp_verify"
                >
                  <div class="form-group">
                    <input
                      type="text"
                      class="form-control"
                      placeholder="Enter your name"
                      v-model="form.name"
                    />
                    <span class="text-danger" v-if="errors.name">{{
                      errors.name[0]
                    }}</span>
                  </div>

                  <div class="form-group">
                    <input
                      type="password"
                      class="form-control"
                      placeholder="Enter your password"
                       v-model="form.password"/>
                     <span class="text-danger" v-if="errors.password">{{
                      errors.password[0]
                    }}</span>
                  </div>
                  <div class="form-group">
                    <input
                      type="password"
                      class="form-control"
                      placeholder="Enter repeat password"
                      v-model="form.password_confirmation"
                    />
                  </div>
                  <div class="form-check mb-3">
                    <input
                      class="form-check-input"
                      type="checkbox"
                      value=""
                      v-model="form.terms"
                      id="check"/>
                      <label class="form-check-label" for="check"
                      >Accept all the <a href="#">Terms & Conditions</a></label>
                    <br>
                      <small class="text-danger" v-if="errors.terms">{{
                      errors.terms[0]
                    }}</small>
                  </div>
                  <div class="form-button">
                    <button type="submit">register</button>
                  </div>
                </form>

                <form class="user-form" @submit.prevent="verifyOtp" v-else>
                  <div class="form-group">
                    <input
                      type="text"
                      class="form-control"
                      placeholder="Otp Code."
                      v-model="otp_code"
                    />
                  
                    <span class="text-danger" v-if="errors.otp_code">{{
                      errors.otp_code[0]
                    }}</span>
                  </div>

                  <a
                    href="#"
                    v-if="timeLeft === '00:00'"
                    class="text-success"
                    style="float: right; padding: 2px 0"
                    @click.prevent="sendOtp"
                    >Resend Otp</a
                  >
                  
                  <a
                    href="javascript::void(0)"
                    v-else
                    class="text-success"
                    style="float: right; margin-top: -10px"
                    >{{ timeLeft }}</a
                  >

                  <div class="form-button">
                    <button type="submit">Verify</button>
                  </div>
                </form>
              </div>
            </div>
            <div class="user-form-remind">
              <p>
                Don't have any account?<router-link :to="{ name: 'Login' }"
                  >login here</router-link
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
import axios from "@/services/AxiosTokenInstance";
import { ElNotification } from "element-plus";

var intervalTimer;
function zeroPadded(num) {
  // 4 --> 04
  return num < 10 ? `0${num}` : num;
}
export default {
  name: "Register",
  data() {
    return {
      loading: false,
      phone: "",
      otp_code: "",

      send_otp: false,
      otp_verify: false,

      form: {
        name: "",
        password: "",
        password_confirmation: "",
        terms:'',
      },
      errors: {},

      selectedTime: 0,
      timeLeft: "00:00",
    };
  },



  methods: {
    sendOtp() {
      this.loading = true;
      axios
        .post("/user/phone-verify", { phone: this.phone })
        .then((res) => {
          if (res.data.status === "pending") {
            this.send_otp = true;
            this.setTime(120);
            ElNotification({
              title: 'Success',
              type: "success",
              message: 'We Are Send Otp Code in Your Phone',
              });
          }
          this.loading = false;
        })
        .catch((err) => {
          this.loading = false;
          this.errors = err.response.data.errors;
        });
    },

    //  start otp send times
    setTime(seconds) {
      clearInterval(intervalTimer);
      this.timer(seconds);
    },
    timer(seconds) {
      const now = Date.now();
      const end = now + seconds * 1000;
      this.displayTimeLeft(seconds);
      this.selectedTime = seconds;
      this.countdown(end);
    },
    countdown(end) {
      // this.initialTime = this.selectedTime;
      intervalTimer = setInterval(() => {
        const secondsLeft = Math.round((end - Date.now()) / 1000);

        if (secondsLeft < 0) {
          clearInterval(intervalTimer);
          return;
        }
        this.displayTimeLeft(secondsLeft);
      }, 1000);
    },
    displayTimeLeft(secondsLeft) {
      const minutes = Math.floor((secondsLeft % 3600) / 60);
      const seconds = secondsLeft % 60;
      this.timeLeft = `${zeroPadded(minutes)}:${zeroPadded(seconds)}`;
    },

    //  end otp send times

    verifyOtp() {
      this.loading = true;
      axios
        .post("/user/phone-verify-code", {
          phone: this.phone,
          otp_code: this.otp_code,
        })
        .then((res) => {
          if (res.data.status === "approved") {
            this.otp_verify = true;
          }
          this.loading = false;
        })
        .catch((err) => {
          this.loading = false;
          this.errors = err.response.data.errors;
        });
    },

    Register() {
      this.loading = true;
      this.$store
        .dispatch("auth/REGISTER", {name: this.form.name, phone:this.phone, password:this.form.password, password_confirmation: this.form.password_confirmation, terms: this.form.terms})
        .then(() => {
         
          ElNotification({
              title: 'Success',
              type: "success",
              message: 'Registration Success',
              });

         this.$router.push({name: 'Home'});
        this.loading = false;
        })
        .catch((err) => {
          this.loading = false;
          this.errors = err.response.data.errors;
        });
    },
  },

  mounted() {
    document.title = "Register";
  },
};
</script>
<style lang=""></style>
