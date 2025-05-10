<template>
    <div>
        <div class="container-fluid">
            <!-- left column -->

            <template v-if="sellers.data">
                <div class="row" id="axiosForm">
                    <div class="loader" v-if="loading"></div>
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">sel list</h3>
                                <!-- <router-link
                                    :to="{ name: 'selAdd' }"
                                    class="btn btn-info btn-sm float-right"
                                >
                                    Add New
                                </router-link> -->
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-2">
                                        <select
                                            class="form-control"
                                            v-model="limit"
                                            @change="getData"
                                        >
                                            <option value="10">10</option>
                                            <option value="20">20</option>
                                            <option value="50">50</option>
                                            <option value="100">100</option>
                                            <option value="200">200</option>
                                        </select>
                                    </div>

                                    <div class="col-md-3">
                                        <button
                                            v-if="selectMultiple.length !== 0"
                                            class="btn btn-sm btn-info"
                                            @click="DeleteMultiple"
                                        >
                                            Delete
                                            <span
                                                >{{
                                                    selectMultiple.length
                                                }}
                                                Items</span
                                            >
                                        </button>
                                    </div>

                                    <div class="col-md-3">
                                        <select
                                            class="form-control"
                                            v-model="status"
                                            @change="getData"
                                        >
                                            <option value="1">
                                                Verified Sellers
                                            </option>
                                            <option value="0">
                                                Unverified Sellers
                                            </option>
                                        </select>
                                    </div>

                                    <div class="col-md-4">
                                        <input
                                            type="text"
                                            v-model="searchTerm"
                                            class="form-control mb-2"
                                            placeholder="search here"
                                        />
                                    </div>
                                </div>

                                <div class="row">
                                    <div
                                        class="col-md-3"
                                        v-for="(
                                            seller, index
                                        ) in dataSearchFilter"
                                        :key="index"
                                    >
                                        <!-- Profile Image -->
                                        <div
                                            class="card card-info card-outline"
                                        >
                                            <div class="btn-group dropdown">
                                                <button
                                                    type="button"
                                                    class="btn btn-sm btn-info dropdown-toggle dropdown-toggle-split"
                                                    data-toggle="dropdown"
                                                    title="order status"
                                                    aria-haspopup="true"
                                                    aria-expanded="false"
                                                >
                                                    <span class="sr-only"
                                                        >Toggle Dropdown</span
                                                    >
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a
                                                        v-show="
                                                            seller.isVerified ==
                                                            0
                                                        "
                                                        class="dropdown-item"
                                                        href="javascript::void(0)"
                                                        @click.prevent="
                                                            verifyAccount(
                                                                seller.id
                                                            )
                                                        "
                                                        >Verify Account</a
                                                    >

                                                    <a
                                                        class="dropdown-item"
                                                        href=""
                                                        >Delete Account</a
                                                    >

                                                    <a
                                                        class="dropdown-item"
                                                        href=""
                                                        >Deactivate Account</a
                                                    >
                                                    <a
                                                        class="dropdown-item"
                                                        href=""
                                                        >Reset Password</a
                                                    >
                                                </div>
                                            </div>

                                            <div class="card-body box-profile">
                                                <div class="text-center">
                                                    <img
                                                        v-if="
                                                            seller.image != null
                                                        "
                                                        class="profile-user-img img-fluid img-circle"
                                                        :src="seller.image"
                                                        alt="User profile picture"
                                                    />

                                                    <img
                                                        v-else
                                                        class="profile-user-img img-fluid img-circle"
                                                        src="/admin/img/user-demo.png"
                                                        alt="User profile picture"
                                                    />
                                                </div>

                                                <h3
                                                    class="profile-username text-center"
                                                >
                                                    {{ seller.shop_name }}
                                                    <span
                                                        v-if="
                                                            seller.isVerified ==
                                                            1
                                                        "
                                                        class="badge badge-pill badge-info"
                                                        ><i
                                                            class="fas fa-check-circle"
                                                        ></i
                                                    ></span>
                                                </h3>

                                                <p
                                                    class="text-muted text-center"
                                                >
                                                    Owner: {{ seller.name }}
                                                </p>

                                                <p
                                                    class="text-muted text-center"
                                                >
                                                    {{ seller.email }}
                                                </p>

                                                <p
                                                    class="text-muted text-center"
                                                >
                                                    {{ seller.phone }}
                                                </p>

                                                <p
                                                    class="text-muted text-center"
                                                >
                                                    {{ seller.address }}
                                                </p>

                                                <!-- <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>Followers</b>
                                    <a class="float-right">1,322</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Following</b>
                                    <a class="float-right">543</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Friends</b>
                                    <a class="float-right">13,287</a>
                                </li>
                            </ul> -->

                                                <a
                                                    href="#"
                                                    class="btn btn-info btn-block"
                                                    ><b>Visit Store</b></a
                                                >
                                            </div>
                                            <!-- /.card-body -->
                                        </div>
                                        <!-- /.card -->
                                    </div>
                                </div>

                                <div
                                    class="mt-5 text-center"
                                    v-if="dataSearchFilter.length == 0"
                                >
                                    <h6 class="text-center">
                                        Search No Result We're sorry. <br />
                                        We cannot find any matches for your
                                        search term.
                                    </h6>
                                </div>
                                <br />
                                <template v-if="dataSearchFilter.length !== 0">
                                    <pagination
                                        v-if="sellers.total"
                                        v-model="current_page"
                                        :records="sellers.total"
                                        :per-page="sellers.per_page"
                                        @paginate="getData"
                                    />
                                </template>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </template>

            <template v-else>
                <Table-skeleton />
            </template>
        </div>
    </div>
