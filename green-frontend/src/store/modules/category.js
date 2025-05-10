// import axios from "axios"
import axiosInstance from "../../services/AxiosTokenInstance";
export const category = {
  namespaced: true,
  state: {
    categories: [],
  },
  getters: {
    GET_CATEGORIES(state) {
      return state.categories;
    },
  },

  actions: {
  
    FETCH_CATEGORIES(context) {
      return new Promise((resolve, reject) => {
        axiosInstance
          .get("/categories")
          .then((res) => {
            context.commit("SET_CATEGORIES", res.data);
            resolve(res);
          })
          .catch((err) => {
            reject(err);
          });
      });
    },
  },
  mutations: {
    SET_CATEGORIES(state, categories) {
      state.categories = categories;
    },
  },
};
