<template>
    <div>
        <div class="container-fluid">
            <!-- left column -->

            <template v-if="sliders.data">
                <div class="row" id="axiosForm">
                    <div class="loader" v-if="loading"></div>
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Slider list</h3>
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
                                            <th>SL</th>
                                            <th>Image</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr
                                            v-for="(sl, index) in sliders.data"
                                            :key="index"
                                        >
                                            <td>
                                                <input
                                                    type="checkbox"
                                                    :value="`${sl.id}`"
                                                    v-model="selectMultiple"
                                                />
                                            </td>
                                            <td>{{ index + 1 }}</td>
                                            <td>
                                                <img
                                                    :src="sl.image"
                                                    style="width: 80px"
                                                    alt=""
                                                />
                                            </td>
                                            <td>
                                                <span
                                                    v-if="sl.status == 'active'"
                                                    class="badge badge-pill badge-primary"
                                                    >{{ sl.status }}</span
                                                >

                                                <span
                                                    v-else
                                                    class="badge badge-pill badge-danger"
                                                    >{{ sl.status }}</span
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
                                                        name: 'sliderEdit',
                                                        params: {
                                                            id: sl.id,
                                                        },
                                                    }"
                                                    class="btn btn-sm btn-info"
                                                    title="edit data"
                                                    ><i class="far fa-edit"></i>
                                                </router-link>
                                                <a
                                                    href=""
                                                    @click.prevent="
                                                        deleteSlider(sl.id)
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
                                    v-if="sliders.data.length == 0"
                                >
                                    <h6 class="text-center">
                                        Search No Result We're sorry. <br />
                                        We cannot find any matches for your
                                        search term.
                                    </h6>
                                </div>
                                <br />
                                <template v-if="sliders.data.length !== 0">
                                    <pagination
                                        v-if="sliders.total"
                                        v-model="current_page"
                                        :records="sliders.total"
                                        :per-page="sliders.per_page"
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
                                <h3 class="card-title">Add New Slider</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form role="form" @submit.prevent="storeSlider">
                                <div class="card-body">
                                    <div class="form-group pb-5">
                                        <label for="exampleInputEmail1"
                                            >Slider Image</label
                                        >

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
                                        </div>

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
                image: "",
                status: "active",
            },
            errors: {},
            current_page: 1,
            selectMultiple: [],
            limit: 10,
            status: "active",
            displayModal: false,
        };
    },

    mounted() {
        document.title = "Slider";
        this.getData();
    },

    methods: {
        getData() {
            this.$store.dispatch("slider/FETCH_DATA", {
                page: this.current_page,
                limit: this.limit,
                status: this.status,
            });
        },

        DeleteMultiple() {
            this.$store
                .dispatch("slider/MULTIPLE_DELETE", this.selectMultiple)
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
            this.sliders.data.map((item) => {
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

        storeSlider() {
            this.$store
                .dispatch("slider/STORE_DATA", this.form)
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
                image: "",
                status: "active",
            }),
                (this.errors = {});
        },

        deleteSlider(Id) {
            this.$swal
                .fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                })
                .then((result) => {
                    if (result.isConfirmed) {
                        this.$store
                            .dispatch("slider/DELETE", Id)
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
        sliders() {
            return this.$store.getters["slider/GET_DATA"];
        },
    },
};
</script>
<style></style>
