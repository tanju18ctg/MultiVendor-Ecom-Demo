import { createStore } from "vuex";
import createPersistedState from "vuex-persistedstate";
import { loader } from "./modules/loader";
import { auth } from "./modules/auth";
import { slider } from "./modules/slider";
import { category } from "./modules/category";
import { subcategory } from "./modules/subcategory";
import { product } from "./modules/product";
import { cart } from "./modules/cart";
import { wishlist } from "./modules/wishlist";
import { shop } from "./modules/shop";
import { order } from "./modules/order";
import { seller } from "./modules/seller";

export default createStore({
  state: {},
  mutations: {},
  actions: {},
  modules: {
    loader,
    auth,
    slider,
    category,
    subcategory,
    product,
    cart,
    wishlist,
    shop,
    order,
    seller,
  },

  plugins: [
    createPersistedState({
      paths: ["auth", "cart"],
    }),
  ],
});
