<template>
  <div>
    <aside class="cart-sidebar">
      <div class="cart-header">
        <div class="cart-total" v-if="!totalPrice == 0">
          <i class="fas fa-shopping-basket"></i
          ><span>total item ({{ cartItemCount }})</span>
        </div>

        <div class="cart-total" v-else>
          <i class="fas fa-shopping-basket"></i><span>Empty Cart</span>
        </div>

        <button class="cart-close"><i class="icofont-close"></i></button>
      </div>
      <ul class="cart-list" v-if="!totalPrice == 0">
        <li
          class="cart-item"
          style="padding-left: 10px"
          v-for="cart in carts"
          :key="cart.id"
        >
          <!-- <input type="checkbox" class="cart-checkbox" /> -->
          <div class="cart-media">
            <a href="#" v-if="cart.thumbnail">
              <!-- <dynamic-img :path="cart.thumbnail"/> -->
              <img :src="`${url + cart.thumbnail}`" alt="product" />
            </a>
            <button class="cart-delete" @click.prevent="deleteCart(cart)">
              <i class="far fa-trash-alt"></i>
            </button>
          </div>
          <div class="cart-info-group">
            <div class="cart-info">
              <h6>
                <a href="product-single.html">{{ cart.name }}</a>
              </h6>

              <span style="float: right; margin-top: -30px">{{
                cart.size
              }}</span>

              <span style="float: right">{{ cart.color }}</span>
              <p>
                Unit Price - {{ currency }}{{ cart.price.toLocaleString() }}
              </p>
            </div>
            <div class="cart-action-group">
              <div class="product-action">
                <button
                  class=""
                  title="Quantity Minus"
                  @click.prevent="decrementCart(cart)"
                >
                  <i class="icofont-minus"></i></button
                ><input
                  title="Quantity Number"
                  type="text"
                  disabled
                  :value="cart.quantity"
                /><button
                  class=""
                  title="Quantity Plus"
                  @click.prevent="incrementCart(cart)"
                >
                  <i class="icofont-plus"></i>
                </button>
              </div>
              <h6>
                {{ currency
                }}{{ (cart.price * cart.quantity).toLocaleString() }}
              </h6>
            </div>
          </div>
        </li>
      </ul>

      <ul class="cart-list" v-else>
        <li class="cart-item" style="margin-top: 100px">
          <img src="/website/images/cart/cart.png" alt="" style="width: 50%" />
        </li>
        <h3 style="text-align: center">Your Cart is Empty</h3>
      </ul>

      <div class="cart-footer" v-if="!totalPrice == 0">
        <!-- <button class="coupon-btn">Do you have a coupon code?</button>
        <form class="coupon-form">
          <input type="text" placeholder="Enter your coupon code" /><button
            type="submit"
          >
            <span>apply</span>
          </button>
        </form> -->
        <router-link :to="{name: 'Checkout'}" class="cart-checkout-btn" href="checkout.html"
          ><span class="checkout-label">Proceed to Checkout</span
          ><span class="checkout-price"
            >{{ currency }}{{ totalPrice.toLocaleString() }}</span
          ></router-link
        >
      </div>
    </aside>
  </div>
</template>
<script>
// import DynamicImg from "../frontend/DynamicImg.vue";
export default {
  // components:{DynamicImg},
  props: ["carts", "totalPrice", "currency", "cartItemCount"],

  methods: {
    incrementCart(product) {
      this.$store.dispatch("cart/ADD_OR_INCREMENT_CART", product);
    },

    decrementCart(product) {
      this.$store.dispatch("cart/DECREMENT_CART", product);
    },

    deleteCart(product) {
      this.$store.dispatch("cart/DELETE_CART", product);
    },
  },

  computed: {
    url() {
      return "http://127.0.0.1:8000";
    },
  },
};
</script>
<style></style>
