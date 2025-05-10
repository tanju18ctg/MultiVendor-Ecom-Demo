<template>
  <div>
    <div>
      <div class="modal fade" id="login-modal">
        <div class="modal-dialog">
          <div class="modal-content">
            <button
              class="modal-close icofont-close"
              id="closeModal"
              data-bs-dismiss="modal"
            ></button>
            <div class="product-view">
              <div class="row">
                <div class="col-12 col-md-12 col-lg-12">
                  <div class="user-form-card">
                    <div class="user-form-title">
                      <h2>You Need To Login Your Account</h2>
                      <p>Use your credentials to access</p>
                    </div>
                    <div class="user-form-group">
                      <form class="user-form" @submit.prevent="login">
                        <fieldset :disabled="btnLoading">
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
                            /><label class="form-check-label" for="check"
                              >Remember Me</label
                            >
                          </div>
                        </fieldset>
                        <div class="form-button">
                          <button
                            type="submit"
                            :class="`${btnLoading ? 'load' : ''}`"
                            :disabled="btnLoading"
                          >
                            {{ btnLoading ? "loading.." : "Login" }}
                            <i
                              class="fas fa-spinner fa-spin"
                              v-if="btnLoading"
                            ></i>
                          </button>
                          <p>
                            New User?<router-link :to="{ name: 'Register' }"
                              >register here</router-link
                            >
                          </p>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import { ElNotification } from "element-plus";
import $ from "jquery";
export default {
  name: "LoginModal",

  data() {
    return {
      form: {
        phone: "01722260010",
        password: "password",
      },
      errors: {},
      btnLoading: false,

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
      this.btnLoading = true;
      this.$store
        .dispatch("auth/LOGIN", this.form)
        .then(() => {
          $("#closeModal").click();

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
        })
        .finally(() => {
          this.btnLoading = false;
        });
    },

    toggleShow() {
      this.showPassword = !this.showPassword;
    },
  },
};
</script>
<style>
.load {
  opacity: 0.7;
}
</style>
