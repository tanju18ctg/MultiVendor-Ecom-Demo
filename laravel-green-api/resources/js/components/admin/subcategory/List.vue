<template>
    <div>
        <div class="container-fluid">
            <!-- left column -->

            <template v-if="subcategories.data">
                <div class="row" id="axiosForm">
                    <div class="loader" v-if="loading"></div>
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="col-md-2">
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
                                <h3 class="card-title">subcategory list</h3>
                                <router-link
                                    :to="{ name: 'subcategoryAdd' }"
                                    class="btn btn-sm btn-info float-right p-2"
                                >
                                    Add New
                                </router-link>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="row">
                                    <!-- <div class="col-md-2">
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
                                    </div> -->

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <select
                                                class="form-control"
                                                v-model="category_id"
                                                @change="getSubcategories"
                                            >
                                                <option
                                                    value=""
                                                    selected
                                                    disabled
                                                >
                                                    Select One
                                                </option>
                                                <option
                                                    v-for="(
                                                        cat, index
                                                    ) in categories.data"
                                                    :key="index"
                                                    :value="cat.id"
                                                >
                                                    {{ cat.name }}
                                                    <span v-if="cat.subcats"
                                                        >({{
                                                            cat.subcats.length
                                                        }})</span
                                                    >
                                                </option>
                                            </select>

                                            <span
                                                v-if="errors.category_id"
                                                class="text-danger"
                                                >{{
                                                    errors.category_id[0]
                                                }}</span
                                            >
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <select
                                            class="form-control"
                                            v-model="limit"
                                            @change="getSubcategories"
                                        >
                                            <option value="10">10</option>
                                            <option value="20">20</option>
                                            <option value="50">50</option>
                                            <option value="100">100</option>
                                            <option value="200">200</option>
                                        </select>
                                    </div>

                                    <div class="col-md-3">
                                        <select
                                            class="form-control"
                                            v-model="status"
                                            @change="getSubcategories"
                                        >
                                            <option value="active">
                                                Active
                                            </option>
                                            <option value="inactive">
                                                Inactive
                                            </option>
                                        </select>
                                    </div>

                                    <div class="col-md-3">
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
                                            <th>subcategory Name</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr
                                            v-for="(
                                                subcat, index
                                            ) in subcategorySearchFilter"
                                            :key="index"
                                        >
                                            <td>
                                                <input
                                                    type="checkbox"
                                                    :value="`${subcat.id}`"
                                                    v-model="selectMultiple"
                                                />
                                            </td>
                                            <td>{{ index + 1 }}</td>

                                            <td>{{ subcat.name }}</td>
                                            <td>
                                                <span
                                                    v-if="
                                                        subcat.status ==
                                                        'active'
                                                    "
                                                    class="badge badge-pill badge-primary"
                                                    >{{ subcat.status }}</span
                                                >

                                                <span
                                                    v-else
                                                    class="badge badge-pill badge-danger"
                                                    >{{ subcat.status }}</span
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
                                                        name: 'subcategoryEdit',
                                                        params: {
                                                            id: subcat.id,
                                                        },
                                                    }"
                                                    class="btn btn-sm btn-info"
                                                    title="edit data"
                                                    ><i class="far fa-edit"></i>
                                                </router-link>
                                                <a
                                                    href=""
                                                    @click.prevent="
                                                        deletesubcategory(
                                                            subcat.id
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
                                    v-show="subcategorySearchFilter.length == 0"
                                >
                                    <h6 class="text-center">
                                        Search No Result We're sorry. <br />
                                        We cannot find any matches for your
                                        search term.
                                    </h6>
                                </div>
                                <br />
                                <template
                                    v-if="subcategorySearchFilter.length !== 0"
                                >
                                    <pagination
                                        v-if="subcategories.total"
                                        v-model="current_page"
                                        :records="subcategories.total"
                                        :per-page="subcategories.per_page"
                                        @paginate="getSubcategories"
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
        <!-- /.container-fluid -->
    </div>
</template>
<script>
import TableSkeleton from "../../skeleton/TableSkeleton.vue";

export default {
    components: { TableSkeleton },
    data() {
        return {
            current_page: 1,
            searchTerm: "",
            selectMultiple: [],
            limit: 10,
            status: "active",
            category_id: "",
            errors: {},
        };
    },

    mounted() {
        document.title = "subcategory";
        this.getSubcategories();
        this.fetchCategory();
    },

    methods: {
        fetchCategory() {
            this.$store.dispatch("category/FETCH_NO_PAGINATE_CATEGORIES");
        },
        getSubcategories() {
            this.$store.dispatch("subcategory/FETCH_DATA", {
                page: this.current_page,
                limit: this.limit,
                status: this.status,
                category_id: this.category_id,
            });
        },

        DeleteMultiple() {
            this.$store
                .dispatch("subcategory/MULTIPLE_DELETE", this.selectMultiple)
                .then((res) => {
                    if (res.data.status == true) {
                        this.selectMultiple = [];
                        this.getSubcategories();
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
            this.subcategorySearchFilter.map((item) => {
                this.selectMultiple.includes(item.id)
                    ? (this.selectMultiple = this.selectMultiple.filter(
                          (item2) => item2 != item.id
                      ))
                    : this.selectMultiple.push(item.id);
            });
        },

        deletesubcategory(Id) {
            this.$swal
                .fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                })
                .then((result) => {
                    if (result.isConfirmed) {
                        this.$store
                            .dispatch("subcategory/DELETE", Id)
                            .then((res) => {
                                if (res.data.status == true) {
                                    this.get();
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
        subcategories() {
            return this.$store.getters["subcategory/GET_DATA"];
        },

        subcategorySearchFilter() {
            return this.subcategories.data.filter((subcategory) => {
                return subcategory.name.match(this.searchTerm);
            });
        },

        categories() {
            return this.$store.getters["category/GET_NO_PAGINATE_CATEGORIES"];
        },
    },
};
</script>
<style>
.VuePagination__pagination-item-prev-chunk {
    display: none;
}

.VuePagination__pagination-item-next-chunk {
    display: none;
}
</style>
