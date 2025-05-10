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
                .get(`/files/?page=${payload.page}&limit=${payload.limit}&sort=${payload.sort}`)
                .then((res) => {
                    if (res.data.status) {
                        commit("SET_FILES", res.data.data);
                    }
                })
                .catch(() => {});
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
