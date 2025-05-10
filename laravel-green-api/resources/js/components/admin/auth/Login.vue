<template>
    <div>
        <div class="login-page">
            <div class="login-box">
                <!-- /.login-logo -->
                <div class="card card-outline card-primary">
                    <div class="card-header text-center">
                        <a href="../../index2.html" class="h1"
                            ><b>Admin</b> Login</a
                        >
                    </div>
                    <div class="card-body" id="axiosForm">
                        <!-- <div class="loader" v-if="loading"></div> -->
                        <p class="login-box-msg">
                            Sign in to start your session
                        </p>

                        <form
                            action=""
                            method="post"
                            @submit.prevent="adminLogin()"
                        >
                            <fieldset :disabled="loading">
                                <div class="input-group mb-3">
                                    <input
                                        type="email"
                                        class="form-control"
                                        v-model="form.email"
                                        placeholder="Email"
                                    />
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span
                                                class="fas fa-envelope"
                                            ></span>
                                        </div>
                                    </div>
                                </div>
                                <strong
                                    v-if="LoginFailed"
                                    class="text-danger text-center"
                                    >{{ LoginFailed }}</strong
                                >
                                <span v-if="errors.email" class="text-danger">{{
                                    errors.email[0]
                                }}</span>
                                <div class="input-group mb-3">
                                    <input
                                        type="password"
                                        class="form-control"
                                        placeholder="Password"
                                        v-model="form.password"
                                    />
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-lock"></span>
                                        </div>
                                    </div>
                                </div>
                                <span
                                    v-if="errors.password"
                                    class="text-danger"
                                    >{{ errors.password[0] }}</span
                                >
                                <div class="row">
                                    <div class="col-8">
                                        <div class="icheck-primary">
                                            <input
                                                type="checkbox"
                                                id="remember"
                                            />
                                            <label for="remember">
                                                Remember Me
                                            </label>
                                        </div>
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-4">
                                        <button
                                            type="submit"
                                            class="btn btn-primary btn-block"
                                        >
                                            <i
                                                class="fas fa-spinner fa-spin"
                                                v-if="loading"
                                            ></i>
                                            <span v-else> Sign In</span>
                                        </button>
                                    </div>
                                    <!-- /.col -->
                                </div>
                            </fieldset>
                        </form>

                        <p class="mb-1">
                            <a href="forgot-password.html"
                                >I forgot my password</a
                            >
                        </p>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            form: {
                email: "admin@gmail.com",
                password: "password",
            },
            errors: {},

            loading: false,
        };
    },

    mounted() {
        document.title = "Login";
    },

    methods: {
        adminLogin() {
            this.loading = true;
            if (this.errors) {
                this.errors = "";
            }
            this.$store
                .dispatch("auth/login", this.form)
                .then(() => {
                    this.$router.replace({ name: "AdminHome" });
                })
                .catch((err) => {
                    if (err.response.data.errors) {
                        this.errors = err.response.data.errors;
                    }
                })
                .finally(() => {
                    this.loading = false;
                });
        },
    },
};
</script>

<style scoped>
#axiosForm {
    position: relative;
}
.loader {
    position: absolute;
    top: 0px;
    right: 0px;
    width: 100%;
    height: 100%;
    background-color: #d4d4d4;
    background-image: url("/admin/img/loader.gif");
    background-size: 450px;
    background-repeat: no-repeat;
    background-position: center;
    z-index: 10000000;
    opacity: 0.4;
    filter: alpha(opacity=40);
}
</style>
