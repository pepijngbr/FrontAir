<!-- Logo, links to available pages (same as top navigation bar, load dynamically via this.$router) -->
<template>
  <footer class="bg-sky-400 relative pt-20">
    <img
      src="../assets/images/clouds.png"
      alt="Clouds"
      class="z-0 w-screen drop-shadow-2xl"
    />
    <div class="absolute bottom-0 flex pl-20 pb-4">
      <img src="../assets/images/FrontAir.png" alt="" class="h-80" />
      <!--      <div class="flex items-end">-->
      <!--        <p>© 2024 FrontAir</p>-->
      <!--      </div>-->
    </div>
  </footer>
</template>

<script lang="ts">
export default {
  name: "MainFooter",
};
</script>
