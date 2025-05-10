<template>
    <div>
        <div class="container-fluid">
            <!-- left column -->

            <template v-if="sizes.data">
                <div class="row" id="axiosForm">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Size list</h3>
                                <router-link
                                    :to="{ name: 'productColor' }"
                                    class="btn btn-sm btn-info float-right"
                                    >Add Product Color</router-link
                                >
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-2">
                                        <select
                                            class="form-control"
                                            v-model="limit"
                                            @change="getSizes"
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
                                            @change="getSizes"
                                        >
                                            <option value="active">
                                                Active
                                            </option>
                                            <option value="inactive">
                                                Inactive
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
                                            <th>Size Name</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr
                                            v-for="(
                                                size, index
                                            ) in sizeSearchFilter"
                                            :key="index"
                                        >
                                            <td>
                                                <input
                                                    type="checkbox"
                                                    :value="`${size.id}`"
                                                    v-model="selectMultiple"
                                                />
                                            </td>
                                            <td>{{ index + 1 }}</td>

                                            <td>{{ size.name }}</td>
                                            <td>
                                                <span
                                                    v-if="
                                                        size.status == 'active'
                                                    "
                                                    class="badge badge-pill badge-primary"
                                                    >{{ size.status }}</span
                                                >

                                                <span
                                                    v-else
                                                    class="badge badge-pill badge-danger"
                                                    >{{ size.status }}</span
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
                                                <router-link
                                                    :to="{
                                                        name: 'productSizeEdit',
                                                        params: {
                                                            id: size.id,
                                                        },
                                                    }"
                                                    class="btn btn-sm btn-info"
                                                    title="edit data"
                                                    ><i class="far fa-edit"></i>
                                                </router-link>
                                                <a
                                                    href=""
                                                    @click.prevent="
                                                        deleteData(size.id)
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
                                    v-if="sizeSearchFilter.length == 0"
                                >
                                    <h6 class="text-center">
                                        Search No Result We're sorry. <br />
                                        We cannot find any matches for your
                                        search term.
                                    </h6>
                                </div>
                                <br />
                                <template v-if="sizeSearchFilter.length !== 0">
                                    <pagination
                                        v-if="sizes.total"
                                        v-model="current_page"
                                        :records="sizes.total"
                                        :per-page="sizes.per_page"
                                        @paginate="getSizes"
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
                                <h3 class="card-title">Add New Size</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form role="form" @submit.prevent="storeData">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"
                                            >Size Name</label
                                        >
                                        <input
                                            type="text"
                                            v-model="form.name"
                                            class="form-control"
                                            id="exampleInputEmail1"
                                            placeholder="Enter size name"
                                        />

                                        <span
                                            v-if="errors.name"
                                            class="text-danger"
                                            >{{ errors.name[0] }}</span
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
                                    <button
                                        type="submit"
                                        class="btn btn-info"
                                        :disabled="loading"
                                    >
                                        {{
                                            loading == true
                                                ? "Loading. "
                                                : "Submit"
                                        }}
                                        <i
                                            class="fas fa-spinner fa-spin"
                                            v-if="loading"
                                        ></i>
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
import { ElNotification } from "element-plus";

export default {
    components: { CategorySkeleton },
    data() {
        return {
            form: {
                name: "",
                status: "active",
            },
            errors: {},
            current_page: 1,
            searchTerm: "",
            selectMultiple: [],
            limit: 10,
            status: "active",
            loading: false,
        };
    },

    mounted() {
        document.title = "Size";
        this.getSizes();
    },

    methods: {
        getSizes() {
            this.$store.dispatch("size/FETCH_DATA_PAGINATION", {
                page: this.current_page,
                limit: this.limit,
                status: this.status,
            });
        },

        DeleteMultiple() {
            this.$store
                .dispatch("size/MULTIPLE_DELETE", this.selectMultiple)
                .then((res) => {
                    if (res.data.status == true) {
                        this.selectMultiple = [];
                        this.getSizes();
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
            this.sizeSearchFilter.map((item) => {
                this.selectMultiple.includes(item.id)
                    ? (this.selectMultiple = this.selectMultiple.filter(
                          (item2) => item2 != item.id
                      ))
                    : this.selectMultiple.push(item.id);
            });
        },

        storeData() {
            this.loading = true;
            this.$store
                .dispatch("size/STORE_DATA", this.form)
                .then(() => {
                    this.getSizes();
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
                })
                .finally(() => {
                    this.loading = false;
                });
        },

        clearForm() {
            (this.form = {
                name: "",
                status: "active",
            }),
                (this.errors = {});
        },

        deleteData(Id) {
            this.$swal
                .fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                })
                .then((result) => {
                    if (result.isConfirmed) {
                        this.$store
                            .dispatch("size/DELETE", Id)
                            .then((res) => {
                                if (res.data.status == true) {
                                    this.getSizes();
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
        sizes() {
            return this.$store.getters["size/GET_DATA"];
        },

        sizeSearchFilter() {
            return this.sizes.data.filter((size) => {
                return size.name.match(this.searchTerm);
            });
        },
    },
};
</script>
<style></style>
