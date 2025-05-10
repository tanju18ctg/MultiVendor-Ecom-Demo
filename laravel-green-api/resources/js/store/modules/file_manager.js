import axiosInstance from "../../services/AxiosTokenInstance";

export const file_manager = {
    namespaced: true,
    state: {
        files: [],
    },
    getters: {
        GET_FILES(state) {
            return state.files;
        },
    },
    actions: {

        FETCH_FILES({commit}, payload) {
            axiosInstance
                .get(`/files/?page=${payload.page}&limit=${payload.limit}&sort=${payload.sort}&type=${payload.type}`)
                .then((res) => {
                    if (res.data.status) {
                        commit("SET_FILES", res.data.data);
                    }
                })
                .catch(() => {});
        },

        STORE_FILES(context, formData) {
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
                    .get(`/category/${Id}/edit`)
                    .then((res) => {
                        resolve(res)
                    })
                    .catch((err) => {
                        reject(err)
                    });

                });
        },



        REMOVE_PHOTO(context,PhotoLink){
            return new Promise((resolve, reject) => {
                axiosInstance
                    .post("/photo-remove", PhotoLink)
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
        SET_FILES(state, files) {
            state.files = files;
        },
    },
};
