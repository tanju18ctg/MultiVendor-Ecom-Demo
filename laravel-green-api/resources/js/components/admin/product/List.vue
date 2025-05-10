<template>
    <div>
        <div class="container-fluid">
            <!-- left column -->

            <template v-if="products.data">
                <div class="row" id="axiosForm">
                    <div class="loader" v-if="loading"></div>
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Product list</h3>
                                <router-link
                                    :to="{ name: 'productAdd' }"
                                    class="btn btn-info btn-sm float-right"
                                >
                                    Add New
                                </router-link>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-2">
                                        <select
                                            class="form-control"
                                            v-model="limit"
                                            @change="getproducts"
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
                                            @change="getproducts"
                                        >
                                            <option value="active">
                                                Publish
                                            </option>
                                            <option value="inactive">
                                                Unpublish
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
                                            <th>SL</th>
                                            <th>Image</th>
                                            <th>product Name</th>
                                            <th>Price</th>
                                            <th>Discount</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr
                                            v-for="(
                                                product, index
                                            ) in productsearchFilter"
                                            :key="index"
                                        >
                                            <td>
                                                <input
                                                    type="checkbox"
                                                    :value="`${product.id}`"
                                                    v-model="selectMultiple"
                                                />
                                            </td>
                                            <td>{{ index + 1 }}</td>
                                            <td>
                                                <img
                                                    :src="product.thumbnail"
                                                    style="width: 80px"
                                                    alt=""
                                                />
                                            </td>
                                            <td>{{ product.name }}</td>
                                            <td>
                                                {{
                                                    $filters.currencyBDT(
                                                        product.price
                                                    )
                                                }}
                                            </td>
                                            <td>
                                                <span
                                                    v-if="product.discount"
                                                    class="badge badge-pill badge-info"
                                                    >{{
                                                        product.discount
                                                    }}%</span
                                                >

                                                <span
                                                    v-else
                                                    class="badge badge-pill badge-danger"
                                                    >No</span
                                                >
                                            </td>

                                            <td>
                                                <span
                                                    v-if="
                                                        product.status ==
                                                        'active'
                                                    "
                                                    class="badge badge-pill badge-primary"
                                                    >{{ product.status }}</span
                                                >

                                                <span
                                                    v-else
                                                    class="badge badge-pill badge-danger"
                                                    >{{ product.status }}</span
                                                >
                                            </td>
                                            <td>
                                                <a
                                                    href="javascript::void(0)"
                                                    class="btn btn-sm btn-priinmary"
                                                    title="view data"
                                                >
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                                <router-link
                                                    :to="{
                                                        name: 'productEdit',
                                                        params: {
                                                            id: product.id,
                                                        },
                                                    }"
                                                    class="btn btn-sm btn-info"
                                                    title="edit data"
                                                    ><i class="far fa-edit"></i>
                                                </router-link>
                                                <a
                                                    href=""
                                                    @click.prevent="
                                                        deleteproduct(
                                                            product.id
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
                                    v-if="productsearchFilter.length == 0"
                                >
                                    <h6 class="text-center">
                                        Search No Result We're sorry. <br />
                                        We cannot find any matches for your
                                        search term.
                                    </h6>
                                </div>
                                <br />
                                <template
                                    v-if="productsearchFilter.length !== 0"
                                >
                                    <pagination
                                        v-if="products.total"
                                        v-model="current_page"
                                        :records="products.total"
                                        :per-page="products.per_page"
                                        @paginate="getproducts"
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
    components: { TableSkeleton},
    data() {
        return {
            current_page: 1,
            searchTerm: "",
            selectMultiple: [],
            limit: 10,
            status: "active",
        };
    },

    mounted() {
        document.title = "product";
        this.getproducts();
    },

    methods: {
        getproducts() {
            this.$store.dispatch("product/FETCH_DATA", {
                page: this.current_page,
                limit: this.limit,
                status: this.status,
            });
        },

        DeleteMultiple() {
            this.$store
                .dispatch("product/MULTIPLE_DELETE", this.selectMultiple)
                .then((res) => {
                    if (res.data.status == true) {
                        this.selectMultiple = [];
                        this.getproducts();
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
            this.productsearchFilter.map((item) => {
                this.selectMultiple.includes(item.id)
                    ? (this.selectMultiple = this.selectMultiple.filter(
                          (item2) => item2 != item.id
                      ))
                    : this.selectMultiple.push(item.id);
            });
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
                            .dispatch("product/DELETE", Id)
                            .then((res) => {
                                if (res.data.status == true) {
                                    this.getproducts();
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
        products() {
            return this.$store.getters["product/GET_DATA"];
        },

        productsearchFilter() {
            return this.products.data.filter((product) => {
                return product.name.match(this.searchTerm);
            });
        },
    },
};
</script>
<style></style>
