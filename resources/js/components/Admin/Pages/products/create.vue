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
      <div class="grid grid-cols-2 space-x-2">
        <div
          class="grid grid-rows-2 md:grid-cols-2 md:grid-rows-1 items-center"
        >
          <div><label for="category"> Selecciona una categoría</label></div>
          <div class="flex justify-start md:justify-center md:pr-2">
            <select
              name="category"
              class="py-1 w-5/6 md:w-full border-2 border-blue-50 text-gray-500"
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
        </div>
        <div
          class="grid grid-rows-2 md:grid-cols-2 md:grid-rows-1 items-center"
        >
          <div>
            <label for="subcategory">Selecciona una subcategoría </label>
          </div>
          <div class="flex justify-start md:justify-center">
            <select
              name="subcategory"
              class="py-1 w-5/6 md:w-full border-2 border-blue-50 text-gray-500"
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
        <div @click="addVariation()">
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
      <div
        id="variacionIndividual"
        class="grid grid-cols-3 space-y-2 w-full overflow-hidden"
      >
        <div class="flex justify-center items-center">
          <label for="attributes"> Selecciona el atributo </label>
        </div>
        <div
          id="Agarra selects y boton"
          class="col-span-2 flex space-x-4 items-center justify-between"
        >
          <div>
            <select name="attributes" id="attributes" v-model="selectedIndex">
              <option
                v-for="(attribute, attributeIndex) in attributes"
                :key="attributeIndex"
                :value="attributeIndex"
              >
                {{ attribute.name }}
              </option>
            </select>
          </div>

          <div>
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
          </div>

          <div @click="addVariation()">
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
          v-for="(attribute, index) in selectedAttributes"
          :key="index"
          class="col-span-3 flex items-center space-x-2 w-full overflow-auto py-1"
        >
          <div class="font-semibold">#1</div>
          <div
            class="pt-1 px-2 shadow text-center font-medium"
            v-for="attributeVariation in attribute.variations"
            :key="attributeVariation.id"
          >
            {{ attributeVariation.value }}
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

    <button @click="sendData()">Guardar producto</button>
  </div>
</template>

<script>
import axios from "axios";
import Division from "../../../OspinaTrap/Division";
export default {
  mounted() {
    this.getCategories();
    this.getAttributes();
  },

  methods: {
    getAllVariations: function ($variationIndex) {
      let response = [];
      let $this = this;
      this.selectedAttributes.forEach(function (attribute) {
        attribute.variations.forEach(function (variation) {response.push(variation)});
      });
      console.log(response);
    },
    addVariation: function () {
      let $this = this;
      let attributeExist = false;
      let attributeIndex = 0;
      let variationExist = false;
      let variationItem = 0;
      if (this.selectedAttributes.length != 0) {
        //Starts verification
        this.selectedAttributes.forEach(function (item, indexAttribute) {
          console.log("entre");
          if (
            item.name == $this.attributes[$this.selectedIndex].name &&
            !attributeExist
          ) {
            console.log("Item Exits");
            attributeExist = true;
            attributeIndex = indexAttribute;
            item.variations.forEach(function (variationItem, indexVariation) {
              if (
                variationItem.id ==
                  $this.attributes[$this.selectedIndex].variations[
                    $this.selectedVariationIndex
                  ].id &&
                !variationExist
              ) {
                console.log("Variation exists!");
                variationExist = true;
                variationItem = indexVariation;
              } else {
                console.log("Variation does not exists!!");
              }
            });
          } else {
            console.log("Item does not exists");
          }
        });
        // End verification
        console.log(
          `VE: Atributo: ${attributeExist},variacion: ${variationExist}`
        );

        if (attributeExist && !variationExist) {
          $this.selectedAttributes[attributeIndex].variations.push(
            $this.attributes[$this.selectedIndex].variations[
              $this.selectedVariationIndex
            ]
          );
        }
        if (!attributeExist) {
          let auxObject = {
            name: $this.attributes[$this.selectedIndex].name,
            variations: [
              $this.attributes[$this.selectedIndex].variations[
                $this.selectedVariationIndex
              ],
            ],
          };
          this.selectedAttributes.push(auxObject);
        }
      } else {
        let auxObject = {
          name: $this.attributes[$this.selectedIndex].name,
          variations: [
            $this.attributes[$this.selectedIndex].variations[
              $this.selectedVariationIndex
            ],
          ],
        };
        this.selectedAttributes.push(auxObject);
      }
      $this.getAllVariations();
      console.log(this.selectedAttributes);
    },
    getAttributes: function () {
      let url = "http://127.0.0.1:8000/admin/attributes";
      let $this = this;

      axios.get(url).then(function (response) {
        console.log(response.data);
        $this.attributes = response.data;
      });
    },

    updateSubcategories: function () {
      let url = "http://127.0.0.1:8000/admin/";
      let $this = this;
      console.log($this.selectedCategory);
      axios
        .get(`${url}categories/${$this.selectedCategory}/getSubcategories`)
        .then(function (response) {
          console.log(response.data.length);
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
      let url = "http://127.0.0.1:8000/admin/";
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
      let url = "http://127.0.0.1:8000/admin/products";
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

      for (let i = 0; i < this.images.length; i++) {
        form.append("image[]", this.images[i]);
      }
      let mensaje = "<ul>";
      axios
        .post(url, form, {
          headers: { "Content-Type": "multipart/form-data" },
        })
        .then(function (response) {
          console.log(response);
        })
        .catch((error) => {
          let respuesta = error.response.data.errors;
          for (error in respuesta) {
            respuesta[error].forEach(function (element) {
              console.log(element);
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
  },
  data() {
    return {
      errorMessage: "",
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
      selectedAttributes: [],
      finalSelectedAttributes: [],
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
    Division,
  },
};
</script>

<style>
</style>