import axiosInstance from "../../services/AxiosTokenInstance";

export const seller = {
    namespaced: true,
    state: {
        sellers: [],
    },
    getters: {
        GET_DATA(state) {
            return state.sellers;
        },
    },
    actions: {
        FETCH_DATA({ commit }, payload) {
            axiosInstance
                .get(
                    `/seller/?page=${payload.page}&limit=${payload.limit}&status=${payload.status}`
                )
                .then((res) => {
                    if (res.data.status) {
                        commit("SET_DATA", res.data.data);
                    }
                })
                .catch(() => {});
        },

        FETCH_DATA_NO_PAGINATE(context) {
            axiosInstance
                .get("/seller-all")
                .then((res) => {
                    if (res.data.status) {
                        context.commit("SET_DATA", res.data);
                    }
                })
                .catch(() => {});
        },

        STORE_DATA(context, formData) {
            return new Promise((resolve, reject) => {
                axiosInstance
                    .post("/seller", formData)
                    .then((res) => {
                        resolve(res);
                    })
                    .catch((err) => {
                        reject(err);
                    });
            });
        },

        EDIT_DATA(context, Id) {
            return new Promise((resolve, reject) => {
                axiosInstance
                    .get(`/seller/${Id}`)
                    .then((res) => {
                        resolve(res);
                    })
                    .catch((err) => {
                        reject(err);
                    });
            });
        },

        UPDATE_DATA({ commit }, updateData) {
            return new Promise((resolve, reject) => {
                axiosInstance
                    .put(`/seller/${updateData.id}`, updateData.form)
                    .then((res) => {
                        resolve(res);
                    })
                    .catch((err) => {
                        reject(err);
                    });
            });
        },

        MULTIPLE_DELETE(context, catIds) {
            return new Promise((resolve, reject) => {
                axiosInstance
                    .post("/seller-destroy-multiple", catIds)
                    .then((res) => {
                        resolve(res);
                    })
                    .catch((err) => {
                        reject(err);
                    });
            });
        },

        DELETE(context, id) {
            return new Promise((resolve, reject) => {
                axiosInstance
                    .delete(`/seller/${id}`)
                    .then((res) => {
                        resolve(res);
                    })
                    .catch((err) => {
                        reject(err);
                    });
            });
        },

        VERIFY_ACCOUNT(context, id) {
            return new Promise((resolve, reject) => {
                axiosInstance
                    .get(`/seller-verify/${id}`)
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
        SET_DATA(state, sellers) {
            state.sellers = sellers;
        },
    },
};
