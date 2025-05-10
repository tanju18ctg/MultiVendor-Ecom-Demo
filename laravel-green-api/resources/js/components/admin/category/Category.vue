<template>
    <div>
        <div class="container-fluid">
            <!-- left column -->

            <template v-if="categories.data">
                <div class="row" id="axiosForm">
                    <div class="loader" v-if="loading"></div>
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Category list</h3>
                                <span
                                    class="badge badge-success float-right p-2"
                                >
                                    Total
                                </span>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-2">
                                        <select
                                            class="form-control"
                                            v-model="limit"
                                            @change="getCategories"
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
                                            @change="getCategories"
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
                                                <button class="btn btn-sm btn-danger" @click="selectAll"
                                                    >Select All</button
                                                >
                                            </th>
                                            <th>SL</th>
                                            <th>Image</th>
                                            <th>Category Name</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr
                                            v-for="(
                                                cat, index
                                            ) in categorySearchFilter"
                                            :key="index"
                                        >
                                            <td>
                                                <input
                                                    type="checkbox"
                                                    :value="`${cat.id}`"
                                                    v-model="selectMultiple"
                                                />
                                            </td>
                                            <td>{{ index + 1 }}</td>
                                            <td>
                                                <img
                                                    :src="cat.image"
                                                    style="width: 80px"
                                                    alt=""
                                                />
                                            </td>
                                            <td>{{ cat.name }}</td>
                                            <td>
                                                <span
                                                    v-if="
                                                        cat.status == 'active'
                                                    "
                                                    class="badge badge-pill badge-primary"
                                                    >{{ cat.status }}</span
                                                >

                                                <span
                                                    v-else
                                                    class="badge badge-pill badge-danger"
                                                    >{{ cat.status }}</span
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
                                                        name: 'editCategory',
                                                        params: { id: cat.id },
                                                    }"
                                                    class="btn btn-sm btn-info"
                                                    title="edit data"
                                                    ><i class="far fa-edit"></i>
                                                </router-link>
                                                <a
                                                    href=""
                                                    @click.prevent="
                                                        deleteCategory(cat.id)
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
                                    v-if="categorySearchFilter.length == 0"
                                >
                                    <h6 class="text-center">
                                        Search No Result We're sorry. <br />
                                        We cannot find any matches for your
                                        search term.
                                    </h6>
                                </div>
                                <br />
                                <template
                                    v-if="categorySearchFilter.length !== 0"
                                >
                                    <pagination
                                        v-if="categories.total"
                                        v-model="current_page"
                                        :records="categories.total"
                                        :per-page="categories.per_page"
                                        @paginate="getCategories"
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
                                <h3 class="card-title">Add New Category</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form role="form" @submit.prevent="storeCategory">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"
                                            >Category Name</label
                                        >
                                        <input
                                            type="text"
                                            v-model="form.name"
                                            class="form-control"
                                            id="exampleInputEmail1"
                                            placeholder="Enter Category Name"
                                        />

                                        <span
                                            v-if="errors.name"
                                            class="text-danger"
                                            >{{ errors.name[0] }}</span
                                        >
                                    </div>

                                    <div class="form-group">
                                        <div class="mb-3 form-check">
                                            <input
                                                type="checkbox"
                                                class="form-check-input"
                                                id="exampleCheck1"
                                                v-model="form.status"
                                            />
                                            <label
                                                class="form-check-label"
                                                for="exampleCheck1"
                                                >Active</label
                                            >
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputEmail1"
                                            >Category Image</label
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

                                    <!-- <div class="form-group">
                                        <label for="enterImage">Image</label>
                                        <input
                                            type="file"
                                            class="form-control"
                                            id="enterImage"
                                             @change="handleImage"
                                        />

                                        <span
                                            v-if="errors.image"
                                            class="text-danger"
                                            >{{ errors.image[0] }}</span
                                        >

                                        <div class="show-image">
                                        <img
                                            v-if="previewPhoto"
                                            :src="previewPhoto"
                                            class="previewImage"
                                            alt=""
                                        />

                                        <input
                                            class="delete btn btn-sm btn-danger"
                                            type="button"
                                            value="X"
                                            @click.prevent="removePhoto"
                                        />
                                    </div>
                                    </div> -->
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
                status: false,
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
        document.title = "Category";
        this.getCategories();
    },

    methods: {
        getCategories() {
            this.$store.dispatch("category/FETCH_CATEGORIES", {
                page: this.current_page,
                limit: this.limit,
                status: this.status,
            });
        },

        DeleteMultiple() {
            this.$store
                .dispatch("category/MULTIPLE_DELETE", this.selectMultiple)
                .then((res) => {
                    if (res.data.status == true) {
                        this.selectMultiple = [];
                        this.getCategories();
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
            this.categorySearchFilter.map((item) => {
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
            // this.form.image.includes(image)
            //     ? (this.form.image = this.form.image.filter((Item) => Item != image))
            //     : 0;
        },

        // removePhoto() {
        //     this.form.image = "";
        //     this.previewPhoto = "";
        // },
        // handleImage(e) {
        //     this.form.image = e.target.files[0];
        //     let file = e.target.files[0];
        //     console.log(e.target.files[0]);

        //     if (file.size > 1048770) {
        //         alert("Image Size Must be Less Than 1Mb");
        //     } else {
        //         let reader = new FileReader();
        //         reader.onload = (event) => {
        //             this.previewPhoto = event.target.result;
        //         };
        //         reader.readAsDataimage(file);
        //     }
        // },

        storeCategory() {
            // let formData = new FormData();
            // formData.append("name", this.form.name);
            // formData.append("image", this.form.image);
            // formData.append("status", this.form.status);

            this.$store
                .dispatch("category/STORE_CATEGORIES", this.form)
                .then(() => {
                    this.getCategories();
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
                status: false,
            }),
                (this.errors = {});
        },

        deleteCategory(Id) {
            this.$swal
                .fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                })
                .then((result) => {
                    if (result.isConfirmed) {
                        this.$store
                            .dispatch("category/DELETE_CATEGORY", Id)
                            .then((res) => {
                                if (res.data.status == true) {
                                    // this.getCategories();s
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
        categories() {
            return this.$store.getters["category/GET_CATEGORIES"];
        },

        categorySearchFilter() {
            return this.categories.data.filter((category) => {
                return category.name.match(this.searchTerm);
            });
        },
    },
};
</script>
<style>
.previewImage {
    margin-top: 5px;
    width: 100px;
    border: 2px solid #0d6efd;
    border-radius: 5%;
}
div.show-image {
    position: relative;
    float: left;
    margin-right: 5px;
}
div.show-image:hover img {
    opacity: 0.5;
}

div.show-image:hover input {
    display: block;
}

div.show-image input {
    position: absolute;
    display: none;
}
div.show-image input.delete {
    top: 0;
    left: 0;
}

.pointer {
    cursor: pointer;
}
</style>
