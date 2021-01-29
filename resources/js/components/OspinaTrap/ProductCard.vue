<template>
  <div class="flex flex-col overflow-hidden">
    <img :src="image" class="w-full h-36 object-cover object-center" alt="" />
    <div class="ml-1">
      <span class="text-enfatizado font-medium">
        ${{ new Intl.NumberFormat().format(price * (1 - discount)) }}
      </span>
     
    </div>
    <div class="font-light mb-2 ml-1">
      {{ name }}
    </div>
    <div class="w-full bg-primario py-2 text-center">
      <span class="text-white font-medium"> Add to cart </span>
    </div>
  </div>
</template>

<script>
import BotonRectangular from "./BotonRectangular";

export default {
  props: ["image", "price", "discount", "name"],
  computed: {
    getImage: function () {
      return "url(" + this.image + ")";
    },
  },
  components: {
    BotonRectangular,
  },
};
</script>

<style>
</style>