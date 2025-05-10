<template>
  <div>
    <img :src="$filters.makeImagePath(path)" alt="product" />
  </div>
</template>
<script>
export default {
  props: ["path"],
};
</script>
<style lang=""></style>
