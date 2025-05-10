import { createStore } from "vuex";
import createPersistedState from "vuex-persistedstate";
import { auth } from "./modules/auth";
import { mixed } from "./modules/mixed";
import { file_manager } from "./modules/file_manager";
import { product } from "./modules/product";

export default createStore({
    modules: {
        auth,
        mixed,
        file_manager,
        product,
    },
    plugins: [
        createPersistedState({
            paths: ["auth"],
        }),
    ],
});
