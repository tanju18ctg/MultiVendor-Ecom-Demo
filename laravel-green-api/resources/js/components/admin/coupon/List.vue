<template>
    <div>
        <div class="container-fluid">
            <!-- left column -->

            <template v-if="coupons.data">
                <div class="row" id="axiosForm">
                    <div class="loader" v-if="loading"></div>
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">couponider list</h3>
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
                                            <option value="active">
                                                Active
                                            </option>
                                            <option value="inactive">
                                                Inactive
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <table
                                    id="example1"
                                    class="table table-bordered table-striped"
                                >
                                    <thead>
                                        <tr>
                                            <th>
                                                <input
                                                    type="checkbox"
                                                    @click="selectAll"
                                                    :checked="check"
                                                />
                                            </th>
                                            <th>Coupon Code</th>
                                            <th>Coupon Value</th>
                                            <th>Type</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr
                                            v-for="(
                                                coupon, index
                                            ) in coupons.data"
                                            :key="index"
                                        >
                                            <td>
                                                <input
                                                    type="checkbox"
                                                    :value="`${coupon.id}`"
                                                    v-model="selectMultiple"
                                                />
                                            </td>
                                            <td>{{ index + 1 }}</td>
                                            <td>
                                                {{ coupon.code }}
                                            </td>

                                            <td>
                                                <span
                                                    v-if="
                                                        coupon.type == 'fixed'
                                                    "
                                                    class="badge badge-pill badge-primary"
                                                    >{{
                                                        $filters.currencyBDT(
                                                            coupon.value
                                                        )
                                                    }}</span
                                                >

                                                <span
                                                    v-else
                                                    class="badge badge-pill badge-danger"
                                                    >{{ coupon.value }}%</span
                                                >
                                            </td>
                                            <td>
                                                <span
                                                    v-if="
                                                        coupon.status ==
                                                        'active'
                                                    "
                                                    class="badge badge-pill badge-primary"
                                                    >{{ coupon.status }}</span
                                                >

                                                <span
                                                    v-else
                                                    class="badge badge-pill badge-danger"
                                                    >{{ coupon.status }}</span
                                                >
                                            </td>

                                            <td>
                                                <a
                                                    href=""
                                                    class="btn btn-sm btn-priinmary"
                                                    title="view data"
                                                >
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                                <!-- <router-link
                                                    :to="{
                                                        name: 'couponiderEdit',
                                                        params: {
                                                            id: coupon.id,
                                                        },
                                                    }"
                                                    class="btn btn-sm btn-info"
                                                    title="edit data"
                                                    ><i class="far fa-edit"></i>
                                                </router-link> -->
                                                <a
                                                    href=""
                                                    @click.prevent="
                                                        deletecouponider(
                                                            coupon.id
                                                        )
                                                    "
                                                    class="btn btn-sm btn-danger"
                                                    id="delete"
                                                    title="delete data"
                                                    ><i class="fa fa-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>

                                <div
                                    class="mt-5 text-center"
                                    v-if="coupons.data.length == 0"
                                >
                                    <h6 class="text-center">
                                        Search No Result We're sorry. <br />
                                        We cannot find any matches for your
                                        search term.
                                    </h6>
                                </div>
                                <br />
                                <template v-if="coupons.data.length !== 0">
                                    <pagination
                                        v-if="coupons.total"
                                        v-model="current_page"
                                        :records="coupons.total"
                                        :per-page="coupons.per_page"
                                        @paginate="getData"
                                    />
                                </template>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>

                    <div class="col-md-4">
                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">Add New Coupon</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form role="form" @submit.prevent="storeData">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"
                                            >Coupon Code</label
                                        >
                                        <input
                                            type="text"
                                            v-model="form.code"
                                            class="form-control"
                                            id="exampleInputEmail1"
                                            placeholder="Enter coupon code"
                                        />

                                        <span
                                            v-if="errors.code"
                                            class="text-danger"
                                            >{{ errors.code[0] }}</span
                                        >
                                    </div>

                                    <div class="form-group">
                                        <label for="type">Type</label>
                                        <select
                                            class="form-control"
                                            v-model="form.type"
                                            id="type"
                                        >
                                            <option selected value="">
                                                Select One
                                            </option>
                                            <option value="fixed">Fixed</option>
                                            <option value="percent">
                                                Percent
                                            </option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="couponValue"
                                            >Coupon value</label
                                        >
                                        <input
                                            type="text"
                                            v-model="form.value"
                                            class="form-control"
                                            id="couponValue"
                                            placeholder="Enter coupon value"
                                        />

                                        <span
                                            v-if="errors.value"
                                            class="text-danger"
                                            >{{ errors.value[0] }}</span
                                        >
                                    </div>

                                    <div class="form-group">
                                        <label for="Status">Status</label>
                                        <select
                                            class="form-control"
                                            v-model="form.status"
                                            id="Status"
                                        >
                                            <option value="active">
                                                Active
                                            </option>
                                            <option value="inactive">
                                                Inactive
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-info">
                                        Submit
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </template>

            <template v-else>
                <Category-skeleton />
            </template>
        </div>
        <!-- /.container-fluid -->
    </div>
</template>
<script>
import CategorySkeleton from "../../skeleton/CategorySkeleton.vue";
import GalleryModal from "../filemanager/GalleryModal.vue";
import { ElNotification } from "element-plus";

export default {
    name: 'List',

    components: { CategorySkeleton, GalleryModal },
    data() {
        return {
            form: {
                type: "",
                code: "",
                value: "",
                status: "active",
            },
            errors: {},
            current_page: 1,
            selectMultiple: [],
            limit: 10,
            status: "active",
        };
    },

    mounted() {
        document.title = "Coupon";
        this.getData();
    },

    methods: {
        getData() {
            this.$store.dispatch("coupon/FETCH_DATA", {
                page: this.current_page,
                limit: this.limit,
                status: this.status,
            });
        },

        DeleteMultiple() {
            this.$store
                .dispatch("coupon/MULTIPLE_DELETE", this.selectMultiple)
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
            this.coupons.data.map((item) => {
                this.selectMultiple.includes(item.id)
                    ? (this.selectMultiple = this.selectMultiple.filter(
                          (item2) => item2 != item.id
                      ))
                    : this.selectMultiple.push(item.id);
            });
        },

        storeData() {
            this.$store
                .dispatch("coupon/STORE_DATA", this.form)
                .then(() => {
                    this.getData();
                    this.clearForm();
                    ElNotification({
                        title: "Success",
                        message: "Create Success",
                        type: "success",
                        showClose: false,
                    });
                })
                .catch((err) => {
                    this.errors = err.response.data.errors;
                });
        },

        clearForm() {
            (this.form = {
                type: "",
                code: "",
                value: "",
                status: "active",
            }),
                (this.errors = {});
        },

        deletecouponider(Id) {
            this.$swal
                .fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                })
                .then((result) => {
                    if (result.isConfirmed) {
                        this.$store
                            .dispatch("coupon/DELETE", Id)
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
    },

    computed: {
        coupons() {
            return this.$store.getters["coupon/GET_DATA"];
        },
    },
};
</script>
<style></style>
