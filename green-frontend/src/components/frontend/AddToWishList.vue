<template>
  <div>
    <button
      class="product-wish wish"
      v-if="user.name"
      @click.prevent="addToWishlist(product.id)"
    >
      <i class="fas fa-spinner fa-spin" v-if="loading"></i>
      <i class="fas fa-heart" v-else></i>

    
    </button>
 
    <button
      class="product-wish wish"
      data-bs-toggle="modal"
      data-bs-target="#login-modal"
      v-else
    >
      <i class="fas fa-heart"></i>
    </button>
  </div>
</template>
<script>
import { ElNotification } from "element-plus";
export default {
  props: ["product"],
  data() {
    return {
      loading: false,
    };
  },
  methods: {
    
    addToWishlist(productId) {
      this.loading = true;
      this.$store
        .dispatch("wishlist/ADD_WISHLISTS", { product_id: productId })
        .then((res) => {
          if (res.data.status == true) {
            ElNotification.success({
              title: "Success",
              message: "Product Added On wishlist",
              offset: 100,
            });
          } else {
            ElNotification.success({
              title: "Success",
              message: "Product Remove from wishlist",
              offset: 100,
            });
          }
        })
        .catch(() => {})
        .finally(() => {
          this.loading = false;
        });
    },
  },

  computed: {
    user() {
      return this.$store.getters["auth/GET_AUTH_INFO"];
    },
  },
};
</script>
<style></style>
