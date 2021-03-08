<template>
  <div class="flex w-full flex-col px-4">
    <div class="flex justify-between">
      <h3 class="text-enfatizado text-lg">Categorias</h3>
    </div>
    <div class="grid grid-cols-5 mt-2 w-full gap-x-4">
      <div v-for="featuredCategorie in featuredCategories" :key="featuredCategorie.id" class="flex flex-col justify-start items-center p-3">
        <div class="bg-blue-50 p-2.5 rounded-full">
          <svg
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 24 24"
            stroke="currentColor"
            class="text-primario w-8 h-8"
          >
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="1"
              :d="featuredCategorie.icon"
            />
          </svg>
        </div>
        <h4 class="text-center text-xs font-gray-500 font-light">{{featuredCategorie.name}}</h4>
      </div>

      <div class="flex flex-col justify-start items-center p-3">
        <div class="bg-blue-50 p-2.5 rounded-full">
          <svg
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 24 24"
            stroke="currentColor"
            class="text-primario w-8 h-8"
          >
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="1"
              d="M12 6v6m0 0v6m0-6h6m-6 0H6"
            />
          </svg>
        </div>

        <h4 class="text-center text-xs font-gray-500 font-light">Ver más</h4>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";
export default {
  mounted() {
    this.getFeaturedCategories();
  },
  methods: {
    getFeaturedCategories: function () {
      let url = "http://127.0.0.1:8000/api/";
      let $this = this;
      axios
        .get(url + "getFeaturedCategories")
        .then(function (response) {
          console.log(response.data);
          $this.featuredCategories = response.data;
        })
        .catch(function (error) {
          console.log(error.message);
        });
    },
  },
  data() {
    return {
      featuredCategories: [],
    };
  },
};
</script>

<style>
</style>