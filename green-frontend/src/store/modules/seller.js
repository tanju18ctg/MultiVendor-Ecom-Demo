// import axios from "axios"
import Http from "../../services/AxiosTokenInstance";
export const seller = {
  namespaced: true,
  state: {
    sellers: [],
    single_seller: {},
    products: [],
  },
  getters: {
    GET_DATA(state) {
      return state.sellers;
    },

    GET_SELLER_DATA(state) {
      return state.single_seller;
    },

    GET_SELLER_PRODUCTS(state) {
      return state.products;
    },
  },

  actions: {
    FETCH_DATA({ commit }, payload) {
      return new Promise((resolve, reject) => {
        Http.get(`/sellers/?page=${payload.page}&limit=${payload.limit}`)
          .then((res) => {
            if (res.data.status == true) {
              commit("SET_DATA", res.data.data);
            }
            resolve(res);
          })
          .catch((err) => {
            reject(err);
          });
      });
    },

    

    FETCH_SINGLE_DATA({ commit }, payload) {
      return new Promise((resolve, reject) => {
        Http.get(
          `/sellers/${payload.slug}/?page=${payload.page}&limit=${payload.limit}&sort=${payload.sort}`
        )
          .then((res) => {
            // console.log(res.data.data);
            if (res.data.status) {
              commit("SET_SELLER_DATA", res.data.data.seller);
              commit("SET_SELLER_PRODUCTS", res.data.data.products);
            }
            resolve(res);
          })
          .catch((err) => {
            reject(err);
          });
      });
    },
  },
  mutations: {
    SET_DATA(state, sellers) {
      state.sellers = sellers;
    },

    SET_SELLER_DATA(state, data) {
      state.single_seller = data;
    },

    SET_SELLER_PRODUCTS(state, data) {
      state.products = data;
    },
  },
};
