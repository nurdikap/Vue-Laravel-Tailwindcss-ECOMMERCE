<template>
  <div class="w-full flex flex-col max-h-screen overflow-hidden">
    <div class="flex flex-col overflow-y-scroll mb-10">
      <Menu class="bg-white" />
      <Destacado class="bg-white" />

      <Division class="my-2" />
      <Categorias class="md:mb-12" />
      <Division class="my-2" />
      <Productos />
    </div>
    <BarraNavegacion />
  </div>
</template>

<script>
import Menu from "../Menu.vue";
import Destacado from "../Destacado.vue";
import Division from "../OspinaTrap/Division.vue";
import Productos from "../Productos.vue";
import Categorias from "../Categorias.vue";
import BarraNavegacion from "../BarraNavegacion.vue";

export default {
  data() {
    return { windowHeight: "640px" };
  },
  beforeMount() {
    let vh = window.innerHeight;
    console.log(vh);
    this.windowHeight = vh + "px";
  },
  components: {
    Menu,
    Destacado,
    Division,
    Productos,
    Categorias,
    BarraNavegacion,
  },
};
</script>
<style>
</style>