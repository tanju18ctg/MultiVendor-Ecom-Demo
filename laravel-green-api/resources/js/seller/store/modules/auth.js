import axiosInstance from "../../services/AxiosTokenInstance";

export const auth = {
    namespaced: true,
    state: {
        loading: false,
        loggedIn: false,
        token: null,

        AUTH_USER: {},

        auth_info: {
            id: null,
            isVerified: false,
            name: null,
            email: null,
            image: null,
            phone: null,
            address: null,
            shop_name: null,
            slug: null,
            banner: null,
        },
        server_url: "http://127.0.0.1:8000",
    },
    getters: {
        Get_Loading(state) {
            return state.loading;
        },

        get_auth_token(state) {
            return state.token;
        },

        GET_USERLOGGEDIN_STATUS(state) {
            return state.loggedIn;
        },

        get_auth_info(state) {
            return state.auth_info;
        },

        GET_AUTH_USER(state) {
            return state.AUTH_USER;
        },
    },
    actions: {
        //admin login
        login(context, credentials) {
            //we use promise and pass the response in login.vue page
            return new Promise((resolve, reject) => {
                axiosInstance
                    .post("/login", credentials)
                    .then((res) => {
                        context.commit("set_auth", res.data.data.access_token);
                        context.commit("set_info_auth", res.data.data.seller);
                        console.log(res.data.data);
                        resolve(res);
                    })
                    .catch((err) => {
                        reject(err);
                    });
            });
        },

        //admin logout
        logout(context) {
            return new Promise((resolve, reject) => {
                axiosInstance
                    .post("/logout")
                    .then((res) => {
                        context.commit("remove_auth");
                        resolve(res);
                    })
                    .catch((err) => {
                        reject(err);
                    });
            });
        },

        //user forgot email send
        forgot(context, credentials) {
            //we use promise and pass the response in login.vue page
            return new Promise((resolve, reject) => {
                axiosInstance
                    .post("/admin/forgot-password", credentials)
                    .then((res) => {
                        resolve(res);
                    })
                    .catch((err) => {
                        reject(err);
                    });
            });
        },

        // user password reset
        reset_password(context, credentials) {
            //we use promise and pass the response in login.vue page
            return new Promise((resolve, reject) => {
                axiosInstance
                    .post("/admin/reset-password", credentials)
                    .then((res) => {
                        resolve(res);
                    })
                    .catch((err) => {
                        reject(err);
                    });
            });
        },

        changeProfilePic(context, credentials) {
            return new Promise((resolve, reject) => {
                axiosInstance
                    .post("/admin/profile-pic-update", credentials)
                    .then((res) => {
                        context.commit("set_info_auth", res.data.data.user);
                        resolve(res);
                    })
                    .catch((err) => {
                        reject(err);
                    });
            });
        },

        FETCH_AUTH_USER(context) {
            axiosInstance
                .get("/auth-user")
                .then((res) => {
                    context.commit("SET_AUTH_USER", res.data.data);
                })
                .catch(() => {});
        },

        UPDATE_SETTINGS(context, settingsData) {
            return new Promise((resolve, reject) => {
                axiosInstance
                    .post("/update-settings", settingsData)
                    .then((res) => {
                        context.commit("SET_AUTH_USER", res.data.data);
                        resolve(res);
                    })
                    .catch((err) => {
                        reject(err);
                    });
            });
        },

        CHANGE_IMAGE(context, form_data) {
            return new Promise((resolve, reject) => {
                axiosInstance
                    .post("/change-image", form_data)
                    .then((res) => {
                        // context.commit("SET_AUTH_USER", res.data.data);
                        resolve(res);
                    })
                    .catch((err) => {
                        reject(err);
                    });
            });
        },

        CHANGE_PASSWORD(context, passForm) {
            return new Promise((resolve, reject) => {
                axiosInstance
                    .post("/change-password", passForm)
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
        SET_LOADING(state, status) {
            state.loading = status;
        },

        set_auth(state, token) {
            state.token = token;
            state.loggedIn = true;
        },

        set_info_auth(state, info) {
            state.auth_info.id = info.id;
            state.auth_info.name = info.name;
            state.auth_info.shop_name = info.shop_name;
            state.auth_info.slug = info.slug;
            state.auth_info.banner = info.banner;
            state.auth_info.email = info.email;
            state.auth_info.phone = info.phone;
            state.auth_info.image = info.image;
            state.auth_info.address = info.address;
            state.auth_info.isVerified = info.isVerified == 1 ? true : false;
        },

        remove_auth(state) {
            state.token = null;
            state.loggedIn = false;
            state.auth_info = {
                id: null,
                isVerified: false,
                name: null,
                email: null,
                image: null,
                phone: null,
                address: null,
                shop_name: null,
                slug: null,
                banner: null,
                address: null,
            };
        },

        SET_AUTH_USER(state, seller) {
            state.AUTH_USER = seller;
        },
    },
};
