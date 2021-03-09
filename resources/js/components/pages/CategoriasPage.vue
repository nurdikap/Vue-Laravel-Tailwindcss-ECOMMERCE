<template>
  <div class="h-screen w-full flex flex-col space-y-4">
    <Menu class="bg-white" />

    <div class="w-full">
      <h2 class="text-2xl font-semibold ml-4">Todas las categorias</h2>
    </div>
    <div class="grid grid-cols-5 w-full">
      <div class="flex flex-col space-y-5 ml-4 col-span-2 cursor-pointer">
        <div
          v-for="(category, index) in categories"
          :key="index"
          @click="SelectCategory(index)"
          class="categoryShadow rounded-lg"
        >
          <CategoryCard
            :name="category.name"
            :class="{
              'text-primario': isSelected(index),
              'bg-blue-50': !isSelected(index),
              'bg-white': isSelected(index),
            }"
          />
        </div>
      </div>

      <div class="col-span-3 font-light" v-if="isLoaded">
        <span
          class="text-light md:text-2xl text-lg uppercase ml-4 font-medium text-enfatizado"
          >{{ categories[selectedCategory].name }}</span
        >
        <div class="rounded shadow-azul-grande px-3 pt-1 mx-4 mt-4">
          <ul class="bg-blue-100">
            <li
              v-for="subcategory in categories[selectedCategory].subcategories"
              :key="subcategory.id"
            >
              <router-link
                :to="{
                  name: 'subcategory',
                  params: {
                    subcategory: subcategory.name,
                    category: categories[selectedCategory].name,
                  },
                }"
                class="py-3 px-2 bg-white hover:bg-gray-50 flex justify-between cursor-pointer items-center"
              >
                <span class="md:text-lg">{{ subcategory.name }}</span>
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  fill="none"
                  viewBox="0 0 24 24"
                  stroke="currentColor"
                  class="md:w-5 md:h-5 w-4 h-4 text-gray-600"
                >
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M13 9l3 3m0 0l-3 3m3-3H8m13 0a9 9 0 11-18 0 9 9 0 0118 0z"
                  />
                </svg>
              </router-link>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Menu from "../Menu.vue";
import CategoryCard from "../OspinaTrap/CategoryCard";
import axios from "axios";

export default {
  mounted() {
    this.getCategories();
  },

  methods: {
    getCategories: function () {
      let url = "http://127.0.0.1:8000/api/";
      let $this = this;
      axios
        .get(url + "categories")
        .then(function (response) {
          console.log(response.data);
          $this.categories = response.data;
          if ($this.$route.params.selectedCategory != undefined) {
            console.log('entre')
            $this.selectedCategory = $this.searchCategoryId(
              $this.$route.params.selectedCategory
            );
          }
          $this.isLoaded =true;
        })
        .catch(function (error) {
          console.log(error.message);
        });
    },
    searchCategoryId: function (categoryName) {
      let response = 0;
      this.categories.forEach(function (category, index) {
        if(category.name == categoryName){
          response = index;
        };
      });
      return response;
    },
    SelectCategory: function (category) {
      console.log(category);
      this.selectedCategory = category;
    },
    isSelected: function (category) {
      return this.selectedCategory == category ? true : false;
    },
  },
  data() {
    return {
      selectedCategory: 0,
      categories: [],
      isLoaded: false,
    };
  },
  components: {
    Menu,
    CategoryCard,
  },
};
</script>

<style>
.categoryShadow {
  -webkit-box-shadow: 0px 10px 20px -5px rgba(138, 184, 231, 0.42);

  box-shadow: 0px 10px 20px -5px rgba(138, 184, 231, 0.42);
}
</style>