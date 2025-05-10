<template>
  <div>
    <section
      class="single-banner"
      style="
        background: url(//website/images/single-banner.jpg) no-repeat center;
      "
    >
      <div class="container">
        <h2>Seller Products</h2>
      </div>
    </section>
    <div class="brand-single" v-if="seller">
      <a href="#"> <Dynamic-img :path="seller.image" /> </a
      ><a href="#"
        ><h3>{{ seller.shop_name }}</h3></a
      >
      <!-- <ul>
        <li class="fas fa-star active"></li>
        <li class="fas fa-star active"></li>
        <li class="fas fa-star active"></li>
        <li class="fas fa-star active"></li>
        <li class="fas fa-star"></li>
        <li class="total">(163 ratings)</li>
      </ul> -->
      <!-- <p>(45 Products)</p> -->
    </div>
    <section class="inner-section shop-part">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="top-filter">
              <div class="filter-show">
                <label class="filter-label">Show :</label
                ><select
                  class="form-select filter-select"
                  v-model="limit"
                  @change="sellerData"
                >
                  <option value="10">10</option>
                  <option value="20">20</option>
                  <option value="30">30</option>
                  <option value="50">50</option>
                  <option value="100">100</option>
                </select>
              </div>
              <div class="filter-short">
                <label class="filter-label">Short by :</label
                ><select class="form-select filter-select" v-model="sortBy" @change="sellerData">
                  <option selected value="">default</option>
                  <option value="new">New</option>
                  <option value="popular">Popular</option>
                  <!-- <option value="winter">Winter</option> -->
                  <option value="feature">Feature</option>
                </select>
              </div>
            </div>
          </div>
        </div>

        <div class="row row-cols-2 row-cols-md-3 row-cols-lg-3 row-cols-xl-5" v-if="products.data">
          <div
            class="col"
            v-for="(product, index) in products.data"
            :key="index"
          >
            <!-- //disable or stock out products // use class product-disable // after product-card -->
            <div
              :class="`product-card ${
                product.stock == 0 ? 'product-disable' : ''
              }`"
            >
              <div class="product-media">
                <div class="product-label">
                  <label class="label-text sale">{{
                    product.conditions
                  }}</label>
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

         <Product-skeleton :data-amounts="10" v-else />
        <div class="row">
          <div class="col-lg-12">
            <div class="bottom-paginate" v-if="products.data">
              <p class="page-info">
                Showing {{ products.data.length }} of
                {{ products.total }} Results
              </p>
              <ul class="pagination">
                <pagination
                  v-model="currentPage"
                  :records="products.total"
                  :per-page="products.per_page"
                  @paginate="sellerData"
                />

                <!-- <li class="page-item">
                  <a class="page-link" href="#"
                    ><i class="fas fa-long-arrow-alt-left"></i
                  ></a>
                </li>
                <li class="page-item">
                  <a class="page-link active" href="#">1</a>
                </li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item">...</li>
                <li class="page-item"><a class="page-link" href="#">60</a></li>
                <li class="page-item">
                  <a class="page-link" href="#"
                    ><i class="fas fa-long-arrow-alt-right"></i
                  ></a>
                </li> -->
              </ul>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>
<script>
import DynamicImg from "@/components/frontend/DynamicImg.vue";
import ProductPrice from "@/components/frontend/ProductPrice.vue";
import AddToWishList from "@/components/frontend/AddToWishList.vue";
import ProductSkeleton from "@/components/skeleton/ProductSkeleton.vue";
import { ElNotification } from "element-plus";
export default {
  components: { DynamicImg, ProductPrice, AddToWishList,ProductSkeleton },
  data() {
    return {
      currentPage: 1,
      limit: 10,
      sortBy:"",
    };
  },

  mounted() {
    this.sellerData();
  },

  methods: {
    sellerData() {
      this.$store.dispatch("seller/FETCH_SINGLE_DATA", {
        slug: this.$route.params.slug,
        page: this.currentPage,
        limit: this.limit,
        sort:this.sortBy
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

  computed: {
    seller() {
      return this.$store.getters["seller/GET_SELLER_DATA"];
    },

    products() {
      return this.$store.getters["seller/GET_SELLER_PRODUCTS"];
    },
  },
};
</script>
<style></style>
