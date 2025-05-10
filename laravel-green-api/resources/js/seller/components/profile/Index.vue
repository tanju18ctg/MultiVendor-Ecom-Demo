<template>
    <div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                    <!-- Profile Image -->
                    <div class="card card-primary card-outline" id="axiosForm">
                        <div class="loader" v-if="imgLoading"></div>
                        <div class="card-body box-profile" v-if="seller">
                            <div class="text-center">
                                <img
                                    class="profile-user-img img-fluid img-circle"
                                    :src="seller.image"
                                    alt="User profile picture"
                                />

                                <span class="icon">
                                    <form
                                        enctype="multipart/form-data"
                                        id="change_image_form"
                                    >
                                        <label for="image">
                                            <i class="fas fa-edit"></i>
                                        </label>
                                        <input
                                            type="file"
                                            name="image"
                                            id="image"
                                            @change="changeImage"
                                            style="display: none"
                                        />
                                    </form>
                                </span>
                            </div>

                            <h3 class="profile-username text-center">
                                {{ seller.shop_name }}
                                <span
                                    v-if="seller.isVerified == 1"
                                    class="badge badge-pill badge-info"
                                    ><i class="fas fa-check-circle"></i
                                ></span>
                            </h3>

                            <p class="text-muted text-center">
                                {{ seller.email }}
                            </p>

                            <p class="text-muted text-center">
                                {{ seller.phone }}
                            </p>

                            <p class="text-muted text-center">
                                {{ seller.address }}
                            </p>

                            <!-- <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>Followers</b>
                                    <a class="float-right">1,322</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Following</b>
                                    <a class="float-right">543</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Friends</b>
                                    <a class="float-right">13,287</a>
                                </li>
                            </ul> -->

                            <a href="#" class="btn btn-primary btn-block"
                                ><b>My Store</b></a
                            >
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item">
                                    <a
                                        class="nav-link"
                                        href="#password"
                                        data-toggle="tab"
                                        >Password</a
                                    >
                                </li>

                                <li class="nav-item">
                                    <a
                                        class="nav-link"
                                        href="#banner"
                                        data-toggle="tab"
                                        >Shop Banner</a
                                    >
                                </li>
                                <li class="nav-item">
                                    <a
                                        class="nav-link active"
                                        href="#settings"
                                        data-toggle="tab"
                                        >Settings</a
                                    >
                                </li>
                            </ul>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane" id="password">
                                    <form
                                        class="form-horizontal"
                                        @submit.prevent="changePassword"
                                    >
                                        <div class="form-group row">
                                            <label
                                                for="inputName"
                                                class="col-sm-2 col-form-label"
                                                >Current Password</label
                                            >
                                            <div class="col-sm-10">
                                                <input
                                                    type="password"
                                                    class="form-control"
                                                    id="inputName"
                                                    v-model="
                                                        passwordForm.current_password
                                                    "
                                                    placeholder="your password"
                                                />
                                                <span
                                                    class="text-danger"
                                                    v-if="
                                                        errors.current_password
                                                    "
                                                    >{{
                                                        errors
                                                            .current_password[0]
                                                    }}</span
                                                >
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label
                                                for="inputEmail"
                                                class="col-sm-2 col-form-label"
                                                >New Password</label
                                            >
                                            <div class="col-sm-10">
                                                <input
                                                    type="password"
                                                    class="form-control"
                                                    id="inputEmail"
                                                    v-model="
                                                        passwordForm.password
                                                    "
                                                    placeholder="new password"
                                                />
                                                <span
                                                    class="text-danger"
                                                    v-if="errors.password"
                                                    >{{
                                                        errors.password[0]
                                                    }}</span
                                                >
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label
                                                for="inputPass"
                                                class="col-sm-2 col-form-label"
                                                >Confirm Password</label
                                            >
                                            <div class="col-sm-10">
                                                <input
                                                    type="password"
                                                    class="form-control"
                                                    id="inputPass"
                                                    v-model="
                                                        passwordForm.password_confirmation
                                                    "
                                                    placeholder="Retype password"
                                                />
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="offset-sm-2 col-sm-10">
                                                <button
                                                    type="submit"
                                                    class="btn btn-danger"
                                                >
                                                    Update
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <div class="tab-pane" id="banner">
                                    <form class="form-horizontal">
                                        <div class="form-group row">
                                            <label
                                                for="inputIMage"
                                                class="col-sm-2 col-form-label"
                                                >Image</label
                                            >
                                            <div class="col-sm-10">
                                                <input
                                                    type="file"
                                                    class="form-control"
                                                    id="enterImage"
                                                    @change="handleImage"
                                                />

                                                <div class="show-image">
                                                    <img
                                                        v-if="previewPhoto"
                                                        :src="previewPhoto"
                                                        class="previewImage"
                                                        alt=""
                                                    />

                                                    <input
                                                        class="delete btn btn-sm btn-danger"
                                                        type="button"
                                                        value="X"
                                                        @click.prevent="
                                                            removePhoto
                                                        "
                                                    />
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="offset-sm-2 col-sm-10">
                                                <button
                                                    type="submit"
                                                    class="btn btn-danger"
                                                >
                                                    Update
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <div class="tab-pane active" id="settings">
                                    <form
                                        class="form-horizontal"
                                        @submit.prevent="updateSetting"
                                    >
                                        <div class="form-group row">
                                            <label
                                                for="inputUsername"
                                                class="col-sm-2 col-form-label"
                                                >Username</label
                                            >
                                            <div class="col-sm-10">
                                                <input
                                                    type="text"
                                                    class="form-control"
                                                    v-model="form.name"
                                                    id="inputUsername"
                                                    placeholder="Name"
                                                />
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label
                                                for="inputName"
                                                class="col-sm-2 col-form-label"
                                                >Shop Name</label
                                            >
                                            <div class="col-sm-10">
                                                <input
                                                    type="text"
                                                    class="form-control"
                                                    v-model="form.shop_name"
                                                    id="inputName"
                                                    placeholder="Name"
                                                />
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label
                                                for="phone"
                                                class="col-sm-2 col-form-label"
                                                >Phone</label
                                            >
                                            <div class="col-sm-10">
                                                <input
                                                    type="text"
                                                    v-model="form.phone"
                                                    class="form-control"
                                                    id="phone"
                                                    placeholder="phone"
                                                />
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label
                                                for="inputAddress"
                                                class="col-sm-2 col-form-label"
                                                >Address</label
                                            >
                                            <div class="col-sm-10">
                                                <textarea
                                                    v-model="form.address"
                                                    class="form-control"
                                                    id="inputAddress"
                                                    placeholder="address"
                                                ></textarea>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="offset-sm-2 col-sm-10">
                                                <button
                                                    type="submit"
                                                    class="btn btn-danger"
                                                    :disabled="loading"
                                                >
                                                    <i
                                                        class="fas fa-spinner fa-spin"
                                                        v-if="loading"
                                                    ></i>
                                                    <span v-else>Update</span>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <!-- /.tab-pane -->
                            </div>
                            <!-- /.tab-content -->
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
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
            passwordForm: {
                current_password: "",
                password: "",
                password_confirmation: "",
            },
            loading: false,
            previewPhoto: "",
            image: "",
            imgLoading: false,
            errors: {},
        };
    },
    mounted() {
        this.actionUser();
        document.title = "Profile";
    },

    methods: {
        actionUser() {
            this.$store.dispatch("auth/FETCH_AUTH_USER");
        },
        updateSetting() {
            this.loading = true;
            this.$store
                .dispatch("auth/UPDATE_SETTINGS", this.form)
                .then((res) => {
                    if (res.data.status == true) {
                        this.actionUser();
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

        removePhoto() {
            this.image = "";
            this.previewPhoto = "";
        },
        handleImage(e) {
            this.image = e.target.files[0];
            let file = e.target.files[0];
            if (file.size > 1048770) {
                alert("Image Size Must be Less Than 1Mb");
            } else {
                let reader = new FileReader();
                reader.onload = (event) => {
                    this.previewPhoto = event.target.result;
                };
                reader.readAsDataURL(file);
            }
        },

        changeImage() {
            this.imgLoading = true;
            let form_data = new FormData(
                document.getElementById("change_image_form")
            );
            this.$store
                .dispatch("auth/CHANGE_IMAGE", form_data)
                .then((res) => {
                    if (res.data.status == true) {
                        this.actionUser();
                    }
                })
                .catch(() => {})
                .finally(() => {
                    this.imgLoading = false;
                });
        },

        changePassword() {
            this.$store
                .dispatch("auth/CHANGE_PASSWORD", this.passwordForm)
                .then((res) => {
                    if (res.data.status == true) {
                        this.passwordForm = {};
                        ElNotification({
                            title: "Success",
                            message: "Password Change Success",
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
    },
    computed: {
        seller() {
            return (this.form = this.$store.getters["auth/GET_AUTH_USER"]);
        },
    },
};
</script>
<style scoped>
.badge-info {
    background-color: #13a717;
}
.badge-pill {
    padding-right: 3px;
    padding-left: 3px;
    font-size: 12px;
}
.profile-user-img {
    position: relative;
}
span.icon {
    position: absolute;
    margin-left: -22px;
    width: 30px;
    height: 30px;
    line-height: 30px;
    vertical-align: middle;
    background: #ffffff;
    color: #13a717;
    border-radius: 100%;
    vertical-align: middle;
    text-align: center;
}

.fa-edit {
    cursor: pointer;
}
</style>
