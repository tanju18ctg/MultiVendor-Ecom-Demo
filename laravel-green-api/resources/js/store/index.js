import { createStore } from "vuex";
import createPersistedState from "vuex-persistedstate";
import { auth } from "./modules/auth";
import { file_manager } from "./modules/file_manager";
import { category } from "./modules/category";
import { subcategory } from "./modules/subcategory";
import { brand } from "./modules/brand";
import { slider } from "./modules/slider";
import { product } from "./modules/product";
import { size } from "./modules/size";
import { color } from "./modules/color";
import { seller } from "./modules/seller";
import { coupon } from "./modules/coupon";
import { order } from "./modules/order";
import { division } from "./modules/division";

export default createStore({
    state: {},
    mutations: {},
    actions: {},

    modules: {
        auth,
        file_manager,
        category,
        subcategory,
        slider,
        brand,
        product,
        size,
        color,
        seller,
        coupon,
        division,
        order,
    },
    plugins: [
        createPersistedState({
            paths: ["auth"],
        }),
    ],
});
