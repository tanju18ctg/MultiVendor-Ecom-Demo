<template>
  <div>
    <section
      class="inner-section single-banner"
      style="
        background: url(//website/images/single-banner.jpg) no-repeat center;
      "
    >
      <div class="container">
        <h2>Seller List</h2>
      </div>
    </section>
    <section class="inner-section">
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
                  <option value="5">50</option>
                  <option value="100">100</option>
                  <option value="200">200</option>
                </select>
              </div>
              <!-- <div class="filter-short">s
                <label class="filter-label">Short by :</label
                ><select class="form-select filter-select isotope-select">
                  <option value="*">show all</option>
                  <option value=".vegetables">vegetables</option>
                  <option value=".fruits">fruits</option>
                  <option value=".drinks">drinks</option>
                  <option value=".fishes">fishes</option>
                  <option value=".meats">meats</option>
                </select>
              </div> -->
            </div>
          </div>
        </div>
        <div
          class="row row-cols-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5 isotope-items"
          v-if="sellers.data"
        >
          <div class="col" v-for="(seller, index) in sellers.data" :key="index">
            <div class="product-card">
              <ul>
                <li>
                  <router-link
                    :to="{
                      name: 'sellerProducts',
                      params: { slug: seller.slug },
                    }"
                    class="suggest-card"
                    href="shop-4column.html"
                  >
                    <img
                      :src="$filters.makeImagePath(seller.image)"
                      alt="seller lists"
                    />
                  </router-link>

                  <div class="brand-meta">
                    <h4 class="text-center">{{ seller.shop_name }}</h4>
                    <p v-if="seller.products" class="text-center">{{seller.products.length}} Products</p>

                    <div class="form-button">
                      <button type="submit">
                        Visit Store <i class="fas fa-angle-right"></i>
                      </button>
                    </div>
                  </div>
                </li>
              </ul>
            </div>
          </div>
        </div>
        <Category-skeleton :data-amounts="10" v-else />
        <div class="row">
          <div class="col-lg-12">
            <div class="bottom-paginate" v-if="sellers.data">
              <p class="page-info">
                Showing {{ sellers.data.length }} of {{ sellers.total }} Results
              </p>
              <ul class="pagination">
                <pagination
                  v-model="currentPage"
                  :records="sellers.total"
                  :per-page="sellers.per_page"
                  @paginate="sellerData"
                />

                <!-- <el-pagination
                                
                                class="page-item"
                                v-model:currentPage="currentPage"
                                layout="prev, pager, next"
                                :total="sellers.total"
                                :page-size="sellers.per_page"
                                @current-change="sellerData"
                            /> -->
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
import CategorySkeleton from "@/components/skeleton/CategorySkeleton.vue";
export default {
  components: { CategorySkeleton },
  data() {
    return {
      limit: 10,
      currentPage: 1,
    };
  },
  mounted() {
    this.sellerData();
  },

  methods: {
    sellerData() {
      this.$store.dispatch("seller/FETCH_DATA", {
        page: this.currentPage,
        limit: this.limit,
      });
    },
  },

  computed: {
    sellers() {
      return this.$store.getters["seller/GET_DATA"];
    },
  },
};
</script>
<style>
.VuePagination__pagination-item-prev-chunk {
  display: none;
}

.VuePagination__pagination-item-next-chunk {
  display: none;
}

.page-item.active .page-link {
  background-color: #119744;
  border-color: #119744;
}

.VuePagination__count{
  display: none;
}
</style>
