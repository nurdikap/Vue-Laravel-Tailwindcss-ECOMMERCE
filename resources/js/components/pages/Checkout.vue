<template>
  <div class="relative flex flex-col min-h-screen space-y-3 mx-4">
    <Menu />
    <h2 class="text-3xl font-semibold">Pago</h2>
    <div v-show="!modal" class="flex flex-col space-y-4 pb-2">
      <!-- Direccion de envio, datos user -->
      <h3 class="text-xl">Dirección de envio</h3>
      <div
        class="shadow-azul w-full border border-blue-200 p-4 flex flex-col space-y-2"
      >
        <div class="flex justify-between">
          <span> Christine Ortiz </span>
          <div
            @click="modal=true"
            class="bg-gray-300 rounded-full p-1.5 flex justify-center items-center"
          >
            <svg
              xmlns="http://www.w3.org/2000/svg"
              fill="none"
              viewBox="0 0 24 24"
              stroke="currentColor"
              class="text-white w-5 h-5"
            >
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="1"
                d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"
              />
            </svg>
          </div>
        </div>
        <div class="flex flex-col space-y-1 text-gray-500">
          <span> Manzana B casa 10 </span>
          <span> Urbanizacion la esperanza </span>
          <span> Ibagué, Tolima, Colombia </span>
        </div>
      </div>
      <!-- FinalizaDireccion de envio, datos user -->

      <!-- Seccion metodos de pago -->
      <h3 class="text-xl">Método de pago</h3>
      <div
        class="shadow-azul w-full border border-blue-200 p-4 flex flex-col space-y-2"
      >
        <div class="flex flex-col p-1">
          <div class="flex justify-between items-center">
            <span>{{ getPaymentMethod }}</span>
            <div
              @click="desplegar = !desplegar"
              class="bg-gray-300 rounded-full p-1.5 flex items-center justify-center"
            >
              <svg
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
                class="w-4 h-4 text-white"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M19 9l-7 7-7-7"
                />
              </svg>
            </div>
          </div>
          <div class="">
            <div
              class="opacity-0 transform transition-opacity duration-700"
              :class="{
                'opacity-100': desplegar,
                'h-auto': desplegar,
                'h-0': !desplegar,
                'scale-0': !desplegar,
                'scale-x-110': desplegar,
                'p-4': desplegar,
              }"
            >
              <ul class="flex flex-col space-y-2">
                <li
                  @click="
                    paymentMethod = 1;
                    desplegar = false;
                  "
                  class="bg-primario cursor-pointer w-full py-2.5 px-1 text-center text-white"
                >
                  Efectivo
                </li>
                <li
                  @click="
                    paymentMethod = 0;
                    desplegar = false;
                  "
                  class="bg-white w-full cursor-pointer py-2.5 px-1 text-center text-primario border border-primario"
                >
                  Pago en linea (CC,Bancos)
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <!-- Finaliza metodos de pago -->

      <!-- Comienza articulos -->
      <h3 class="text-xl">Artículos</h3>
      <div v-for="item in 4" :key="item" class="flex justify-between w-full">
        <div class="grid grid-cols-3 rounded-lg sombra border border-blue-50">
          <div class="flex justify-center items-center">
            <img
              src="/images/productos/final2.jpg"
              class="object-center object-cover w-full h-full"
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
              </div>
              <div>
                <span class="text-gray-500 text-sm">Cantidad: 1</span>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Finaliza articulos -->
      <SeparadorAzul />

      <!-- Comienza total -->
      <div class="grid grid-cols-2">
        <div class="flex flex-col justify-between">
          <span class="text-gray-500 uppercase text-sm"> Total </span>
          <span class="text-2xl font-medium"> $1.547.987 </span>
        </div>
        <router-link
          :to="{ name: 'payment' }"
          class="bg-primario py-2 text-white rounded-md font-medium flex justify-center items-center"
        >
          Finalizar compra
        </router-link>
      </div>
      <!-- Finaliza total -->
    </div>

    <!-- Intento de modal -->
    <div v-show="modal" class="w-full h-full flex flex-col space-y-5">
      <h3 class="text-xl">Detalles de envío</h3>

      <div
        v-for="i in 5"
        :key="i"
        :class="{ 'border-primario': nameSelect, shadow: nameSelect }"
        class="py-3.5 flex justify-between space-x-6 px-2 border border-gray"
      >
        <label for="name" class="text-gray-500">Nombre</label>
        <div class="flex-1">
          <input
            type="text"
            id="name"
            @focus="nameSelect = true"
            @focusout="nameSelect = false"
            placeholder="Ingresa tu nombre"
            class="quita w-full text-right pl-2 text-gray-500 font-medium"
          />
        </div>
      </div>
      <button
        @click="modal = false"
        :to="{ name: 'payment' }"
        class="bg-primario py-3 text-white rounded-md font-medium flex justify-center items-center"
      >
        Actualizar datos
      </button>
    </div>
  </div>
</template>

<script>
import Menu from "../MenuSimple";
import SeparadorAzul from "../OspinaTrap/SeparadorAzul";

export default {
  computed: {
    getPaymentMethod: function () {
      return this.paymentMethod ? "Efectivo" : "Pago en linea";
    },
  },
  components: {
    Menu,
    SeparadorAzul,
  },
  data() {
    return {
      modal: false,
      nameSelect: false,
      desplegar: false,
      paymentMethod: true,
    };
  },
};
</script>

<style>
.quita {
  outline: none;
}
</style>