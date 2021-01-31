<template>
   <div
        class="flex flex-col justify-center items-center p-3 rounded-md"
      >
        <svg
          xmlns="http://www.w3.org/2000/svg"
          fill="none"
          viewBox="0 0 24 24"
          stroke="currentColor"
          class="text-primario w-14 h-14"
        >
          <path
            stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="1"
            d="M13 10V3L4 14h7v7l9-11h-7z"
          />
        </svg>
        <h4 class="text-center text-md font-light">{{name}}</h4>
      </div>
</template>

<script>
export default {
    computed:{
      getBackground: function () {
        return this.background
      }
    },
    props: ['name','background']
}
</script>

<style>

</style>