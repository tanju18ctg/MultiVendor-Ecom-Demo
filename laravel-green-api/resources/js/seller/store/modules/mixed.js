import axiosInstance from "../../services/AxiosTokenInstance";

export const mixed = {
    namespaced: true,
    state: {
        brands: [],
        categories: [],
        subcategories: [],
        colors: [],
        sizes: [],
    },
    getters: {
        GET_BRAND_DATA(state) {
            return state.brands;
        },

        GET_CATEGORY_DATA(state) {
            return state.categories;
        },

        GET_SUBCATEGORY_DATA(state) {
            return state.subcategories;
        },

        GET_SIZE_DATA(state) {
            return state.sizes;
        },

        GET_COLOR_DATA(state) {
            return state.colors;
        },
    },
    actions: {
        FETCH_BRAND_NO_PAGINATE(context) {
            axiosInstance
                .get("/brand-all")
                .then((res) => {
                    if (res.data.status) {
                        context.commit("SET_BRAND_DATA", res.data);
                    }
                })
                .catch(() => {});
        },

        FETCH_CATEGORY_NO_PAGINATE(context) {
            axiosInstance
                .get("/category")
                .then((res) => {
                    if (res.data.status) {
                        context.commit("SET_CATEGORY_DATA", res.data);
                    }
                })
                .catch(() => {});
        },

        FETCH_SUBCATEGORY_NO_PAGINATE({commit},catID) {
            axiosInstance
                .get(`/subcategory-by-id/${catID}`)
                .then((res) => {
                    if (res.data.status) {
                        commit("SET_SUBCATEGORY_DATA", res.data);
                    }
                })
                .catch(() => {});
        },

        FETCH_SIZE_NO_PAGINATE(context) {
            axiosInstance
                .get("/size")
                .then((res) => {
                    if (res.data.status) {
                        context.commit("SET_SIZE_DATA", res.data);
                    }
                })
                .catch(() => {});
        },

        FETCH_COLOR_NO_PAGINATE(context) {
            axiosInstance
                .get("/color")
                .then((res) => {
                    if (res.data.status) {
                        context.commit("SET_COLOR_DATA", res.data);
                    }
                })
                .catch(() => {});
        },
    },
    mutations: {
        SET_BRAND_DATA(state, brands) {
            state.brands = brands;
        },

        SET_CATEGORY_DATA(state, categories) {
            state.categories = categories;
        },

        SET_SUBCATEGORY_DATA(state, subcategories) {
            state.subcategories = subcategories;
        },

        SET_SIZE_DATA(state, sizes) {
            state.sizes = sizes;
        },

        SET_COLOR_DATA(state, colors) {
            state.colors = colors;
        },

    },
};
