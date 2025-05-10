// import axios from "axios"
import axiosInstance from "../../services/AxiosTokenInstance";
export const slider = {
  namespaced: true,
  state: {
    sliders: [],
  },
  getters: {
    GET_SLIDERS(state) {
      return state.sliders;
    },
  },

  actions: {
    //user login
    FETCH_SLIDERS(context) {
      return new Promise((resolve, reject) => {
        axiosInstance
          .get("/home-slider")
          .then((res) => {
            context.commit("SET_SLIDERS", res.data);
            resolve(res);
          })
          .catch((err) => {
            reject(err);
          });
      });
    },
  },
  mutations: {
    SET_SLIDERS(state, sliders) {
      state.sliders = sliders;
    },
  },
};
