import { createApp } from "vue";
import App from "./App.vue";
import router from "./router";
import store from "./store";
let $ = (window.jQuery = require("jquery"));
window.$ = $;
import "../node_modules/slick-carousel/slick/slick.min";
require("slick-carousel");
require("bootstrap");

import ElementPlus from "element-plus";
import "element-plus/dist/index.css";

import Pagination from "v-pagination-3";

import ProductZoomer from "vue-product-zoomer";
import "./assets/css/app.css";

const app = createApp(App);
app.use(store);
app.use(router);
app.use(ElementPlus);
app.component("pagination", Pagination);
app.use(ProductZoomer);

app.mixin({
  computed: {
    getSkeletonLoading() {
      return this.$store.getters["loader/GET_LOADING"];
    },
    server_url() {
      return "http://127.0.0.1:8000/";
    },
  },
});

app.config.globalProperties.$filters = {
  currencyBDT(value) {
    return "৳" + value.toLocaleString();
  },

  makeImagePath(img) {
    return "http://127.0.0.1:8000" + img;
  },

  //thausand separate with comma
  // LocaleString(value){
  //   return value.toLocaleString();
  // }
};

// Vue.filter('uppercase', function (v){
//  return v.toUpperCase()
// });

app.mount("#app");
