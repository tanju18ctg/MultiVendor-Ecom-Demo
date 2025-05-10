<template>
  <div>
    <section class="user-form-part">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-12 col-sm-10 col-md-12 col-lg-12 col-xl-12">
            <!-- <div class="user-form-logo">
              <a href="index.html"><img src="/website/images/logo.png" alt="logo" /></a>
            </div> -->
            <div class="user-form-card" v-if="!send">
              <div class="user-form-title">
                <h2>Seller Registration Form</h2>
                <p>Use your right information and start your business</p>
              </div>
              <div class="user-form-group" id="axiosForm">
                <form class="user-form" @submit.prevent="applySeller">
                  <div class="loader" v-if="loading"></div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <input
                          type="text"
                          class="form-control"
                          placeholder="your name"
                          v-model="form.name"
                        />
                        <span class="text-danger" v-if="errors.name">{{
                          errors.name[0]
                        }}</span>
                      </div>

                      <div class="form-group">
                        <input
                          type="text"
                          class="form-control"
                          placeholder="shop name"
                          v-model="form.shop_name"
                        />
                        <span class="text-danger" v-if="errors.shop_name">{{
                          errors.shop_name[0]
                        }}</span>
                      </div>

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
                        <textarea
                          class="form-control"
                          placeholder="shop address"
                          v-model="form.address"
                        ></textarea>
                        <span class="text-danger" v-if="errors.address">{{
                          errors.address[0]
                        }}</span>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group">
                        <input
                          type="email"
                          class="form-control"
                          placeholder="email address"
                          v-model="form.email"
                        />
                        <span class="text-danger" v-if="errors.email">{{
                          errors.email[0]
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

                      <div class="form-group">
                        <input
                          v-if="showPasswordConfirm"
                          type="text"
                          class="form-control"
                          placeholder="Retype Password"
                          v-model="form.password_confirmation"
                        />

                        <input
                          v-else
                          type="password"
                          class="form-control"
                          placeholder="Retype Password"
                          v-model="form.password_confirmation"
                        />
                        <span class="view-password" @click="toggleShowConfp">
                          <i
                            class="fas text-success"
                            :class="{
                              'fa-eye-slash': showPasswordConfirm,
                              'fa-eye': !showPasswordConfirm,
                            }"
                          ></i>
                        </span>
                      </div>

                      <div class="form-check mb-3">
                        <input
                          class="form-check-input"
                          type="checkbox"
                          value=""
                          id="check"
                        /><label class="form-check-label" for="check"
                          >agree with all <a href="">terms</a> &
                          <a href="">conditions</a></label
                        >
                      </div>

                      <div class="form-button">
                        <button type="submit">Submit</button>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </div>

            <template v-else>
              <div class="user-form-card">
                <div class="row justify-content-center">
                  <div class="col-md-4">
                    <div class="card">
                      <div class="card-body">
                        <h4 class="card-title text-green">
                          Thank you for your information
                          <i class="fas fa-check-circle"></i>
                        </h4>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </template>

            <div class="user-form-footer"></div>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>
<script>
export default {
  data() {
    return {
      form: {
        name: "",
        shop_name: "",
        address: "",
        phone: "",
        email: "",
        password: "",
        password_confirmation: "",
      },
      errors: {},
      loading: false,
      showPassword: false,
      showPasswordConfirm: false,
      send: false,
    };
  },

  methods: {
    applySeller() {
      this.loading = true;
      this.$store
        .dispatch("auth/STORE_SELLER_APPLY", this.form)
        .then((res) => {
          if (res.data.status == true) {
            this.send = true;
          }
        })
        .catch((err) => {
            this.errors = err.response.data.errors;
        }).finally(()=>{
           this.loading = false;
        })
    },

    toggleShow() {
      this.showPassword = !this.showPassword;
    },

    toggleShowConfp() {
      this.showPasswordConfirm = !this.showPasswordConfirm;
    },
  },
};
</script>
<style lang=""></style>
