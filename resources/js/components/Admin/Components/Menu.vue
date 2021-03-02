<template>
  <div>
    <div
      v-show="show"
      class="absolute flex flex-col text-xl bg-white uppercase space-y-10 overflow-hidden font-medium justify-center items-center inset-0 w-full h-screen"
    >
      <div class="absolute top-5 right-3" @click="show = !show">
        <svg
          class="w-6 h-6 cursor-pointer"
          xmlns="http://www.w3.org/2000/svg"
          fill="none"
          viewBox="0 0 24 24"
          stroke="currentColor"
        >
          <path
            stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="2"
            d="M6 18L18 6M6 6l12 12"
          />
        </svg>
      </div>
      <router-link class="block" :to="{ name: 'adminProducts' }">
        Productos
      </router-link>
      <router-link class="block" :to="{ name: 'adminAttributesCreate' }">
        Atributos
      </router-link>
      <router-link class="block" :to="{ name: 'adminVariations' }">
        Variaciones
      </router-link>
    </div>
    <div class="w-full py-3 flex justify-between items-center">
      <div @click="show = !show" class="cursor-pointer">
        <svg
          class="w-4 h-4"
          xmlns="http://www.w3.org/2000/svg"
          fill="none"
          viewBox="0 0 24 24"
          stroke="currentColor"
        >
          <path
            stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="2"
            d="M4 6h16M4 12h16M4 18h16"
          />
        </svg>
      </div>
      <div class="font-medium text-center">INGERCOL</div>
      <button @click="$router.back()">Volver</button>
    </div>
  </div>
</template>

<script>
export default {
    props:['active'],
    data() {
        return{
            show:false
        }
    }
};
</script>

<style>
</style>