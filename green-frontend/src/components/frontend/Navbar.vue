<template>
  <div>
    <nav class="navbar-part">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="navbar-content">
              <ul class="navbar-list">
                <li class="navbar-item dropdown">
                  <router-link :to="{ name: 'Home' }" class="navbar-link"
                    >home</router-link
                  >
                </li>

                <li class="navbar-item dropdown-megamenu">
                  <a class="navbar-link dropdown-arrow" href="#">category</a>
                  <div class="megamenu">
                    <div class="container megamenu-scroll">
                      <div class="row row-cols-5">
                        <div
                          class="col"
                          v-for="(cat, index) in categories().data"
                          :key="index"
                        >
                          <div class="megamenu-wrap">
                            <h5 class="megamenu-title">
                              <a href="#">{{ cat.name }}</a>
                            </h5>
                            <!-- <span v-if="cat.subcategories">{{ cat.subcategories() }}</span> -->
                            <ul class="megamenu-list" v-if="cat.subcategories">
                              <li
                                v-for="(subcat, index) in cat.subcategories"
                                :key="index"
                              >
                                <a href="#">{{ subcat.name }}</a>
                              </li>
                            </ul>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </li>

                <li class="navbar-item dropdown">
                  <router-link :to="{ name: 'Shop' }" class="navbar-link"
                    >Shop</router-link
                  >
                </li>

                 <li class="navbar-item dropdown">
                  <router-link :to="{ name: 'Sellers' }" class="navbar-link"
                    >All Sellers</router-link
                  >
                </li>

                <li class="navbar-item dropdown">
                  <a class="navbar-link" href="#">About Us</a>
                </li>

                <li class="navbar-item dropdown">
                  <a class="navbar-link" href="#">Contact Us</a>
                </li>
              </ul>
              <!-- <div class="navbar-info-group">
                <div class="navbar-info">
                  <i class="icofont-ui-touch-phone"></i>
                  <p><small>call us</small><span>(+880) 183 8288 389</span></p>
                </div>
                <div class="navbar-info">
                  <i class="icofont-ui-email"></i>
                  <p><small>email us</small><span>support@greeny.com</span></p>
                </div>
              </div> -->
            </div>
          </div>
        </div>
      </div>
    </nav>

    <!-- for mobile menu category sidebar and home end  -->

    <aside class="category-sidebar">
      <div class="category-header">
        <h4 class="category-title">
          <i class="fas fa-align-left"></i><span>categories</span>
        </h4>
        <button class="category-close"><i class="icofont-close"></i></button>
      </div>
      <ul class="category-list">
        <li
          class="category-item"
          v-for="(cat, index) in categories().data"
          :key="index"
        >
          <a
            class="category-link dropdown-link"
            @click.prevent="openCategory"
            href="javascript::void(0)"
            ><i class="flaticon-vegetable"></i><span>{{ cat.name }}</span></a
          >
          <ul class="dropdown-list">
            <li v-for="(subcat, index) in cat.subcategories" :key="index">
              <a href="#">{{ subcat.name }}</a>
            </li>
          </ul>
        </li>
      </ul>
      <div class="category-footer">
        <p>All Rights Reserved by <a href="#">W3Coders</a></p>
      </div>
    </aside>

    <aside class="nav-sidebar">
      <div class="nav-header">
        <a href="#"><img src="/website/images/logo.png" alt="logo" /></a
        ><button class="nav-close"><i class="icofont-close"></i></button>
      </div>
      <div class="nav-content">
        <ul class="nav-list">
          <li>
            <router-link :to="{ name: 'Home' }" class="nav-link"
              ><i class="icofont-home"></i>Home</router-link
            >
          </li>

          <li>
            <a class="nav-link" href="contact.html"
              ><i class="icofont-contacts"></i>contact us</a
            >
          </li>

          <li>
            <a class="nav-link" href="login.html"
              ><i class="icofont-logout"></i>logout</a
            >
          </li>
        </ul>
        <div class="nav-info-group">
          <div class="nav-info">
            <i class="icofont-ui-touch-phone"></i>
            <p><small>call us</small><span>(+880) 183 8288 389</span></p>
          </div>
          <div class="nav-info">
            <i class="icofont-ui-email"></i>
            <p><small>email us</small><span>support@greeny.com</span></p>
          </div>
        </div>
      </div>
    </aside>

    <!-- for mobile menu category sidebar and home end  -->
  </div>
</template>
<script>
import $ from "jquery";
export default {
  props: ["categories"],

  methods: {
    openCategory() {
      $(".dropdown-link").next().toggle(),
        $(".dropdown-link").toggleClass("active"),
        $(".dropdown-list:visible").length > 1 &&
          ($(".dropdown-list:visible").hide(),
          $(".dropdown-link").next().show(),
          $(".dropdown-link").removeClass("active"),
          $(".dropdown-link").addClass("active"));
    },
  },
};
</script>
<style></style>
