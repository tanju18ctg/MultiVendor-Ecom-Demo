<template>
  <div>
    <div class="backdrop"></div>
    <a class="backtop fas fa-arrow-up" href="#"></a>
    <div class="header-top">
      <div class="container">
        <div class="row">
          <div class="col-md-12 col-lg-5">
            <div class="header-top-welcome">
              <p>Welcome to Global Bazaar !</p>
            </div>
          </div>
          <div class="col-md-5 col-lg-3"></div>
          <div class="col-md-7 col-lg-4">
            <ul class="header-top-list">
              <li>
                <router-link :to="{ name: 'sellerApply' }"
                  >Become a Seller</router-link
                >
              </li>
              <li><a href="faq.html">need help</a></li>
              <li><a href="contact.html">contact us</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>

    <header class="header-part">
      <div class="container">
        <div class="header-content">
          <div class="header-media-group">
            <button class="header-user">
              <img src="/website/images/menu.png" alt="user" /></button
            ><router-link :to="{ name: 'Home' }" href="index.html"
              ><img src="/website/images/logo.png" alt="logo" /></router-link
            ><button class="header-src" @click.prevent="searchBtn">
              <i class="fas fa-search"></i>
            </button>
          </div>
          <router-link :to="{ name: 'Home' }" class="header-logo"
            ><img src="/website/images/logo.png" alt="logo"
          /></router-link>

          <form class="header-form">
            <input type="text" placeholder="Search anything..." /><button>
              <i class="fas fa-search"></i>
            </button>
          </form>
          <div class="header-widget-group hover-nav">
            <li class="nav-item dropdown">
              <a
                class="nav-link header-widget"
                href="#"
                data-bs-toggle="dropdown"
                v-if="user.name"
              >
                <img :src="userImage" alt="user" />
              </a>

              <a
                class="nav-link header-widget"
                href="#"
                data-bs-toggle="dropdown"
                v-else
              >
                <i class="fas fa-user"></i>
              </a>

              <ul class="dropdown-menu dropdown-menu-end" v-if="user.name">
                <li>
                  <router-link
                    :to="{ name: 'UserProfile' }"
                    class="dropdown-item"
                    href="#"
                  >
                    My Profile</router-link
                  >
                </li>

                <li>
                  <router-link
                    :to="{ name: 'Wishlist' }"
                    class="dropdown-item"
                    href="#"
                  >
                    My Wishlist</router-link
                  >
                </li>

                <li>
                  <router-link
                    :to="{ name: 'Orders' }"
                    class="dropdown-item"
                    href="#"
                  >
                    My Orders</router-link
                  >
                </li>

                <li>
                  <a
                    class="dropdown-item"
                    href="javascript::void(0)"
                    @click.prevent="userLogout"
                  >
                    {{ loading == true ? "loading.." : "Logout" }}
                    <i class="fas fa-spinner fa-spin" v-if="loading"></i>
                  </a>
                </li>

                <!-- <li>
                  <router-link
                    :to="{ name: 'Register' }"
                    class="dropdown-item"
                    href="#"
                  >
                    Logout</router-link
                  >
                </li> -->
              </ul>

              <ul class="dropdown-menu dropdown-menu-end" v-else>
                <li>
                  <router-link
                    :to="{ name: 'Login' }"
                    class="dropdown-item"
                    href="#"
                  >
                    Login</router-link
                  >
                </li>
                <li>
                  <router-link
                    :to="{ name: 'Register' }"
                    class="dropdown-item"
                    href="#"
                  >
                    Register</router-link
                  >
                </li>
              </ul>
            </li>
            <router-link
              :to="{ name: 'Wishlist' }"
              class="header-widget"
              title="Wishlist"
              ><i class="fas fa-bell"></i><sup>0</sup></router-link
            >

            <button class="header-widget header-cart" title="Cartlist">
              <i class="fas fa-shopping-basket"></i
              ><sup>{{ cartItemCount }}</sup>
              <span
                >total price<small
                  >{{ currency }} {{ totalPrice.toLocaleString() }}</small
                ></span
              >
            </button>
          </div>
        </div>
      </div>
    </header>

    <Navbar :categories="categories" />

    <Cart-sidebar
      :carts="carts"
      :currency="currency"
      :total-price="totalPrice"
      :cart-item-count="cartItemCount"
    />

    <Login-modal />

    <div class="mobile-menu">
      <router-link :to="{ name: 'Home' }" title="Home Page"
        ><i class="fas fa-home"></i><span>Home</span></router-link
      ><button class="cate-btn" title="Category List">
        <i class="fas fa-list"></i><span>category</span></button
      ><button class="cart-btn" title="Cartlist">
        <i class="fas fa-shopping-basket"></i><span>Cart</span
        ><sup>{{ cartItemCount }}</sup></button
      ><router-link :to="{ name: 'Wishlist' }" title="Wishlist"
        ><i class="fas fa-bell"></i><span>Notifications</span
        ><sup>0</sup></router-link
      >
      <router-link
        :to="{ name: 'UserProfile' }"
        v-if="user.name"
        title="My Account"
        ><i class="fas fa-user"></i><span>My Account</span></router-link
      >

      <router-link :to="{ name: 'Login' }" v-else title="My Account"
        ><i class="fas fa-user"></i><span>My Account</span></router-link
      >
    </div>
    <!-- <Product-modal></Product-modal> -->
    <router-view />
    <!-- <Newsletter-component></Newsletter-component> -->
    <Footer-component></Footer-component>
  </div>
