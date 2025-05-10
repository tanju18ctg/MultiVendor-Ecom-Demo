// import axios from "axios"
import axiosInstance from "../../services/AxiosTokenInstance";
export const shop = {
  namespaced: true,
  state: {
    products: [],
    sidebardata: {},
    categories: [],
    brands: [],
  },
  getters: {
    GET_PRODUCTS(state) {
      return state.products;
    },

    GET_SIDEBAR_DATA(state) {
      return state.sidebardata;
    },

    GET_CATEGORIES(state) {
      return state.categories;
    },

    GET_BRANDS(state) {
      return state.brands;
    },
  },

  actions: {
    //user products
    FETCH_PRODUCTS(context) {
      return new Promise((resolve, reject) => {
        axiosInstance
          .get("/products")
          .then((res) => {
            context.commit("SET_PRODUCTS", res.data);
            console.log(res.data);
            resolve(res);
          })
          .catch((err) => {
            reject(err);
          });
      });
    },

    //shop page sidebar data fetch
    FETCH_SIDEBAR_DATA(context) {
      axiosInstance
        .get("/shop-sidebar-data")
        .then((res) => {
            if (res.data.status) {
            context.commit("SET_SIDEBAR_DATA", res.data);
          }
        })
        .catch(() => {});
    },

    SHOP_FILTER(context,payload){
      return new Promise((resolve, reject) => {
        axiosInstance
          .post("/shop-filter",payload)
          .then((res) => {
            console.log(res.data);
            context.commit("SET_PRODUCTS", res.data);
            resolve(res);
          })
          .catch((err) => {
            reject(err);
          });
      });
    },
    //fetch categories

    FETCH_CATEGORIES(context) {
      return new Promise((resolve, reject) => {
        axiosInstance
          .get("/categories-all")
          .then((res) => {
            context.commit("SET_CATEGORIES", res.data);
            resolve(res);
          })
          .catch((err) => {
            reject(err);
          });
      });
    },

    //fetch brands
    FETCH_BRANDS(context) {
      return new Promise((resolve, reject) => {
        axiosInstance
          .get("/brands-all")
          .then((res) => {
            context.commit("SET_BRANDS", res.data);
            resolve(res);
          })
          .catch((err) => {
            reject(err);
          });
      });
    },
  },
  mutations: {
    SET_PRODUCTS(state, products) {
      state.products = products;
    },

    SET_SIDEBAR_DATA(state, data) {
      state.sidebardata = data;
    },

    SET_CATEGORIES(state, categories) {
      state.categories = categories;
    },

    SET_BRANDS(state, brands) {
      state.brands = brands;
    },
  },
};
