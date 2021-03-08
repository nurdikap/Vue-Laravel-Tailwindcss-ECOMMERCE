<template>
  <div class="flex flex-col w-full space-y-2">
    <div class="flex items-center justify-around space-x-4 pr-1 pl-3">
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
        class="rounded overflow-hidden border-2"
        :class="{
          'border-primario': isSelected(index),
          'border-gray-100': !isSelected(index),
        }"
      >
        <ProductCardSimple
          :image="`/${JSON.parse(product.images)[0]}`"
          :price="product.price"
          :id="product.id"
          :name="product.name"
          :slug="product.slug"
          :discount="product.discount"
        />
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";
import Menu from "../Menu.vue";
import ProductCardSimple from "../OspinaTrap/ProductCardSimple";
export default {
  mounted() {
    this.getBySubcategory();
  },
  methods: {
    getBySubcategory: function () {
      let url = "http://127.0.0.1:8000/api/";
      let $this = this;
      let params = {
        subcategory: this.$route.params.subcategory,
      };
      console.log(params);
      axios
        .get(url + "products/getBySubcategory", { params })
        .then(function (response) {
          console.log(response.data);
          $this.products = response.data;
          console.log(JSON.parse(response.data[0].images)[0]);
        })
        .catch(function (error) {
          console.log(error.message);
        });
    },

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
      products: [],
    };
  },
};
</script>

<style>
</style>