<template>
    <div>
        <div class="container-fluid">
            <!-- left column -->
            <!-- {{ orders.data }} -->

            <template v-if="orders.data">
                <div class="row" id="axiosForm">
                    <div class="loader" v-if="loading"></div>
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Order list</h3>

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
                                        <!-- <button
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
                                        </button> -->
                                    </div>

                                    <div class="col-md-3">
                                        <select
                                            class="form-control"
                                            v-model="status"
                                            @change="getData"
                                        >
                                            <option value="pending">
                                                Pending
                                            </option>
                                            <option value="confirmed">
                                                Confirmed
                                            </option>

                                            <option value="delivered">
                                                Delivered
                                            </option>
                                        </select>
                                    </div>

                                    <div class="col-md-4">
                                        <!-- <input
                                            type="text"
                                            v-model="searchTerm"
                                            class="form-control mb-2"
                                            placeholder="search here"
                                        /> -->
                                    </div>
                                </div>
                                <table
                                    id="example1"
                                    class="table table-bordered table-striped mt-3"
                                    v-for="(order, key) in orders.data"
                                    :key="key"
                                >
                                    <thead class="bg-info">
                                        <tr>
                                            <th>
                                                <input
                                                    type="checkbox"
                                                    @click="selectAll"
                                                    :checked="check"
                                                />
                                            </th>
                                            <th>Order Number</th>
                                            <th>Shipping Addres</th>
                                            <th>Subtotal</th>
                                            <th>Discount</th>
                                            <th>Charges</th>
                                            <th>Total</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>

                                    <tr>
                                        <td>
                                            {{ ++key }}
                                        </td>
                                        <td>
                                            {{ order.order_number }}
                                        </td>

                                        <td>
                                            {{ order.shipping_address }}
                                        </td>

                                        <td>
                                            {{
                                                $filters.currencyBDT(
                                                    order.subtotal
                                                )
                                            }}
                                        </td>

                                        <td>
                                            <span v-if="order.discount != 0">
                                                -{{
                                                    $filters.currencyBDT(
                                                        order.discount
                                                    )
                                                }}
                                            </span>
                                            <span v-else>0</span>
                                        </td>

                                        <td>
                                            {{
                                                $filters.currencyBDT(
                                                    order.charges
                                                )
                                            }}
                                        </td>

                                        <td>
                                            {{
                                                $filters.currencyBDT(
                                                    order.total
                                                )
                                            }}
                                        </td>

                                        <td>
                                            <span
                                                class="badge badge-pill badge-info"
                                                v-if="order.status == 'pending'"
                                                >{{ order.status }}</span
                                            >
                                            <span
                                                class="badge badge-pill badge-success"
                                                v-else
                                                >{{ order.status }}</span
                                            >
                                        </td>
                                    </tr>

                                    <thead class="bg-danger">
                                        <tr>
                                            <th>
                                                <!-- <input
                                                    type="checkbox"
                                                    @click="selectAll"
                                                    :checked="check"
                                                /> -->
                                            </th>
                                            <th></th>
                                            <th>SL</th>
                                            <th>Image</th>
                                            <th>Items Name</th>
                                            <th>Quantity</th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr
                                            v-for="(
                                                product, index
                                            ) in order.products"
                                            :key="index"
                                        >
                                            <td></td>

                                            <td></td>
                                            <td>
                                                {{ ++index }}
                                            </td>
                                            <td>
                                                <img
                                                    :src="product.thumbnail"
                                                    style="width: 80px"
                                                    alt=""
                                                />
                                            </td>

                                            <td>
                                                {{ product.name }}
                                            </td>

                                            <td>
                                                <span v-if="product.pivot">
                                                    {{ product.pivot.qty }}
                                                </span>
                                            </td>

                                            <td></td>
                                            <td></td>
                                        </tr>
                                    </tbody>
                                </table>

                                <!-- <div
                                    class="mt-5 text-center"
                                    v-if="datasearchFilter.length == 0"
                                >
                                    <h6 class="text-center">
                                        Search No Result We're sorry. <br />
                                        We cannot find any matches for your
                                        search term.
                                    </h6>
                                </div> -->
                                <br />
                                <template v-if="orders.data.length !== 0">
                                    <pagination
                                        v-if="orders.total"
                                        v-model="current_page"
                                        :records="orders.total"
                                        :per-page="orders.per_page"
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
            status: "pending",
        };
    },

    mounted() {
        document.title = "Orders";
        this.getData();
    },

    methods: {
        getData() {
            this.$store.dispatch("order/FETCH_DATA", {
                page: this.current_page,
                limit: this.limit,
                status: this.status,
            });
        },

        DeleteMultiple() {
            this.$store
                .dispatch("order/MULTIPLE_DELETE", this.selectMultiple)
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
            // this.datasearchFilter.map((item) => {
            //     this.selectMultiple.includes(item.id)
            //         ? (this.selectMultiple = this.selectMultiple.filter(
            //               (item2) => item2 != item.id
            //           ))
            //         : this.selectMultiple.push(item.id);
            // });
        },

        deleteproduct(Id) {
            this.$swal
                .fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                })
                .then((result) => {
                    if (result.isConfirmed) {
                        this.$store
                            .dispatch("order/DELETE", Id)
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
        orders() {
            return this.$store.getters["order/GET_DATA"];
        },

        // datasearchFilter() {
        //     return this.orders.data.filter((order) => {
        //         return order.qty.match(this.searchTerm);
        //     });
        // },
    },
};
</script>
<style></style>
