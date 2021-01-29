<template>
  <div
    class="relative h-full flex flex-col pl-4 rounded-lg justify-around mr-4 bg-center bg-cover"
    style="background-image: url('/images/homepage/destacada1.jpg')"
    :style="{ 'background-image': getBackground(src) }"
  >
    <ImageOverlay opacity="30" />
    <p class="text-white text-3xl z-20">Super Flash Sale 50% off</p>
    <div class="z-20">
      <BotonRectangular  />
    </div>
  </div>
</template>

<script>
import BotonRectangular from "./BotonRectangular";
import ImageOverlay from "./ImageOverlay";

export default {
  methods: {
    getBackground: function (src) {
      return "url(" + src + ")";
    },
  },
  props: ["src"],
  components: {
    BotonRectangular,
    ImageOverlay,
  },
};
</script>

<style>
</style>