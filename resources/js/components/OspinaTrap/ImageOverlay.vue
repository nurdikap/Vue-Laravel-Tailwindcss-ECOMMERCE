<template>
  <div
    class="absolute w-full h-full bg-black z-10 top-0 right-0 left-0 bottom-0 rounded-lg"
    :class="getOpacity"
  ></div>
</template>

<script>
export default {
  computed: {
    getOpacity: function () {
      return 'opacity-'+this.opacity;
    },
  },
  props: ["opacity"],
};
</script>

<style>
</style>