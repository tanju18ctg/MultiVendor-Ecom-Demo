<template>
  <div class="col-lg-12 order-0 order-lg-1 order-xl-1">
    <div
      class="home-grid-slider slider-arrow slider-dots"
      @click.prevent="homeSlider"
    >
      <a href="javascript::void(0)" v-for="(data, index) in dataAmounts" :key="index">
        <img src="/website/images/slider/slider.jpg" alt=""/></a>
    </div>
  </div>
</template>
<script>
export default {
  props: ["dataAmounts"],
};
</script>
<style></style>
