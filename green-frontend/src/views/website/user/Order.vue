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
        <h2>Order List</h2>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">My Orders</a></li>
        </ol>
      </div>
    </section>
    <section class="inner-section wishlist-part">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="table-scroll" v-if="orders.data">
              <table
                class="table-list"
                v-for="(order, index) in orders.data"
                :key="index"
              >
                <thead>
                  <tr>
                    <th scope="col">SL</th>
                    <th scope="col">Image</th>
                    <th scope="col">Name</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Order</th>
                  </tr>
                </thead>

                <tbody>
                  <tr v-for="(product, key) in order.products" :key="key">
                    <td class="table-serial">
                      <h6>{{ key + 1 }}</h6>
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
                    <td class="table-name" v-if="product.pivot">
                      <h6>{{ product.pivot.qty }}</h6>
                    </td>

                    <td></td>
                  </tr>

                  <tr>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th>
                      <span v-if="order.order_number">
                        Order:#{{ order.order_number }}
                      </span>
                    </th>
                  </tr>

                  <tr>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th>
                      <span>
                        Subtotal: {{ $filters.currencyBDT(order.subtotal) }}
                      </span>
                    </th>
                  </tr>

                  <tr v-show="order.discount != 0">
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th>
                      <span v-show="order.discount != 0">
                        Discount: -{{ $filters.currencyBDT(order.discount) }}
                      </span>
                    </th>
                  </tr>

                  <tr>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th>
                      <span>
                        Delivery Charge:
                        {{ $filters.currencyBDT(order.charges) }}
                      </span>
                    </th>
                  </tr>

                  <tr>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th>
                      <span
                        >Total: {{ $filters.currencyBDT(order.total) }}</span
                      >
                    </th>
                  </tr>
                </tbody>
              </table>
            </div>

            <template v-else>
              <table-skeleton></table-skeleton>
            </template>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-12">
            <div class="text-center mt-5">
              <button class="btn btn-outline">Load more Orders</button>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>
<script>
// import { ElNotification } from "element-plus";
import TableSkeleton from "../../../components/skeleton/TableSkeleton.vue";

export default {
  name: "Orders",
  components: { TableSkeleton },

  data() {
    return {
      btn_loading: false,
    };
  },

  created() {
    document.title = "Order";
    this.$store.dispatch("order/FETCH_DATA");
  },

  computed: {
    orders() {
      return this.$store.getters["order/GET_DATA"];
    },
  },

  methods: {},
};
</script>
<style lang=""></style>
