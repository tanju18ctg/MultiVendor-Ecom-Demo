<template>
    <div>
        <div class="container-fluid">
            <template v-if="categories.data">
                <div class="row">
                    <!-- left column -->
                    <!-- general form elements -->
                    <div class="col-md-12">
                        <form @submit.prevent="updateProduct">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Add Product</h3>
                                    <!-- <router-link
                                        :to="{ name: 'Product' }"
                                        class="btn btn-sm btn-info float-right p-2"
                                    >
                                        All Products
                                    </router-link> -->
                                </div>

                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="ProuductName"
                                                    >Product Name</label
                                                >
                                                <input
                                                    type="text"
                                                    class="form-control"
                                                    id="ProuductName"
                                                    placeholder="product name"
                                                    v-model="form.name"
                                                />

                                                <span
                                                    v-if="errors.name"
                                                    class="text-danger"
                                                    >{{ errors.name[0] }}</span
                                                >
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="pPrice"
                                                    >Product Price</label
                                                >
                                                <input
                                                    type="text"
                                                    class="form-control"
                                                    id="pPrice"
                                                    placeholder="price"
                                                    v-model="form.price"
                                                />

                                                <span
                                                    v-if="errors.price"
                                                    class="text-danger"
                                                    >{{ errors.price[0] }}</span
                                                >
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="pPrice"
                                                    >Product Discount (%)</label
                                                >
                                                <input
                                                    type="text"
                                                    class="form-control"
                                                    id="pPrice"
                                                    min="1"
                                                    max="99"
                                                    placeholder="discount %"
                                                    v-model="form.discount"
                                                />

                                                <span
                                                    v-if="errors.discount"
                                                    class="text-danger"
                                                    >{{
                                                        errors.discount[0]
                                                    }}</span
                                                >
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="pstock"
                                                    >Product Stock</label
                                                >
                                                <input
                                                    type="text"
                                                    class="form-control"
                                                    id="pstock"
                                                    placeholder="stock qty"
                                                    v-model="form.stock"
                                                />

                                                <span
                                                    v-if="errors.stock"
                                                    class="text-danger"
                                                    >{{ errors.stock[0] }}</span
                                                >
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card card-default">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1"
                                                    >Thumbnail Image</label
                                                >

                                                <div
                                                    class="input-group pointer"
                                                >
                                                    <div
                                                        class="input-group-prepend"
                                                    >
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
                                                    @close-modal-event="
                                                        hideModal
                                                    "
                                                    :multiImg="getMultiImg"
                                                />

                                                <span
                                                    v-if="errors.thumbnail"
                                                    class="text-danger"
                                                    >{{
                                                        errors.thumbnail[0]
                                                    }}</span
                                                >

                                                <div
                                                    class="form-group"
                                                    v-if="
                                                        form.thumbnail.length >
                                                        0
                                                    "
                                                >
                                                    <div class="show-image">
                                                        <img
                                                            :src="
                                                                form.thumbnail
                                                            "
                                                            class="previewImage"
                                                            alt=""
                                                        />

                                                        <input
                                                            class="delete btn btn-sm btn-danger"
                                                            type="button"
                                                            value="X"
                                                            @click.prevent="
                                                                removeThumbnail()
                                                            "
                                                        />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1"
                                                    >Gallery Image</label
                                                >

                                                <div
                                                    class="input-group pointer"
                                                >
                                                    <div
                                                        class="input-group-prepend"
                                                    >
                                                        <div
                                                            class="input-group-text bg-soft-secondary font-weight-medium"
                                                            @click="showModal"
                                                        >
                                                            Browse
                                                        </div>
                                                    </div>
                                                    <div
                                                        class="form-control"
                                                        v-if="
                                                            form.image.length >
                                                            0
                                                        "
                                                    >
                                                        {{ form.image.length }}
                                                        File Selected
                                                    </div>
                                                    <div
                                                        class="form-control"
                                                        v-else
                                                    >
                                                        Choose file
                                                    </div>
                                                </div>

                                                <Gallery-modal
                                                    v-if="displayModal"
                                                    @close-modal-event="
                                                        hideModal
                                                    "
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
                                                    <div
                                                        class="show-image"
                                                        v-for="(
                                                            img, index
                                                        ) in form.image"
                                                        :key="index"
                                                    >
                                                        <img
                                                            :src="img"
                                                            class="previewImage"
                                                            alt=""
                                                        />

                                                        <input
                                                            class="delete btn btn-sm btn-danger"
                                                            type="button"
                                                            value="X"
                                                            @click.prevent="
                                                                removeGalleryImage(
                                                                    img
                                                                )
                                                            "
                                                        />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.row -->
                                </div>
                                <!-- /.card-body -->
                            </div>

                            <div class="card card-default">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1"
                                                    >Descripton</label
                                                >

                                                <quill-editor
                                                    v-model:content="
                                                        form.description
                                                    "
                                                    contentType="html"
                                                    toolbar="full"
                                                    theme="snow"
                                                />
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.row -->
                                </div>
                                <!-- /.card-body -->
                            </div>

                            <div class="card card-default">
                                <div class="card-body">
                                    <div class="row">
                                        <!-- <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1"
                                                    >Select Size</label
                                                >

                                                <el-select
                                                    v-model="form.size"
                                                    multiple
                                                    placeholder="Select Size"
                                                    class="form-control"
                                                >
                                                    <el-option
                                                        v-for="item in sizes.data"
                                                        :key="item.id"
                                                        :label="item.name"
                                                        :value="item.name"
                                                    />
                                                </el-select>

                                                <span
                                                    v-if="errors.size"
                                                    class="text-danger"
                                                    >{{ errors.size[0] }}</span
                                                >
                                            </div>
                                        </div> -->

                                        <!-- <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1"
                                                    >Select Color</label
                                                >

                                                <el-select
                                                    v-model="form.color"
                                                    multiple
                                                    placeholder="Select color"
                                                    class="form-control"
                                                >
                                                    <el-option
                                                        v-for="item in colors.data"
                                                        :key="item.id"
                                                        :label="item.name"
                                                        :value="item.name"
                                                    />
                                                </el-select>
                                                <span
                                                    v-if="errors.color"
                                                    class="text-danger"
                                                    >{{ errors.color[0] }}</span
                                                >
                                            </div>
                                        </div> -->

                                        <!-- <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1"
                                                    >Select Category</label
                                                >

                                                <select
                                                    class="form-control"
                                                    v-model="form.category_id"
                                                    @change="fetchSubCategory"
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
                                                                cat.subcats
                                                                    .length
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

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1"
                                                    >Select SubCategory</label
                                                >

                                                <select
                                                    class="form-control"
                                                    v-model="
                                                        form.subcategory_id
                                                    "
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
                                                            subcat, index
                                                        ) in subcategories.data"
                                                        :key="index"
                                                        :value="subcat.id"
                                                    >
                                                        {{ subcat.name }}
                                                    </option>
                                                </select>

                                                <span
                                                    v-if="errors.subcategory_id"
                                                    class="text-danger"
                                                    >{{
                                                        errors.subcategory_id[0]
                                                    }}</span
                                                >
                                            </div>
                                        </div> -->

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1"
                                                    >Select Brand</label
                                                >

                                                <select
                                                    class="form-control"
                                                    v-model="form.brand_id"
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
                                                            brand, index
                                                        ) in brands.data"
                                                        :key="index"
                                                        :value="brand.id"
                                                    >
                                                        {{ brand.name }}
                                                    </option>
                                                </select>

                                                <span
                                                    v-if="errors.brand_id"
                                                    class="text-danger"
                                                    >{{
                                                        errors.brand_id[0]
                                                    }}</span
                                                >
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1"
                                                    >Select Conditions</label
                                                >

                                                <select
                                                    class="form-control"
                                                    v-model="form.conditions"
                                                >
                                                    <option
                                                        value=""
                                                        selected
                                                        disabled
                                                    >
                                                        Select One
                                                    </option>
                                                    <option value="new">
                                                        New
                                                    </option>

                                                    <option value="popular">
                                                        Popular
                                                    </option>

                                                    <option value="winter">
                                                        Winter
                                                    </option>

                                                    <option value="feature">
                                                        Feature
                                                    </option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1"
                                                    >Status</label
                                                >

                                                <select
                                                    class="form-control"
                                                    v-model="form.status"
                                                >
                                                    <option
                                                        value=""
                                                        selected
                                                        disabled
                                                    >
                                                        Select One
                                                    </option>
                                                    <option value="active">
                                                        Publish
                                                    </option>

                                                    <option value="inactive">
                                                        Unpublish
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.row -->
                                </div>
                                <!-- /.card-body -->
                            </div>

                            <div class="card-footer">
                                <button
                                    class="btn btn-info"
                                    :disabled="loading"
                                >
                                    {{
                                        loading == true
                                            ? "Saving.."
                                            : " Save Product"
                                    }}
                                    <i
                                        class="fas fa-spinner fa-spin"
                                        v-if="loading"
                                    ></i>
                                </button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
            </template>

            <template v-else>
                <Table-skeleton />
            </template>
        </div>
    </div>
