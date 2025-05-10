<template>
    <div>
        <div class="container-fluid">
            <!-- left column -->

            <template v-if="divisions.data">
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
                                <h3 class="card-title">district list</h3>
                                <!-- <router-link
                                    :to="{ name: 'districtAdd' }"
                                    class="btn btn-sm btn-info float-right p-2"
                                >
                                    Add New
                                </router-link> -->
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
                                        <select
                                            class="form-control"
                                            v-model="limit"
                                            @change="getDivision"
                                        >
                                            <option value="10">10</option>
                                            <option value="20">20</option>
                                            <option value="50">50</option>
                                            <option value="100">100</option>
                                            <option value="200">200</option>
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
                                            <th>Name</th>
                                            <th>Charge</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr
                                            v-for="(
                                                data, index
                                            ) in dataSearchFilter"
                                            :key="index"
                                        >
                                            <td>
                                                <input
                                                    type="checkbox"
                                                    :value="`${data.id}`"
                                                    v-model="selectMultiple"
                                                />
                                            </td>
                                            <td>{{ index + 1 }}</td>

                                            <td>
                                                {{ data.name }}-{{
                                                    data.bn_name
                                                }}
                                                <span v-if="data.districts"
                                                    >({{
                                                        data.districts.length
                                                    }})</span
                                                >
                                            </td>
                                            <td>
                                                {{
                                                    $filters.currencyBDT(
                                                        data.charge
                                                    )
                                                }}
                                            </td>

                                            <td>
                                                <router-link
                                                    :to="{
                                                        name: 'districtList',
                                                        params:{
                                                            id:data.id
                                                        }
                                                    }"
                                                    class="btn btn-sm btn-priinmary"
                                                    title="view data"
                                                    target="_blank"
                                                >
                                                    <i class="fa fa-eye"></i>
                                                </router-link>
                                                <!-- <router-link
                                                    :to="{
                                                        name: 'districtEdit',
                                                        params: {
                                                            id: data.id,
                                                        },
                                                    }"
                                                    class="btn btn-sm btn-info"
                                                    title="edit data"
                                                    ><i class="far fa-edit"></i>
                                                </router-link> -->
                                                <a
                                                    href=""
                                                    @click.prevent="
                                                        deletedistrict(data.id)
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
                                    v-show="dataSearchFilter.length == 0"
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
                                        v-if="divisions.total"
                                        v-model="current_page"
                                        :records="divisions.total"
                                        :per-page="divisions.per_page"
                                        @paginate="getDivision"
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
            errors: {},
        };
    },

    mounted() {
        document.title = "Division List";
        this.getDivision();
    },

    methods: {
        getDivision() {
            this.$store.dispatch("division/FETCH_DATA", {
                page: this.current_page,
                limit: this.limit,
            });
        },

        DeleteMultiple() {
            this.$store
                .dispatch("district/MULTIPLE_DELETE", this.selectMultiple)
                .then((res) => {
                    if (res.data.status == true) {
                        this.selectMultiple = [];
                        this.getDivision();
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

        deletedistrict(Id) {
            this.$swal
                .fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                })
                .then((result) => {
                    if (result.isConfirmed) {
                        this.$store
                            .dispatch("district/DELETE", Id)
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
        divisions() {
            return this.$store.getters["division/GET_DATA"];
        },

        dataSearchFilter() {
            return this.divisions.data.filter((district) => {
                return district.name.match(this.searchTerm);
            });
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
