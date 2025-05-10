import { createRouter, createWebHistory } from "vue-router";
import store from "../store";

import AdminLogin from "../components/admin/auth/Login.vue";
import AdminLayout from "../components/admin/AdminLayout.vue";
import AdminHome from "../components/admin/AdminHome.vue";

//slider
import Slider from "../components/admin/slider/List.vue";
import sliderEdit from "../components/admin/slider/Edit.vue";
//category
import Category from "../components/admin/category/Category.vue";
import editCategory from "../components/admin/category/EditCategory.vue";

//subcategory
import Subcategory from "../components/admin/subcategory/List.vue";
import subcategoryAdd from "../components/admin/subcategory/AddNew.vue";
import subcategoryEdit from "../components/admin/subcategory/Edit.vue";

//brand
import Brand from "../components/admin/brand/List.vue";
import brandEdit from "../components/admin/brand/Edit.vue";

//coupon
import Coupon from "../components/admin/Coupon/List.vue";

//products
import Product from "../components/admin/product/List.vue";
import productAdd from "../components/admin/product/AddNew.vue";
import productEdit from "../components/admin/product/Edit.vue";

//product attributes
import productSize from "../components/admin/product_attribute/Size.vue";
import productColor from "../components/admin/product_attribute/Color.vue";
import productColorEdit from "../components/admin/product_attribute/EditColor.vue";
import productSizeEdit from "../components/admin/product_attribute/EditSize.vue";

//sellerlist
import Seller from "../components/admin/seller/List.vue";
import sellerAdd from "../components/admin/seller/AddNew.vue";
import sellerEdit from "../components/admin/seller/Edit.vue";

//seller products list
import sellerProducts from "../components/admin/seller_products/List.vue";
//delivery area

import Division from "../components/admin/delivery_area/DivisionList.vue";
import districtList from "../components/admin/delivery_area/DistrictList.vue";

// orders
import Orders from "../components/admin/orders/Index.vue";

import Dropzone from "../components/Dropzone.vue";
import fileManager from "../components/admin/filemanager/UploadedFile.vue";
import uploadNew from "../components/admin/filemanager/NewUpload.vue";

// user routes will be end here

const routes = [
    {
        path: "/",
        name: "AdminLogin",
        component: AdminLogin,
        meta: {
            guest: true,
        },
    },

    {
        path: "/admin",
        component: AdminLayout,
        children: [
            {
                path: "home",
                name: "AdminHome",
                component: AdminHome,
            },

            {
                path: "slider",
                name: "Slider",
                component: Slider,
            },

            {
                path: "slider/:id",
                name: "sliderEdit",
                component: sliderEdit,
            },

            {
                path: "category",
                name: "Category",
                component: Category,
            },

            {
                path: "category/:id",
                name: "editCategory",
                component: editCategory,
            },

            {
                path: "subcategory",
                name: "Subcategory",
                component: Subcategory,
            },

            {
                path: "subcategory-add",
                name: "subcategoryAdd",
                component: subcategoryAdd,
            },

            {
                path: "subcategory/:id",
                name: "subcategoryEdit",
                component: subcategoryEdit,
            },

            {
                path: "brand",
                name: "Brand",
                component: Brand,
            },

            {
                path: "brand/:id",
                name: "brandEdit",
                component: brandEdit,
            },

            {
                path: "product",
                name: "Product",
                component: Product,
            },

            {
                path: "product-new",
                name: "productAdd",
                component: productAdd,
            },

            {
                path: "product/:id",
                name: "productEdit",
                component: productEdit,
            },

            {
                path: "product-size",
                name: "productSize",
                component: productSize,
            },

            {
                path: "product-size/:id",
                name: "productSizeEdit",
                component: productSizeEdit,
            },

            {
                path: "product-color/:id",
                name: "productColorEdit",
                component: productColorEdit,
            },

            {
                path: "product-color",
                name: "productColor",
                component: productColor,
            },

            {
                path: "seller",
                name: "Seller",
                component: Seller,
            },

            {
                path: "seller-add",
                name: "sellerAdd",
                component: sellerAdd,
            },

            {
                path: "seller/:id",
                name: "sellerEdit",
                component: sellerEdit,
            },

            {
                path: "seller-products",
                name: "sellerProducts",
                component: sellerProducts,
            },

            {
                path: "coupons",
                name: "Coupon",
                component: Coupon,
            },

            {
                path: "file-manager",
                name: "fileManager",
                component: fileManager,
            },

            {
                path: "orders",
                name: "Orders",
                component: Orders,
            },

            {
                path: "divisions",
                name: "Division",
                component: Division,
            },

            {
                path: "district-list/:id",
                name: "districtList",
                component: districtList,
            },

            {
                path: "file-upload",
                name: "uploadNew",
                component: uploadNew,
            },

            {
                path: "dropzone",
                name: "Dropzone",
                component: Dropzone,
            },
        ],
        meta: {
            auth: true,
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

    if (to.matched.some((record) => record.meta.auth)) {
        if (!store.getters["auth/GET_USERLOGGEDIN_STATUS"]) {
            next({ name: "AdminLogin" });
        } else {
            next();
        }
    } else if (to.matched.some((record) => record.meta.guest)) {
        if (store.getters["auth/GET_USERLOGGEDIN_STATUS"]) {
            next({
                name: "AdminHome",
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
