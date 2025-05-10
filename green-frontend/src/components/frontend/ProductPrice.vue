<template>
  <div>
    <!-- //jodi modal ba single product page theke data ase.. tahole h3 design  -->
    <template v-if="modal">
      <h3 class="view-price" v-if="discount">
        <del>{{ $filters.currencyBDT(price) }}</del>
        <span>{{ $filters.currencyBDT(discountPrice) }}</span>
      </h3>
      <h3 class="view-price" v-else>
        <span>{{ $filters.currencyBDT(price) }}</span>
      </h3>
    </template>

    <template v-else>
      <h6 class="product-price" v-if="discount">
        <del>{{ $filters.currencyBDT(price) }} </del
        ><span>{{ $filters.currencyBDT(discountPrice) }}</span>
      </h6>
      <h6 class="product-price" v-else>
        <!-- {{ $filters.currencyBDT(product.price) }} -->
        <span>{{ $filters.currencyBDT(price) }}</span>
      </h6>
    </template>
  </div>
</template>
<script>
export default {
  props: ["price", "discount", "modal"],

  computed: {
    discountPrice() {
      var numVal1 = this.price;
      var numVal2 = this.discount / 100;
      var totalValue = numVal1 - numVal1 * numVal2;
      return totalValue.toFixed();
    },

    // normalPrice() {
    //   return this.price.toLocaleString();
    // },
  },
};
</script>
<style lang=""></style>
