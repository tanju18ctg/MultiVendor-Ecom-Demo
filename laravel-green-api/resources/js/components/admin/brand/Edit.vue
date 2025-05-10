<template>
    <div>
        <div class="container-fluid">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Update Brand</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form role="form" @submit.prevent="updateBrand">
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
                                placeholder="Enter Brand Name"
                            />

                            <span v-if="errors.name" class="text-danger">{{
                                errors.name[0]
                            }}</span>
                        </div>

                        <div class="form-group">
                            <label for="">Status</label>
                            <select class="form-control" v-model="form.status">
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>

                          <div class="form-group">
                            <label for="exampleInputEmail1"
                                >Brand Image</label
                            >

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
    components:{GalleryModal},
    data() {
        return {
            form: {},
            errors: {},
             displayModal: false,
        };
    },

    created() {
        this.editbrand();
    },

    methods: {
        editbrand() {
            this.$store
                .dispatch("brand/EDIT_DATA", this.$route.params.id)
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

        updateBrand() {
            this.$store
                .dispatch("brand/UPDATE_DATA", {
                    form: this.form,
                    id: this.$route.params.id,
                })
                .then((res) => {
                    if (res.data.status == true) {
                        this.$router.push({ name: "Brand" });
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
