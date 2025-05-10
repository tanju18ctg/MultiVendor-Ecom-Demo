import axiosInstance from "../../services/AxiosTokenInstance";

export const product = {
    namespaced: true,
    state: {
        products: [],
    },
    getters: {
        GET_DATA(state) {
            return state.products;
        },
    },
    actions: {
        FETCH_DATA({ commit }, payload) {
            axiosInstance
                .get(
                    `/product/?page=${payload.page}&limit=${payload.limit}&status=${payload.status}`
                )
                .then((res) => {
                    if (res.data.status) {
                        commit("SET_DATA", res.data.data);
                    }
                })
                .catch(() => {});
        },

        FETCH_SELLER_DATA({ commit }, payload) {
            axiosInstance
                .get(
                    `/seller-products/?page=${payload.page}&limit=${payload.limit}&status=${payload.status}`
                )
                .then((res) => {
                    if (res.data.status) {
                        commit("SET_DATA", res.data.data);
                    }
                })
                .catch(() => {});
        },

        STORE_DATA(context, formData) {
            return new Promise((resolve, reject) => {
                axiosInstance
                    .post("/product", formData)
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
                    .get(`/product/${Id}`)
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
                    .put(`/product/${updateData.id}`, updateData.form)
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
                    .post("/product-destroy-multiple", catIds)
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
                    .delete(`/product/${id}`)
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
        SET_DATA(state, products) {
            state.products = products;
        },
    },
};
