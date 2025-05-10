<template>
    <div class="bootstrap-modal-no-jquery">
        <div class="modal" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg modal-adaptive" role="document">
                <div class="modal-content h-100">
                    <div class="modal-header pb-0 bg-light">
                        <div class="uppy-modal-nav">
                            <ul class="nav nav-tabs border-0">
                                <li class="nav-item">
                                    <a
                                        class="nav-link font-weight-medium text-dark active"
                                        data-toggle="tab"
                                        href="#select-file"
                                        @click="actionImages"
                                        >Select File</a
                                    >
                                </li>
                                <li class="nav-item">
                                    <a
                                        class="nav-link font-weight-medium text-dark"
                                        data-toggle="tab"
                                        href="#upload-new"
                                        >Upload New</a
                                    >
                                </li>
                            </ul>
                        </div>
                        <button
                            type="button"
                            class="close"
                            data-dismiss="modal"
                            aria-label="Close"
                            @click="closeModal"
                        >
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="tab-content h-100">
                            <div class="tab-pane h-100 active" id="select-file">
                                <div
                                    class="aiz-uploader-filter pt-1 pb-3 border-bottom mb-4"
                                >
                                    <div
                                        class="row align-items-center gutters-5 gutters-md-10 position-relative"
                                    >
                                        <div class="col-xl-2 col-md-3 col-5">
                                            <div class="">
                                                <!-- Input -->
                                                <select
                                                    class="form-control form-control-xs aiz-selectpicker"
                                                    name="aiz-uploader-sort"
                                                    v-model="sort"
                                                    @change="actionImages"
                                                >
                                                    <option value="Asc">
                                                        Sort by Oldest
                                                    </option>
                                                    <option value="Desc">
                                                        Sort by Newest
                                                    </option>
                                                </select>
                                                <!-- End Input -->
                                            </div>
                                        </div>
                                          <div class="col-md-2 col-5">
                                            <div class="">
                                                <!-- Input -->
                                                <select
                                                    class="form-control form-control-xs"
                                                    v-model="type"
                                                    @change="actionImages"
                                                >
                                                    <option value="product">
                                                        Products
                                                    </option>
                                                    <option value="category">
                                                        Categories
                                                    </option>

                                                    <option value="brand">
                                                        Brands
                                                    </option>


                                                </select>
                                                <!-- End Input -->
                                            </div>
                                        </div>
                                        <div class="col-md-2 col-5">
                                            <div class="">
                                                <!-- Input -->
                                                <select
                                                    class="form-control form-control-xs"
                                                    v-model="limit"
                                                    @change="actionImages"
                                                >
                                                    <option value="30">
                                                        30
                                                    </option>
                                                    <option value="60">
                                                        60
                                                    </option>

                                                    <option value="90">
                                                        90
                                                    </option>

                                                    <option value="120">
                                                        120
                                                    </option>

                                                    <option value="180">
                                                        180
                                                    </option>

                                                    <option value="540">
                                                        540
                                                    </option>
                                                </select>
                                                <!-- End Input -->
                                            </div>
                                        </div>
                                        <div
                                            class="col-md-4 col-xl-3 ml-auto mr-0 col-2 position-static"
                                        >
                                         <p class="mb-2">showing <span v-if="images.data">{{images.data.length}} of {{images.total}}</span></p>
                                            <!-- <div
                                                class="aiz-uploader-search text-right"
                                            >
                                                <input
                                                    type="text"
                                                    class="form-control form-control-xs"
                                                    name="aiz-uploader-search"
                                                    placeholder="Search your files"
                                                />
                                                <i class="search-icon d-md-none"
                                                    ><span></span
                                                ></i>
                                            </div> -->
                                        </div>
                                    </div>
                                </div>
                                <div
                                    class="aiz-uploader-all clearfix c-scrollbar-light"
                                >
                                    <div class="row">
                                        <div
                                            class="col-md-2"
                                            v-for="(img, index) in images.data"
                                            :key="index"
                                        >
                                            <div class="gallery-card">
                                                <div class="gallery-card-body">
                                                    <label class="block-check">
                                                        <img
                                                            :src="img.url"
                                                            class="img-responsive img-rounded"
                                                        />
                                                        <input
                                                            type="checkbox"
                                                            :value="img.url"
                                                            v-model="selectData"
                                                        />
                                                        <span
                                                            class="checkmark"
                                                        ></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- <el-upload
                                        action="http://127.0.0.1:8000/api/v1/upload"
                                        list-type="picture-card"
                                        multiple
                                        :on-preview="handlePictureCardPreview"
                                        :on-remove="handleRemove"
                                        :file-list="fileList"
                                    >

                                        <el-icon><Plus /></el-icon>
                                    </el-upload>
                                    <el-dialog v-model="dialogVisible">
                                        <img
                                            w-full
                                            :src="dialogImageUrl"
                                            alt="Preview Image"
                                        />
                                    </el-dialog> -->
                                </div>
                            </div>

                            <div class="tab-pane h-100" id="upload-new">
                                <div id="aiz-upload-files" class="h-100">
                                    <div
                                        class="uppy-Root uppy-Dashboard uppy-Dashboard--animateOpenClose uppy-Dashboard--isInnerWrapVisible"
                                        aria-hidden="false"
                                        aria-label="File Uploader"
                                    >
                                        <div
                                            class="uppy-Dashboard-overlay"
                                            tabindex="-1"
                                        ></div>
                                        <div
                                            class="uppy-Dashboard-inner aiz-uploader-all"
                                            style="height: 550px"
                                        >
                                            <div>
                                                <!-- <el-upload
                                                    action="http://127.0.0.1:8000/api/v1/upload"
                                                    list-type="picture-card"
                                                    :on-preview="handlePictureCardPreview "
                                                    :on-remove="handleRemove"
                                                    :file-list="fileList"
                                                    multiple
                                                    :limit="100"
                                                >
                                                    <el-icon><Plus /></el-icon>
                                                </el-upload>

                                                <el-dialog
                                                    v-model="dialogVisible"
                                                >
                                                    <img
                                                        w-full
                                                        :src="dialogImageUrl"
                                                        alt="Preview Image"
                                                    />
                                                </el-dialog> -->

                                            <new-upload></new-upload>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between bg-light">
                        <div class="flex-grow-1 overflow-hidden d-flex">
                            <div class="">
                                <div class="aiz-uploader-selected">
                                    {{ selectData.length }} File selected
                                </div>
                                <button
                                    type="button"
                                    class="btn-link btn btn-sm p-0"
                                    @click="clearSelectData"
                                >
                                    Clear
                                </button>
                            </div>
                            <div class="mb-0 ml-3">
                                <button
                                    type="button"
                                    class="btn btn-sm btn-primary mr-2"
                                    :disabled="
                                        images.prev_page_url == null
                                            ? true
                                            : false
                                    "
                                    @click.prevent="
                                        changePage(images.current_page - 1)
                                    "
                                >
                                    Prev {{ images.current_page - 1 }}
                                </button>
                                <button
                                    type="button"
                                    class="btn btn-sm btn-primary"
                                    :disabled="
                                        images.next_page_url == null
                                            ? true
                                            : false
                                    "
                                    @click.prevent="
                                        changePage(images.current_page + 1)
                                    "
                                >
                                    Next {{ images.current_page }}
                                </button>
                                <!-- <el-pagination
                                background
                                v-model:currentPage="currentPage"
                                layout="prev, pager, next"
                                :total="images.total"
                                :page-size="images.per_page"
                                @current-change="actionImages"
                            /> -->
                            </div>
                        </div>
                        <button
                            type="button"
                            class="btn btn-sm btn-primary"
                            data-toggle="aizUploaderAddSelected"
                            :disabled="selectData.length == 0 ? true : false"
                            @click="multiImg(selectData)"
                        >
                            Add Files
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { Plus } from "@element-plus/icons-vue";
import { ref } from "vue";
import NewUpload from './admin/filemanager/NewUpload.vue';
export default {
    components: { Plus,NewUpload },
    data() {
        return {
            dialogImageUrl: ref(""),
            dialogVisible: ref(false),
            limit: 30,
            currentPage: 1,
            sort: "Desc",
             type: "product",
            selectData: [],

        };
    },

    created() {
        this.actionImages();
    },
    methods: {
        //for modal
        closeModal() {
            this.$emit("close-modal-event");
        },
        saveChanges() {
            this.closeModal();
        },

        //for modal

        handlePictureCardPreview(uploadFile) {
            this.dialogImageUrl = uploadFile.url;
            this.dialogVisible = true;
        },

        handleRemove(uploadFile) {
            console.log(uploadFile);
            let photo = JSON.parse(JSON.stringify(uploadFile.response));

            this.$store
                .dispatch("category/REMOVE_PHOTO", { photo: photo })
                .then((res) => {
                    console.log(res.data);
                })
                .catch((err) => {
                    console.log(err);
                });
        },

        // fetch all images
        actionImages() {
            this.$store
                .dispatch("file_manager/FETCH_FILES", {
                    page: this.currentPage,
                    limit: this.limit,
                    sort: this.sort,
                    type: this.type,
                })
                .then((res) => {
                    console.log(res.data);
                })
                .catch((err) => {
                    console.log(err);
                });
        },

        clearSelectData() {
            this.selectData = [];
        },

        changePage(page) {
            this.currentPage = page;
            // this.$emit('paginate');
            this.actionImages();
        },

        // addFiles(){
        //     this.closeModal();
        // }
    },

    props: {
        multiImg: Function,
    },

    computed: {
        images() {
            return this.$store.getters["file_manager/GET_FILES"];
        },
    },
};
</script>

