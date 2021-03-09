<template>
  <div class="flex flex-col min-h-screen w-full space-y-5 bg-gray-50">
    <MenuSimple />
    <div class="w-full px-2">
      <splide v-if="isLoaded" :options="options">
        <splide-slide
          v-for="src in JSON.parse(product.images)"
          :alt="product.name"
          :key="src"
          class="relative"
        >
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
          <svg
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 24 24"
            stroke="currentColor"
            class="w-6 h-6 absolute right-8 top-1 text-primario"
          >
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="1"
              d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"
            />
          </svg>
          <img :src="`/${src}`" alt="" class="object-cover w-full h-full" />
        </splide-slide>
      </splide>
    </div>
    <div class="flex justify-between mx-3">
      <div class="flex flex-col justify-center">
        <span class="text-primario font-medium"
          >${{ new Intl.NumberFormat().format(product.discount) }}</span
        >
        <h1>{{ product.name }}</h1>
      </div>
      <div class="flex flex-col justify-center text-sm">
        <div class="flex items-center">
          <div v-for="star in 5" :key="star">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 20 20"
              fill="currentColor"
              class="w-4 h-4"
              :class="getStarColor(star)"
            >
              <path
                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"
              />
            </svg>
          </div>
          <span>
            {{ product.stars }}
          </span>
        </div>
        <span class="block text-right text-primario font-medium">
          {{ product.stock != 0 ? "En stock" : "Agotado" }}
        </span>
      </div>
    </div>
    <div class="h-px w-full bg-blue-50"></div>
    <div class="mx-4">
      <h3 class="text-xs capitalize text-gray-500 font-bold">Descripción</h3>
      <p class="text-sm">
        {{ product.short_description }}
      </p>
    </div>
    <div class="grid grid-cols-2 mx-4 space-y-3">
      <h3 class="text-xs col-span-2 capitalize font-bold text-gray-500">Ficha técnica</h3>

      <div
        v-for="(item, index) in JSON.parse(product.description)"
        :key="index"
        class="flex flex-col justify-center"
      >
        <h3
          class="text-xs capitalize text-gray-500"
          :class="{ 'text-right': !(index % 2 == 0) }"
        >
          {{ Object.keys(item)[0].replaceAll("_", " ") }}
        </h3>
        <p class="text-sm" :class="{ 'text-right': !(index % 2 == 0) }">
          {{ item[Object.keys(item)[0]] }}
        </p>
      </div>

      <div class="col-span-2">
        <span class="text-xs capitalize text-gray-500 font-bold">
          Cantidad
        </span>
      </div>
      <div class="flex items-center">
        <span class="text-sm">Por favor, Selecciona</span>
      </div>
      <div class="flex justify-end space-x-2 items-center">
        <svg
          xmlns="http://www.w3.org/2000/svg"
          fill="none"
          viewBox="0 0 24 24"
          stroke="currentColor"
          class="w-4 h-4 text-gray-500 cursor-pointer"
          @click="quantity = quantity - 1 == 0 ? 1 : quantity - 1"
        >
          <path
            stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="2"
            d="M18 12H6"
          />
        </svg>

        <input
          type="text"
          v-model="quantity"
          class="w-7 h-8 border text-center text-gray-600 border-primario"
        />
        <svg
          @click="quantity = quantity + 1"
          xmlns="http://www.w3.org/2000/svg"
          fill="none"
          viewBox="0 0 24 24"
          stroke="currentColor"
          class="w-4 h-4 text-gray-500 cursor-pointer"
        >
          <path
            stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="2"
            d="M12 6v6m0 0v6m0-6h6m-6 0H6"
          />
        </svg>
      </div>
    </div>

    <div class="h-px w-full bg-blue-50"></div>

    <div
      class="w-full grid grid-cols-2 space-x-3 text-center px-3 font-medium pb-4"
    >
      <div
        class="py-2.5 bg-gray-50 text-primario border rounded border-primario"
      >
        Añadir al carrito
      </div>
      <div class="py-2.5 bg-primario shadow-lg text-white rounded">Comprar</div>
    </div>
  </div>
</template>

<script>
import MenuSimple from "../MenuSimple.vue";
import { Splide, SplideSlide } from "@splidejs/vue-splide";
import "@splidejs/splide/dist/css/themes/splide-default.min.css";
import axios from "axios";

export default {
  async mounted() {
    await this.getProduct();
  },
  methods: {
    getProduct: async function () {
      let url = "http://127.0.0.1:8000/api";
      let $this = this;
      await axios
        .get(`${url}/products/${$this.$route.params.productId}`)
        .then(function (response) {
          console.log(response.data);
          $this.product = response.data;
          $this.isLoaded = true;
        })
        .catch(function (error) {
          console.log(error.message);
        });
    },

    getStarColor: function (star) {
      return star <= this.product.stars ? "text-primario" : "text-gray-300";
    },
  },
  computed: {
    getImage: function () {
      return "url(" + this.image + ")";
    },
    getBackground: function () {
      return this.clicked ? "#2291FF" : "none";
    },
  },
  data() {
    return {
      quantity: 1,
      clicked: false,
      product: { name: "Cargando...", description: "[]"},
      options: {
        height: 300,
        arrows: false,
      },
      isLoaded:false
    };
  },
  components: {
    MenuSimple,
    Splide,
    SplideSlide,
  },
};
</script>

<style>
.splide__pagination__page {
  background-color: #5aadff;
}
.splide__pagination__page.is-active {
  background-color: #2291ff;
}
</style>