</template>
<script>
import TableSkeleton from "../../../components/skeleton/TableSkeleton.vue";
import GalleryModal from "../filemanager/GalleryModal.vue";
import { ElNotification } from "element-plus";
export default {
    components: { TableSkeleton, GalleryModal },
    data() {
        return {
            form: {
                name: "",
                category_id: "",
                subcategory_id: "",
                brand_id: "",
                color: [],
                size: [],
                description: "",
                stock: "",
                thumbnail: "",
                image: [],
                conditions: "",
                status: "",
            },
            errors: {},
            displayModal: false,
            loading: false,
        };
    },

    mounted() {
         document.title = "edit product";
        this.fetchCategory();
        this.fetchBrand();
        this.fetchSize();
        this.fetchColor();
        this.editProduct();
    },

    methods: {
        fetchCategory() {
            this.$store.dispatch("mixed/FETCH_CATEGORY_NO_PAGINATE");
        },

        fetchSubCategory() {
            this.$store
                .dispatch(
                    "mixed/FETCH_SUBCATEGORY_NO_PAGINATE",
                    this.form.category_id
                )
                .then((res) => {
                    if (res.data.status == true) {
                        this.form.subcategory_id = "";
                    }
                })
                .catch(() => {});
        },

        fetchBrand() {
            this.$store.dispatch("mixed/FETCH_BRAND_NO_PAGINATE");
        },

        fetchSize() {
            this.$store.dispatch("mixed/FETCH_SIZE_NO_PAGINATE");
        },

        fetchColor() {
            this.$store.dispatch("mixed/FETCH_COLOR_NO_PAGINATE");
        },

        showModal() {
            this.displayModal = true;
        },
        hideModal() {
            this.displayModal = false;
        },

        getMultiImg(imgs) {
            if (imgs.length > 1) {
                this.form.image = imgs;
            } else {
                this.form.thumbnail = imgs[0];
            }
        },

        removeGalleryImage(image) {
            this.form.image.includes(image)
                ? (this.form.image = this.form.image.filter(
                      (Item) => Item != image
                  ))
                : 0;
        },

        removeThumbnail() {
            this.form.thumbnail = "";
        },

        editProduct() {
            this.$store
                .dispatch("product/EDIT_DATA", this.$route.params.id)
                .then((res) => {
                    this.form = res.data.data;
                })
                .catch(() => {
                    this.$router.push({ name: "AllProducts" });
                });
        },
        updateProduct() {
            this.loading = true;
            this.$store
                .dispatch("product/UPDATE_DATA", {
                    form: this.form,
                    id: this.$route.params.id,
                })
                .then((res) => {
                    if (res.data.status == true) {
                        this.$router.push({ name: "AllProducts" });
                        ElNotification({
                            title: "Success",
                            message: "Product Update Success",
                            type: "success",
                            showClose: false,
                        });
                    }
                })
                .catch((err) => {
                    this.errors = err.response.data.errors;
                })
                .finally(() => {
                    this.loading = false;
                });
        },

        clearForm() {
            this.form = {
                name: "",
                category_id: "",
                subcategory_id: "",
                brand_id: "",
                color: [],
                size: [],
                description: "",
                stock: "",
                thumbnail: "",
                image: [],
                conditions: "",
                status: "",
            };
            this.errors = {};
        },
    },

    computed: {
        categories() {
            return this.$store.getters["mixed/GET_CATEGORY_DATA"];
        },

        subcategories() {
            return this.$store.getters["mixed/GET_SUBCATEGORY_DATA"];
        },

        brands() {
            return this.$store.getters["mixed/GET_BRAND_DATA"];
        },

        sizes() {
            return this.$store.getters["mixed/GET_SIZE_DATA"];
        },

        colors() {
            return this.$store.getters["mixed/GET_COLOR_DATA"];
        },
    },
};
</script>
<style></style>
