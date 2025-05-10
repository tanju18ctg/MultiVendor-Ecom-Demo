import axiosInstance from "../../services/AxiosTokenInstance";

export const auth = {
    namespaced: true,
    state: {
        loading: false,
        userLoggedIn: false,
        auth_token: null,
        AUTH_USER: {},
        auth_info: {
            id: null,
            name: null,
            email: null,
            image: null,
            phone: null,
            address: null,
        },
        server_url: "http://127.0.0.1:8000",
    },
    getters: {
        Get_Loading(state) {
            return state.loading;
        },

        get_auth_token(state) {
            return state.auth_token;
        },

        GET_USERLOGGEDIN_STATUS(state) {
            return state.userLoggedIn;
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
                        context.commit(
                            "set_auth_token",
                            res.data.data.access_token
                        );
                        context.commit("set_auth_info", res.data.data.admin);
                        context.commit("SET_AUTH_USER", res.data.data.admin);
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
                        context.commit("remove_auth_token");
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
                        context.commit("set_auth_info", res.data.data.user);
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
    },
    mutations: {
        SET_LOADING(state, status) {
            state.loading = status;
        },

        set_auth_token(state, auth_token) {
            state.auth_token = auth_token;
            state.userLoggedIn = true;
        },

        set_auth_info(state, info) {
            state.auth_info.id = info.id;
            state.auth_info.name = info.name;
            state.auth_info.email = info.email;
            state.auth_info.phone = info.phone;
            state.auth_info.image = info.image;
        },

        remove_auth_token(state) {
            state.auth_token = null;
            state.userLoggedIn = false;
            state.auth_info = {
                id: null,
                name: null,
                email: null,
                image: null,
                phone: null,
                address: null,
            };
        },

        SET_AUTH_USER(state, admin) {
            state.AUTH_USER = admin;
        },
    },
};
