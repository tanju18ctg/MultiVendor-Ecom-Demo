import { createRouter, createWebHistory } from "vue-router";
import store from "../store";
import SellerLogin from "../components/auth/Login.vue";
import SellerLayout from "../components/SellerLayout.vue";
import SellerHome from "../components/SellerHome.vue";

import AddProduct from "../components/product/AddNew.vue";
import AllProducts from "../components/product/List.vue";
import ProductEdit from "../components/product/Edit.vue";
//profile
import MyProfile from "../components/profile/Index.vue";



import ManageFiles from "../components/filemanager/UploadedFile.vue";
import UploadNewFiles from "../components/filemanager/NewUpload.vue";

const routes = [
    {
        path: "/seller",
        name: "SellerLogin",
        component: SellerLogin,
        meta: {
            visitor: true,
        },
    },

    {
        path: "/seller",
        component: SellerLayout,
        children: [
            {
                path: "home",
                name: "SellerHome",
                component: SellerHome,
            },

            {
                path: "add-product",
                name: "AddProduct",
                component: AddProduct,
            },

            {
                path: "products",
                name: "AllProducts",
                component: AllProducts,
            },

            {
                path: "product/:id",
                name: "ProductEdit",
                component: ProductEdit,
            },

            {
                path: "profile",
                name: "MyProfile",
                component: MyProfile,
            },



            {
                path: "uploaded-files",
                name: "ManageFiles",
                component: ManageFiles,
            },

            {
                path: "upload-new-files",
                name: "UploadNewFiles",
                component: UploadNewFiles,
            },
        ],
        meta: {
            reuire_auth: true,
            verified: true,
        },
    },

    //authentication routes will be end here
];

const router = createRouter({
    history: createWebHistory(process.env.BASE_URL),
    routes,
    linkActiveClass: "active",
});

// let's start protected routes
router.beforeEach((to, from, next) => {
    //   store.dispatch("loader/ADD_LOADING", true);

    if (to.matched.some((record) => record.meta.reuire_auth)) {
        if (!store.getters["auth/GET_USERLOGGEDIN_STATUS"]) {
            next({ name: "SellerLogin" });
        } else {
            next();
        }
    } else if (to.matched.some((record) => record.meta.visitor)) {
        if (store.getters["auth/GET_USERLOGGEDIN_STATUS"]) {
            next({
                name: "SellerHome",
            });
        } else {
            next();
        }
    } else {
        next();
    }
});
// end protected routes

export default router;