<style scoped>
/* Override default value of 'none' */
.modal {
    display: block;
}

@media (min-width: 1200px) {
    .modal-adaptive {
        max-width: 1140px;
    }
}

@media (min-width: 992px) {
    .modal-adaptive {
        max-width: 960px;
    }
}
@media (min-width: 768px) {
    .modal-adaptive {
        max-width: 720px;
    }
}
@media (min-width: 576px) {
    .modal-adaptive {
        max-width: 540px;
    }
}
.modal-adaptive {
    max-width: 1140px;
}

.aiz-uploader-all {
    margin-left: -10px;
    margin-right: -10px;
    overflow-y: auto;
    height: calc(100vh - 303px);
}

.aiz-file-box {
    position: relative;
}

.aiz-file-box .card-file .card-file-thumb {
    position: absolute;
    width: calc(100% - 16px);
    top: 8px;
    left: 8px;
    height: calc(100% - 55px);
}

.card-file .card-file-thumb {
    height: 120px;
    background-color: #f5f6fa;
    display: flex;
    align-items: center;
    justify-content: center;
}
*,
::after,
::before {
    box-sizing: border-box;
}

.img-fit {
    max-height: 100%;
    width: 100%;
    object-fit: cover;
}

img {
    vertical-align: middle;
    border-style: none;
}

