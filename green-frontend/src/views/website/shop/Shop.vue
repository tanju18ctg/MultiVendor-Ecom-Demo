<template>
  <div>
    <section
      class="inner-section single-banner"
      style="
        background: url(//website/images/single-banner.jpg) no-repeat center;
      "
    >
      <div class="container">
        <h2>Shop Page Products</h2>
      </div>
    </section>
    <section class="inner-section shop-part">
      <div class="container">
        
        <div class="row content-reverse">
          <div class="col-lg-3">
            <!-- <div class="shop-widget-promo">
              <a href="#"><img src="/website/images/promo/shop/01.jpg" alt="promo" /></a>
            </div> -->
            <div v-if="sidebar.data">
              <Shop-sidebar :sidebar="sidebar" />
            </div>
            <Shop-sidebar-skeleton v-else />
          </div>
          <div class="col-lg-9">
            <div v-if="products.data">
              <Products-component :products="products" />
            </div>

            <Product-skeleton :data-amounts="20" v-else />
          </div>

        </div>
      </div>
    </section>
  </div>
</template>
<script>
import ProductsComponent from "./inc/ProductsComponent.vue";
import ProductSkeleton from "@/components/skeleton/ProductSkeleton.vue";
import ShopSidebar from "./inc/ShopSidebar.vue";
import ShopSidebarSkeleton from "../../../components/skeleton/ShopSidebarSkeleton.vue";
export default {
  components: {
    ShopSidebar,
    ProductsComponent,
    ProductSkeleton,
    ShopSidebarSkeleton,
  },

  created() {
    document.title = "Products";

    this.productAction();
    this.sidebarAction();
  },

  methods: {
    sidebarAction() {
      this.$store.dispatch("shop/FETCH_SIDEBAR_DATA");
    },

    productAction() {
      this.$store.dispatch("shop/FETCH_PRODUCTS");
    },
  },

  computed: {
    products() {
      return this.$store.getters["shop/GET_PRODUCTS"];
    },
    sidebar() {
      return this.$store.getters["shop/GET_SIDEBAR_DATA"];
    },
  },
};
</script>
<style></style>
