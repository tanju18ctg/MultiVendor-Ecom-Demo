<template>
    <div>
        <div class="container-fluid">
            <!-- left column -->

            <template v-if="brands.data">
                <div class="row" id="axiosForm">
                    <div class="loader" v-if="loading"></div>
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">brand list</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-2">
                                        <select
                                            class="form-control"
                                            v-model="limit"
                                            @change="getBrands"
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
                                            @change="getBrands"
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
                                            <th>Image</th>
                                            <th>brand Name</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr
                                            v-for="(
                                                brand, index
                                            ) in brandSearchFilter"
                                            :key="index"
                                        >
                                            <td>
                                                <input
                                                    type="checkbox"
                                                    :value="`${brand.id}`"
                                                    v-model="selectMultiple"
                                                />
                                            </td>
                                            <td>{{ index + 1 }}</td>
                                            <td>
                                                <img
                                                    :src="brand.image"
                                                    style="width: 80px"
                                                    alt=""
                                                />
                                            </td>
                                            <td>{{ brand.name }}</td>
                                            <td>
                                                <span
                                                    v-if="
                                                        brand.status == 'active'
                                                    "
                                                    class="badge badge-pill badge-primary"
                                                    >{{ brand.status }}</span
                                                >

                                                <span
                                                    v-else
                                                    class="badge badge-pill badge-danger"
                                                    >{{ brand.status }}</span
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
                                                        name: 'brandEdit',
                                                        params: {
                                                            id: brand.id,
                                                        },
                                                    }"
                                                    class="btn btn-sm btn-info"
                                                    title="edit data"
                                                    ><i class="far fa-edit"></i>
                                                </router-link>
                                                <a
                                                    href=""
                                                    @click.prevent="
                                                        deletebrand(brand.id)
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
                                    v-if="brandSearchFilter.length == 0"
                                >
                                    <h6 class="text-center">
                                        Search No Result We're sorry. <br />
                                        We cannot find any matches for your
                                        search term.
                                    </h6>
                                </div>
                                <br />
                                <template v-if="brandSearchFilter.length !== 0">
                                    <pagination
                                        v-if="brands.total"
                                        v-model="current_page"
                                        :records="brands.total"
                                        :per-page="brands.per_page"
                                        @paginate="getBrands"
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
                                <h3 class="card-title">Add New brand</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form role="form" @submit.prevent="storeBrand">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"
                                            >brand Name</label
                                        >
                                        <input
                                            type="text"
                                            v-model="form.name"
                                            class="form-control"
                                            id="exampleInputEmail1"
                                            placeholder="Enter brand Name"
                                        />

                                        <span
                                            v-if="errors.name"
                                            class="text-danger"
                                            >{{ errors.name[0] }}</span
                                        >
                                    </div>

                                    <div class="form-group pb-5">
                                        <label for="exampleInputEmail1"
                                            >brand Image</label
                                        >

                                        <!-- <button
                                            class="btn btn-secondary"
                                            @click="showModal"
                                        >
                                            Open Bootstrap Modal
                                        </button> -->

                                        <div class="input-group pointer">
                                            <div class="input-group-prepend">
                                                <div
                                                    class="input-group-text bg-soft-secondary font-weight-medium"
                                                    @click="showModal"
                                                >
                                                    Browse
                                                </div>
                                            </div>
                                            <div class="form-control">
                                                Choose file
                                            </div>
                                            <!-- <div class="form-control" v-else>
                                                {{ form.image }} File Selected
                                            </div> -->
                                        </div>

                                        <!-- <div class="file-preview box sm"></div> -->

                                        <Gallery-modal
                                            v-if="displayModal"
                                            @close-modal-event="hideModal"
                                            :multiImg="getMultiImg"
                                        />

                                        <span
                                            v-if="errors.image"
                                            class="text-danger"
                                            >{{ errors.image[0] }}</span
                                        >

                                        <div
                                            class="form-group"
                                            v-if="form.image.length > 0"
                                        >
                                            <div class="show-image">
                                                <img
                                                    :src="form.image"
                                                    class="previewImage"
                                                    alt=""
                                                />

                                                <input
                                                    class="delete btn btn-sm btn-danger"
                                                    type="button"
                                                    value="X"
                                                    @click.prevent="
                                                        removeImage()
                                                    "
                                                />
                                            </div>
                                        </div>

                                        <!-- <div class="form-group">
                                            <div
                                                class="show-image"
                                                v-for="(dat, index) in form.image"
                                                :key="index"
                                            >
                                                <img
                                                    :src="dat"
                                                    class="previewImage"
                                                    alt=""
                                                />

                                                <input
                                                    class="delete btn btn-sm btn-danger"
                                                    type="button"
                                                    value="X"
                                                    @click.prevent="
                                                        removeImage(dat)
                                                    "
                                                />
                                            </div>
                                        </div> -->
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
    components: { CategorySkeleton, GalleryModal },
    data() {
        return {
            form: {
                name: "",
                image: "",
                status: "active",
            },
            errors: {},
            current_page: 1,
            searchTerm: "",
            selectMultiple: [],
            limit: 10,
            status: "active",
            displayModal: false,
        };
    },

    mounted() {
        document.title = "brand";
        this.getBrands();
    },

    methods: {
        getBrands() {
            this.$store.dispatch("brand/FETCH_DATA", {
                page: this.current_page,
                limit: this.limit,
                status: this.status,
            });
        },

        DeleteMultiple() {
            this.$store
                .dispatch("brand/MULTIPLE_DELETE", this.selectMultiple)
                .then((res) => {
                    if (res.data.status == true) {
                        this.selectMultiple = [];
                        this.getBrands();
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
            this.brandSearchFilter.map((item) => {
                this.selectMultiple.includes(item.id)
                    ? (this.selectMultiple = this.selectMultiple.filter(
                          (item2) => item2 != item.id
                      ))
                    : this.selectMultiple.push(item.id);
            });
        },

        showModal() {
            this.displayModal = true;
        },
        hideModal() {
            this.displayModal = false;
        },

        getMultiImg(imgs) {
            this.form.image = imgs[0];
        },

        removeImage() {
            this.form.image = "";
        },

        storeBrand() {
            this.$store
                .dispatch("brand/STORE_DATA", this.form)
                .then(() => {
                    this.getBrands();
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
                name: "",
                image: "",
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
                            .dispatch("brand/DELETE", Id)
                            .then((res) => {
                                if (res.data.status == true) {
                                    this.getBrands();
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
        brands() {
            return this.$store.getters["brand/GET_DATA"];
        },

        brandSearchFilter() {
            return this.brands.data.filter((brand) => {
                return brand.name.match(this.searchTerm);
            });
        },
    },
};
</script>
<style>

</style>
