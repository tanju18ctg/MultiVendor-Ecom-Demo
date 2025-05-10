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
        <h2>Order Details</h2>
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="index.html">My Order Details</a>
          </li>
        </ol>
      </div>
    </section>
    <section class="inner-section wishlist-part">
      <div class="container">
        <div class="row mb-3" v-if="products.data">
          <div class="col-lg-6">
            <ul class="list-group">
              <li class="list-group-item bg-success text-white">Order Information</li>
              <li class="list-group-item">
                <strong>Subtotal:</strong
                >{{ $filters.currencyBDT(products.data.subtotal) }}
              </li>
              <li class="list-group-item" v-show="products.data.discount != 0">
                Discount: -{{ $filters.currencyBDT(products.data.discount) }}
              </li>
              <li class="list-group-item">
                Delivery Charge:
                {{ $filters.currencyBDT(products.data.charges) }}
              </li>
              <li class="list-group-item">
                Total: {{ $filters.currencyBDT(products.data.total) }}
              </li>
            </ul>
          </div>

          <div class="col-lg-6">
            <ul class="list-group">
              <li class="list-group-item bg-success text-white">Shipping Details</li>
              <li class="list-group-item">{{products.data.shipping_address}}</li>
              <li class="list-group-item">Payment Type: {{products.data.payment_type}}</li>
              <li class="list-group-item">Status: {{products.data.status}}</li>
              
            </ul>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-12">
            <!-- {{ products }} -->
            <div class="table-scroll">
              <table class="table-list" v-if="products.data">
                <thead>
                  <tr>
                    <th scope="col">Serial</th>
                    <th scope="col">Product</th>
                    <th scope="col">Name</th>
                    <th scope="col">Price</th>
                    <th scope="col">Quantity</th>
                  </tr>
                </thead>

                <tbody>
                  <tr
                    v-for="(product, index) in products.data.products"
                    :key="index"
                  >
                    <td class="table-serial">
                      <h6>{{ index + 1 }}</h6>
                    </td>
                    <td class="table-image">
                      <img
                        :src="$filters.makeImagePath(product.thumbnail)"
                        alt="product"
                      />
                    </td>
                    <td class="table-name">
                      <h6>{{ product.name }}</h6>
                    </td>

                    <td class="table-price">
                      <Product-price
                        :price="product.price"
                        :discount="product.discount"
                      />
                    </td>

                    <td class="table-name" v-if="product.pivot">
                      <h6>{{ product.pivot.qty }}</h6>
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
import ProductPrice from "@/components/frontend/ProductPrice.vue";
import TableSkeleton from "../../../components/skeleton/TableSkeleton.vue";

export default {
  name: "viewOrder",
  components: { TableSkeleton, ProductPrice },

  mounted() {
    this.FETCH_SINGLE_DATA();
  },
  methods: {
    FETCH_SINGLE_DATA() {
      this.$store.dispatch("order/FETCH_SINGLE_DATA", this.$route.params.id);
    },
  },

  computed: {
    products() {
      return this.$store.getters["order/GET_SINGLE_DATA"];
    },
  },
};
</script>
<style scoped>

</style>
