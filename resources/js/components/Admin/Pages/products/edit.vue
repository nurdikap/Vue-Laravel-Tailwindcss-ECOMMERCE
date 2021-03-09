<template>
  <div
    class="w-full h-screen flex flex-col text-sm space-y-4 px-3 py-3 relative"
  >
    <AdminMenu />
    <h1 class="text-xl font-medium">Editar producto {{ product.id }}</h1>
    <div class="space-x-1">
      <span> Atributos: </span>
      <span
        class="inline-block"
        v-for="(attribute, index) in product.attributes"
        :key="index"
      >
        {{
          index + 1 !== product.attributes.length
            ? ` ${attribute.value},`
            : attribute.value
        }}
      </span>
    </div>
    <div class="flex flex-col space-y-6">
      <div class="grid grid-cols-1 space-y-2 items-center">
        <label for="name">Nombre del producto</label>
        <input
          class="p-2 focus:border-blue-400 text-gray-500 border border-gray-200 shadow rounded"
          type="text"
          id="name"
          name="name"
          v-model="name"
          placeholder="Nombre"
        />
      </div>

      <div class="grid grid-cols-1 space-y-2 items-center">
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
      <div class="grid grid-cols-1 space-y-3 items-center">
        <label for="description">Descripción larga</label>
        <textarea
          class="p-2 focus:border-blue-400 text-gray-400 rounded border border-gray-200 shadow"
          name="description"
          id="description"
          placeholder="Descripcion larga y detallada del producto"
          v-model="description"
        />
      </div>
      <div class="grid grid-cols-1 space-y-2 items-center">
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
      <div class="grid grid-cols-1 space-y-2 items-center">
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
      <div class="grid grid-cols-1 space-y-2 items-center">
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
      <div class="grid grid-cols-1 space-y-2 items-center">
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

    <div
      class="grid grid-cols-1 space-y-2 items-center"
      v-show="look_for_stock"
    >
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
import AdminMenu from "../../Components/Menu";
export default {
  components: { AdminMenu },
  async mounted() {
    let product = await this.getproduct();
    this.updateproduct(product);
  },

  methods: {
    getproduct: async function () {
      let url = "http://127.0.0.1:8000/api/";
      let $this = this;
      let respuesta = "";
      await axios
        .get(`${url}products/${$this.$route.params.product}/edit`)
        .then(function (response) {
          console.log(response.data);
          respuesta = response.data;
        })
        .catch(function (error) {
          console.log(error.message);
        });
      return respuesta;
    },
    updateproduct: function (product) {
      this.product = product;
      this.name = this.product.name;
      this.price = this.product.price;
      this.discount = this.product.discount;
      this.reference = this.product.reference;
      this.stock = this.product.stock;
      this.look_for_stock = this.product.look_for_stock;
      this.description = this.product.description;
      this.short_description = this.product.short_description;
    },
    sendData: function () {
      let url = `http://127.0.0.1:8000/api/products/${this.$route.params.product}`;
      let form = new FormData();
      let $this = this;
      form.append("name", this.name);
      form.append("short_description", this.short_description);
      form.append("description", this.description);
      form.append("price", this.price);
      form.append("discount", this.discount);
      form.append("reference", this.reference);
      form.append("look_for_stock", this.look_for_stock);
      form.append("stock", this.stock);

      for (let i = 0; i < this.images.length; i++) {
        form.append("image[]", this.images[i]);
      }
      form.append("_method", "patch");

      let mensaje = "<ul>";
      console.log(form);
      axios
        .post(url, form, {
          headers: { "Content-Type": "multipart/form-data" },
        })
        .then(function (response) {
          $this.confirmationMensaje =
            "Se ha editado exitosamente el producto con ID: " + response.data;
          $this.$modal.show("modalExito");
          console.log(response);
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
  },
  data() {
    return {
      menu: false,
      product: "",
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