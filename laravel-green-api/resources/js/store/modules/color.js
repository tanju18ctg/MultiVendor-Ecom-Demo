import axiosInstance from "../../services/AxiosTokenInstance";

export const color = {
    namespaced: true,
    state: {
        colors: [],
    },
    getters: {
        GET_DATA(state) {
            return state.colors;
        },
    },
    actions: {
        FETCH_DATA(context) {
            axiosInstance
                .get("/color")
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
                    `/color-pagination/?page=${payload.page}&limit=${payload.limit}&status=${payload.status}`
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
                    .post("/color", formData)
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
                    .get(`/color/${Id}`)
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
                    .put(`/color/${updateData.id}`, updateData.form)
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
                    .post("/color-destroy-multiple", catIds)
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
                    .delete(`/color/${id}`)
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
        SET_DATA(state, colors) {
            state.colors = colors;
        },
    },
};
