// import axios from "axios"
import axiosInstance from "../../services/AxiosTokenInstance";
export const auth = {
  namespaced: true,
  state: {
    userLoggedIn: false,
    auth_token: null,
    auth_info: {
      name: null,
      email: null,
      image: null,
      phone: null,
      isVerified: null,
    },
    server_url: "http://127.0.0.1:8000",
    deliveryAddress: {},
  },
  getters: {
    GET_AUTH_TOKEN(state) {
      return state.auth_token;
    },

    GET_USERLOGGEDIN_STATUS(state) {
      return state.userLoggedIn;
    },

    GET_AUTH_INFO(state) {
      return state.auth_info;
    },

    GET_DELIVERY_ADDRESS(state){
      return state.deliveryAddress;
    },

    // GET_SERVER_URL(state) {
    //   return state.server_url;
    // },

    GET_AUTH_USER_IMAGE(state) {
      return state.server_url + "/" + state.auth_info.image;
    },
  },
  actions: {
    //user login
    LOGIN(context, credentials) {
      return new Promise((resolve, reject) => {
        axiosInstance
          .post("/user/login", credentials)
          .then((res) => {
            context.commit("SET_AUTH_TOKEN", res.data);
            context.commit("SET_AUTH_INFO", res.data.data.user);
            resolve(res);
          })
          .catch((err) => {
            reject(err);
          });
      });
    },

    REGISTER(context, credentials) {
      return new Promise((resolve, reject) => {
        axiosInstance
          .post("/user/register", credentials)
          .then((res) => {
            context.commit("SET_AUTH_TOKEN", res.data);
            context.commit("SET_AUTH_INFO", res.data.data.user);
            resolve(res);
          })
          .catch((err) => {
            reject(err);
          });
      });
    },

    USER_LOGOUT(context) {
      return new Promise((resolve, reject) => {
        axiosInstance
          .post("/user/logout")
          .then((res) => {
            if (res.data.status) {
              context.commit("REMOVE_AUTH_TOKEN");
            }
            resolve(res);
          })
          .catch((err) => {
            reject(err);
          });
      });
    },

    UPDATE_PROFILE_IMG(context, formData) {
      return new Promise((resolve, reject) => {
        axiosInstance
          .post("/user/update-profile-img", formData)
          .then((res) => {
            context.commit("SET_AUTH_INFO", res.data.data.user);
            resolve(res);
          })
          .catch((err) => {
            reject(err);
          });
      });
    },
    UPDATE_PROFILE(context, formData) {
      return new Promise((resolve, reject) => {
        axiosInstance
          .post("/user/update-profile", formData)
          .then((res) => {
            context.commit("SET_AUTH_INFO", res.data.data.user);
            resolve(res);
          })
          .catch((err) => {
            reject(err);
          });
      });
    },

    // //user forgot email send
    // forgot(context, credentials) {
    //     return new Promise((resolve, reject) => {
    //         axiosInstance.post("/user/forgot-password", credentials)
    //             .then((res) => {
    //                 resolve(res)
    //             }).catch((err) => {
    //                 reject(err)
    //             });
    //     });
    // },

    // // user password reset
    // reset_password(context, credentials) {
    //     return new Promise((resolve, reject) => {
    //         axiosInstance.post("/user/reset-password", credentials)
    //             .then((res) => {
    //                 resolve(res)
    //             }).catch((err) => {
    //                 reject(err)
    //             });
    //     });
    // },

    // changeProfilePic(context, credentials) {
    //     return new Promise((resolve, reject) => {
    //         axiosInstance.post("/user/profile-pic-update", credentials)
    //             .then((res) => {
    //                 context.commit('set_auth_info', res.data.data.user);
    //                 resolve(res)
    //             }).catch((err) => {
    //                 reject(err)
    //             });
    //     });
    // }

    STORE_SELLER_APPLY(context, sellerForm) {
      return new Promise((resolve, reject) => {
        axiosInstance
          .post("/seller", sellerForm)
          .then((res) => {
            resolve(res);
          })
          .catch((err) => {
            reject(err);
          });
      });
    },

    
  },
  mutations: {
    SET_AUTH_TOKEN(state, auth) {
      state.auth_token = auth.data.access_token;
      state.userLoggedIn = auth.status;
    },

    SET_AUTH_INFO(state, info) {
      state.auth_info.name = info.name;
      state.auth_info.email = info.email;
      state.auth_info.phone = info.phone;
      state.auth_info.image = info.image;
      state.auth_info.isVerified = info.isVerified;
    },

    REMOVE_AUTH_TOKEN(state) {
      state.auth_token = null;
      state.userLoggedIn = false;
      state.auth_info = {
        name: null,
        email: null,
        image: null,
        phone: null,
        isVerified: null,
      };
    },
  },
};
