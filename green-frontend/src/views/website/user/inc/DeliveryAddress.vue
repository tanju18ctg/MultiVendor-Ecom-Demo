<template>
  <div>
    <div class="col-lg-12">
      <div class="account-card">
        <div class="account-title">
          <h4>delivery address</h4>
          <button
            data-bs-toggle="modal"
            data-bs-target="#address-add"
            @click="getDivisions"
          >
            add address
          </button>
        </div>
        <div class="account-content">
          <div class="row">
            <div class="col-md-6 col-lg-4 alert fade show">
              <div class="profile-card address active">
                <!-- <h6>Home</h6> -->
                <p v-show="myAddress !== null">
                 
                  <span  v-if="myAddress.division">{{ myAddress.division.name }}</span>, <span v-if="myAddress.district">{{ myAddress.district.name }}</span>, {{ myAddress.address }}.
                </p>
                <ul class="user-action">
                  <!-- <li>
                    <button
                      class="edit icofont-edit"
                      title="Edit This"
                      data-bs-toggle="modal"
                      data-bs-target="#address-edit"
                    ></button>
                  </li> -->
                  <!-- <li>
                          <button
                            class="trash icofont-ui-delete"
                            title="Remove This"
                            data-bs-dismiss="alert"
                          ></button>
                        </li> -->
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="modal fade" id="address-add">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <button class="modal-close" data-bs-dismiss="modal">
            <i class="icofont-close"></i>
          </button>
          <form class="modal-form" @submit.prevent="storeDeliveryAddress">
            <div class="form-title"><h3>add new address</h3></div>
            <div class="form-group">
              <label class="form-label">Select Area</label
              ><select
                class="form-select"
                v-model="deliveryForm.division_id"
                @change="getDistrict"
              >
                <option selected value="">choose division</option>
                <option
                  :value="div.id"
                  v-for="(div, index) in divisions"
                  :key="index"
                >
                  {{ div.name }}-{{ div.bn_name }}
                </option>
              </select>
            </div>

            <div class="form-group" v-show="disticts.length > 0">
              <label class="form-label">Select Division</label
              ><select class="form-select" v-model="deliveryForm.district_id">
                <option selected value="">choose district</option>
                <option
                  :value="dist.id"
                  v-for="(dist, index) in disticts"
                  :key="index"
                >
                  {{ dist.name }}-{{ dist.bn_name }}
                </option>
              </select>
            </div>

            <div class="form-group">
              <label class="form-label">address</label
              ><textarea
                class="form-control"
                placeholder="Enter your address"
                v-model="deliveryForm.address"
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
import axiosInstance from "@/services/AxiosTokenInstance";
export default {
  data() {
    return {
      divisions: [],
      disticts: [],
      deliveryForm: {
        division_id: "",
        district_id: "",
        address: "",
      },

      myAddress:{}
    };
  },

  mounted() {
    this.getAddress();
  },

  methods: {
    getDivisions() {
      axiosInstance
        .get("/user/divisions")
        .then((res) => {
          if (res.data.status == true) {
            this.divisions = res.data.data;
          }
        })
        .catch(() => {});
    },

    getDistrict() {
      axiosInstance
        .get(`/user/district/${this.deliveryForm.division_id}`)
        .then((res) => {
          if (res.data.status == true) {
            this.disticts = res.data.data;
          }
        })
        .catch(() => {});
    },

    storeDeliveryAddress() {
      axiosInstance
        .post("/user/store-delivery", this.deliveryForm)
        .then((res) => {
          if (res.data.status == true) {
           this.getAddress();
          }
        })
        .catch(() => {});
    },

    getAddress() {
      axiosInstance
        .get("/user/my-address")
        .then((res) => {
          this.myAddress = res.data.data;
        })
        .catch(() => {});
    },
  },
};
</script>
<style></style>
