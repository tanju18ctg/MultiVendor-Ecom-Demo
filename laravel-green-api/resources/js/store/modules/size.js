import axiosInstance from "../../services/AxiosTokenInstance";

export const size = {
    namespaced: true,
    state: {
        sizes: [],
    },
    getters: {
        GET_DATA(state) {
            return state.sizes;
        },
    },
    actions: {
        FETCH_DATA(context) {
            axiosInstance
                .get("/size")
                .then((res) => {
                    if (res.data.status) {
                        context.commit("SET_DATA", res.data);
                    }
                })
                .catch(() => {});
        },

        FETCH_DATA_PAGINATION({ commit }, payload) {
            axiosInstance
                .get(
                    `/size-pagination/?page=${payload.page}&limit=${payload.limit}&status=${payload.status}`
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
                    .post("/size", formData)
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
                    .get(`/size/${Id}`)
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
                    .put(`/size/${updateData.id}`, updateData.form)
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
                    .post("/size-destroy-multiple", catIds)
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
                    .delete(`/size/${id}`)
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
        SET_DATA(state, sizes) {
            state.sizes = sizes;
        },
    },
};
