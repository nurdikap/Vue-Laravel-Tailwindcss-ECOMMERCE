<template>
  <div class="w-full relative h-screen flex flex-col text-sm space-y-2 px-3 py-2">
       <AdminMenu/>

    <h1 class="text-xl font-medium">Subida de productos</h1>
    <div class="flex flex-col space-y-4">
      <div class="grid grid-cols-1 items-center">
        <label for="name">Nombre</label>
        <input
          class="p-2 border focus:border-blue-400 text-gray-500 border-gray-200 shadow rounded"
          type="text"
          id="name"
          name="name"
          v-model="name"
          placeholder="Nombre"
        />
      </div>
      <div class="grid grid-cols-1 space-y-2">
        <div class="grid">
          <div><label for="category"> Selecciona una categoría</label></div>
          <select
            name="category"
            class="p-2 border focus:border-blue-400 text-gray-500 border-gray-200 shadow rounded"
            id="subcategory"
            v-model="selectedCategory"
            placeholder="hola"
            @change="updateSubcategories()"
          >
            <option
              v-for="category in categories"
              :key="category.name"
              :value="category.id"
            >
              {{ category.name }}
            </option>
          </select>
        </div>
        <div class="grid">
          <div>
            <label for="subcategory">Selecciona una subcategoría </label>
          </div>
          <select
            name="subcategory"
            class="p-2 border focus:border-blue-400 text-gray-500 border-gray-200 shadow rounded"
            id="subcategory"
            v-model="selectedSubcategory"
          >
            <option v-if="areSubcategories" :selected="true" disabled>
              No se han encontrado subcagorias
            </option>

            <option
              v-for="subcategory in subcategories"
              :key="subcategory.name"
              :value="subcategory.id"
            >
              {{ subcategory.name }}
            </option>
          </select>
        </div>
      </div>
      <div class="grid grid-cols-1 items-center">
        <label for="short_description">Descripción corta</label>
        <input
          class="p-2 border focus:border-blue-400 text-gray-500 border-gray-200 shadow rounded"
          type="text"
          id="short_description"
          name="short_description"
          placeholder="Descripcion corta"
          v-model="short_description"
        />
      </div>
      <div class="grid grid-cols-1 items-center">
        <label for="description">Descripción larga</label>
        <textarea
          class="p-2 border focus:border-blue-400 text-gray-500 border-gray-200 shadow rounded"
          name="description"
          id="description"
          placeholder="Descripcion larga y detallada del producto"
          v-model="description"
        />
      </div>
      <div class="grid grid-cols-1 items-center">
        <label for="price">Precio regular</label>
        <input
          class="p-2 border focus:border-blue-400 text-gray-500 border-gray-200 shadow rounded"
          type="number"
          id="price"
          name="price"
          v-model="price"
          placeholder="Ejemplo: 10.0000"
        />
      </div>
      <div class="grid grid-cols-1 items-center">
        <label for="discount">Precio con descuento</label>
        <input
          class="p-2 border focus:border-blue-400 text-gray-500 border-gray-200 shadow rounded"
          type="text"
          id="discount"
          name="discount"
          v-model="discount"
          placeholder="Ejemplo: 8.000"
        />
      </div>
      <div class="grid grid-cols-1 items-center">
        <label for="reference">Referencia</label>
        <input
          class="p-2 border focus:border-blue-400 text-gray-500 border-gray-200 shadow rounded"
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
        class="p-2 border focus:border-blue-400 text-gray-500 border-gray-200 shadow rounded"
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
        <strong>Seccion de variaciones del producto</strong>: Debe añadir las
        propiedades y los valores de estos atributos.
      </p>
      <div class="flex justify-around items-center">
        <div class="flex-1 space-y-4">
          <span> Añadir nueva variación </span>
        </div>
        <div @click="createNewVariationGroup()">
          <svg
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 24 24"
            stroke="currentColor"
            class="w-4 h-4"
          >
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"
            />
          </svg>
        </div>
      </div>
      <Division height="h-1" />
      <!-- Panel de control items de variaciones  -->
      <div class="flex flex-col">
        <div class="flex justify-between w-full items-end">
          <label for="attributes">Atributo</label>
          <!-- seleccion de atributo  -->
          <select name="attributes" id="attributes" v-model="selectedIndex">
            <option
              v-for="(attribute, attributeIndex) in attributes"
              :key="attributeIndex"
              :value="attributeIndex"
            >
              {{ attribute.name }}
            </option>
          </select>
          <!-- Seleccion de variacion real  -->
          <select
            name="attributes"
            id="attributes"
            v-model="selectedVariationIndex"
          >
            >
            <option
              v-for="(variation, variationIndex) in attributes[selectedIndex]
                .variations"
              :key="variationIndex"
              :value="variationIndex"
            >
              {{ variation.value }}
            </option>
          </select>
          <!-- Seleccion de No. Variacion -->
          <select v-model="selectedRealVariationIndex">
            <option
              v-for="number in variationGroups.length"
              :key="number"
              :value="number - 1"
            >
              {{ number - 1 }}
            </option>
          </select>
          <div
            @click="addVariationToVariationArray(selectedRealVariationIndex)"
          >
            <svg
              xmlns="http://www.w3.org/2000/svg"
              fill="none"
              viewBox="0 0 24 24"
              stroke="currentColor"
              class="w-4 h-4"
            >
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"
              />
            </svg>
          </div>
        </div>
        <div
          v-for="(variations, varationIndex) in variationGroups"
          :key="varationIndex"
          class="flex items-center space-x-2 space-y-1 w-full overflow-auto py-1"
        >
          <div class="pointer" @click="removeVariationGroup(varationIndex)">
            <svg
              class="w-3.5 h-3.5 text-blue-400"
              xmlns="http://www.w3.org/2000/svg"
              fill="none"
              viewBox="0 0 24 24"
              stroke="currentColor"
            >
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"
              />
            </svg>
          </div>
          <div class="font-semibold">#{{ varationIndex }}</div>
          <div
            class="py-1 px-2 shadow text-center font-medium cursor-pointer"
            v-for="(variation, indexOfVariation) in variations"
            :key="variation.id"
            @click="removeVariationFromGroup(varationIndex, indexOfVariation)"
          >
            {{ variation.value }}
          </div>
        </div>
      </div>
    </div>
    <div class="flex flex-col" v-if="!showProperties">
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
        <p class="font-medium text-center">¡Producto creado con éxito! 🎆</p>
        <div v-html="confirmationMensaje" class="px-2 my-1"></div>
      </div>
    </modal>
    <div class="self-center">
      <button
        class="py-1 px-5 rounded shadow border text-white text-center border-gray-300 bg-blue-500 inline-block"
        @click="sendData()"
      >
        Guardar producto
      </button>
    </div>
    <div class="opacity-0">s</div>
  </div>
