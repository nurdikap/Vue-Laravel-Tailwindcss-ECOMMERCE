<template>
  <div class="w-full h-screen flex flex-col text-sm space-y-4 px-3 py-3">
    <h1 class="text-xl font-medium">Editar variacion</h1>
    <div class="flex flex-col space-y-4">
      <div class="grid grid-cols-2 items-center">
        <label for="name">Nombre</label>
        <input
          class="py-2 px-1"
          type="text"
          id="name"
          name="name"
          v-model="name"
          placeholder="Nombre"
        />
      </div>

      <div class="grid grid-cols-2 items-center">
        <label for="short_description">Descripción corta</label>
        <input
          class="py-2 px-1"
          type="text"
          id="short_description"
          name="short_description"
          placeholder="Descripcion corta"
          v-model="short_description"
        />
      </div>
      <div class="grid grid-cols-2 items-center">
        <label for="description">Descripción larga</label>
        <textarea
          name="description"
          id="description"
          placeholder="Descripcion larga y detallada del producto"
          v-model="description"
        />
      </div>
      <div class="grid grid-cols-2 items-center">
        <label for="price">Precio regular</label>
        <input
          class="py-2 px-1"
          type="number"
          id="price"
          name="price"
          v-model="price"
          placeholder="Ejemplo: 10.0000"
        />
      </div>
      <div class="grid grid-cols-2 items-center">
        <label for="discount">Precio con descuento</label>
        <input
          class="py-2 px-1"
          type="text"
          id="discount"
          name="discount"
          v-model="discount"
          placeholder="Ejemplo: 8.000"
        />
      </div>
      <div class="grid grid-cols-2 items-center">
        <label for="reference">Referencia</label>
        <input
          class="py-2 px-1"
          type="text"
          id="reference"
          name="reference"
          v-model="reference"
          placeholder="Referencia del producto"
        />
      </div>
      <div class="grid grid-cols-2 items-center">
        <label for="look_for_stock_yes">Control de Stock</label>
        <div class="flex flex-col space-y-2 text-gray-500">
          <div>
            <input
              v-model="look_for_stock"
              type="radio"
              name="look_for_stock"
              id="look_for_stock_yes"
              :value="1"
            />
            <label for="look_for_stock_yes">Sí</label>
          </div>
          <div>
            <input
              v-model="look_for_stock"
              type="radio"
              name="look_for_stock"
              id="look_for_stock_no"
              :value="0"
            />
            <label for="look_for_stock_no">No</label>
          </div>
        </div>
      </div>
    </div>

    <div class="grid grid-cols-2 items-center" v-show="look_for_stock">
      <label for="stock">Stock</label>
      <input
        class="py-2 px-1"
        type="number"
        id="stock"
        name="stock"
        v-model="stock"
        placeholder="cantidad de productos disponibles"
      />
    </div>

    <div class="flex flex-col">
      <input type="file" multiple @change="photosChange" />
    </div>

    <modal name="modalError" adaptive height="auto" classes="bg-red-200"
      ><div class="space-y-4 flex flex-col justify-center w-full h-full py-3">
        <p class="font-medium text-center">¡Ha ocurrido un error! 😯</p>
        <div v-html="errorMessage" class="px-2 my-1"></div>
      </div>
    </modal>

    <modal name="modalExito" adaptive height="auto" classes="bg-red-200"
      ><div class="space-y-4 flex flex-col justify-center w-full h-full py-3">
        <p class="font-medium text-center">
          ¡Variacion actualizada con éxito! 🎆
        </p>
        <div v-html="confirmationMensaje" class="px-2 my-1"></div>
      </div>
    </modal>

    <button @click="sendData()">Guardar producto</button>
  </div>
</template>

<script>
import axios from "axios";
export default {
  async mounted() {
    let variation = await this.getvariation();
    this.updateVariation(variation);
  },

  methods: {
    getvariation: async function () {
      let url = "http://127.0.0.1:8000/admin/";
      let $this = this;
      let respuesta = "";
      await axios
        .get(url + "getVariation/" + $this.$route.params.variation)
        .then(function (response) {
          console.log(response.data);
          respuesta = response.data;
        })
        .catch(function (error) {
          console.log(error.message);
        });
      return respuesta;
    },
    updateVariation: function (variation) {
      this.variation = variation;
      this.name = this.variation.name;
      this.price = this.variation.price;
      this.discount = this.variation.discount;
      this.reference = this.variation.reference;
      this.stock = this.variation.stock;
      this.look_for_stock = this.variation.look_for_stock;

    },

    photosChange: function (event) {
      let imagenes = event.target.files;

      for (let i = 0; i < event.target.files.length; i++) {
        this.images.push(imagenes[i]);
      }
    },
  },
  data() {
    return {
      variation: "",
      errorMessage: "",
      confirmationMensaje: "",
      images: [],
      name: "",
      price: "",
      discount: "",
      reference: "",
      stock: 0,
      look_for_stock: false,
      short_description: "",
      description: "",
    };
  },
};
</script>

<style>
</style>