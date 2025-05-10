<template>
  <div>
    <div class="modal fade" id="product-view">
      <div class="modal-dialog">
        <div class="modal-content">
          <button
            class="modal-close icofont-close"
            @click.prevent="closeModal"
            id="closePModal"
            data-bs-dismiss="modal"
          ></button>
          <div class="product-view">
            <div class="row">
              <div class="col-md-6 col-lg-6">
                <div class="view-gallery">
                  <div class="view-label-group">
                    <label class="view-label new">{{
                      product.conditions
                    }}</label
                    ><label class="view-label off"
                      >-{{ product.discount }}%</label
                    >
                  </div>

                  <img
                    :src="$filters.makeImagePath(product.thumbnail)"
                    v-if="product.thumbnail"
                    style="width: 100%"
                    alt=""
                  />

                  <img
                    src="/website/images/cart/no-image.png"
                    v-else
                    style="width: 100%"
                    alt=""
                  />
                </div>
              </div>

              <div class="col-md-6 col-lg-6" v-if="product">
                <div class="view-details">
                  <h3 class="view-name">
                    <a href="product-video.html" v-if="product">
                      {{ product.name }}</a
                    >

                    <!-- <i class="icofont-heart" style="float: right"></i> -->
                   
                  </h3>
                   <button
                      class="product-wish wish"
                      
                    >
                      <i class="fas fa-heart"></i>
                      <!-- added class is active class  -->
                    </button>
                  <div class="view-meta" v-if="product.category">
                    <p>
                      Category:<span>{{ product.category.name }}</span>
                    </p>
                    <p>
                      Shop:<a href="#" v-if="product.shop">{{
                        product.shop.name
                      }}</a>
                    </p>
                  </div>
                  <div class="view-rating">
                    <i class="active icofont-star"></i
                    ><i class="active icofont-star"></i
                    ><i class="active icofont-star"></i
                    ><i class="active icofont-star"></i
                    ><i class="icofont-star"></i
                    ><a href="product-video.html">(3 reviews)</a>
                  </div>
                  <!-- 
                  <h3 class="view-price" v-if="product.offer_price">
                    <del>{{ $filters.currencyBDT(product.price) }}</del>
                    <span>{{ $filters.currencyBDT(product.offer_price) }}</span>
                  </h3>
                  <h3 class="view-price" v-else>
                    <span v-if="product.price">{{
                      $filters.currencyBDT(product.price)
                    }}</span>
                  </h3> -->

                  <Product-price
                    :price="product.price"
                    :discount="product.discount"
                    :modal="true"
                  />

                  <div class="view-list-group" v-if="product.size">
                    <label
                      class="view-list-title"
                      v-if="product.size.length > 0"
                      >Sizes:</label
                    >
                    <ul class="view-tag-list" v-if="product.size.length > 0">
                      <li
                        aria-label="box"
                        v-for="(sz, index) in product.size"
                        :key="index"
                      >
                        <a href="#"
                          ><input
                            id="box"
                            v-model="size"
                            class="radioBox"
                            :value="sz"
                            type="radio"
                          />
                          {{ sz }}</a
                        >
                      </li>
                    </ul>
                  </div>

                  <div class="view-list-group" v-if="product.size">
                    <label
                      class="view-list-title"
                      v-if="product.color.length > 0"
                      >Colors:</label
                    >
                    <ul class="view-tag-list" v-if="product.color.length > 0">
                      <li
                        aria-label="box"
                        v-for="(colr, index) in product.color"
                        :key="index"
                      >
                        <a href="#"
                          ><input
                            id="box"
                            v-model="color"
                            class="radioBox"
                            :value="colr"
                            type="radio"
                          />
                          {{ colr }}</a
                        >
                      </li>
                    </ul>
                  </div>

                  <!-- <div class="view-list-group">
                    <label class="view-list-title">Share:</label>
                    <ul class="view-share-list">
                      <li>
                        <a
                          href="#"
                          class="icofont-facebook"
                          title="Facebook"
                        ></a>
                      </li>
                      <li>
                        <a href="#" class="icofont-twitter" title="Twitter"></a>
                      </li>
                      <li>
                        <a
                          href="#"
                          class="icofont-linkedin"
                          title="Linkedin"
                        ></a>
                      </li>
                      <li>
                        <a
                          href="#"
                          class="icofont-instagram"
                          title="Instagram"
                        ></a>
                      </li>
                    </ul>
                  </div> -->
                  <div class="view-add-group">
                    <button
                      class="product-add"
                      title="Add to Cart"
                      @click.prevent="addToCart(product)"
                    >
                      <i class="fas fa-shopping-basket"></i
                      ><span>add to cart</span>
                    </button>
                  </div>
                  <div class="view-action-group">
                    <a
                      class="view-compare"
                      href="compare.html"
                      title="Compare This Item"
                      ><i class="fas fa-random"></i><span>Buy Now</span></a
                    >

                    <!-- <a class="view-wish wish" href="#" title="Add Your Wishlist"
                      ><i class="icofont-heart"></i><span>add to wish</span></a
                    > -->
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import { ElNotification } from "element-plus";
// import ProductModalSkeleton from '../skeleton/ProductModalSkeleton.vue';
import ProductPrice from "./ProductPrice.vue";
import $ from "jquery";
export default {
  components: { ProductPrice },
  props: ["product"],

  data() {
    return {
      size: "",
      color: "",
      price: "",
    };
  },

  methods: {
    closeModal() {
      this.size = "";
      this.color = "";
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
        size: this.size,
        color: this.color,
        thumbnail: product.thumbnail,
      });

      $("#closePModal").click();

      this.size = "";
      this.color = "";

      ElNotification.success({
        title: "Success",
        message: "Successfully Added On Cart",
        offset: 100,
      });
      // var e = $('.product-add').next(".product-action");
      // $('.product-add').hide(), e.css("display", "flex");
    },
  },

  mounted() {
    // this.eventBus.$on("showProductModal", (payload) => {
    //   this.product.push(payload);
    // });
  },
};
</script>
<style>
.icofont-heart {
  cursor: pointer;
}
.added {
  color: #ff3838;
}
</style>
