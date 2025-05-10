<template>
    <div>
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <router-link :to="{ name: 'SellerHome' }" class="brand-link">
                <span class="brand-text font-weight-light text-center"
                    >Seller Panel</span
                >
            </router-link>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex" v-if="seller">
                    <div class="image">
                        <img
                            :src="seller.image"
                            class="img-circle elevation-2"
                            alt="shop-image"
                        />
                    </div>
                    <div class="info">
                        <router-link
                            :to="{ name: 'MyProfile' }"
                            class="d-block"
                            >{{ seller.name }}</router-link
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
                                :to="{ name: 'SellerHome' }"
                                class="nav-link"
                            >
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>Home</p>
                            </router-link>
                        </li>

                        <li class="nav-item">
                            <router-link
                                :to="{ name: 'AddProduct' }"
                                class="nav-link"
                            >
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>Add Product</p>
                            </router-link>
                        </li>

                        <li class="nav-item">
                            <router-link
                                :to="{ name: 'AllProducts' }"
                                class="nav-link"
                            >
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>All Products</p>
                            </router-link>
                        </li>

                        <li class="nav-item">
                            <router-link
                                :to="{ name: 'ManageFiles' }"
                                :class="`nav-link ${
                                    $route.name == 'UploadNewFiles'
                                        ? 'active'
                                        : ''
                                }`"
                            >
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>Manage Files</p>
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
    props: ["seller"],
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
                    this.$router.push({ name: "SellerLogin" });
                })
                .catch(() => {})
                .finally(() => {
                    this.loading = false;
                });
        },
    },
};
</script>
<style></style>
