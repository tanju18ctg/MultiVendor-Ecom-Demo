import axiosInstance from "../../services/AxiosTokenInstance";

export const brand = {
    namespaced: true,
    state: {
        brands: [],
    },
    getters: {
        GET_DATA(state) {
            return state.brands;
        },
    },
    actions: {

        FETCH_DATA({commit}, payload) {
            axiosInstance
                .get(`/brand/?page=${payload.page}&limit=${payload.limit}&status=${payload.status}`)
                .then((res) => {
                    if (res.data.status) {
                        commit("SET_DATA", res.data.data);
                    }
                })
                .catch(() => {});
        },

        FETCH_DATA_NO_PAGINATE(context) {
            axiosInstance
                .get("/brand-all")
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
                .post("/brand", formData)
                .then((res) => {
                    resolve(res)
                })
                .catch((err) => {
                    reject(err)
                });

            });
        },

        EDIT_DATA(context,Id){
            return new Promise((resolve, reject) => {
                axiosInstance
                    .get(`/brand/${Id}`)
                    .then((res) => {
                        resolve(res)
                    })
                    .catch((err) => {
                        reject(err)
                    });

                });
        },

        UPDATE_DATA({commit}, updateData){
            return new Promise((resolve, reject) => {
                axiosInstance
                    .put(`/brand/${updateData.id}`,updateData.form)
                    .then((res) => {
                        resolve(res)
                    })
                    .catch((err) => {
                        reject(err)
                    });

                });
        },

        MULTIPLE_DELETE(context,catIds) {
            return new Promise((resolve, reject) => {
            axiosInstance
                .post("/brand-destroy-multiple", catIds)
                .then((res) => {
                    resolve(res)
                })
                .catch((err) => {
                    reject(err)
                });
            });

        },

        DELETE(context,id){
            return new Promise((resolve, reject) => {
                axiosInstance
                    .delete(`/brand/${id}`)
                    .then((res) => {
                        resolve(res)
                    })
                    .catch((err) => {
                        reject(err)
                    });
                });
        }

    },
    mutations: {
        SET_DATA(state, brands) {
            state.brands = brands;
        },
    },
};
