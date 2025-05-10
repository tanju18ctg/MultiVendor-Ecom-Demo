<template >
    <div>
        <section
      class="inner-section single-banner"
      style="background: url(//website/images/single-banner.jpg) no-repeat center"
    >
      <div class="container">
        <h2>my profile</h2>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><router-link :to="{ name: $route.name }">{{$route.name}}</router-link></li>
          <!-- <li class="breadcrumb-item active" aria-current="page">{{$route}}</li> -->
        </ol>
      </div>
    </section>

    <router-view></router-view>

</div>
</template>
<script>
export default {
    name: 'UserLayout'
}
</script>
<style lang="">
    
</style>