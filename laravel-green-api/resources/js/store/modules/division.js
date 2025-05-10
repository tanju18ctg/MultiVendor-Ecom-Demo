import axiosInstance from "../../services/AxiosTokenInstance";

export const division = {
    namespaced: true,
    state: {
        divisions: [],
        districts: [],
    },
    getters: {
        GET_DATA(state) {
            return state.divisions;
        },

        GET_DISTRICT(state) {
            return state.districts;
        },
    },
    actions: {
        FETCH_DATA({ commit }, payload) {
            axiosInstance
                .get(`/division/?page=${payload.page}&limit=${payload.limit}`)
                .then((res) => {
                    if (res.data.status) {
                        commit("SET_DATA", res.data.data);
                    }
                })
                .catch(() => {});
        },

        FETCH_DATA_ID(context, id) {
            axiosInstance
                .get(`/district-list/${id}`)
                .then((res) => {
                    if (res.data.status) {
                        context.commit("SET_DISTRICT", res.data.data);
                    }
                })
                .catch(() => {});
        },

        STORE_DATA(context, formData) {
            return new Promise((resolve, reject) => {
                axiosInstance
                    .post("/division", formData)
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
                    .get(`/division/${Id}`)
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
                    .put(`/division/${updateData.id}`, updateData.form)
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
                    .post("/division-destroy-multiple", catIds)
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
                    .delete(`/division/${id}`)
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
        SET_DATA(state, divisions) {
            state.divisions = divisions;
        },

        SET_DISTRICT(state, districts) {
            state.districts = districts;
        },
    },
};