</template>

<script>
import $ from "jquery";
// import HeaderComponent from "@/components/frontend/HeaderComponent.vue";
// import NewsletterComponent from "@/components/frontend/NewsletterComponent.vue";
import FooterComponent from "@/components/frontend/FooterComponent.vue";
import LoginModal from "./components/frontend/LoginModal.vue";
import Navbar from "./components/frontend/Navbar.vue";
import CartSidebar from "./components/frontend/CartSidebar.vue";
// import ProductModal from "@/components/frontend/ProductModal.vue";
import { ElNotification } from "element-plus";
// import localString from './filters/LocaleString';
export default {
  name: "Home",
  components: {
    // HeaderComponent,
    // NewsletterComponent,
    FooterComponent,
    LoginModal,
    Navbar,
    CartSidebar,
    // ProductModal,
  },

  data() {
    return {
      loading: false,
    };
  },

  created() {
    this.reviewJquery();
    this.$store.dispatch("category/FETCH_CATEGORIES");
  },

  methods: {
    userLogout() {
      this.loading = true;
      this.$store
        .dispatch("auth/USER_LOGOUT")
        .then((res) => {
          if (res.data.status) {
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

    categories() {
      return this.$store.getters["category/GET_CATEGORIES"];
    },

    reviewJquery() {
      "use strict";
      setTimeout(() => {
        $(window).on("scroll", function () {
          $(this).scrollTop() > 130
            ? $(".header-part").addClass("active")
            : $(".header-part").removeClass("active");
        }),
          $(window).on("scroll", function () {
            $(this).scrollTop() > 700
              ? $(".backtop").show()
              : $(".backtop").hide();
          }),
          // $(function () {
          //   $(".dropdown-link").click(function () {
          //     $(this).next().toggle(),
          //       $(this).toggleClass("active"),
          //       $(".dropdown-list:visible").length > 1 &&
          //         ($(".dropdown-list:visible").hide(),
          //         $(this).next().show(),
          //         $(".dropdown-link").removeClass("active"),
          //         $(this).addClass("active"));
          //   });
          // }),
          $(".nav-link").on("click", function () {
            $(".nav-list li a").removeClass("active"),
              $(this).addClass("active");
          }),
          $(".header-cate, .cate-btn").on("click", function () {
            $("body").css("overflow", "hidden"),
              $(".category-sidebar").addClass("active"),
              $(".category-close").on("click", function () {
                $("body").css("overflow", "inherit"),
                  $(".category-sidebar").removeClass("active"),
                  $(".backdrop").fadeOut();
              });
          }),
          $(".header-user").on("click", function () {
            $("body").css("overflow", "hidden"),
              $(".nav-sidebar").addClass("active"),
              $(".nav-close").on("click", function () {
                $("body").css("overflow", "inherit"),
                  $(".nav-sidebar").removeClass("active"),
                  $(".backdrop").fadeOut();
              });
          }),
          $(".header-cart, .cart-btn").on("click", function () {
            $("body").css("overflow", "hidden"),
              $(".cart-sidebar").addClass("active"),
              $(".cart-close").on("click", function () {
                $("body").css("overflow", "inherit"),
                  $(".cart-sidebar").removeClass("active"),
                  $(".backdrop").fadeOut();
              });
          }),
          $(
            ".header-user, .header-cart, .header-cate, .cart-btn, .cate-btn"
          ).on("click", function () {
            $(".backdrop").fadeIn(),
              $(".backdrop").on("click", function () {
                $(this).fadeOut(),
                  $("body").css("overflow", "inherit"),
                  $(".nav-sidebar").removeClass("active"),
                  $(".cart-sidebar").removeClass("active"),
                  $(".category-sidebar").removeClass("active");
              });
          }),
          $(".coupon-btn").on("click", function () {
            $(this).hide(), $(".coupon-form").css("display", "flex");
          }),
          $(".header-src").on("click", function () {
            $(".header-form").toggleClass("active"),
              $(this).children(".fa-search").toggleClass("fa-times");
          }),
          $(".wish").on("click", function () {
            $(this).toggleClass("active");
          }),
          // $(".product-add").on("click", function () {
          //   var e = $(this).next(".product-action");
          //   $(this).hide(), e.css("display", "flex");
          // }),
          $(".review-widget-btn").on("click", function () {
            $(this).next(".review-widget-list").toggle();
          }),
          $(".offer-select").on("click", function () {
            $(this).text("Copied!");
          }),
          $(".modal").on("shown.bs.modal", function () {
            $(".preview-slider, .thumb-slider").slick("setPosition", 0);
          }),
          $(".profile-card.schedule").on("click", function () {
            $(".profile-card.schedule").removeClass("active"),
              $(this).addClass("active");
          }),
          $(".profile-card.contact").on("click", function () {
            $(".profile-card.contact").removeClass("active"),
              $(this).addClass("active");
          }),
          $(".profile-card.address").on("click", function () {
            $(".profile-card.address").removeClass("active"),
              $(this).addClass("active");
          }),
          $(".payment-card.payment").on("click", function () {
            $(".payment-card.payment").removeClass("active"),
              $(this).addClass("active");
          });
      }, 200);
    },

    searchBtn() {
      $(".header-form").toggleClass("active"),
        $(this).children(".fa-search").toggleClass("fa-times");
    },
  },

  computed: {
    user() {
      return this.$store.getters["auth/GET_AUTH_INFO"];
    },

    userImage() {
      return this.$store.getters["auth/GET_AUTH_USER_IMAGE"];
    },

    carts() {
      return this.$store.getters["cart/GET_CART_ITEMS"];
    },

    cartItemCount() {
      return this.$store.getters["cart/GET_CART_ITEMCOUNT"];
    },

    totalPrice() {
      return this.$store.getters["cart/GET_CART_TOTAL"];
      // let price = 0;
      // this.$store.getters["cart/GET_CART_ITEMS"].map((el) => {
      //   price +=
      //     (el["offer_price"] ? el["offer_price"] : el["price"]) *
      //     el["quantity"];
      // });

      // return price;
    },
    currency() {
      return "৳";
    },
  },
};
</script>

<style>
.user-img {
  width: 20%;
  border-radius: 50%;
  margin-right: 10px;
  margin-top: -2px;
}

.cart-checkbox {
  margin-right: 10px;
  margin-top: 40px;
}

.hover-nav .nav-item .dropdown-menu {
  display: none;
}
.hover-nav .nav-item:hover .nav-link {
}
.hover-nav .nav-item:hover .dropdown-menu {
  display: block;
}
.hover-nav .nav-item .dropdown-menu {
  margin-top: 0;
}

.nav-item {
  list-style-type: none;
}
.dropdown-item.active,
.dropdown-item:active {
  background-color: #119744;
}

.nav-link.active {
  background: none !important;
}

.nav-link i {
  margin-right: 0px;
}

.nav-item {
  margin-right: -10px;
}
</style>
