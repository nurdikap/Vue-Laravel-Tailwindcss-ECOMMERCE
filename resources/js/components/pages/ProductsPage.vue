<template>
  <div class="flex flex-col w-full space-y-2">
    <div class="flex items-center justify-around space-x-4 pr-1 pl-3 
    ">
      <svg
        xmlns="http://www.w3.org/2000/svg"
        fill="none"
        viewBox="0 0 24 24"
        stroke="currentColor"
        class="w-6 h-6 text-texto"

      >
        <path
          stroke-linecap="round"
          stroke-linejoin="round"
          stroke-width="2"
          d="M15 19l-7-7 7-7"
        />
      </svg>
      <Menu class="flex-grow" />
    </div>
    <div
      class="grid grid-cols-2 sm:grid-cols-3 w-full p-3 grid-rows-3 gap-y-3 gap-x-1.5 sm:gap-3"
    >
      <div
        v-for="(product, index) in products"
        :key="index"
        @click="selectThis(index)"
        class="rounded overflow-hidden border-2"
        :class="{
          'border-primario': isSelected(index),
          'border-gray-100': !isSelected(index),
        }"
      >
        <ProductCardSimple
          :image="product.image"
          :price="product.price"
          :name="product.name"
          :discount="product.discount"
        />
      </div>
    </div>
  </div>
</template>

<script>
import Menu from "../Menu.vue";
import ProductCardSimple from "../OspinaTrap/ProductCardSimple";
export default {
  methods: {
    isSelected: function (index) {
      return index == this.selectedItem ? true : false;
    },
    selectThis: function (index) {
      this.selectedItem = index;
    },
  },
  components: {
    Menu,
    ProductCardSimple,
  },
  data() {
    return {
      selectedItem: null,
      products: [
        {
          name: "Martillo",
          price: 60000,
          discount: 0.2,
          image: "/images/productos/final1.png",
        },
        {
          name: "Taladro",
          price: 155000,
          discount: 0.3,
          image: "/images/productos/final2.jpg",
        },
        {
          name: "Martillo",
          price: 60000,
          discount: 0.2,
          image: "/images/productos/final1.png",
        },
        {
          name: "Taladro",
          price: 155000,
          discount: 0.3,
          image: "/images/productos/final2.jpg",
        },
        {
          name: "Martillo",
          price: 60000,
          discount: 0.2,
          image: "/images/productos/final1.png",
        },
        {
          name: "Taladro",
          price: 155000,
          discount: 0.3,
          image: "/images/productos/final2.jpg",
        },
        {
          name: "Martillo",
          price: 60000,
          discount: 0.2,
          image: "/images/productos/final1.png",
        },
        {
          name: "Taladro",
          price: 155000,
          discount: 0.3,
          image: "/images/productos/final2.jpg",
        },
        {
          name: "Martillo",
          price: 60000,
          discount: 0.2,
          image: "/images/productos/final1.png",
        },
        {
          name: "Taladro",
          price: 1558000,
          discount: 0.3,
          image: "/images/productos/final2.jpg",
        },
      ],
    };
  },
};
</script>

<style>
</style>