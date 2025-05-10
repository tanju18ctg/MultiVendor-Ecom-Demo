<template>
    <div>
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Upload New Files</h3>
                <router-link
                    :to="{ name: 'fileManager' }"
                    class="btn btn-sm btn-default"
                    style="float: right"
                    >Back to Uploaded Files</router-link
                >
            </div>
            <div class="card-body">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a
                            class="nav-link active"
                            id="product-tab"
                            data-toggle="tab"
                            href="#product"
                            role="tab"
                            aria-controls="product"
                            aria-selected="true"
                            >Proudct</a
                        >
                    </li>

                    <li class="nav-item">
                        <a
                            class="nav-link"
                            id="category-tab"
                            data-toggle="tab"
                            href="#category"
                            role="tab"
                            aria-controls="category"
                            aria-selected="false"
                            >Category</a
                        >
                    </li>

                    <li class="nav-item">
                        <a
                            class="nav-link"
                            id="brand-tab"
                            data-toggle="tab"
                            href="#brand"
                            role="tab"
                            aria-controls="brand"
                            aria-selected="false"
                            >Brand</a
                        >
                    </li>

                     <li class="nav-item">
                        <a
                            class="nav-link"
                            id="slider-tab"
                            data-toggle="tab"
                            href="#slider"
                            role="tab"
                            aria-controls="slider"
                            aria-selected="false"
                            >Slider</a
                        >
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div
                        class="tab-pane fade show active"
                        id="product"
                        role="tabpanel"
                        aria-labelledby="product-tab"
                    >
                        <el-upload
                            action="http://127.0.0.1:8000/api/v1/product-upload"
                            list-type="picture-card"
                            :on-preview="handlePictureCardPreview"
                            :on-remove="handleRemove"
                            accept=" .jpg, .jpeg, .png"
                            multiple
                            :limit="20"
                        >
                            <el-icon><Plus /></el-icon>
                        </el-upload>

                        <el-dialog v-model="dialogVisible">
                            <img
                                w-full
                                :src="dialogImageUrl"
                                alt="Preview Image"
                            />
                        </el-dialog>
                    </div>

                    <div
                        class="tab-pane fade"
                        id="category"
                        role="tabpanel"
                        aria-labelledby="category-tab"
                    >
                        <el-upload
                            action="http://127.0.0.1:8000/api/v1/category-upload"
                            list-type="picture-card"
                            :on-preview="handlePictureCardPreview"
                            :on-remove="handleRemove"
                            multiple
                            :limit="20"
                        >
                            <el-icon><Plus /></el-icon>
                        </el-upload>

                        <el-dialog v-model="dialogVisible">
                            <img
                                w-full
                                :src="dialogImageUrl"
                                alt="Preview Image"
                            />
                        </el-dialog>
                    </div>

                    <div
                        class="tab-pane fade"
                        id="brand"
                        role="tabpanel"
                        aria-labelledby="brand-tab"
                    >
                        <el-upload
                            action="http://127.0.0.1:8000/api/v1/brand-upload"
                            list-type="picture-card"
                            :on-preview="handlePictureCardPreview"
                            :on-remove="handleRemove"
                            multiple
                            :limit="20"
                        >
                            <el-icon><Plus /></el-icon>
                        </el-upload>

                        <el-dialog v-model="dialogVisible">
                            <img
                                w-full
                                :src="dialogImageUrl"
                                alt="Preview Image"
                            />
                        </el-dialog>
                    </div>

                     <div
                        class="tab-pane fade"
                        id="slider"
                        role="tabpanel"
                        aria-labelledby="slider-tab"
                    >
                        <el-upload
                            action="http://127.0.0.1:8000/api/v1/slider-upload"
                            list-type="picture-card"
                            :on-preview="handlePictureCardPreview"
                            :on-remove="handleRemove"
                            multiple
                            :limit="20"
                        >
                            <el-icon><Plus /></el-icon>
                        </el-upload>

                        <el-dialog v-model="dialogVisible">
                            <img
                                w-full
                                :src="dialogImageUrl"
                                alt="Preview Image"
                            />
                        </el-dialog>
                    </div>


                </div>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
</template>
<script>
import { Plus } from "@element-plus/icons-vue";
import { ref } from "vue";
// import headAxios from '../../../services/AxiosTokenInstance';

export default {
    components: { Plus },
    data() {
        return {
            dialogImageUrl: ref(""),
            dialogVisible: ref(false),
        };
    },

    methods: {
        handlePictureCardPreview(uploadFile) {
            this.dialogImageUrl = uploadFile.url;
            this.dialogVisible = true;
        },

        handleRemove(uploadFile) {
            console.log(uploadFile);
            let photo = JSON.parse(JSON.stringify(uploadFile.response));

            this.$store
                .dispatch("file_manager/REMOVE_PHOTO", { photo: photo })
                .then((res) => {
                    console.log(res.data);
                })
                .catch((err) => {
                    console.log(err);
                });
        },
    },

};
</script>
