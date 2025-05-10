<template>
    <div>
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Upload New Files</h3>
                <router-link
                    :to="{ name: 'ManageFiles' }"
                    class="btn btn-sm btn-default"
                    style="float: right"
                    >Back to file list</router-link
                >
            </div>
            <div class="card-body">
                <el-upload
                    action="http://127.0.0.1:8000/api/v1/product-upload-seller"
                    list-type="picture-card"
                    :data="auth"
                    :on-preview="handlePictureCardPreview"
                    :on-remove="handleRemove"
                    accept=" .jpg, .jpeg, .png"
                    multiple
                    :limit="20"
                >
                    <el-icon><Plus /></el-icon>
                </el-upload>

                <el-dialog v-model="dialogVisible">
                    <img w-full :src="dialogImageUrl" alt="Preview Image" />
                </el-dialog>
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

    computed: {
         auth() {
            return this.$store.getters["auth/GET_AUTH_USER"];
        },
    },
};
</script>
