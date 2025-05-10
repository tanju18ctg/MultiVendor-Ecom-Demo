<template>
  <div class="home">
    <section class="banner-part">
      <div class="">
        <div class="row">
          <div
            class="col-lg-12 order-0 order-lg-1 order-xl-1"
            v-if="sliders.data"
          >
            <div class="home-grid-slider slider-arrow slider-dots">
              <carousel
                :autoplay="2500"
                :wrap-around="true"
                :pause-autoplay-on-hover="true"
              >
                <slide v-for="(slider, index) in sliders.data" :key="index">
                  <Dynamic-img :path="slider.image" />
                </slide>

                <template #addons>
                  <pagination />
                </template>
              </carousel>
            </div>
          </div>
          <Home-slider :data-amounts="1" v-else />
        </div>
      </div>
    </section>

    <section class="section suggest-part">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="section-heading">
              <h3 style="float: left">SHOP BY CATEGORIES</h3>
            </div>
          </div>
        </div>

        <div
          class="row row-cols-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5"
          v-if="categories.data"
        >
          <div class="col" v-for="(cat, index) in categories.data" :key="index">
            <div class="product-card">
              <ul>
                <li>
                  <a class="suggest-card" href="shop-4column.html">
                    <Dynamic-img :path="cat.image" />
                  </a>
                </li>
              </ul>

              <h6 class="text-center mt-2">
                {{ cat.name }}
                <!-- <span v-if="cat.products"
                  >{{ cat.products.length }} products</span
                > -->
              </h6>
            </div>
          </div>
        </div>
        <Category-skeleton :data-amounts="10" v-else />
      </div>
    </section>

    <!-- recently sold items will be go here  -->
    <section class="section recent-part">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="section-heading">
              <h2>Recently Sold Items</h2>
            </div>
          </div>
        </div>

        <div
          class="row row-cols-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5"
          v-if="sale_products.data"
        >
          <div
            class="col"
            v-for="(product, index) in sale_products.data"
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

                <!-- <button
                  class="product-wish wish"
                  v-if="user.name"
                  @click.prevent="addToWishlist(product.id)"
                >
                  <i class="fas fa-heart"></i>
                </button>

                <button
                  class="product-wish wish"
                  data-bs-toggle="modal"
                  data-bs-target="#login-modal"
                  v-else
                >
                  <i class="fas fa-heart"></i>
                </button> -->
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
                <!-- title="Add to Cart"
                  data-bs-toggle="modal"
                  data-bs-target="#product-view" -->
                <button
                  title="Add to Cart"
                  class="product-add"
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
            <div class="section-btn-25">
              <a href="shop-4column.html" class="btn btn-outline"
                ><i class="fas fa-eye"></i><span>show more</span></a
              >
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="section recent-part">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="section-heading">
              <h2>Popular Items.</h2>
            </div>
          </div>
        </div>
        <div
          class="row row-cols-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5"
          v-if="popular_products.data"
        >
          <div
            class="col"
            v-for="(product, index) in popular_products.data"
            :key="index"
          >
            <div class="product-card">
              <div class="product-media">
                <div class="product-label">
                  <label class="label-text rate">{{
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
                <h6 class="product-name">
                  <a href="product-video.html">{{ product.name }}</a>
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
            <div class="section-btn-25">
              <a href="shop-4column.html" class="btn btn-outline"
                ><i class="fas fa-eye"></i><span>show more</span></a
              >
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="section recent-part">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="section-heading">
              <h2>Featured Items.</h2>
            </div>
          </div>
        </div>
        <div
          class="row row-cols-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5"
          v-if="feature_products.data"
        >
          <div
            class="col"
            v-for="(product, index) in feature_products.data"
            :key="index"
          >
            <div class="product-card">
              <div class="product-media">
                <div class="product-label">
                  <label class="label-text feat">{{
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
            <div class="section-btn-25">
              <a href="shop-4column.html" class="btn btn-outline"
                ><i class="fas fa-eye"></i><span>show more</span></a
              >
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- <div class="section promo-part">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="promo-img">
              <a href="#"
                ><img src="/website/images/promo/home/03.jpg" alt="promo"
              /></a>
            </div>
          </div>
        </div>
      </div>
    </div> -->

    <section class="section newitem-part">
      <div class="container">
        <div class="row">
          <div class="col">
            <div class="section-heading">
              <h2>collected new items</h2>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col">
            <ul class="new-slider slider-arrow" v-if="new_products.data">
              <Carousel
                :settings="settings"
                :breakpoints="breakpoints"
                :autoplay="2000"
                :wrap-around="true"
              >
                <Slide
                  v-for="(product, index) in new_products.data"
                  :key="index"
                >
                  <div class="product-card">
                    <div class="product-media">
                      <div class="product-label">
                        <label class="label-text new">{{
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
                      <div class="product-rating">
                        <i class="active icofont-star"></i
                        ><i class="active icofont-star"></i
                        ><i class="active icofont-star"></i
                        ><i class="active icofont-star"></i
                        ><i class="icofont-star"></i
                        ><a href="product-video.html">(3)</a>
                      </div>
                      <h6 class="product-name">
                        <a href="product-video.html">{{ product.name }}</a>
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
                        <i class="fas fa-shopping-basket"></i
                        ><span>Shop Now</span>
                      </button>
                    </div>
                  </div>
                </Slide>

                <template #addons>
                  <Navigation />
                </template>
              </Carousel>
            </ul>

            <Product-skeleton :data-amounts="5" v-else />
          </div>
        </div>
        <div class="row">
          <div class="col">
            <div class="section-btn-25">
              <a href="shop-4column.html" class="btn btn-outline"
                ><i class="fas fa-eye"></i><span>show more</span></a
              >
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- <div class="section promo-part">
      <div class="container">
        <div class="row">
          <div class="col-sm-12 col-md-6 col-lg-6 px-xl-3">
            <div class="promo-img">
              <a href="#"
                ><img src="/website/images/promo/home/01.jpg" alt="promo"
              /></a>
            </div>
          </div>
          <div class="col-sm-12 col-md-6 col-lg-6 px-xl-3">
            <div class="promo-img">
              <a href="#"
                ><img src="/website/images/promo/home/02.jpg" alt="promo"
              /></a>
            </div>
          </div>
        </div>
      </div>
    </div> -->

    <product-modal :product="modalData" />
  </div>
</template>
<script>
// @ is an alias to /src
// import HelloWorld from '@/components/HelloWorld.vue'
import $ from "jquery";
import { ElNotification } from "element-plus";
import HomeSlider from "@/components/skeleton/HomeSlider.vue";
import ProductSkeleton from "@/components/skeleton/ProductSkeleton.vue";
import CategorySkeleton from "../../components/skeleton/CategorySkeleton.vue";
import "vue3-carousel/dist/carousel.css";
import { Carousel, Slide, Pagination, Navigation } from "vue3-carousel";
import ProductModal from "../../components/frontend/ProductModal.vue";
import ProductPrice from "../../components/frontend/ProductPrice.vue";
import DynamicImg from "../../components/frontend/DynamicImg.vue";
import AddToWishList from "../../components/frontend/AddToWishList.vue";

export default {
  name: "Home",
  components: {
    HomeSlider,
    ProductSkeleton,
    CategorySkeleton,
    Carousel,
    Slide,
    Pagination,
    Navigation,
    ProductModal,
    ProductPrice,
    DynamicImg,
    AddToWishList,
  },

  data() {
    return {
      price: "",
      settings: {
        itemsToShow: 1,
        snapAlign: "center",
      },
      // breakpoints are mobile first
      // any settings not specified will fallback to the carousel settings
      breakpoints: {
        // 700px and up
        700: {
          itemsToShow: 3.5,
          snapAlign: "center",
        },

        // 1024 and up
        1024: {
          itemsToShow: 5,
          snapAlign: "start",
        },
      },

      modalData: "",
    };
  },

  created() {
    this.reviewJquery();
    this.$store.dispatch("slider/FETCH_SLIDERS");
    this.$store.dispatch("category/FETCH_CATEGORIES");
    this.$store.dispatch("product/FETCH_SALE_PRODUCTS");

    this.$store.dispatch("product/FETCH_CONDITIONS_PRODUCTS", "new");
    this.$store.dispatch("product/FETCH_CONDITIONS_PRODUCTS", "winter");
    this.$store.dispatch("product/FETCH_CONDITIONS_PRODUCTS", "popular");
    this.$store.dispatch("product/FETCH_CONDITIONS_PRODUCTS", "feature");
  },

  methods: {
    reviewJquery() {
      "use strict";
      setTimeout(() => {
        $(window).on("scroll", function () {
          $(this).scrollTop() > 130
            ? $(".header-part").addClass("active")
            : $(".header-part").removeClass("active");
        }),
          $(window).on("scroll", function () {
            $(this).scrollTop() > 700
              ? $(".backtop").show()
              : $(".backtop").hide();
          }),
          $(function () {
            $(".dropdown-link").click(function () {
              $(this).next().toggle(),
                $(this).toggleClass("active"),
                $(".dropdown-list:visible").length > 1 &&
                  ($(".dropdown-list:visible").hide(),
                  $(this).next().show(),
                  $(".dropdown-link").removeClass("active"),
                  $(this).addClass("active"));
            });
          }),
          $(".nav-link").on("click", function () {
            $(".nav-list li a").removeClass("active"),
              $(this).addClass("active");
          }),
          $(".header-cate, .cate-btn").on("click", function () {
            $("body").css("overflow", "hidden"),
              $(".category-sidebar").addClass("active"),
              $(".category-close").on("click", function () {
                $("body").css("overflow", "inherit"),
                  $(".category-sidebar").removeClass("active"),
                  $(".backdrop").fadeOut();
              });
          }),
          $(".header-user").on("click", function () {
            $("body").css("overflow", "hidden"),
              $(".nav-sidebar").addClass("active"),
              $(".nav-close").on("click", function () {
                $("body").css("overflow", "inherit"),
                  $(".nav-sidebar").removeClass("active"),
                  $(".backdrop").fadeOut();
              });
          }),
          $(".header-cart, .cart-btn").on("click", function () {
            $("body").css("overflow", "hidden"),
              $(".cart-sidebar").addClass("active"),
              $(".cart-close").on("click", function () {
                $("body").css("overflow", "inherit"),
                  $(".cart-sidebar").removeClass("active"),
                  $(".backdrop").fadeOut();
              });
          }),
          $(
            ".header-user, .header-cart, .header-cate, .cart-btn, .cate-btn"
          ).on("click", function () {
            $(".backdrop").fadeIn(),
              $(".backdrop").on("click", function () {
                $(this).fadeOut(),
                  $("body").css("overflow", "inherit"),
                  $(".nav-sidebar").removeClass("active"),
                  $(".cart-sidebar").removeClass("active"),
                  $(".category-sidebar").removeClass("active");
              });
          }),
          $(".coupon-btn").on("click", function () {
            $(this).hide(), $(".coupon-form").css("display", "flex");
          }),
          $(".header-src").on("click", function () {
            $(".header-form").toggleClass("active"),
              $(this).children(".fa-search").toggleClass("fa-times");
          }),
          $(".wish").on("click", function () {
            $(this).toggleClass("active");
          }),
          // $(".product-add").on("click", function () {
          //   var e = $(this).next(".product-action");
          //   $(this).hide(), e.css("display", "flex");
          // }),
          $(".action-plus").on("click", function () {
            var e = $(this)
                .closest(".product-action")
                .children(".action-input")
                .get(0).value++,
              c = $(this).closest(".product-action").children(".action-minus");
            e > 0 && c.removeAttr("disabled");
          }),
          $(".action-minus").on("click", function () {
            2 ==
              $(this)
                .closest(".product-action")
                .children(".action-input")
                .get(0).value-- && $(this).attr("disabled", "disabled");
          }),
          $(".review-widget-btn").on("click", function () {
            $(this).next(".review-widget-list").toggle();
          }),
          $(".offer-select").on("click", function () {
            $(this).text("Copied!");
          }),
          $(".modal").on("shown.bs.modal", function () {
            $(".preview-slider, .thumb-slider").slick("setPosition", 0);
          }),
          $(".profile-card.schedule").on("click", function () {
            $(".profile-card.schedule").removeClass("active"),
              $(this).addClass("active");
          }),
          $(".profile-card.contact").on("click", function () {
            $(".profile-card.contact").removeClass("active"),
              $(this).addClass("active");
          }),
          $(".profile-card.address").on("click", function () {
            $(".profile-card.address").removeClass("active"),
              $(this).addClass("active");
          }),
          $(".payment-card.payment").on("click", function () {
            $(".payment-card.payment").removeClass("active"),
              $(this).addClass("active");
          }),
          $(".new-slider").slick({
            dots: !1,
            infinite: !0,
            autoplay: !0,
            arrows: !0,
            speed: 800,
            prevArrow: '<i class="icofont-arrow-right dandik"></i>',
            nextArrow: '<i class="icofont-arrow-left bamdik"></i>',
            slidesToShow: 5,
            slidesToScroll: 1,
            responsive: [
              {
                breakpoint: 1200,
                settings: { slidesToShow: 4, slidesToScroll: 2 },
              },
              {
                breakpoint: 992,
                settings: { slidesToShow: 3, slidesToScroll: 3 },
              },
              {
                breakpoint: 768,
                settings: { slidesToShow: 2, slidesToScroll: 2 },
              },
              {
                breakpoint: 576,
                settings: {
                  slidesToShow: 1,
                  slidesToScroll: 1,
                  variableWidth: !0,
                  arrows: !1,
                },
              },
            ],
          }),
          $(".category-slider").slick({
            dots: !1,
            infinite: !0,
            autoplay: !0,
            arrows: !0,
            speed: 800,
            prevArrow: '<i class="icofont-arrow-right dandik"></i>',
            nextArrow: '<i class="icofont-arrow-left bamdik"></i>',
            slidesToShow: 5,
            slidesToScroll: 1,
            responsive: [
              {
                breakpoint: 1200,
                settings: { slidesToShow: 5, slidesToScroll: 5 },
              },
              {
                breakpoint: 992,
                settings: { slidesToShow: 4, slidesToScroll: 4 },
              },
              {
                breakpoint: 768,
                settings: { slidesToShow: 3, slidesToScroll: 3 },
              },
              {
                breakpoint: 576,
                settings: {
                  slidesToShow: 2,
                  slidesToScroll: 2,
                  variableWidth: !0,
                  arrows: !1,
                },
              },
            ],
          }),
          $(".brand-slider").slick({
            dots: !1,
            infinite: !0,
            autoplay: !1,
            arrows: !0,
            speed: 800,
            prevArrow: '<i class="icofont-arrow-right dandik"></i>',
            nextArrow: '<i class="icofont-arrow-left bamdik"></i>',
            slidesToShow: 5,
            slidesToScroll: 1,
            responsive: [
              {
                breakpoint: 1200,
                settings: { slidesToShow: 4, slidesToScroll: 4 },
              },
              {
                breakpoint: 992,
                settings: { slidesToShow: 3, slidesToScroll: 3 },
              },
              {
                breakpoint: 768,
                settings: { slidesToShow: 2, slidesToScroll: 2 },
              },
              {
                breakpoint: 576,
                settings: {
                  slidesToShow: 2,
                  slidesToScroll: 1,
                  variableWidth: !0,
                  arrows: !1,
                },
              },
            ],
          }),
          $(".blog-slider").slick({
            dots: !1,
            infinite: !0,
            autoplay: !1,
            arrows: !0,
            speed: 800,
            prevArrow: '<i class="icofont-arrow-right dandik"></i>',
            nextArrow: '<i class="icofont-arrow-left bamdik"></i>',
            slidesToShow: 3,
            slidesToScroll: 1,
            responsive: [
              {
                breakpoint: 1200,
                settings: { slidesToShow: 3, slidesToScroll: 3 },
              },
              {
                breakpoint: 992,
                settings: { slidesToShow: 2, slidesToScroll: 2 },
              },
              {
                breakpoint: 768,
                settings: { slidesToShow: 1, slidesToScroll: 1 },
              },
              {
                breakpoint: 576,
                settings: { slidesToShow: 1, slidesToScroll: 1, arrows: !1 },
              },
            ],
          }),
          $(".testimonial-slider").slick({
            dots: !1,
            infinite: !0,
            autoplay: !1,
            arrows: !0,
            fade: !1,
            speed: 1e3,
            centerMode: !0,
            centerPadding: "250px",
            slidesToShow: 1,
            slidesToScroll: 1,
            prevArrow: '<i class="icofont-arrow-right dandik"></i>',
            nextArrow: '<i class="icofont-arrow-left bamdik"></i>',
            responsive: [
              {
                breakpoint: 1200,
                settings: {
                  slidesToShow: 1,
                  slidesToScroll: 1,
                  centerPadding: "250px",
                },
              },
              {
                breakpoint: 992,
                settings: {
                  slidesToShow: 1,
                  slidesToScroll: 1,
                  centerPadding: "130px",
                },
              },
              {
                breakpoint: 768,
                settings: {
                  slidesToShow: 1,
                  slidesToScroll: 1,
                  centerPadding: "40px",
                },
              },
              {
                breakpoint: 576,
                settings: {
                  arrows: !1,
                  slidesToShow: 1,
                  slidesToScroll: 1,
                  centerPadding: "10px",
                },
              },
            ],
          }),
          $(".testi-slider").slick({
            dots: !1,
            infinite: !0,
            autoplay: !1,
            arrows: !0,
            speed: 800,
            prevArrow: '<i class="icofont-arrow-right dandik"></i>',
            nextArrow: '<i class="icofont-arrow-left bamdik"></i>',
            slidesToShow: 1,
            slidesToScroll: 1,
            responsive: [
              {
                breakpoint: 1200,
                settings: { slidesToShow: 1, slidesToScroll: 1 },
              },
              {
                breakpoint: 992,
                settings: { slidesToShow: 1, slidesToScroll: 1 },
              },
              {
                breakpoint: 768,
                settings: { slidesToShow: 1, slidesToScroll: 1 },
              },
              {
                breakpoint: 576,
                settings: { slidesToShow: 1, slidesToScroll: 1 },
              },
            ],
          }),
          $(".team-slider").slick({
            dots: !1,
            infinite: !0,
            autoplay: !1,
            arrows: !0,
            speed: 800,
            prevArrow: '<i class="icofont-arrow-right dandik"></i>',
            nextArrow: '<i class="icofont-arrow-left bamdik"></i>',
            slidesToShow: 4,
            slidesToScroll: 1,
            responsive: [
              {
                breakpoint: 1200,
                settings: { slidesToShow: 3, slidesToScroll: 3 },
              },
              {
                breakpoint: 992,
                settings: { slidesToShow: 3, slidesToScroll: 3 },
              },
              {
                breakpoint: 768,
                settings: { slidesToShow: 2, slidesToScroll: 2 },
              },
              {
                breakpoint: 576,
                settings: { slidesToShow: 1, slidesToScroll: 1 },
              },
            ],
          }),
          $(".isotope-slider").slick({
            dots: !1,
            infinite: !0,
            autoplay: !1,
            arrows: !0,
            speed: 800,
            prevArrow: '<i class="icofont-arrow-right dandik"></i>',
            nextArrow: '<i class="icofont-arrow-left bamdik"></i>',
            slidesToShow: 5,
            slidesToScroll: 2,
            responsive: [
              {
                breakpoint: 1200,
                settings: { slidesToShow: 5, slidesToScroll: 2 },
              },
              {
                breakpoint: 992,
                settings: { slidesToShow: 3, slidesToScroll: 3 },
              },
              {
                breakpoint: 768,
                settings: { slidesToShow: 2, slidesToScroll: 2 },
              },
              {
                breakpoint: 576,
                settings: { slidesToShow: 2, slidesToScroll: 2 },
              },
            ],
          }),
          $(".preview-slider").slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: !0,
            fade: !0,
            asNavFor: ".thumb-slider",
            prevArrow: '<i class="icofont-arrow-right dandik"></i>',
            nextArrow: '<i class="icofont-arrow-left bamdik"></i>',
            responsive: [
              {
                breakpoint: 576,
                settings: { slidesToShow: 1, slidesToScroll: 1, arrows: !0 },
              },
            ],
          }),
          $(".thumb-slider").slick({
            slidesToShow: 3,
            slidesToScroll: 1,
            asNavFor: ".preview-slider",
            dots: !1,
            arrows: !1,
            centerMode: !0,
            focusOnSelect: !0,
            responsive: [
              {
                breakpoint: 992,
                settings: { slidesToShow: 3, slidesToScroll: 1 },
              },
              {
                breakpoint: 768,
                settings: { slidesToShow: 3, slidesToScroll: 1 },
              },
              {
                breakpoint: 576,
                settings: { slidesToShow: 3, slidesToScroll: 1 },
              },
              {
                breakpoint: 400,
                settings: { slidesToShow: 2, slidesToScroll: 1 },
              },
            ],
          }),
          $(".details-preview").slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: !1,
            fade: !0,
            asNavFor: ".details-thumb",
            prevArrow: '<i class="icofont-arrow-right dandik"></i>',
            nextArrow: '<i class="icofont-arrow-left bamdik"></i>',
            responsive: [
              {
                breakpoint: 576,
                settings: { slidesToShow: 1, slidesToScroll: 1, arrows: !0 },
              },
            ],
          }),
          $(".details-thumb").slick({
            slidesToShow: 5,
            slidesToScroll: 1,
            asNavFor: ".details-preview",
            dots: !1,
            arrows: !1,
            focusOnSelect: !0,
            responsive: [
              {
                breakpoint: 1200,
                settings: { slidesToShow: 3, slidesToScroll: 1 },
              },
              {
                breakpoint: 992,
                settings: { slidesToShow: 5, slidesToScroll: 1 },
              },
              {
                breakpoint: 768,
                settings: { slidesToShow: 4, slidesToScroll: 1 },
              },
              {
                breakpoint: 576,
                settings: { slidesToShow: 4, slidesToScroll: 1, vertical: !1 },
              },
              {
                breakpoint: 400,
                settings: { slidesToShow: 3, slidesToScroll: 1, vertical: !1 },
              },
            ],
          });
      }, 200);
    },

    newSlider() {
      $(".new-slider").slick({
        dots: !1,
        infinite: !0,
        autoplay: !0,
        arrows: !0,
        speed: 800,
        prevArrow: '<i class="icofont-arrow-right dandik"></i>',
        nextArrow: '<i class="icofont-arrow-left bamdik"></i>',
        slidesToShow: 5,
        slidesToScroll: 1,
        responsive: [
          {
            breakpoint: 1200,
            settings: { slidesToShow: 4, slidesToScroll: 2 },
          },
          {
            breakpoint: 992,
            settings: { slidesToShow: 3, slidesToScroll: 3 },
          },
          {
            breakpoint: 768,
            settings: { slidesToShow: 2, slidesToScroll: 2 },
          },
          {
            breakpoint: 576,
            settings: {
              slidesToShow: 1,
              slidesToScroll: 1,
              variableWidth: !0,
              arrows: !1,
            },
          },
        ],
      });
    },

    // showProductModal(product) {
    //   if (product.size.length > 0) {
    //     this.modalData = product;
    //   } else if (product.color.length > 0) {
    //     this.modalData = product;
    //   } else {
    //     this.addToCart(product);
    //   }
    //   // alert(product);
    // },

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

  mounted() {
    document.title = "Home";
  },

  computed: {
    sliders() {
      return this.$store.getters["slider/GET_SLIDERS"];
    },

    categories() {
      return this.$store.getters["category/GET_CATEGORIES"];
    },

    sale_products() {
      return this.$store.getters["product/GET_SALE_PRODUCTS"];
    },

    carts() {
      return this.$store.getters["cart/GET_CART_ITEMS"];
    },

    cartItemCount() {
      return this.$store.getters["cart/GET_CART_ITEMCOUNT"];
    },

    new_products() {
      return this.$store.getters["product/GET_NEW_PRODUCTS"];
    },

    popular_products() {
      return this.$store.getters["product/GET_POPULAR_PRODUCTS"];
    },

    winter_products() {
      return this.$store.getters["product/GET_WINTER_PRODUCTS"];
    },

    feature_products() {
      return this.$store.getters["product/GET_FEATURE_PRODUCTS"];
    },

    user() {
      return this.$store.getters["auth/GET_AUTH_INFO"];
    },

    // carts(){
    //  return this.$store.getters['cart/GET_CART'];
    // }
  },
};
</script>

<style>
.home-grid-slider img {
  border-radius: 0;
}
.carousel__pagination-button {
  width: 9px;
  height: 9px;
  margin: 0px 5px;
  border-radius: 30px;
  cursor: pointer;
  display: inline-block;
  background: #119744;
  -webkit-box-shadow: 0px 2px 8px 0px rgba(0, 0, 0, 0.15);
  box-shadow: 0px 2px 8px 0px rgba(0, 0, 0, 0.15);
  transition: all linear 0.3s;
  -webkit-transition: all linear 0.3s;
  -moz-transition: all linear 0.3s;
  -ms-transition: all linear 0.3s;
  -o-transition: all linear 0.3s;
}

.carousel__pagination-button--active {
  width: 25px;
  background: #119744;
  transition: all linear 0.3s;
  -webkit-transition: all linear 0.3s;
  -moz-transition: all linear 0.3s;
  -ms-transition: all linear 0.3s;
  -o-transition: all linear 0.3s;
}

.carousel__prev {
  background: #119744;
  color: #fff;
}

.carousel__next {
  background: #119744;
  color: #fff;
}
</style>
