<template>
    <div>
        <div class="wrapper">
            <template v-if="adminLoggedIn">
                <Navbar />
                <Sidebar :seller="seller" />
            </template>
            <router-view />
        </div>
    </div>
</template>
<script>
import Navbar from "./inc/Navbar.vue";
import Sidebar from "./inc/Sidebar.vue";
export default {
    components: { Navbar, Sidebar },

    computed: {
        adminLoggedIn() {
            return this.$store.getters["auth/GET_USERLOGGEDIN_STATUS"];
        },

        seller() {
            return this.$store.getters["auth/GET_AUTH_USER"];
        },
    },
};
</script>
<style></style>
