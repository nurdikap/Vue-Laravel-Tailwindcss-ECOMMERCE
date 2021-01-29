<template>
  <div class="h-screen w-full flex flex-col">
    <Menu />
    <Destacado/>
  </div>
</template>

<script>
import Menu from "./Menu.vue";
import Destacado from "./Destacado.vue";

export default {
  mounted() {
    console.log("Component mounted.");
    
  },
  components: {
    Menu,
    Destacado
  },
};
</script>
