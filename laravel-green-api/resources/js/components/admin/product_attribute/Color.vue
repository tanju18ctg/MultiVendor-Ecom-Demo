<template>
    <div>
        <div class="container-fluid">
            <!-- left column -->

            <template v-if="colors.data">
                <div class="row" id="axiosForm">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Color list</h3>
                                 <router-link :to="{name: 'productSize'}" class="btn btn-sm btn-info float-right">Back To Product Size</router-link>
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
                                            <th>Color Name</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr
                                            v-for="(
                                                color, index
                                            ) in dataSearchFilter"
                                            :key="index"
                                        >
                                            <td>
                                                <input
                                                    type="checkbox"
                                                    :value="`${color.id}`"
                                                    v-model="selectMultiple"
                                                />
                                            </td>
                                            <td>{{ index + 1 }}</td>

                                            <td>{{ color.name }}</td>
                                            <td>
                                                <span
                                                    v-if="
                                                        color.status == 'active'
                                                    "
                                                    class="badge badge-pill badge-primary"
                                                    >{{ color.status }}</span
                                                >

                                                <span
                                                    v-else
                                                    class="badge badge-pill badge-danger"
                                                    >{{ color.status }}</span
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
                                                        name: 'productColorEdit',
                                                        params: {
                                                            id: color.id,
                                                        },
                                                    }"
                                                    class="btn btn-sm btn-info"
                                                    title="edit data"
                                                    ><i class="far fa-edit"></i>
                                                </router-link>
                                                <a
                                                    href=""
                                                    @click.prevent="
                                                        deletebrand(color.id)
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
                                        v-if="colors.total"
                                        v-model="current_page"
                                        :records="colors.total"
                                        :per-page="colors.per_page"
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
                                <h3 class="card-title">Add New Colors</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form role="form" @submit.prevent="storeData">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"
                                            >Color Name</label
                                        >
                                        <input
                                            type="text"
                                            v-model="form.name"
                                            class="form-control"
                                            id="exampleInputEmail1"
                                            placeholder="Enter color name"
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
        document.title = "Color";
        this.getData();
    },

    methods: {
        getData() {
            this.$store.dispatch("color/FETCH_DATA_PAGINATION", {
                page: this.current_page,
                limit: this.limit,
                status: this.status,
            });
        },

        DeleteMultiple() {
            this.$store
                .dispatch("color/MULTIPLE_DELETE", this.selectMultiple)
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

        storeData() {
            this.loading = true;
            this.$store
                .dispatch("color/STORE_DATA", this.form)
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

        deletebrand(Id) {
            this.$swal
                .fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                })
                .then((result) => {
                    if (result.isConfirmed) {
                        this.$store
                            .dispatch("color/DELETE", Id)
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
        colors() {
            return this.$store.getters["color/GET_DATA"];
        },

        dataSearchFilter() {
            return this.colors.data.filter((color) => {
                return color.name.match(this.searchTerm);
            });
        },
    },
};
</script>
<style></style>