</template>
<script>
import TableSkeleton from "../../skeleton/TableSkeleton.vue";
import { ElNotification } from "element-plus";

export default {
    components: { TableSkeleton },
    data() {
        return {
            current_page: 1,
            searchTerm: "",
            selectMultiple: [],
            limit: 10,
            status: 1,
        };
    },

    mounted() {
        document.title = "seller list";
        this.getData();
    },

    methods: {
        getData() {
            this.$store.dispatch("seller/FETCH_DATA", {
                page: this.current_page,
                limit: this.limit,
                status: this.status,
            });
        },

        DeleteMultiple() {
            this.$store
                .dispatch("seller/MULTIPLE_DELETE", this.selectMultiple)
                .then((res) => {
                    if (res.data.status == true) {
                        this.selectMultiple = [];
                        this.getData();
                        ElNotification({
                            title: "Success",
                            message: "Delete Success",
                            type: "success",
                            showClose: false,
                        });
                    }
                })
                .catch((err) => {
                    console.log(err);
                });
        },

        selectAll() {
            this.dataSearchFilter.map((item) => {
                this.selectMultiple.includes(item.id)
                    ? (this.selectMultiple = this.selectMultiple.filter(
                          (item2) => item2 != item.id
                      ))
                    : this.selectMultiple.push(item.id);
            });
        },

        deletesel(Id) {
            this.$swal
                .fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                })
                .then((result) => {
                    if (result.isConfirmed) {
                        this.$store
                            .dispatch("seller/DELETE", Id)
                            .then((res) => {
                                if (res.data.status == true) {
                                    this.getData();
                                    ElNotification({
                                        title: "Success",
                                        message: "Delete Success",
                                        type: "success",
                                        showClose: false,
                                    });
                                }
                            })
                            .catch(() => {
                                alert("danger");
                            });
                    }
                });
        },

        verifyAccount(id) {
            this.$store
                .dispatch("seller/VERIFY_ACCOUNT", id)
                .then((res) => {
                    if (res.data.status == true) {
                        this.getData();
                        ElNotification({
                            title: "Success",
                            message: "Verify Success",
                            type: "success",
                            showClose: false,
                        });
                    }
                })
                .catch(() => {});
        },
    },

    computed: {
        sellers() {
            return this.$store.getters["seller/GET_DATA"];
        },
        dataSearchFilter() {
            return this.sellers.data.filter((seller) => {
                return seller.name.match(this.searchTerm);
            });
        },
    },
};
</script>
<style scoped>
.badge-info {
    background-color: #13a717;
}
.badge-pill {
    padding-right: 3px;
    padding-left: 3px;
    font-size: 12px;
}
</style>
