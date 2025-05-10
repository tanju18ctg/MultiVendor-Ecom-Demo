<template>
  <div>
    <!-- title="Add to Cart"
                  data-bs-toggle="modal"
                  data-bs-target="#product-view" -->
    <button
      title="Add to Cart"
      class="product-add"
      @click.prevent="showProductModal(product)"
    >
      <i class="fas fa-shopping-basket"></i><span>Shop Now</span>
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
      if (this.product.size.length > 0) {
        this.modalData = product;
      } else if (product.color.length > 0) {
        this.modalData = product;
      } else {
        this.addToCart(product);
      }
    },
  },
};
</script>
<style></style>
