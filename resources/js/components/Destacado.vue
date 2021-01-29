<template>
  <div class="ml-4 mt-2 h-40">
    <h2 class="text-enfatizado text-lg mb-2">Destacado</h2>
    <splide :options="options">
      <splide-slide v-for="src in images" :key="src">
        <TarjetaHorizontal :src="src" />
      </splide-slide>
    </splide>
  </div>
</template>

<script>
import TarjetaHorizontal from "./OspinaTrap/TarjetaHorizontal";
import { Splide, SplideSlide } from "@splidejs/vue-splide";
import "@splidejs/splide/dist/css/themes/splide-default.min.css";

export default {
  data() {
    return {
      images: [
        "/images/homepage/destacada1.jpg",
        "/images/homepage/destacada2.jpg",
        "/images/homepage/destacada3.jpg",
      ],
      options: {
        padding: {
          left: 0,
          right: "0.5rem",
        },
        height: 200,
        arrows: false,
        pagination: false,
      },
    };
  },
  components: {
    TarjetaHorizontal,
    Splide,
    SplideSlide,
  },
};
</script>

<style>
</style>