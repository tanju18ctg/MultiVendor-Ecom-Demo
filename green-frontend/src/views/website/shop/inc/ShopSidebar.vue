<template>
  <div>
    <div class="shop-widget">
      <h6 class="shop-widget-title">Filter by Price</h6>
      <form @submit.prevent="productFilter('price')">
        <div class="shop-widget-group">
          <input
            type="text"
            v-model="minPrice"
            :placeholder="`Min - ${$filters.currencyBDT(
              sidebar.data.price.min_price
            )}`"
          />
          <input
            type="text"
            v-model="maxPrice"
            :placeholder="`Max - ${$filters.currencyBDT(
              sidebar.data.price.max_price
            )}`"
          />
        </div>
        <button class="shop-widget-btn">
          <i class="fas fa-search"></i><span>search</span>
        </button>
      </form>
    </div>
    <!-- <div class="shop-widget">
      <h6 class="shop-widget-title">Filter by Rating</h6>
      <form>
        <ul class="shop-widget-list">
          <li>
            <div class="shop-widget-content">
              <input type="checkbox" id="feat1" /><label for="feat1"
                ><i class="fas fa-star active"></i
                ><i class="fas fa-star active"></i
                ><i class="fas fa-star active"></i
                ><i class="fas fa-star active"></i
                ><i class="fas fa-star active"></i
              ></label>
            </div>
            <span class="shop-widget-number">(13)</span>
          </li>
          <li>
            <div class="shop-widget-content">
              <input type="checkbox" id="feat2" /><label for="feat2"
                ><i class="fas fa-star active"></i
                ><i class="fas fa-star active"></i
                ><i class="fas fa-star active"></i
                ><i class="fas fa-star active"></i><i class="fas fa-star"></i
              ></label>
            </div>
            <span class="shop-widget-number">(28)</span>
          </li>
          <li>
            <div class="shop-widget-content">
              <input type="checkbox" id="feat3" /><label for="feat3"
                ><i class="fas fa-star active"></i
                ><i class="fas fa-star active"></i
                ><i class="fas fa-star active"></i><i class="fas fa-star"></i
                ><i class="fas fa-star"></i
              ></label>
            </div>
            <span class="shop-widget-number">(35)</span>
          </li>
          <li>
            <div class="shop-widget-content">
              <input type="checkbox" id="feat4" /><label for="feat4"
                ><i class="fas fa-star active"></i
                ><i class="fas fa-star active"></i><i class="fas fa-star"></i
                ><i class="fas fa-star"></i><i class="fas fa-star"></i
              ></label>
            </div>
            <span class="shop-widget-number">(47)</span>
          </li>
          <li>
            <div class="shop-widget-content">
              <input type="checkbox" id="feat5" /><label for="feat5"
                ><i class="fas fa-star active"></i><i class="fas fa-star"></i
                ><i class="fas fa-star"></i><i class="fas fa-star"></i
                ><i class="fas fa-star"></i
              ></label>
            </div>
            <span class="shop-widget-number">(59)</span>
          </li>
        </ul>
        <button class="shop-widget-btn">
          <i class="far fa-trash-alt"></i><span>clear filter</span>
        </button>
      </form>
    </div> -->
    <!-- <div class="shop-widget">
      <h6 class="shop-widget-title">Filter by Tag</h6>
      <form>
        <ul class="shop-widget-list">
          <li>
            <div class="shop-widget-content">
              <input type="checkbox" id="tag1" /><label for="tag1"
                >new items</label
              >
            </div>
            <span class="shop-widget-number">(13)</span>
          </li>
          <li>
            <div class="shop-widget-content">
              <input type="checkbox" id="tag2" /><label for="tag2"
                >sale items</label
              >
            </div>
            <span class="shop-widget-number">(28)</span>
          </li>
          <li>
            <div class="shop-widget-content">
              <input type="checkbox" id="tag3" /><label for="tag3"
                >rating items</label
              >
            </div>
            <span class="shop-widget-number">(35)</span>
          </li>
          <li>
            <div class="shop-widget-content">
              <input type="checkbox" id="tag4" /><label for="tag4"
                >feature items</label
              >
            </div>
            <span class="shop-widget-number">(47)</span>
          </li>
          <li>
            <div class="shop-widget-content">
              <input type="checkbox" id="tag5" /><label for="tag5"
                >discount items</label
              >
            </div>
            <span class="shop-widget-number">(59)</span>
          </li>
        </ul>
        <button class="shop-widget-btn">
          <i class="far fa-trash-alt"></i><span>clear filter</span>
        </button>
      </form>
    </div> -->
    <div class="shop-widget">
      <h6 class="shop-widget-title">Filter by Brand</h6>
      <form>
        <input
          class="shop-widget-search"
          v-model="brandSearch"
          type="text"
          placeholder="Search..."
        />
        <ul
          class="shop-widget-list shop-widget-scroll"
          v-if="sidebar.data.brands"
        >
          <li v-for="(brand, index) in brandSearchFilter" :key="index">
            <div class="shop-widget-content">
              <input
                type="checkbox"
                v-model="selectedBrand"
                :value="`${brand.slug}`"
                :id="`brand1${index}`"
                @change="productFilter('brand')"
              /><label :for="`brand1${index}`">{{ brand.name }}</label>
            </div>
            <span class="shop-widget-number"
              >({{ brand.products.length }})</span
            >
          </li>
          <li v-if="brandSearchFilter.length == 0">
            <div class="shop-widget-content text-danger">
              Opps. no brand founds.!
            </div>
          </li>
        </ul>

        <Shop-sidebar-skeleton v-else />
        <button
          v-if="selectedBrand.length !== 0"
          class="shop-widget-btn"
          @click.prevent="clearFilter('brand')"
        >
          <i class="far fa-trash-alt"></i><span>clear filter</span>
        </button>
      </form>
    </div>
    <div class="shop-widget">
      <h6 class="shop-widget-title">Filter by Category</h6>

      <input
        class="shop-widget-search"
        v-model="categorySearch"
        type="text"
        placeholder="Search..."
      />
      <ul
        class="shop-widget-list shop-widget-scroll"
        v-if="sidebar.data.categories"
      >
        <li v-for="(cat, index) in categorySearchFilter" :key="index">
          <div class="shop-widget-content">
            <input
              type="checkbox"
              v-model="selectedCategory"
              :value="`${cat.slug}`"
              :id="`cate${index}`"
              @change="productFilter('category')"
            /><label :for="`cate${index}`">{{ cat.name }}</label>
          </div>
          <span class="shop-widget-number">({{ cat.products.length }})</span>
        </li>

        <li v-if="categorySearchFilter.length == 0">
          <div class="shop-widget-content text-danger">
            Opps. no category founds.!
          </div>
        </li>
      </ul>
      <Shop-sidebar-skeleton v-else />

      <button
        v-if="selectedCategory.length !== 0"
        class="shop-widget-btn"
        @click.prevent="clearFilter('category')"
      >
        <i class="far fa-trash-alt"></i><span>clear filter</span>
      </button>
    </div>
  </div>
</template>
<script>
import ShopSidebarSkeleton from "../../../../components/skeleton/ShopSidebarSkeleton.vue";
export default {
  components: { ShopSidebarSkeleton },
  props: ["sidebar"],

  data() {
    return {
      categorySearch: "",
      brandSearch: "",
      minPrice: "",
      maxPrice: "",

      selectedCategory: [],
      selectedBrand: [],
    };
  },

  computed: {
    categorySearchFilter() {
      return this.sidebar.data.categories.filter((category) => {
        return category.name.match(this.categorySearch);
      });
    },

    brandSearchFilter() {
      return this.sidebar.data.brands.filter((brand) => {
        return brand.name.match(this.brandSearch);
      });
    },
  },

  methods: {
    productFilter(field) {
      if (field == "price") {
        this.selectedBrand = [];
        this.selectedCategory = [];
      } else if (field == "brand") {
        this.minPrice = "";
        this.maxPrice = "";
        this.selectedCategory = [];
      } else {
        this.minPrice = "";
        this.maxPrice = "";
        this.selectedBrand = [];
      }

      this.$store.dispatch("shop/SHOP_FILTER", {
        category: this.selectedCategory.join(","),
        brand: this.selectedBrand.join(","),
        price: this.minPrice + "-" + this.maxPrice,
      });
    },

    clearFilter(filterName) {
      this.productFilter();
      if (filterName === "brand") {
        this.selectedBrand = [];
      } else {
        this.selectedCategory = [];
      }
    },
  },
};
</script>
<style></style>
