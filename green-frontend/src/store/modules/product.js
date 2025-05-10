// import axios from "axios"
import Http from "../../services/AxiosTokenInstance";
export const product = {
  namespaced: true,
  state: {
    products: [],
    product:{}, // use for single product fetch
    sales: [],
    new: [],
    winter: [],
    popular: [],
    feature: [],
  },
  getters: {
    GET_PRODUCTS(state) {
      return state.products;
    },

    GET_SALE_PRODUCTS(state) {
      return state.sales;
    },

    GET_NEW_PRODUCTS(state) {
      return state.new;
    },

    GET_WINTER_PRODUCTS(state) {
      return state.winter;
    },

    GET_POPULAR_PRODUCTS(state) {
      return state.popular;
    },

    GET_FEATURE_PRODUCTS(state) {
      return state.feature;
    },

    GET_SINGLE_PRODUCT(state){
      return state.product;
    }
  },

  actions: {
    /// fetch all conditions products like,winter,popular,feature,new
    // FETCH_PRODUCTS(context, data) {
    //   return new Promise((resolve, reject) => {
    //   Http
    //     .get(`/product-condition/${data}`)
    //     .then((res) => {
    //       context.commit("SET_PRODUCTS", res.data);
    //       console.log(res.data);
    //       resolve(res);
    //     })
    //     .catch((err) => {
    //       reject(err);
    //       alert(err.response.data);
    //     });
    //   });
    // },

    FETCH_CONDITIONS_PRODUCTS(context, data) {
      // return new Promise((resolve, reject) => {
      Http
        .get(`/product-condition/${data}`)
        .then((res) => {
          context.commit("SET_CONDITIONS_PRODUCT", res.data);
          // resolve(res);
        })
        .catch(() => {
          // reject(err);
         
        });
      // });
    },

    FETCH_SALE_PRODUCTS(context) {
      // return new Promise((resolve, reject) => {
      Http
        .get("/sale-products")
        .then((res) => {
          context.commit("SET_SALE_PRODUCTS", res.data);
          // resolve(res);
        })
        .catch(() => {
          // reject(err);
        });
      // });
    },

    FETCH_SINGLE_PRODUCT(context,slug){
      return new Promise((resolve, reject) => {
            Http
              .get(`/product/${slug}`)
              .then((res) => {
                if (res.data.status == true) {
                  context.commit("SET_SINGLE_PRODUCT", res.data.data);
                }
                resolve(res);
              })
              .catch((err) => {
                reject(err);
              });
          });
    },

    

    // FETCH_NEW_PRODUCTS(context) {
    //   return new Promise((resolve, reject) => {
    //     Http
    //       .get("/new-products")
    //       .then((res) => {
    //         context.commit("SET_NEW_PRODUCTS", res.data);
    //         resolve(res);
    //       })
    //       .catch((err) => {
    //         reject(err);
    //       });
    //   });
    // },

    // FETCH_WINTER_PRODUCTS(context) {
    //   return new Promise((resolve, reject) => {
    //     Http
    //       .get("/winter-products")
    //       .then((res) => {
    //         context.commit("SET_WINTER_PRODUCTS", res.data);
    //         resolve(res);
    //       })
    //       .catch((err) => {
    //         reject(err);
    //       });
    //   });
    // },

    // FETCH_POPULAR_PRODUCTS(context) {
    //   return new Promise((resolve, reject) => {
    //     Http
    //       .get("/popular-products")
    //       .then((res) => {
    //         context.commit("SET_POPULAR_PRODUCTS", res.data);
    //         resolve(res);
    //       })
    //       .catch((err) => {
    //         reject(err);
    //       });
    //   });
    // },
  },
  mutations: {
    // SET_PRODUCTS(state, product) {
    //   state.products = product;
    // },

    SET_SALE_PRODUCTS(state, product) {
      state.sales = product;
    },

    SET_CONDITIONS_PRODUCT(state, product) {
      if (product.condition === "new") {
        state.new = product;
      } else if (product.condition === "popular") {
        state.popular = product;
      } else if (product.condition === "winter") {
        state.winter = product;
      } else {
        state.feature = product;
      }
    },


    SET_SINGLE_PRODUCT(state,product){
      state.product = product;
    }

    // SET_NEW_PRODUCTS(state, product) {
    //   state.new = product;
    // },

    // SET_WINTER_PRODUCTS(state, product) {
    //   state.winter = product;
    // },

    // SET_POPULAR_PRODUCTS(state, product) {
    //   state.popular = product;
    // },
  },
};
