// import axios from "axios"
import axiosInstance from "../../services/AxiosTokenInstance";
export const wishlist = {
  namespaced: true,
  state: {
    WISHLISTS: [],
  },
  getters: {
    GET_WISHLISTS(state) {
      return state.WISHLISTS;
    },
  },

  actions: {
    //add to wishlist
    ADD_WISHLISTS(context, data) {
      return new Promise((resolve, reject) => {
        axiosInstance
          .post("/user/wishlist", data)
          .then((res) => {
            resolve(res);
          })
          .catch((err) => {
            reject(err);
          });
      });
    },

    FETCH_WISHLISTS(context) {
      return new Promise((resolve, reject) => {
        axiosInstance
          .get("/user/wishlist")
          .then((res) => {
            context.commit("SET_WISHLISTS", res.data);
            resolve(res);
          })
          .catch((err) => {
            reject(err);
          });
      });
    },

    DELETE_WISHLIST(context, PiD) {
      return new Promise((resolve, reject) => {
        axiosInstance
          .delete(`/user/wishlist/${PiD}`)
          .then((res) => {
            if (res.data.status == true) {
              context.commit("REMOVE_WISHLIST", PiD);
            }

            // state.cartItems.splice(index, 1);
            resolve(res);
          })
          .catch((err) => {
            reject(err);
          });
      });
    },
  },
  mutations: {
    SET_WISHLISTS(state, data) {
      state.WISHLISTS = data;
    },

    REMOVE_WISHLIST(state, PiD) {
      // state.WISHLISTS = data;
      let index = state.WISHLISTS.data.findIndex((el) => el.id === PiD);
      state.WISHLISTS.data.splice(index, 1);
    },
  },
};
