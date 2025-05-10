<template>
  <div>
    <div class="row">
      <div class="col-lg-12">
        <div class="top-filter">
          <div class="filter-show">
            <label class="filter-label">Show :</label
            ><select class="form-select filter-select">
              <option value="20">20</option>
              <option value="40">40</option>
              <option value="100">100</option>
            </select>
          </div>
          <div class="filter-short">
            <input
              class="shop-widget-search"
              type="text"
              v-model="productSearch"
              placeholder="Search..."
            />
          </div>

          <div class="filter-short">
            <label class="filter-label">Short by :</label
            ><select class="form-select filter-select">
              <option selected>default</option>
              <option value="3">trending</option>
              <option value="1">featured</option>
              <option value="2">recommend</option>
            </select>
          </div>
        </div>
      </div>
    </div>

    <div class="row row-cols-2 row-cols-md-3 row-cols-lg-3 row-cols-xl-4">
      <div
        class="col"
        v-for="(product, index) in productSearchFilter"
        :key="index"
      >
        <!-- //disable or stock out products // use class product-disable // after product-card -->
        <div
          :class="`product-card ${product.stock == 0 ? 'product-disable' : ''}`"
        >
          <div class="product-media">
            <div class="product-label">
              <label class="label-text sale">{{ product.conditions }}</label>
              <label class="view-label off" v-if="product.discount"
                >-{{ product.discount }}%</label
              >
            </div>
             <add-to-wish-list :product="product" />
             
            <router-link
              :to="{
                name: 'SingleProduct',
                params: { slug: product.slug },
              }"
              class="product-image"
            >
              <Dynamic-img :path="product.thumbnail" />
            </router-link>
          </div>
          <div class="product-content">
            <!-- <div class="product-rating">
              <i class="active icofont-star"></i
              ><i class="active icofont-star"></i
              ><i class="active icofont-star"></i
              ><i class="active icofont-star"></i><i class="icofont-star"></i
              ><a href="product-video.html">(3)</a>
            </div> -->
            <h6 class="product-name">
              <router-link
                :to="{
                  name: 'SingleProduct',
                  params: { slug: product.slug },
                }"
                >{{ product.name }}</router-link
              >
            </h6>
            <Product-price
              :price="product.price"
              :discount="product.discount"
            />

            <button
              class="product-add"
              title="Add to Cart"
              @click.prevent="addToCart(product)"
            >
              <i class="fas fa-shopping-basket"></i><span>Shop Now</span>
            </button>
          </div>
        </div>
      </div>
    </div>

    <div class="row" v-if="productSearchFilter.length == 0">
      <h6 class="text-center">
        Search No Result We're sorry. <br />
        We cannot find any matches for your search term.
      </h6>
    </div>
  </div>
</template>
<script>
import DynamicImg from "@/components/frontend/DynamicImg.vue";
import ProductPrice from "@/components/frontend/ProductPrice.vue";
import AddToWishList from "@/components/frontend/AddToWishList.vue";
import { ElNotification } from "element-plus";
export default {
  components: { DynamicImg, ProductPrice,AddToWishList },
  props: ["products"],

  data() {
    return {
      productSearch: "",
    };
  },
  computed: {
    user() {
      return this.$store.getters["auth/GET_AUTH_INFO"];
    },

    productSearchFilter() {
      return this.products.data.data.filter((product) => {
        return product.name.match(this.productSearch);
      });
    },
  },

  methods: {
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
<style></style>
