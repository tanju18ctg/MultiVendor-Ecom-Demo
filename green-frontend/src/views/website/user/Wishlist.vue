<template>
  <div>
    <section
      class="inner-section single-banner"
      style="
        background: url(//website//website/images/single-banner.jpg) no-repeat
          center;
      "
    >
      <div class="container">
        <h2>wishlist</h2>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">My Wishlist</a></li>
        </ol>
      </div>
    </section>
    <section class="inner-section wishlist-part">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="table-scroll">
              <table class="table-list" v-if="wishlists.data">
                <thead>
                  <tr>
                    <th scope="col">Serial</th>
                    <th scope="col">Product</th>
                    <th scope="col">Name</th>
                    <th scope="col">Price</th>
                    <th scope="col">shopping</th>
                    <th scope="col">action</th>
                  </tr>
                </thead>


                <tbody>
                  <tr v-for="(wish, index) in wishlists.data" :key="index">
                    <td class="table-serial">
                      <h6>{{ index + 1 }}</h6>
                    </td>
                    <td class="table-image">
                      <img
                        :src="$filters.makeImagePath(wish.thumbnail)"
                        alt="product"
                      />
                    </td>
                    <td class="table-name">
                      <h6>{{ wish.name }}</h6>
                    </td>
                    <td class="table-price">
                      <h6 class="product-price" v-if="wish.offer_price">
                        <del>{{ $filters.currencyBDT(wish.price) }}</del
                        ><span>{{
                          $filters.currencyBDT(wish.offer_price)
                        }}</span>
                      </h6>
                      <h6 class="product-price" v-else>
                        <span>{{ $filters.currencyBDT(wish.price) }}</span>
                      </h6>
                    </td>

                    <td class="table-shop">
                      <button
                        class="product-add"
                        title="Add to Cart"
                        @click.prevent="addToCart(wish)"
                      >
                        add to cart
                      </button>
                      <!-- fas fa-spinner fa-spin -->
                    </td>
                    <td class="table-action">
                      
                      <a
                        class=""
                        href="javascript::void(0)"
                        @click.prevent="deleteWishlist(wish.id)"
                        title="Remove Wishlist"
                      >
                        <i
                          class="fas fa-spinner fa-spin"
                          v-if="loading == wish.id"
                        ></i>
                        <i class="icofont-trash" v-else></i>
                      </a>
                    </td>
                  </tr>
                </tbody>
              </table>
              <template v-else>
                <table-skeleton></table-skeleton>
              </template>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-12">
            <div class="text-center mt-5">
              <button class="btn btn-outline">Load more items</button>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>
<script>
import { ElNotification } from "element-plus";
import TableSkeleton from "../../../components/skeleton/TableSkeleton.vue";

export default {
  name: "Wishlist",
  components: { TableSkeleton },

  data() {
    return {
      loading:0,
    };
  },

  created() {
    document.title = "Wishlist";
    this.$store.dispatch("wishlist/FETCH_WISHLISTS");
  },

  computed: {
    wishlists() {
      return this.$store.getters["wishlist/GET_WISHLISTS"];
    },
  },

  methods: {
    deleteWishlist(pId) {
      this.loading = pId;
      // this.btn_loading = true;
      this.$store
        .dispatch("wishlist/DELETE_WISHLIST", pId)
        .then(() => {
          ElNotification.success({
            title: "Success",
            message: "Product Removed",
            offset: 100,
          });
        })
        .catch(() => {})
        .finally(() => {
          this.loading = 0;
        });
    },

    addToCart(product) {
      if (product.discount) {
        var numVal1 = product.price;
        var numVal2 = product.discount / 100;
        var totalValue = numVal1 - numVal1 * numVal2;
        this.price = totalValue.toFixed();
      } else {
        this.price = product.price;
      }

      this.$store.dispatch("cart/ADD_OR_INCREMENT_CART", {
        id: product.id,
        name: product.name,
        price: this.price,
        thumbnail: product.thumbnail,
      });
      ElNotification.success({
        title: "Success",
        message: "Successfully Added On Cart",
        offset: 100,
      });
    },
  },
};
</script>
<style lang=""></style>
