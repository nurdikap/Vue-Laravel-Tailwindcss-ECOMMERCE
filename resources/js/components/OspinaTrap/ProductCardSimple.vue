<template>
  <div class="flex flex-col w-full h-full space-y-1.5 pb-2 bg-gray-50">
    <div class="relative">
      <router-link
        :to="{
          name: 'product',
          params: {
            productId: id,
            slug: slug,
          },
        }"
        ><img :src="image" class="w-full h-36 object-fill object-center" alt=""
      /></router-link>
      <svg
        @click="clicked = !clicked"
        xmlns="http://www.w3.org/2000/svg"
        :fill="getBackground"
        viewBox="0 0 24 24"
        stroke="currentColor"
        class="w-6 h-6 absolute right-1.5 top-1 text-primario"
      >
        <path
          stroke-linecap="round"
          stroke-linejoin="round"
          stroke-width="1"
          d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"
        />
      </svg>
    </div>

    <div class="font-light mx-2">
      {{ name }}
    </div>
    <div class="mx-2 flex justify-between items-center">
      <span class="text-enfatizado font-medium">
        ${{ new Intl.NumberFormat().format(discount) }}
      </span>
      <div
        class="text-xs space-x-0.5 bg-primario rounded p-1 flex justify-between items-center text-white"
      >
        <svg
          xmlns="http://www.w3.org/2000/svg"
          viewBox="0 0 20 20"
          fill="currentColor"
          class="w-3 h-3"
        >
          <path
            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"
          />
        </svg>
        <span>4.8</span>
      </div>
    </div>
  </div>
</template>

<script>
import BotonRectangular from "./BotonRectangular";

export default {
  data() {
    return {
      clicked: false,
    };
  },
  props: ["image", "price", "discount", "name","id","slug"],
  computed: {
    getImage: function () {
      return "url(" + this.image + ")";
    },
    getBackground: function () {
      return this.clicked ? "#2291FF" : "none";
    },
  },
  components: {
    BotonRectangular,
  },
};
</script>

<style>
</style>