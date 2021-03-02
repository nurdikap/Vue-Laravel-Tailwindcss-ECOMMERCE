<template>
  <div class="w-full relative min-h-screen space-y-3 flex flex-col overflow-hidden p-2">
    <AdminMenu />

    <h2 class="text-xl font-medium text-center">Variaciones de variationos</h2>
    <h3 class="">
      En esta pagina se puede visualizar las variaciones de los productos, y
      permite editarlas.
    </h3>
    <!-- Tabla de variaciones  -->
    <div class="w-full overflow-auto md:px-4">
      <table class="table-auto w-full border-collapse mx-auto">
        <thead>
          <tr class="text-left">
            <th class="py-2.5 pl-2 pr-10 border-t border-b border-blue-200">
              ID
            </th>
            <th class="py-2.5 pr-10 border-t border-b border-blue-200">
              Producto
            </th>
            <th class="py-2.5 pr-10 border-t border-b border-blue-200">
              Atributos
            </th>
            <th class="py-2.5 pr-1 border-t border-b border-blue-200">
              Acciones
            </th>
          </tr>
        </thead>
        <tbody>
          <tr
            v-for="variation in variations"
            :key="variation.id"
            class="hover:bg-blue-50"
          >
            <td class="py-2.5 pl-2 pr-6 border-t border-b border-blue-200">
              {{ variation.id }}
            </td>
            <td class="py-2.5 pr-6 border-t border-b border-blue-200">
              {{ variation.name }}
            </td>
            <td class="py-2.5 pr-6 border-t border-b border-blue-200">
              <span
                v-for="(attribute, index) in variation.attributes"
                :key="attribute.id"
              >
                {{
                  index + 1 == variation.attributes.length
                    ? attribute.value
                    : `${attribute.value},`
                }}
              </span>
            </td>
            <td class="py-2.5 pr-1 border-t border-b border-blue-200">
              <div class="flex space-x-2 justify-center items-center w-full">
                <router-link
                  :to="{
                    name: 'adminVariationsEdit',
                    params: { variation: variation.id },
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
                <div class="bg-blue-100 cursor-pointer p-1.5 rounded-full">
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
  </div>
</template>

<script>
import axios from "axios";
import AdminMenu from "../../Components/Menu";
export default {
  components: { AdminMenu },
  async mounted() {
    let variations = await this.getvariations();
    this.updatevariations(variations);
  },
  methods: {
    getvariations: async function () {
      let url = "http://127.0.0.1:8000/api/";
      let $this = this;
      let respuesta = "";
      await axios
        .get(url + "variations")
        .then(function (response) {
          console.log(response.data);
          respuesta = response.data;
        })
        .catch(function (error) {
          console.log(error.message);
        });
      return respuesta;
    },
    updatevariations: function (variations) {
      this.variations = variations;
    },
  },
  data() {
    return {
      variations: [],
    };
  },
};
</script>

<style>
</style>