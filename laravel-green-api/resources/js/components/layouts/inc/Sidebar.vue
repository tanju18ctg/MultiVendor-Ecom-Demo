<template>
    <div>
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <router-link :to="{ name: 'AdminHome' }" class="brand-link">
                <span class="brand-text font-weight-light text-center"
                    >Admin Panel</span
                >
            </router-link>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex" v-if="admin">
                    <div class="image">
                        <img
                            src="/admin/img/user2-160x160.jpg"
                            class="img-circle elevation-2"
                            alt="User Image"
                        />
                    </div>
                    <div class="info">
                        <router-link :to="{ name: 'AdminHome' }" class="d-block"
                            >{{admin.name}}</router-link
                        >
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul
                        class="nav nav-pills nav-sidebar flex-column"
                        data-widget="treeview"
                        role="menu"
                        data-accordion="false"
                    >
                        <li class="nav-item">
                            <router-link
                                :to="{ name: 'AdminHome' }"
                                class="nav-link"
                            >
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>Dashboard</p>
                            </router-link>
                        </li>

                        <li class="nav-item">
                            <router-link
                                :to="{ name: 'Slider' }"
                                class="nav-link"
                            >
                                <i class="nav-icon fas fa-list-alt"></i>
                                <p>Slider</p>
                            </router-link>
                        </li>

                        <li class="nav-item">
                            <router-link
                                :to="{ name: 'Brand' }"
                                class="nav-link"
                            >
                                <i class="nav-icon fas fa-list-alt"></i>
                                <p>Brand</p>
                            </router-link>
                        </li>

                        <li class="nav-item">
                            <router-link
                                :to="{ name: 'Category' }"
                                class="nav-link"
                            >
                                <i class="nav-icon fas fa-list-alt"></i>
                                <p>Category</p>
                            </router-link>
                        </li>

                        <li class="nav-item">
                            <router-link
                                :to="{ name: 'Subcategory' }"
                                :class="`nav-link ${
                                    $route.name == 'subcategoryAdd'
                                        ? 'active'
                                        : ''
                                }`"
                            >
                                <i class="nav-icon fas fa-list-alt"></i>
                                <p>Sub Category</p>
                            </router-link>
                        </li>

                         <li class="nav-item">
                            <router-link
                                :to="{ name: 'Coupon' }"
                                class="nav-link"
                            >
                                <i class="nav-icon fas fa-list-alt"></i>
                                <p>Coupon Management</p>
                            </router-link>
                        </li>

                        <li class="nav-item">
                            <router-link
                                :to="{ name: 'Product' }"
                                :class="`nav-link ${
                                    $route.name == 'productAdd' ? 'active' : ''
                                }`"
                            >
                                <i class="nav-icon fas fa-list-alt"></i>
                                <p>In House Products</p>
                            </router-link>
                        </li>

                        <!-- <li class="nav-item">
                            <router-link
                                :to="{ name: 'productSize' }"
                                :class="`nav-link ${
                                    $route.name == 'productColor'
                                        ? 'active'
                                        : ''
                                }`"
                            >
                                <i class="nav-icon fas fa-list-alt"></i>
                                <p>Product Attributes</p>
                            </router-link>
                        </li> -->

                        <li class="nav-item">
                            <router-link
                                :to="{ name: 'Seller' }"
                                class="nav-link"
                            >
                                <i class="nav-icon fas fa-list-alt"></i>
                                <p>Seller List</p>
                            </router-link>
                        </li>

                        <li class="nav-item">
                            <router-link
                                :to="{ name: 'sellerProducts' }"
                                class="nav-link"
                            >
                                <i class="nav-icon fas fa-list-alt"></i>
                                <p>Seller Products</p>
                            </router-link>
                        </li>

                        <li class="nav-item">
                            <router-link
                                :to="{ name: 'fileManager' }"
                                class="nav-link"
                            >
                                <i class="nav-icon fas fa-list-alt"></i>
                                <p>Uploaded Files</p>
                            </router-link>
                        </li>

                        <li class="nav-item">
                            <router-link
                                :to="{ name: 'Orders' }"
                                class="nav-link"
                            >
                                <i class="nav-icon fas fa-list-alt"></i>
                                <p>Orders</p>
                            </router-link>
                        </li>

                        <li class="nav-item">
                            <router-link
                                :to="{ name: 'Division' }"
                                class="nav-link"
                            >
                                <i class="nav-icon fas fa-list-alt"></i>
                                <p>Delivery Area</p>
                            </router-link>
                        </li>

                        <li class="nav-item">
                            <a
                                href="javascript::void(0)"
                                v-if="loading"
                                class="nav-link"
                            >
                                <i
                                    class="nav-icon fas fa-sign-out-alt text-danger"
                                ></i>
                                <p>
                                    Loading..
                                    <i class="fas fa-spinner fa-spin"></i>
                                </p>
                            </a>

                            <a
                                v-else
                                href="#"
                                class="nav-link"
                                @click.prevent="adminLogout"
                            >
                                <i
                                    class="nav-icon fas fa-sign-out-alt text-danger"
                                ></i>
                                <p>Logout</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <router-link
                                :to="{ name: 'Dropzone' }"
                                class="nav-link"
                            >
                                <i class="nav-icon fas fa-list-alt"></i>
                                <p>Dropzone</p>
                            </router-link>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>
    </div>
</template>
<script>
import { ElNotification } from "element-plus";
export default {
    data() {
        return {
            loading: false,
        };
    },
    methods: {
        adminLogout() {
            this.loading = true;
            this.$store
                .dispatch("auth/logout")
                .then(() => {
                    ElNotification({
                        title: "Success",
                        message: "logout Success",
                        type: "success",
                        showClose: false,
                    });
                    this.$router.push({ name: "AdminLogin" });
                })
                .catch(() => {})
                .finally(() => {
                    this.loading = false;
                });
        },
    },

    computed: {
        admin() {
            return this.$store.getters["auth/GET_AUTH_USER"];
        },
    },
};
</script>
<style></style>
