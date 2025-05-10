<template>
  <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5">
    <div class="col" v-for="(data, index) in dataAmounts" :key="index">
      <div class="product-card">
        <ul>
          <li>
            <a class="suggest-card" href="javascript::void(0)"
              ><img src="/website/images/category/cat.jpg" alt="suggest" />
              <div class="ssc-line w-100"></div>
               <!-- <h5>No Items <span>Founds..!</span></h5> -->
            </a>
          </li>
        </ul>
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
