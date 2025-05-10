<template>
  <div>
    <section class="inner-section profile-part">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="account-card" id="axiosForm">
              <div class="loader" v-if="loading"></div>
              <div class="account-title">
                <h4>Your Profile</h4>

                <button @click.prevent="userLogout">Logout</button>

                <button data-bs-toggle="modal" data-bs-target="#profile-edit">
                  edit profile
                </button>
              </div>
              <div class="account-content">
                <div class="row">
                  <div class="col-lg-2">
                    <div>
                      <a href="#" class="profile-image">
                        <img :src="userImage" class="user-image" alt="user" />
                        <span class="icon">
                          <form
                            enctype="multipart/form-data"
                            id="change_profile_form"
                          >
                            <label for="image">
                              <i class="edit icofont-edit"></i>
                            </label>
                            <input
                              type="file"
                              name="image"
                              id="image"
                              @change="change_profile_img"
                              style="display: none"
                            />
                          </form>
                        </span>
                      </a>
                    </div>
                  </div>
                  <div class="col-md-3 col-lg-2">
                    <div class="form-group">
                      <label class="form-label">name</label
                      ><input
                        class="form-control"
                        type="text"
                        :value="user.name"
                        disabled
                      />
                    </div>
                  </div>
                  <div class="col-md-6 col-lg-4">
                    <div class="form-group">
                      <label class="form-label">Email</label
                      ><input
                        v-if="user.email"
                        class="form-control"
                        type="text"
                        :value="user.email"
                        disabled
                      />
                      <p style="margin-top: 10px" v-else>no email add yet</p>
                    </div>
                  </div>

                  <div class="col-md-3 col-lg-2">
                    <div class="form-group">
                      <label class="form-label">phone</label
                      ><input
                        class="form-control"
                        type="text"
                        :value="user.phone"
                        disabled
                      />
                    </div>
                  </div>
                  <div class="col-lg-2">
                    <div class="profile-btn">
                      <a href="change-password.html">Change pass.</a> <br />
                      <a href="change-password.html">My Orders</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <delivery-address/>
         
        </div>
      </div>
    </section>

    <div class="modal fade" id="profile-edit">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <button class="modal-close" data-bs-dismiss="modal" id="closeModal">
            <i class="icofont-close"></i>
          </button>
          <form class="modal-form" id="profile_update_form">
            <div class="form-title"><h3>edit profile info</h3></div>

            <div class="form-group">
              <label class="form-label">name</label
              ><input
                class="form-control"
                name="name"
                type="text"
                :value="user.name"
              />
            </div>
            <div class="form-group">
              <label class="form-label">email</label
              ><input
                class="form-control"
                name="email"
                type="email"
                :value="user.email"
              />
            </div>

            <!-- <div class="form-group">
              <label class="form-label">phone</label
              ><input class="form-control" name="phone" type="text" :value="user.phone" />
            </div> -->

            <button
              v-if="btn_loading"
              class="form-btn cstm-form"
              type="submit"
              disabled
            >
              updating...
            </button>

            <button
              v-else
              class="form-btn"
              type="submit"
              @click.prevent="updateProfile"
            >
              update profile info
            </button>
          </form>
        </div>
      </div>
    </div>

    <div class="modal fade" id="contact-edit">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <button class="modal-close" data-bs-dismiss="modal">
            <i class="icofont-close"></i>
          </button>
          <form class="modal-form">
            <div class="form-title"><h3>edit contact info</h3></div>
            <div class="form-group">
              <label class="form-label">title</label
              ><select class="form-select">
                <option value="primary" selected>primary</option>
                <option value="secondary">secondary</option>
              </select>
            </div>
            <div class="form-group">
              <label class="form-label">number</label
              ><input class="form-control" type="text" value="+8801838288389" />
            </div>
            <button class="form-btn" type="submit">save contact info</button>
          </form>
        </div>
      </div>
    </div>
    <div class="modal fade" id="address-edit">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <button class="modal-close" data-bs-dismiss="modal">
            <i class="icofont-close"></i>
          </button>
          <form class="modal-form">
            <div class="form-title"><h3>edit address info</h3></div>
            <div class="form-group">
              <label class="form-label">title</label
              ><select class="form-select">
                <option value="home" selected>home</option>
                <option value="office">office</option>
                <option value="Bussiness">Bussiness</option>
                <option value="academy">academy</option>
                <option value="others">others</option>
              </select>
            </div>
            <div class="form-group">
              <label class="form-label">address</label
              ><textarea
                class="form-control"
                placeholder="jalkuri, fatullah, narayanganj-1420. word no-09, road no-17/A"
              ></textarea>
            </div>
            <button class="form-btn" type="submit">save address info</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
// import axios from "@/services/AxiosTokenInstance";
import { ElNotification } from "element-plus";
import $ from "jquery";
import DeliveryAddress from './inc/DeliveryAddress.vue';
export default {
  components: { DeliveryAddress },
  name: "Profile",

  data() {
    return {
      loading: false,
      btn_loading: false,
      form: {
        name: "",
        email: "",
        phone: "",
      },
    };
  },

  methods: {
    userLogout() {
      this.loading = true;
      this.$store
        .dispatch("auth/USER_LOGOUT")
        .then((res) => {
          if (res.data.status) {
            this.$router.push({ name: "Home" });
            ElNotification({
              title: "Success",
              type: "success",
              message: "You are Logged Out Success",
            });
          }
        })
        .catch(() => {})
        .finally(() => {
          this.loading = false;
        });
    },

    change_profile_img() {
      this.loading = true;
      let form_data = new FormData(
        document.getElementById("change_profile_form")
      );
      this.$store
        .dispatch("auth/UPDATE_PROFILE_IMG", form_data)
        .then(() => {})
        .catch(() => {})
        .finally(() => {
          this.loading = false;
        });
    },

    updateProfile() {
      this.btn_loading = true;

      let form_data = new FormData(
        document.getElementById("profile_update_form")
      );

      this.$store
        .dispatch("auth/UPDATE_PROFILE", form_data)
        .then(() => {
          $("#closeModal").click();
          ElNotification({
            title: "Success",
            type: "success",
            message: "Profile Update Successfully",
          });
        })
        .catch(() => {})
        .finally(() => {
          this.btn_loading = false;
        });
    },
  },

  computed: {
    user() {
      return this.$store.getters["auth/GET_AUTH_INFO"];
    },

    userImage() {
      return this.$store.getters["auth/GET_AUTH_USER_IMAGE"];
    },
  },

  mounted() {
    document.title = "Profile";
  },
};
</script>
<style>
.user-image {
  border-radius: 50%;
  width: 50%;
}

.user-modalImg {
  border-radius: 50%;
  width: 14%;
  margin-top: 5px;
}

.profile-image {
  position: relative;
}
span.icon {
  position: absolute;
  background: #ffffff;
  border-radius: 100%;
  width: 30px;
  height: 30px;
  line-height: 30px;
  vertical-align: middle;
  text-align: center;
  color: #ff3838;
  font-size: 14px;
  cursor: pointer;
  margin-right: 70px;
}

.cstm-form {
  opacity: 0.7;
}

@media (min-width: 1200px) {
 
}

@media (min-width: 992px) {
  span.icon {
    margin-right: 65px;
  }
}
@media (min-width: 768px) {
  span.icon {
    right: 0;
    margin-right: 90px;
  }
}

@media (min-width: 576px) {
  .aiz-file-box-wrap {
    width: 33.3333%;
  }
}
</style>
