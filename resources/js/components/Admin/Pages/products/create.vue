<template>
  <div class="w-full h-screen flex flex-col text-sm space-y-4 px-3 py-3">
    <h1 class="text-xl font-medium">Subida de productos</h1>
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
              :value="true"
            />
            <label for="look_for_stock_yes">Sí</label>
          </div>
          <div>
            <input
              v-model="look_for_stock"
              type="radio"
              name="look_for_stock"
              id="look_for_stock_no"
              :value="false"
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

    <div class="grid grid-cols-2 items-center">
      <label for="product_type">Tipo de producto</label>
      <div class="flex flex-col space-y-2 text-gray-500">
        <div>
          <input
            type="radio"
            name="product_type"
            id="product_type_simple"
            value="simple"
            v-model="product_type"
          />
          <label for="product_type_simple">Simple (no tiene atributos)</label>
        </div>

        <div>
          <input
            type="radio"
            name="product_type"
            id="product_type_variable"
            value="variable"
            v-model="product_type"
          />
          <label for="product_type_variable"
            >Variable (posee diferentes atributos)</label
          >
        </div>
      </div>
    </div>

    <div class="flex flex-col space-y-4 w-full" v-if="showProperties">
      <Division height="h-px" />

      <p>
        <strong>Seccion de Atributos del producto</strong>: Debe añadir las
        propiedades y cada una de sus variaciones de la siguiente manera
      </p>

      <div class="grid grid-cols-2 px-1 space-x-3 items-center">
        <span> Añadir nuevo atributo </span>
        <input
          type="text"
          placeholder="atributo"
          v-model="currentAttribute"
          class="p-1 text-center shadow rounded-lg bg-blue-200 outline-none"
          @keyup.enter="addAttribute(currentAttribute)"
        />
      </div>

      <div
        v-for="(attribute, index) in attributes"
        :key="index"
        class="grid grid-cols-6 items-center justify-between space-x-1"
      >
        <p class="text-base col-span-2">
          {{ attributes[index].name }}
        </p>

        <div
          class="border flex flex-col rounded-xl p-2 col-span-3"
          :class="`bg-${attributes[index].color}-100`"
        >
          <input
            type="text"
            class="bg-transparent outline-none"
            v-model="attributes[index].aux"
            @keyup.enter="addVariationToAttribute(index, attributes[index].aux)"
          />

          <div
            v-for="(variation, variationIndex) in attributes[index].variations"
            :key="variationIndex"
          >
            <div class="flex justify-between px-1 my-1">
              <span>
                {{ variation }}
              </span>
              <svg
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
                class="w-4 h-4"
                :class="`text-${attributes[index].color}-400`"
                @click="removeVariation(index, variationIndex)"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"
                />
              </svg>
            </div>
          </div>
        </div>

        <div class="flex justify-center items-center">
          <svg
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 24 24"
            stroke="currentColor"
            class="w-4 h-4 text-primario"
            @click="removeAttribute(index)"
          >
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"
            />
          </svg>
        </div>
      </div>
    </div>
    <div class="flex flex-col" v-if="!showProperties">
      <input type="file" multiple @change="photosChange" />
    </div>
    <button @click="sendData()">Guardar producto</button>
  </div>
</template>

<script>
import axios from "axios";
import Division from "../../../OspinaTrap/Division";
export default {
  computed: {
    showProperties: function () {
      return this.product_type == "simple" ? false : true;
    },
  },
  methods: {
    sendData: function () {
      let url = "http://127.0.0.1:8000/admin/products";
      let form = new FormData();
      form.append("attributes", JSON.stringify(this.attributes));
      form.append("name", this.name);
      form.append("short_description", this.short_description);
      form.append("description", this.description);
      form.append("price", this.price);
      form.append("discount", this.discount);
      form.append("reference", this.reference);
      form.append("look_for_stock", this.look_for_stock);
      form.append("stock", this.stock);
      form.append("product_type", this.product_type);

      for (let i = 0; i < this.images.length; i++) {
        form.append("image[]", this.images[i]);
      }

      axios
        .post(url, form, {
          headers: { "Content-Type": "multipart/form-data" },
        })
        .then(function (response) {
          console.log(response);
        });
    },
    photosChange: function (event) {
      let imagenes = event.target.files;

      for (let i = 0; i < event.target.files.length; i++) {
        this.images.push(imagenes[i]);
      }

      console.log(this.images);
    },
    removeAttribute: function (attributeIndex) {
      this.attributes.splice(attributeIndex, 1);
    },
    removeVariation: function (attributeIndex, variationIndex) {
      this.attributes[attributeIndex].variations.splice(variationIndex, 1);
    },
    getRandomBackground: function () {
      let random = Math.floor(Math.random() * this.backgroundColors.length);
      return this.backgroundColors[random];
    },
    addAttribute: function (attribute) {
      let objeto = {
        name: attribute,
        aux: "",
        color: this.getRandomBackground(),
        variations: [],
      };
      this.attributes.push(objeto);
      this.currentAttribute = "";
    },
    addVariationToAttribute: function (index, variation) {
      this.attributes[index].variations.push(variation);
      this.attributes[index].aux = "";
      console.log(this.attributes[index].variations);
    },
  },
  data() {
    return {
      images: [],
      name:'',
      short_description:'',
      description:'',
      price:'',
      discount:'',
      reference:'',
      stock:0,
      backgroundColors: ["red", "blue", "green", "purple", "yellow"],
      attributes: [],
      currentAttribute: "",
      product_type: "simple",
      look_for_stock: true,
    };
  },
  components: {
    Division,
  },
};
</script>

<style>
</style>