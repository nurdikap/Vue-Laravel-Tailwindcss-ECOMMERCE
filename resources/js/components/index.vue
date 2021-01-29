<template>
  <div class="h-screen w-full flex flex-col">
    <Menu class="bg-white" />
    <Destacado class="bg-white" />
    <Division class="my-2"/>
    <Productos/>
  </div>
</template>

<script>
import Menu from "./Menu.vue";
import Destacado from "./Destacado.vue";
import Division from "./OspinaTrap/Division.vue";
import Productos from "./Productos.vue";

export default {
  mounted() {
    console.log("Component mounted.");
  },
  components: {
    Menu,
    Destacado,
    Division,
    Productos
  },
};
</script>
