// import axios from "axios"
import axiosInstance from "../../services/AxiosTokenInstance";
export const order = {
  namespaced: true,
  state: {
    orders: [],
    single_order: {},
  },
  getters: {
    GET_DATA(state) {
      return state.orders;
    },

    GET_SINGLE_DATA(state) {
      return state.single_order;
    },
  },

  actions: {
    FETCH_DATA(context) {
      return new Promise((resolve, reject) => {
        axiosInstance
          .get("/user/orders")
          .then((res) => {
            context.commit("SET_DATA", res.data);
            resolve(res);
          })
          .catch((err) => {
            reject(err);
          });
      });
    },

    FETCH_SINGLE_DATA(context, id) {
      return new Promise((resolve, reject) => {
        axiosInstance
          .get(`/user/order-view/?id=${id}`)
          .then((res) => {
            context.commit("SET_SINGLE_DATA", res.data);
            resolve(res);
          })
          .catch((err) => {
            reject(err);
          });
      });
    },
  },
  mutations: {
    SET_DATA(state, orders) {
      state.orders = orders;
    },

    SET_SINGLE_DATA(state, order) {
      state.single_order = order;
    },
  },
};
