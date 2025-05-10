import axiosInstance from "../../services/AxiosTokenInstance";

export const category = {
    namespaced: true,
    state: {
        categories: [],
    },
    getters: {
        GET_CATEGORIES(state) {
            return state.categories;
        },

        GET_NO_PAGINATE_CATEGORIES(state) {
            return state.categories;
        },
    },
    actions: {

        FETCH_CATEGORIES({commit}, payload) {
            axiosInstance
                .get(`/category-data/?page=${payload.page}&limit=${payload.limit}&status=${payload.status}`)
                .then((res) => {
                    if (res.data.status) {
                        commit("SET_CATEGORIES", res.data.data);
                    }
                })
                .catch(() => {});
        },

        FETCH_NO_PAGINATE_CATEGORIES(context) {
            axiosInstance
                .get("/category")
                .then((res) => {
                    if (res.data.status) {
                        context.commit("SET_CATEGORIES", res.data);
                    }
                })
                .catch(() => {});
        },

        STORE_CATEGORIES(context, formData) {
            return new Promise((resolve, reject) => {
            axiosInstance
                .post("/category", formData)
                .then((res) => {
                    resolve(res)
                })
                .catch((err) => {
                    reject(err)
                });

            });
        },

        EDIT_CATEGORY(context,Id){
            return new Promise((resolve, reject) => {
                axiosInstance
                    .get(`/category/${Id}`)
                    .then((res) => {
                        resolve(res)
                    })
                    .catch((err) => {
                        reject(err)
                    });

                });
        },

        UPDATE_CATEGORY({commit}, updateData){
            return new Promise((resolve, reject) => {
                axiosInstance
                    .put(`/category/${updateData.id}`,updateData.form)
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
                .post("/category-destroy-multiple", catIds)
                .then((res) => {
                    resolve(res)
                })
                .catch((err) => {
                    reject(err)
                });
            });

        },

        DELETE_CATEGORY(context,id){
            return new Promise((resolve, reject) => {
                axiosInstance
                    .delete(`/category/${id}`)
                    .then((res) => {
                        if (res.data.status == true) {
                            context.commit("DELETE_CATEGORY",id);
                        }
                        resolve(res)
                    })
                    .catch((err) => {
                        reject(err)
                    });
                });
        }

        // REMOVE_PHOTO(context,PhotoLink){
        //     return new Promise((resolve, reject) => {
        //         axiosInstance
        //             .post("/photo-remove", PhotoLink)
        //             .then((res) => {
        //                 resolve(res)
        //             })
        //             .catch((err) => {
        //                 reject(err)
        //             });
        //         });
        // }


    },
    mutations: {
        SET_CATEGORIES(state, categories) {
            state.categories = categories;
        },

        DELETE_CATEGORY(state, catId) {
            // state.categories = catId;
            let index = state.categories.data.findIndex((el) => el.id === catId);
            state.categories.data.splice(index, 1);
        },
    },
};
