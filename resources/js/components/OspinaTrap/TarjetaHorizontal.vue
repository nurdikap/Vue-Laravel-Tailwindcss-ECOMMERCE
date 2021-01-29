<template>
  <div
    class="h-full flex flex-col pl-4 rounded-lg justify-around mr-4 bg-cover"
    style="background-image: url('/images/homepage/destacada1.jpg')"
    :style="{ 'background-image': getBackground(src) }"
  >
    <p class="text-white text-3xl">Super Flash Sale 50% off</p>
    <div class="">
      <BotonRectangular class="" />
    </div>
  </div>
</template>

<script>
import BotonRectangular from "./BotonRectangular";
export default {
  methods: {
      getBackground: function(src){
          return 'url('+src+')';
      }
  },
  props: ["src"],
  components: {
    BotonRectangular,
  },
};
</script>

<style>
</style>