.text-truncate {
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}

.flex-shrink-0 {
    -ms-flex-negative: 0 !important;
    flex-shrink: 0 !important;
}

.aiz-file-box .card-file .card-body {
    /* position: absolute; */
    width: calc(100% - 16px);
    bottom: 5px;
    left: 8px;
}

.aiz-file-box .card-file {
    cursor: pointer;
    overflow: hidden;
    /* position: absolute; */
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    opacity: 1;
}

.card-file {
    padding: 8px;
    /* position: relative; */
    border-color: rgb(223, 224, 228);
    transition: all 0.2s ease-in-out;
    margin-bottom: 20px;
}

@media (min-width: 1200px) {
    .aiz-file-box-wrap {
        width: 16.66666%;
    }
}

@media (min-width: 1200px) {
    .aiz-file-box-wrap {
        width: 16.66666%;
    }
}

@media (min-width: 992px) {
    .aiz-file-box-wrap {
        width: 20%;
    }
}
@media (min-width: 768px) {
    .aiz-file-box-wrap {
        width: 25%;
    }
}

@media (min-width: 576px) {
    .aiz-file-box-wrap {
        width: 33.3333%;
    }
}

.aiz-file-box-wrap {
    padding: 0 10px;
    width: 16.66666%;
    float: left;
}

*,
::after,
::before {
    box-sizing: border-box;
}

a {
    color: #fff;
    text-decoration: none;
}
a:hover {
    color: #fff;
    text-decoration: none;
}
/*--choice modal1--*/

.openbtn {
    margin-top: 80px;
}
.modal-header {
    padding: 15px;
    border-bottom: none;
}
.modal-title {
    font-weight: bold;
}
.modal-body.choice-modal {
    position: relative;
    padding: 0px;
}

.row.inner-scroll {
    height: 445px;
    overflow: auto;
}

.mycard-footer {
    height: 25px;
    background: #333333;
    font-size: 15px;
    text-indent: 10px;
    /* border-radius: 0 0px 4px 4px;*/
}

.gallery-card {
    position: relative;
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-orient: vertical;
    -webkit-box-direction: normal;
    -ms-flex-direction: column;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    background-color: #fff;
    background-clip: border-box;
    border: 1px solid rgba(0, 0, 0, 0.125);
    border-radius: 0.25rem;
    height: 132px;
    margin-bottom: 14px;
}
.gallery-card-body {
    -webkit-box-flex: 1;
    -ms-flex: 1 1 auto;
    flex: 1 1 auto;
    padding: 10px;
}
.gallery-card img {
    height: 100px;
    width: 100%;
}
label {
    margin-bottom: 0 !important;
}
/*--checkbox--*/

.block-check {
    display: block;
    position: relative;

    cursor: pointer;
    font-size: 22px;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
}

/* Hide the browser's default checkbox */
.block-check input {
    position: absolute;
    opacity: 0;
    cursor: pointer;
}

/* Create a custom checkbox */
.checkmark {
    position: absolute;
    top: 0;
    left: 0;
    height: 25px;
    width: 25px;
    background-color: #eee;
    cursor: pointer;
}

/* On mouse-over, add a grey background color */
.block-check:hover input ~ .checkmark {
    background-color: #ccc;
}

/* When the checkbox is checked, add a blue background */
.block-check input:checked ~ .checkmark {
    background-color: #2196f3;
}

/* Create the checkmark/indicator (hidden when not checked) */
.checkmark:after {
    content: "";
    position: absolute;
    display: none;
}

/* Show the checkmark when checked */
.block-check input:checked ~ .checkmark:after {
    display: block;
}

/* Style the checkmark/indicator */
.block-check .checkmark:after {
    left: 9px;
    top: 5px;
    width: 5px;
    height: 10px;
    border: solid white;
    border-width: 0 3px 3px 0;
    -webkit-transform: rotate(45deg);
    -ms-transform: rotate(45deg);
    transform: rotate(45deg);
}

/*--checkbox css end--*/

.row {
    margin-right: 0px;
    margin-left: 0px;
}
</style>
