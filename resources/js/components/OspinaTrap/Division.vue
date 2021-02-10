<template>
  <div class="w-full"
  :class="[height,backgroundColor]"
  >

  </div>
</template>

<script>
export default {
props:{
  height: {
    type: String,
    default: 'h-2'
  },
  backgroundColor: {
    type: String,
    default: 'bg-fondoClaro'
  },
}
}
</script>

<style>

</style>