</template>

<script>
import axios from "axios";
import Division from "../../../OspinaTrap/Division";
import AdminMenu from "../../Components/Menu"
export default {
  mounted() {
    this.getCategories();
    this.getAttributes();
  },

  methods: {
    // Method for maging variations
    createNewVariationGroup: function () {
      this.variationGroups.push([]);
    },

    addVariationToVariationArray: function (indexOfVariationGroup) {
      let $this = this;
      let actualArray = this.variationGroups[indexOfVariationGroup];
      let variation = this.attributes[this.selectedIndex].variations[
        this.selectedVariationIndex
      ];
      // Si el grupo esta vacio
      if (actualArray.length == 0) {
        let auxiliarVariation =
          $this.attributes[$this.selectedIndex].variations[
            $this.selectedVariationIndex
          ];
        actualArray.push(auxiliarVariation);
      } //Si no esta vacio.
      else {
        // Si no existe, se añade.
        let itemExist = false;
        actualArray.forEach(function (variationItem) {
          if (variationItem.id == variation.id) {
            itemExist = true;
          }
        });
        if (!itemExist) actualArray.push(variation);
      }
    },

    removeVariationFromGroup: function (indexOfGroup, indexOfVariation) {
      this.variationGroups[indexOfGroup].splice(indexOfVariation, 1);
    },
    removeVariationGroup: function (indexOfGroup) {
      this.variationGroups.splice(indexOfGroup, 1);
    },

    getAllVariations: function ($variationIndex) {
      let response = [];
      let $this = this;
      this.selectedAttributes.forEach(function (attribute) {
        attribute.variations.forEach(function (variation) {
          response.push(variation);
        });
      });
    },
    // Methods for attributes
    getAttributes: function () {
      let url = "http://127.0.0.1:8000/api/attributes";
      let $this = this;
      axios.get(url).then(function (response) {
        console.log(response.data);
        $this.attributes = response.data;
      });
    },

    updateSubcategories: function () {
      let url = "http://127.0.0.1:8000/api/";
      let $this = this;
      axios
        .get(`${url}categories/${$this.selectedCategory}/getSubcategories`)
        .then(function (response) {
          $this.subcategories = response.data;
          $this.selectedSubcategory =
            $this.subcategories.length == 0
              ? "No se han encontrado subcagorias"
              : $this.subcategories[0].id;
        })
        .catch(function (error) {
          console.log(error.message);
        });
    },

    getCategories: function () {
      let url = "http://127.0.0.1:8000/api/";
      let $this = this;
      axios
        .get(url + "categories")
        .then(function (response) {
          console.log(response.data);
          $this.categories = response.data;
          $this.selectedCategory = $this.categories[0].id;
          $this.updateSubcategories();
        })
        .catch(function (error) {
          console.log(error.message);
        });
    },
    sendData: function () {
      let url = "http://127.0.0.1:8000/api/products";
      let form = new FormData();
      let $this = this;
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
      form.append("subcategory_id", this.selectedSubcategory);
      form.append("variations", JSON.stringify(this.variationGroups));

      for (let i = 0; i < this.images.length; i++) {
        form.append("image[]", this.images[i]);
      }
      console.log(form);
      let mensaje = "<ul>";
      axios
        .post(url, form, {
          headers: { "Content-Type": "multipart/form-data" },
        })
        .then(function (response) {
          $this.confirmationMensaje =
            "Se ha creado exitosamente el producto con ID: " + response.data;
          $this.$modal.show("modalExito");
          console.log(response.data);
        })
        .catch((error) => {
          let respuesta = error.response.data.errors;
          for (error in respuesta) {
            respuesta[error].forEach(function (element) {
              mensaje += `<li> ${element}</li>`;
            });
          }
          mensaje += "</ul>";

          $this.$modal.show("modalError");
          $this.errorMessage = mensaje;
        });
    },
    photosChange: function (event) {
      let imagenes = event.target.files;

      for (let i = 0; i < event.target.files.length; i++) {
        this.images.push(imagenes[i]);
      }
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
  },
  data() {
    return {
      errorMessage: "",
      confirmationMensaje: "",
      categories: [""],
      selectedCategory: "",
      subcategories: "",
      selectedSubcategory: "No se han encontrado subcagorias",
      images: [],
      name: "",
      short_description: "",
      description: "",
      price: "",
      discount: "",
      reference: "",
      stock: 0,
      backgroundColors: ["red", "blue", "green", "purple", "yellow"],
      attributes: [
        { color: "Cargando...", variations: [{ value: "Cargando variacion" }] },
      ],

      variationGroups: [],
      selectedRealVariationIndex: 0,
      selectedIndex: 0,
      selectedVariationIndex: 0,
      currentAttribute: "",
      product_type: "variable",
      look_for_stock: 1,
    };
  },
  computed: {
    areSubcategories: function () {
      return this.subcategories.length == 0 ? true : false;
    },
    showProperties: function () {
      return this.product_type == "simple" ? false : true;
    },
  },
  components: {
    Division,AdminMenu
  },
};
</script>

<style>
</style>