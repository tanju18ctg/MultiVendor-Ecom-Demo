<template>
  <div :class="`row row-cols-2 row-cols-md-3 row-cols-lg-4  ${dataAmounts == 20 ? 'row-cols-xl-4':'row-cols-xl-5'}`">
    <div class="col" v-for="(data, index) in dataAmounts" :key="index" style="margin-bottom:18px;">
      <div class="ssc ssc-card">
        <div class="ssc-wrapper">
          <div class="flex align-start">
            <div class="mr w-100">
              <!-- <div class="ssc-line"></div> -->
              <div class="ssc-square mb w-100 h-400"></div>
              <div class="ssc-line w-80"></div>
              <div class="ssc-line w-40"></div>
              <div class="ssc-line"></div>
              <div class="ssc-square mb" style="height: 35px"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
    props: ["dataAmounts"],
    
};
</script>
<style></style>
