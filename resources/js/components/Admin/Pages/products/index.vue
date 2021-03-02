<template>
  <div
    class="w-full relative min-h-screen space-y-5 flex flex-col overflow-hidden py-2 px-2 md:px-5"
  >
    <AdminMenu />

    <h2 class="text-xl font-medium text-center">Productos creados en el sistema</h2>
    <div class="flex justify-end items-center">
     
      <router-link class="py-1 md:py-1.5 rounded px-1 bg-primario hover:bg-blue-500 text-white font-medmium md:mr-4" :to="{name:'adminProductsCreate'}"> 
        Crear producto
      </router-link>
    </div>

    <!-- Tabla de variaciones  -->
    <div class="w-full overflow-auto">
      <table class="table-auto w-full border-collapse mx-auto">
        <thead>
          <tr class="text-left">
            <th class="py-2.5 pl-2 pr-10 border-t border-b border-blue-200">
              Referencia
            </th>
            <th class="py-2.5 pr-10 border-t border-b border-blue-200">
              Producto
            </th>
            <th class="py-2.5 pr-10 border-t border-b border-blue-200">
              Precio
            </th>
            <th class="py-2.5 pr-10 border-t border-b border-blue-200">
              Descuento
            </th>
            <th class="py-2.5 pr-1 border-t border-b border-blue-200">
              Descripción
            </th>
            <th class="py-2.5 pr-1 border-t border-b border-blue-200">
              Variaciones
            </th>
            <th class="py-2.5 pr-1 border-t border-b border-blue-200">
              Acciones
            </th>
          </tr>
        </thead>
        <tbody>
          <tr
            v-for="product in products"
            :key="product.id"
            class="hover:bg-blue-50"
          >
            <td class="py-2.5 pl-2 pr-6 border-t border-b border-blue-200">
              {{ product.reference }}
            </td>
            <td class="py-2.5 pr-6 border-t border-b border-blue-200">
              {{ product.name }}
            </td>
            <td class="py-2.5 pr-6 border-t border-b border-blue-200">
              {{ product.price }}
            </td>
            <td class="py-2.5 pr-6 border-t border-b border-blue-200">
              {{ product.discount }}
            </td>
            <td class="py-2.5 pr-6 border-t border-b border-blue-200">
              {{ product.short_description }}
            </td>
            <td class="py-2.5 pr-6 border-t border-b border-blue-200">
              {{ product.variations.length }}
            </td>
            <!-- <td class="py-2.5 pr-6 border-t border-b border-blue-200">
              <span
                v-for="(attribute, index) in product.attributes"
                :key="attribute.id"
              >
                {{
                  index + 1 == product.attributes.length
                    ? attribute.value
                    : `${attribute.value},`
                }}
              </span>
            </td> -->
            <td class="py-2.5 pr-1 border-t border-b border-blue-200">
              <div class="flex space-x-2 justify-center items-center w-full">
                <router-link
                  :to="{
                    name: 'adminProductsEdit',
                    params: { product: product.id },
                  }"
                  class="bg-blue-100 cursor-pointer p-1.5 rounded-full"
                >
                  <svg
                    class="w-4 h-4 text-blue-600"
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                  >
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"
                    />
                  </svg>
                </router-link>
                <div
                  class="bg-blue-100 cursor-pointer p-1.5 rounded-full"
                  @click="
                    selectedProduct = product.id;
                    $modal.show('confirmationModal');
                  "
                >
                  <svg
                    class="w-4 h-4 text-blue-600"
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
              </div>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    <modal name="confirmationModal" adaptive height="auto" classes="bg-red-200"
      ><div class="space-y-4 flex flex-col justify-center w-full h-full py-3">
        <p class="font-medium text-center">
          ¡Cuidado, esta acción es irreversible ⚠!
        </p>
        <div class="px-2 my-1 space-y-4">
          <p class="text-center">
            ¿Estás seguro de que deseas eliminar este conjunto de variaciones?
          </p>
          <div class="flex justify-around">
            <button
              @click="$modal.hide('confirmationModal')"
              class="bg-white text-primario font-medium uppercase py-1 px-2 border border-primario"
            >
              Cancelar
            </button>
            <button
              @click="deleteProduct()"
              class="bg-primario text-white font-medium uppercase py-1 px-2 rounded"
            >
              Aceptar
            </button>
          </div>
        </div>
      </div>
    </modal>
    <modal name="successModal" adaptive height="auto" classes="bg-red-200"
      ><div class="space-y-4 flex flex-col justify-center w-full h-full py-3">
        <p class="font-medium text-center">¡Éxito!</p>
        <div class="px-2 my-1 space-y-4">
          <p class="text-center">
            Las variaciones se han eliminado exitosamente
          </p>
        </div>
      </div>
    </modal>
  </div>
</template>

<script>
import axios from "axios";
import AdminMenu from "../../Components/Menu";
export default {
  components: { AdminMenu },
  async mounted() {
    let products = await this.getProducts();
    this.updateProducts(products);
  },
  methods: {
    getProducts: async function () {
      let url = "http://127.0.0.1:8000/api/";
      let $this = this;
      let respuesta = "";
      await axios
        .get(url + "products")
        .then(function (response) {
          respuesta = response.data;
        })
        .catch(function (error) {
          console.log(error.message);
        });
      return respuesta;
    },
    updateProducts: function (products) {
      this.products = products;
    },
    deleteProduct: async function () {
      let url = "http://127.0.0.1:8000/api/";
      let $this = this;
      axios
        .delete(url + `products/${this.selectedProduct}`)
        .then(function (response) {
          $this.$modal.hide("confirmationModal");
          $this.$modal.show("successModal");
          $this.getProducts().then(function (products) {
            $this.updateProducts(products);
          });
        })
        .catch(function (error) {
          console.log(error.message);
        });
    },
  },
  data() {
    return {
      selectedProduct: "",
      products: [],
    };
  },
};
</script>

<style>
</style>