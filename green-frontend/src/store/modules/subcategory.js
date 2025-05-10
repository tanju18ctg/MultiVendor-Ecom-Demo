// import axios from "axios"
import axiosInstance from "../../services/AxiosTokenInstance";
export const subcategory = {
  namespaced: true,
  state: {
    subcategories: [],
  },
  getters: {
    GET_SUB_CATEGORIES(state) {
      return state.subcategories;
    },
  },

  actions: {
    //fetch all sub categories
    FETCH_SUB_CATEGORIES(context) {
      return new Promise((resolve, reject) => {
        axiosInstance
          .get("/sub-categories")
          .then((res) => {
            context.commit("SET_SUB_CATEGORIES", res.data);
            resolve(res);
          })
          .catch((err) => {
            reject(err);
          });
      });
    },
  },
  mutations: {
    SET_SUB_CATEGORIES(state, subcategories) {
      state.subcategories = subcategories;
    },
  },
};
