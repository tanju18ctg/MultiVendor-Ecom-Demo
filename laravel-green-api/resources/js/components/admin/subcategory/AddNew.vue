<template>
    <div>
        <div class="container-fluid">
            <template v-if="categories.data">
                <div class="row">
                    <!-- left column -->
                    <!-- general form elements -->
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Add Subcategory</h3>
                                <router-link
                                    :to="{ name: 'Subcategory' }"
                                    class="btn btn-sm btn-info float-right p-2"
                                >
                                    All List
                                </router-link>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form
                                role="form"
                                @submit.prevent="storeSubcategory"
                            >
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"
                                            >Select Category</label
                                        >

                                        <select
                                            class="form-control"
                                            v-model="category_id"
                                        >
                                            <option value="" selected disabled>
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
                                                        cat.subcats.length
                                                    }})</span
                                                >
                                            </option>
                                        </select>

                                        <span
                                            v-if="errors.category_id"
                                            class="text-danger"
                                            >{{ errors.category_id[0] }}</span
                                        >
                                    </div>
                                    <button
                                        class="btn btn-info btn-rounded"
                                        title="add more"
                                        @click.prevent="addRow"
                                    >
                                        <i class="fa fa-plus-circle"></i>
                                    </button>
                                    <div
                                        class="row"
                                        v-for="(form, index) in form"
                                        :key="index"
                                    >
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label for="subcat3"
                                                    >Name</label
                                                >
                                                <input
                                                    type="text"
                                                    class="form-control"
                                                    id="subcat3"
                                                    v-model="form.name"
                                                    placeholder="subcategory name"
                                                />
                                            </div>
                                        </div>

                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="">Status</label>
                                                <select
                                                    class="form-control"
                                                    v-model="form.status"
                                                >
                                                    <option value="active">
                                                        Active
                                                    </option>
                                                    <option value="inactive">
                                                        Inactive
                                                    </option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-2 top">
                                            <button
                                                class="btn btn-danger btn-rounded"
                                                title="remove row"
                                                @click.prevent="
                                                    removeRow(index, form)
                                                "
                                            >
                                                <i
                                                    class="fa fa-minus-circle"
                                                ></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <button
                                        type="submit"
                                        class="btn btn-primary"
                                    >
                                        Submit
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
            </template>

            <template v-else>
                <Subcategory-skeleton />
            </template>
        </div>
    </div>
</template>
<script>
import TableSkeleton from "../../skeleton/TableSkeleton.vue";
import { ElNotification } from "element-plus";
export default {
    components: { TableSkeleton },
    data() {
        return {
            category_id: "",
            form: [
                {
                    name: "",
                    status: "active",
                },
            ],

            errors: {},
        };
    },

    mounted() {
        this.fetchCategory();
    },

    methods: {
        addRow() {
            this.form.push({ name: "", status: "active" });
        },

        removeRow(index, f) {
            var idx = this.form.indexOf(f);
            console.log(idx, index);
            if (idx > -1) {
                this.form.splice(idx, 1);
            }
            // this.form.splice(index, 1);
        },

        fetchCategory() {
            this.$store.dispatch("category/FETCH_NO_PAGINATE_CATEGORIES");
        },

        storeSubcategory() {
            this.$store
                .dispatch("subcategory/STORE", {
                    category_id: this.category_id,
                    name: this.form,
                })
                .then((res) => {
                    if (res.data.status == true) {
                        this.clearForm();
                        ElNotification({
                            title: "Success",
                            message: "Create Success",
                            type: "success",
                            showClose: false,
                        });
                    }
                })
                .catch((err) => {
                    this.errors = err.response.data.errors;
                });
        },
        clearForm() {
            this.category_id = "";
            this.form = [{ name: "", status: "active" }];
        },
    },

    computed: {
        categories() {
            return this.$store.getters["category/GET_NO_PAGINATE_CATEGORIES"];
        },
    },
};
</script>
<style>
.top {
    padding-top: 30px;
}
</style>
