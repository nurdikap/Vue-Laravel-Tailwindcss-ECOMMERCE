<template>
  <div class="h-screen w-full flex flex-col space-y-3">
    <Menu class="bg-white" />

    <div class="w-full">
      <h2 class="text-2xl font-semibold ml-4">Todas las categorias</h2>
    </div>
    <div class="grid grid-cols-3 w-full">
      <div class="flex flex-col space-y-5">
        <div
          v-for="(category, index) in categories"
          :key="category.name"
          @click="SelectCategory(index)"
          class="categoryShadow"
        >
          <CategoryCard
            :name="category.name"
            :class="{ 'text-primario': isSelected(index) }"
          />
        </div>
      </div>

      <div class="col-span-2 font-light">
        <span class="text-light uppercase ml-4 font-medium">{{
          categories[selectedCategory].name
        }}</span>
        <div class="bg-white-rounded shadow-azul-grande px-3 pt-1 mx-4 mt-4">
          <ul class="bg-blue-100">
            <li
              v-for="subcategory in categories[selectedCategory].subcategories"
              :key="subcategory"
              class="py-3 px-2 bg-white flex justify-between items-center"
            >
              <span>{{ subcategory }}</span>
              <svg
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
                class="w-4 h-4 text-gray-600"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M13 9l3 3m0 0l-3 3m3-3H8m13 0a9 9 0 11-18 0 9 9 0 0118 0z"
                />
              </svg>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Menu from "./Menu.vue";
import CategoryCard from "./OspinaTrap/CategoryCard";
export default {
  methods: {
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
      categories: [
        {
          name: "Agrícola",
          subcategories: ["Motosierras", "Palas", "picas", "Barras"],
        },
        {
          name: "Carpinteria",
          subcategories: ["Cepillos", "Cerruchos", "Prensas", "Trovadores"],
        },
        {
          name: "Construcción",
          subcategories: ["Motosierras", "Palas", "picas", "Barras"],
        },
        {
          name: "Electricos",
          subcategories: ["Motosierras", "Palas", "picas", "Barras"],
        },
      ],
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
  -webkit-box-shadow: 0px 3px 20px -1px rgba(138, 184, 231, 0.42);

  box-shadow: 0px 3px 20px -1px rgba(138, 184, 231, 0.42);
}
</style>