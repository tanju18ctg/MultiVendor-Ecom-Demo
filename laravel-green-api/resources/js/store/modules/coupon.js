import axiosInstance from "../../services/AxiosTokenInstance";

export const coupon = {
    namespaced: true,
    state: {
        coupons: [],
    },
    getters: {
        GET_DATA(state) {
            return state.coupons;
        },
    },
    actions: {

        FETCH_DATA({commit}, payload) {
            axiosInstance
                .get(`/coupon/?page=${payload.page}&limit=${payload.limit}&status=${payload.status}`)
                .then((res) => {
                    if (res.data.status) {
                        commit("SET_DATA", res.data.data);
                    }
                })
                .catch(() => {});
        },

        FETCH_DATA_NO_PAGINATE(context) {
            axiosInstance
                .get("/coupon-all")
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
                .post("/coupon", formData)
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
                    .get(`/coupon/${Id}`)
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
                    .put(`/coupon/${updateData.id}`,updateData.form)
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
                .post("/coupon-destroy-multiple", catIds)
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
                    .delete(`/coupon/${id}`)
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
        SET_DATA(state, coupons) {
            state.coupons = coupons;
        },
    },
};
