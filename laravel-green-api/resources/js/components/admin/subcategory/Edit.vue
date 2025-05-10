<template>
    <div>
        <div class="container-fluid">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Update Subcategory</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form role="form" @submit.prevent="updateSubcategory">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1"
                                >Subcategory Name</label
                            >
                            <input
                                type="text"
                                v-model="form.name"
                                class="form-control"
                                id="exampleInputEmail1"
                                placeholder="Enter subcategory Name"
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
export default {
    data() {
        return {
            form: {},
            errors: {},
        };
    },

    created() {
        this.editSubCategory();
    },

    methods: {
        editSubCategory() {
            this.$store
                .dispatch("subcategory/EDIT_DATA", this.$route.params.id)
                .then((res) => {
                    this.form = res.data.data;
                })
                .catch(() => {});
        },

        updateSubcategory() {
            this.$store
                .dispatch("subcategory/UPDATE_DATA", {
                    form: this.form,
                    id: this.$route.params.id,
                })
                .then((res) => {
                    if (res.data.status == true) {
                        this.$router.push({ name: "Subcategory" });
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
