<template>
    <div>
        <div class="container-fluid">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Update slider</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form role="form" @submit.prevent="updateData">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="">Status</label>
                            <select class="form-control" v-model="form.status">
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">slider Image</label>

                            <div class="input-group pointer">
                                <div class="input-group-prepend">
                                    <div
                                        class="input-group-text bg-soft-secondary font-weight-medium"
                                        @click.prevent="showModal"
                                    >
                                        Browse
                                    </div>
                                </div>
                                <div class="form-control">Choose file</div>
                            </div>

                            <Gallery-modal
                                v-if="displayModal"
                                @close-modal-event="hideModal"
                                :multiImg="getMultiImg"
                            />

                            <span v-if="errors.image" class="text-danger">{{
                                errors.image[0]
                            }}</span>

                            <div class="form-group" v-if="form.image">
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
                                        @click.prevent="removeImage()"
                                    />
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-info">
                            Update
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>
<script>
import { ElNotification } from "element-plus";
import GalleryModal from "../filemanager/GalleryModal.vue";
export default {
    components: { GalleryModal },
    data() {
        return {
            form: {},
            errors: {},
            displayModal: false,
        };
    },

    created() {
        this.editslider();
    },

    methods: {
        editslider() {
            this.$store
                .dispatch("slider/EDIT_DATA", this.$route.params.id)
                .then((res) => {
                    this.form = res.data.data;
                })
                .catch(() => {});
        },

        removeImage() {
            this.form.image = "";
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

        updateData() {
            this.$store
                .dispatch("slider/UPDATE_DATA", {
                    form: this.form,
                    id: this.$route.params.id,
                })
                .then((res) => {
                    if (res.data.status == true) {
                        this.$router.push({ name: "Slider" });
                        ElNotification({
                            title: "Success",
                            message: "Update Success",
                            type: "success",
                            showClose: false,
                        });
                    }
                })
                .catch(() => {});
        },
    },
};
</script>
<style></style>
