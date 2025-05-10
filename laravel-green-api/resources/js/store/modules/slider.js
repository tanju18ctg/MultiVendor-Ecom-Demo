import axiosInstance from "../../services/AxiosTokenInstance";

export const slider = {
    namespaced: true,
    state: {
        sliders: [],
    },
    getters: {
        GET_DATA(state) {
            return state.sliders;
        },
    },
    actions: {

        FETCH_DATA({commit}, payload) {
            axiosInstance
                .get(`/slider/?page=${payload.page}&limit=${payload.limit}&status=${payload.status}`)
                .then((res) => {
                    if (res.data.status) {
                        commit("SET_DATA", res.data.data);
                    }
                })
                .catch(() => {});
        },

        FETCH_DATA_NO_PAGINATE(context) {
            axiosInstance
                .get("/slider-all")
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
                .post("/slider", formData)
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
                    .get(`/slider/${Id}`)
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
                    .put(`/slider/${updateData.id}`,updateData.form)
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
                .post("/slider-destroy-multiple", catIds)
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
                    .delete(`/slider/${id}`)
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
        SET_DATA(state, sliders) {
            state.sliders = sliders;
        },
    },
};
