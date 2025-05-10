<template>
    <div>
        <div class="card">
            <template v-if="images.data">
                <div class="card-header">
                    <h3 class="card-title">
                        showing
                        <span v-if="images.data"
                            >{{ images.data.length }} of
                            {{ images.total }}</span
                        >
                    </h3>
                    <router-link
                        :to="{ name: 'uploadNew' }"
                        class="btn btn-sm btn-default"
                        style="float: right"
                        >Upload New Files</router-link
                    >
                </div>
                <div class="card-body">
                    <div>
                        <div class="col-md-2" style="float: right">
                            <select
                                class="form-control form-control-xs mb-2"
                                v-model="limit"
                                @change="actionImages"
                            >
                                <option value="30">30</option>
                                <option value="60">60</option>

                                <option value="90">90</option>

                                <option value="120">120</option>

                                <option value="180">180</option>

                                <option value="540">540</option>
                            </select>
                        </div>

                        <div class="col-md-2" style="float: right">
                            <select
                                class="form-control form-control-xs mb-2"
                                v-model="sort"
                                @change="actionImages"
                            >
                                <option value="Asc">Sort by Oldest</option>
                                <option value="Desc">Sort by Newest</option>
                            </select>
                        </div>

                        <div class="col-md-2">
                            <select
                                class="form-control form-control-xs mb-2"
                                v-model="type"
                                @change="actionImages"
                            >
                                <option value="product">Proudcts</option>
                                <option value="category">Category</option>
                                <option value="brand">Brand</option>
                                <option value="slider">Sliders</option>
                            </select>
                        </div>
                    </div>

                    <template v-if="images.data.length != 0">
                        <el-upload
                            list-type="picture-card"
                            :on-preview="handlePictureCardPreview"
                            :on-remove="handleRemove"
                            :file-list="images.data"
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
                    </template>
                    <template v-else>
                        <p class="text-center">
                            Search No Result We're sorry. We cannot find any
                            matches for your search term.
                        </p>
                    </template>
                </div>
                <!-- /.card-body -->

                <div
                    class="mb-0 ml-3 card-footer text-center"
                    v-if="images.data"
                >
                    <button
                        type="button"
                        class="btn btn-sm btn-primary mr-2"
                        :disabled="images.prev_page_url == null ? true : false"
                        @click.prevent="changePage(images.current_page - 1)"
                    >
                        Prev {{ images.current_page - 1 }}
                    </button>
                    <button
                        type="button"
                        class="btn btn-sm btn-primary"
                        :disabled="images.next_page_url == null ? true : false"
                        @click.prevent="changePage(images.current_page + 1)"
                    >
                        Next {{ images.current_page }}
                    </button>
                </div>
            </template>

            <template v-else>
                <Image-gallery-skeleton :dataAmounts="30" />
            </template>
        </div>
    </div>
</template>
<script>
import { Plus } from "@element-plus/icons-vue";
import { ref } from "vue";
import ImageGallerySkeleton from "../../skeleton/ImageGallerySkeleton.vue";
export default {
    components: { Plus, ImageGallerySkeleton },
    data() {
        return {
            dialogImageUrl: ref(""),
            dialogVisible: ref(false),
            currentPage: 1,
            limit: 30,
            sort: "Desc",
            type: "product",
        };
    },

    mounted() {
        this.actionImages();
    },
    methods: {
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

        handlePictureCardPreview(uploadFile) {
            this.dialogImageUrl = uploadFile.url;
            this.dialogVisible = true;
        },

        handleRemove(uploadFile) {
            console.log(uploadFile);
            let photo = JSON.parse(JSON.stringify(uploadFile.url));

            this.$store
                .dispatch("file_manager/REMOVE_PHOTO", { photo: photo })
                .then((res) => {
                    console.log(res.data);
                })
                .catch((err) => {
                    console.log(err);
                });
        },

        changePage(page) {
            this.currentPage = page;
            // this.$emit('paginate');
            this.actionImages();
        },
    },

    computed: {
        images() {
            return this.$store.getters["file_manager/GET_FILES"];
        },
    },
};
</script>
<style scoped>
.el-upload--picture-card {
    display: none !important;
}
</style>
