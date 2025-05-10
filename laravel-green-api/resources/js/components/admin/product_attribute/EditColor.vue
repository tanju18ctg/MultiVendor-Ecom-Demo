<template>
    <div>
        <div class="container-fluid">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Update Color</h3>
                    <router-link
                        :to="{ name: 'productColor' }"
                        class="btn btn-sm btn-info float-right"
                        >Back</router-link
                    >
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form role="form" @submit.prevent="updateData">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Color Name</label>
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
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button
                            type="submit"
                            class="btn btn-info"
                            :disabled="loading"
                        >
                            {{ loading == true ? "Updating. " : "Update" }}
                            <i
                                class="fas fa-spinner fa-spin"
                                v-if="loading"
                            ></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>
<script>
import { ElNotification } from "element-plus";
export default {
    data() {
        return {
            form: {},
            errors: {},
            loading: false,
        };
    },

    created() {
        this.editData();
    },

    methods: {
        editData() {
            this.$store
                .dispatch("color/EDIT_DATA", this.$route.params.id)
                .then((res) => {
                    this.form = res.data.data;
                })
                .catch(() => {});
        },

        updateData() {
            this.loading = true;
            this.$store
                .dispatch("color/UPDATE_DATA", {
                    form: this.form,
                    id: this.$route.params.id,
                })
                .then((res) => {
                    if (res.data.status == true) {
                        this.$router.push({ name: "productColor" });
                        ElNotification({
                            title: "Success",
                            message: "Update Success",
                            type: "success",
                            showClose: false,
                        });
                    }
                })
                .catch(() => {})
                .finally(() => {
                    this.loading = false;
                });
        },
    },
};
</script>
<style></style>
