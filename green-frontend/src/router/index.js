import { createRouter, createWebHistory } from "vue-router";
import store from "../store";

import Home from "../views/website/Home.vue";

import SingleProduct from "../views/website/product/SingleProduct.vue";
import Shop from "../views/website/shop/Shop.vue";
//authentiation routes will be go here
// import authLayout from "../views/website/auth/AuthLayout.vue";
import Register from "../views/website/auth/Register.vue";
import Login from "../views/website/auth/Login.vue";
import Forgot from "../views/website/auth/password/Forgot.vue";
//authentiation routes will be end here
import sellerApply from "../views/website/seller/Form.vue";
import Sellers from "../views/website/seller/SellerList.vue";
import sellerProducts from "../views/website/seller/SellerProducts.vue";

// Checkout
import Checkout from "@/views/website/Checkout.vue";

//user routes will be go here
import User from "@/views/website/user/UserLayout";
import UserProfile from "@/views/website/user/Profile";
import Wishlist from "../views/website/user/Wishlist.vue";
import Orders from "../views/website/user/Order.vue";

import viewOrder from "../views/website/user/viewOrder.vue";

// user routes will be end here

const routes = [
  {
    path: "/",
    name: "Home",
    component: Home,
  },

  {
    path: "/apply-for-seller",
    name: "sellerApply",
    component: sellerApply,
  },

  {
    path: "/product/:slug",
    name: "SingleProduct",
    component: SingleProduct,
  },

  {
    path: "/shop",
    name: "Shop",
    component: Shop,
  },

  {
    path: "/seller",
    name: "Sellers",
    component: Sellers,
  },

  {
    path: "/seller/:slug",
    name: "sellerProducts",
    component: sellerProducts,
  },

  {
    path: "/checkout",
    name: "Checkout",
    component: Checkout,
  },

  //authentication routes will be go here

  {
    path: "/my-wishist",
    name: "Wishlist",
    component: Wishlist,
    meta: {
      auth: true,
    },
  },

  {
    path: "/my-orders",
    name: "Orders",
    component: Orders,
    meta: {
      auth: true,
    },
  },

  {
    path: "/my-order/:id",
    name: "viewOrder",
    component: viewOrder,
    meta: {
      auth: true,
    },
  },

  {
    path: "/auth/login",
    name: "Login",
    component: Login,
    meta: {
      guest: true,
    },
  },

  {
    path: "/auth/register",
    name: "Register",
    component: Register,
    meta: {
      guest: true,
    },
  },

  {
    path: "/auth/forgot",
    name: "Forgot",
    component: Forgot,
    meta: {
      guest: true,
    },
  },

  {
    path: "/user",
    component: User,
    children: [
      {
        path: "profile",
        name: "UserProfile",
        component: UserProfile,
      },
    ],
    meta: {
      auth: true,
    },
  },

  //authentication routes will be end here
];

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes,
  linkActiveClass: "active",
});

//let's start protected routes
router.beforeEach((to, from, next) => {
  store.dispatch("loader/ADD_LOADING", true);

  if (to.matched.some((record) => record.meta.auth)) {
    if (!store.getters["auth/GET_USERLOGGEDIN_STATUS"]) {
      next({ name: "Login" });
    } else {
      next();
    }
  } else if (to.matched.some((record) => record.meta.guest)) {
    if (store.getters["auth/GET_USERLOGGEDIN_STATUS"]) {
      next({
        name: "Home",
      });
    } else {
      next();
    }
  } else {
    next();
  }
});
// end protected routes

export default router;
