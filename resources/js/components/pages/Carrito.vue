<template>
  <div class="flex flex-col w-full min-h-screen py-2 space-y-6 px-4">
    <Menu></Menu>
    <h2 class="text-3xl ml-2 font-medium">Carrito</h2>
    <div
      v-for="item in 5"
      :key="item"
      class="flex justify-between w-full h-28"
      @mouseover="activo = true"
      @mouseleave="activo = false"
    >
      <div
        :class="{ '-translate-x-16': activo }"
        class="transform flex-1 transition duration-1000 grid grid-cols-3 rounded-lg sombra border border-blue-50"
      >
        <div class="flex justify-center items-center">
          <img
            src="/images/productos/final2.jpg"
            class="object-center object-cover w-full h-full"
            valt=""
          />
        </div>
        <div class="col-span-2 grid grid-cols-4 grid-rows-3 px-2 py-3">
          <div class="col-span-3 row-span-3 flex flex-col justify-between">
            <div class="flex flex-col justify-around">
              <span>Pilot bargs</span>
              <span class="text-xs text-gray-500">Medium light</span>
            </div>
            <div class="flex justify-start space-x-2">
              <span class="text-primario font-medium"> $109.475 </span>
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
          <div class="row-span-3 flex flex-col items-center justify-around">
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
            <input
              type="text"
              v-model="quantity"
              class="w-7 h-8 border text-center text-gray-600 border-primario"
            />
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
          </div>
        </div>
      </div>
      <div
        :class="{ 'opacity-100': activo, '-translate-x-6': activo }"
        class="opacity-0 flex transform transition duration-1000 flex-col items-center justify-center"
      >
        <svg
          xmlns="http://www.w3.org/2000/svg"
          fill="none"
          viewBox="0 0 24 24"
          stroke="currentColor"
          class="w-6 h-6 text-primario cursor-pointer"
        >
          <path
            stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="1.5"
            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"
          />
        </svg>
      </div>
    </div>
    <div class="h-px w-full bg-blue-50"></div>
    <div class="flex flex-col w-full  space-y-5">
      <div class="flex justify-between items-center">
        <div>
          <input
            type="text"
            class="bg-gray-100 px-2 py-2 text-gray-700 text-center text-sm w-40"
            placeholder="Ingresa cupón"
          />
        </div>
        <button
          class="py-2 px-3 text-primario text-sm bg-white border border-primario"
        >
          Aplicar cupon
        </button>
      </div>

      <div class="grid grid-cols-2 items-center mb-80">
        <div class="flex flex-col justify-between">
          <span class="text-sm text-gray-500">TOTAL</span>
          <span class="font-medium text-lg">
            $488.500
          </span>
        </div>
        <router-link :to="{name:'checkout'}" class="bg-primario shadow-azul text-white py-2 w-full text-center ">Pagar</router-link>
      </div>
      <div class="w-full h-10 bg-trasparent"></div>
    </div>
    <BarraNavegacion class="mt-10"/>
  </div>
</template>

<script>
import Menu from "../Menu.vue";
import BarraNavegacion from "../BarraNavegacion.vue";

export default {
  components: {
    Menu,
    BarraNavegacion
  },
  data() {
    return {
      activo: false,
      quantity: 1,
    };
  },
};
</script>

<style>
.izquierda {
  -webkit-transform: translate(-20%, 0%);
  -moz-transform: translate(-20%, 0%);
  -ms-transform: translate(-20%, 0%);
  -o-transform: translate(-20%, 0%);
  transform: translate(-20%, 0%);
}
.sombra {
  -webkit-box-shadow: 1px 4px 35px 1px rgba(34, 145, 255, 0.09);
  box-shadow: 1px 4px 35px 1px rgba(34, 145, 255, 0.09);
}
</style>