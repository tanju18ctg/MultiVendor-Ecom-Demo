<template>
  <div>
    <section
      class="inner-section single-banner"
      style="
        background: url(//website/images/single-banner.jpg) no-repeat center;
      "
    >
      <div class="container">
        <h2>Checkout</h2>
      </div>
    </section>
    <section class="inner-section checkout-part">
      <div class="container">
        <div class="row">
          <div class="col-lg-12" v-show="!user.name">
            <div class="alert-info">
              <p>
                Returning customer?
                <a
                  href="javascript::void(0)"
                  data-bs-toggle="modal"
                  data-bs-target="#login-modal"
                  >Click here to login</a
                >
              </p>
            </div>
          </div>

          <delivery-address></delivery-address>

          <div class="col-lg-12">
            <div class="account-card">
              <div class="account-title"><h4>Your order</h4></div>
              <div class="account-content">
                <div class="table-scroll">
                  <table class="table-list">
                    <thead>
                      <tr>
                        <th scope="col">Product</th>
                        <th scope="col">Name</th>
                        <th scope="col">Price</th>
                        <th scope="col">quantity</th>
                        <!-- <th scope="col">action</th> -->
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="cart in carts" :key="cart.id">
                        <td class="table-image">
                          <dynamic-img :path="cart.thumbnail" />
                        </td>
                        <td class="table-name">
                          <h6>{{ cart.name }}</h6>
                        </td>
                        <td class="table-price">
                          <h6>{{ $filters.currencyBDT(cart.price) }}</h6>
                        </td>
                        <td class="table-quantity">
                          <h6>{{ cart.quantity }}</h6>
                        </td>
                        <!-- <td class="table-action">
                          <a
                            class="trash"
                            href="javascript::void(0)"
                            title="Remove Wishlist"
                            @click.prevent="deleteCart(cart)"
                            ><i class="icofont-trash"></i
                          ></a>
                        </td> -->
                      </tr>
                    </tbody>
                  </table>
                </div>
                <div class="chekout-coupon">
                  <button class="coupon-btn" @click="couponBtn">
                    Do you have a coupon code?
                  </button>
                  <form class="coupon-form" @submit.prevent="applyCoupon">
                    <input
                      type="text"
                      v-model="couponForm.code"
                      placeholder="Enter your coupon code"
                    />
                    <i class="fas fa-check-circle" v-show="applied"></i>

                    <button type="submit">
                      <!-- <span v-if="applied">
                        <i class="fas fa-check-circle"></i>
                      </span> -->

                      <span
                        >{{ loading ? "applying" : "apply" }}
                        <i class="fas fa-spinner fa-spin" v-if="loading"></i
                      ></span>
                    </button>
                  </form>
                  <small v-if="errors.code" class="text-danger">{{
                    errors.code[0]
                  }}</small>
                </div>
                <div class="checkout-charge">
                  <ul>
                    <li>
                      <span>Sub total</span
                      ><span>{{ $filters.currencyBDT(totalPrice) }}.00</span>
                    </li>

                    <li>
                      <span>discount</span
                      ><span>{{ $filters.currencyBDT(discount) }}</span>
                    </li>

                    <li>
                      <span>delivery charge</span
                      ><span>{{ $filters.currencyBDT(deliveryChrg) }}</span>
                    </li>
                    <li>
                      <span>Total<small>(Incl. VAT)</small></span
                      ><span
                        >{{
                          $filters.currencyBDT(
                            totalPrice - discount + deliveryChrg
                          )
                        }}.00</span
                      >
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
          <div class="checkout-proced">
            <button
              class="btn btn-inline"
              :disabled="!userStatus"
              @click.prevent="placeOrder"
            >
              <i class="fas fa-spinner fa-spin" v-if="place_order_status"></i>
              <span v-else></span>
              Place Order
            </button>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>
<script>
import $ from "jquery";
import DynamicImg from "../../components/frontend/DynamicImg.vue";
import axiosInstance from "../../services/AxiosTokenInstance";
import DeliveryAddress from "./user/inc/DeliveryAddress.vue";
import { ElNotification } from "element-plus";
export default {
  components: { DynamicImg, DeliveryAddress },
  data() {
    return {
      couponForm: {
        code: "",
      },
      errors: {},
      discount: "0",
      applied: false,
      loading: false,
      deliveryChrg: "0",
      place_order_status: false,
    };
  },
  mounted() {
    document.title = "Checkout";
    this.deliveryCharge();
  },

  methods: {
    couponBtn() {
      $(this).hide(), $(".coupon-form").css("display", "flex");
    },

    deleteCart(product) {
      this.$store.dispatch("cart/DELETE_CART", product);
    },

    applyCoupon() {
      this.loading = true;
      this.applied = false;
      axiosInstance
        .post("/apply-coupon", {
          code: this.couponForm.code,
          subtotal: this.totalPrice,
        })
        .then((res) => {
          if (res.data.status == true) {
            this.errors = {};
            this.discount = res.data.data;
            this.applied = true;
            ElNotification.success({
              title: "Success",
              message: "Coupon Applied",
              offset: 100,
            });
          }
        })
        .catch((err) => {
          this.errors = err.response.data.errors;
          this.couponForm.code = "";
        })
        .finally(() => {
          this.loading = false;
        });
    },

    deliveryCharge() {
      axiosInstance
        .get("/user/delivery-charge")
        .then((res) => {
          if (res.data.status == true) {
            this.deliveryChrg = res.data.data.charge;
          }
        })
        .catch(() => {});
    },

    placeOrder() {
      this.place_order_status = true;
      axiosInstance
        .post("/user/place-order", {
          subtotal: this.totalPrice,
          discount: this.discount,
          total: this.totalPrice - this.discount + this.deliveryChrg,
          carts: this.carts,
        })
        .then((res) => {
          if (res.data.status == true) {
            this.$router.push({ name: "Orders" });
            this.$store.dispatch("cart/DESTROY_CART");
            ElNotification.success({
              title: "Success",
              message: "Order Place Success",
              offset: 100,
            });
          }
        })
        .catch(() => {})
        .finally(() => {
          this.place_order_status = false;
        });
    },
  },

  computed: {
    user() {
      return this.$store.getters["auth/GET_AUTH_INFO"];
    },

    userStatus() {
      return this.$store.getters["auth/GET_USERLOGGEDIN_STATUS"];
    },

    carts() {
      return this.$store.getters["cart/GET_CART_ITEMS"];
    },

    totalPrice() {
      return this.$store.getters["cart/GET_CART_TOTAL"];
    },
  },

  watch: {
    user() {
      console.log("change");
    },

    carts() {
      console.log("carts change");
    },
  },
};
</script>
<style></style>
