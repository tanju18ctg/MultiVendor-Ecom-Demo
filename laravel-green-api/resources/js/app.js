require("./bootstrap");

import { createApp } from "vue";
import router from "./router";
import store from "./store";

import ElementPlus from "element-plus";
import "element-plus/dist/index.css";

import Pagination from "v-pagination-3";
require("skeleton-screen-css");

import DropZone from "dropzone-vue";

// optionally import default styles
import "dropzone-vue/dist/dropzone-vue.common.css";

// import Swal from 'sweetalert2'
// window.Swal = Swal;

import VueSweetalert2 from "vue-sweetalert2";
import "sweetalert2/dist/sweetalert2.min.css";
const options = {
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Yes, delete it!",
};

import { QuillEditor } from "@vueup/vue-quill";
import "@vueup/vue-quill/dist/vue-quill.snow.css";

//declare master file globally
import AdminMaster from "./components/layouts/AdminMaster.vue";

const app = createApp({});

app.use(router);
app.use(store);
app.use(ElementPlus);
app.use(DropZone);
app.component("admin-master", AdminMaster);
app.component("pagination", Pagination);
app.use(VueSweetalert2, options);
app.component("QuillEditor", QuillEditor);
app.mount("#app");

app.config.globalProperties.$filters = {
    currencyBDT(value) {
        return "৳" + value.toLocaleString();
    },
};


