<template>
  <div class="w-full h-screen flex flex-col space-y-4 px-3 py-3">
    <AdminMenu />

    <h1 class="text-lg font-medium">Crear nuevo atributos</h1>
    <div class="flex flex-col space-y-4">
      <div class="flex flex-col space-y-4 w-full">
        <p class="text-justify">
          <strong>Seccion de Atributos del producto</strong>: Debe añadir las
          propiedades y cada una de sus variaciones de la siguiente manera
        </p>

        <div class="grid grid-cols-6 px-1 space-x-3 items-center text-sm">
          <span class="col-span-2"> Añadir nuevo atributo </span>
          <input
            type="text"
            placeholder="atributo"
            v-model="currentAttribute"
            class="p-1 text-center col-span-4 md:col-span-3 shadow rounded-lg bg-blue-200 outline-none"
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
              @keyup.enter="
                addVariationToAttribute(index, attributes[index].aux)
              "
            />

            <div
              v-for="(variation, variationIndex) in attributes[index]
                .variations"
              :key="variationIndex"
            >
              <div class="flex justify-between px-1 my-1">
                <span>
                  {{ variation.value }}
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

      <modal name="modalError" adaptive height="auto" classes="bg-red-200"
        ><div class="space-y-4 flex flex-col justify-center w-full h-full py-3">
          <p class="font-medium text-center">¡Ha ocurrido un error! 😯</p>
          <div v-html="errorMessage" class="px-2 my-1"></div>
        </div>
      </modal>

      <div class="text-center"><button class="py-1 px-2 bg-primario rounded text-white mb-2 text-sm font-medium" @click="sendData()">Guardar Atributos</button></div>
    </div>
    <modal name="modalExito" adaptive height="auto" classes="bg-red-200"
      ><div class="space-y-4 flex flex-col justify-center w-full h-full py-3">
        <p class="font-medium text-center">¡Attributos actualizados con éxito! 🎆</p>
      </div>
    </modal>
  </div>
</template>

<script>
import axios from "axios";
import AdminMenu from "../../Components/Menu";
export default {
  components: { AdminMenu },
  mounted() {
    this.getAttributes();
  },
  methods: {
    getAttributes: function () {
      let url = "http://127.0.0.1:8000/api/attributes";
      let $this = this;

      axios.get(url).then(function (response) {
        console.log(response.data);
        $this.attributes = response.data;
      });
    },
    sendData: function () {
      let url = "http://127.0.0.1:8000/api/attributes";
      let $this = this;
      let data = {
        attributes: this.attributes,
        removedIndex: this.removedIndex,
      };
      axios.post(url, data).then(function (response) {
        console.log(response);
        $this.$modal.show("modalExito");
      });
    },

    removeAttribute: function (attributeIndex) {
      let $this = this;
      this.attributes[attributeIndex].variations.forEach(function (variation) {
        $this.removedIndex.push(variation.id);
      });

      this.attributes.splice(attributeIndex, 1);
    },
    removeVariation: function (attributeIndex, variationIndex) {
      this.removedIndex.push(
        this.attributes[attributeIndex].variations[variationIndex].id
      );

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
      let auxiliarVariation = {
        id: null,
        value: variation,
      };
      this.attributes[index].variations.push(auxiliarVariation);
      this.attributes[index].aux = ""; //Clear auxiliar variation (input)
      console.log(this.attributes[index].variations);
    },
  },
  data() {
    return {
      errorMessage: "",
      backgroundColors: ["red", "blue", "green", "purple", "yellow"],
      attributes: [],
      currentAttribute: "",
      removedIndex: [],
    };
  },
};
</script>

<style>
</style>