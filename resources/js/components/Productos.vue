<template>
  <div class="flex flex-col w-full px-4 ">
    <div class="flex justify-between items-center">
      <h3 class="text-enfatizado text-lg">Productos</h3>
      <span class="text-sm font-light"> Ver todos </span>
    </div>
    <div class="grid grid-cols-2 w-full pb-2 space-x-1.5">
          <ProductCard
            v-for="product in products"
            :key="product.name"
            :image="product.image"
            :price="product.price"
            :name="product.name"
            :discount="product.discount"
            class="rounded-lg mt-2 border border-gray-100"
          />
    </div>
  </div>
</template>

<script>
import ProductCard from "./OspinaTrap/ProductCard";
export default {
  data() {
    return {
      products: [
        {
          name: "Martillo",
          price: 60000,
          discount: 0.2,
          image: "images/productos/final1.png",
        },
        {
          name: "Taladro",
          price: 155000,
          discount: 0.3,
          image: "images/productos/final2.jpg",
        },
      ],
    };
  },
  components: {
    ProductCard,
  },
};
</script>

<style>
</style>