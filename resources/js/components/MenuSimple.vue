<template>
  <div class="flex items-center justify-around space-x-4 pr-1.5 pl-3 mt-1">
    <svg
    @click="$router.go(-1)"

      xmlns="http://www.w3.org/2000/svg"
      fill="none"
      viewBox="0 0 24 24"
      stroke="currentColor"
      class="w-6 h-6 text-texto
      cursor-pointer"
    >
      <path
        stroke-linecap="round"
        stroke-linejoin="round"
        stroke-width="2"
        d="M15 19l-7-7 7-7"
      />
    </svg>
    <div class="flex mx-1 mt-1 py-2 px-2 flex-grow">
      <div class="flex flex-grow"></div>
      <div class="relative">
        <div
          class="h-5 w-5 left-3 bottom-3 bg-primario rounded-full text-white shadow-azul-grande flex items-center justify-center absolute text-xs"
        >
          10
        </div>
        <svg
          xmlns="http://www.w3.org/2000/svg"
          fill="none"
          viewBox="0 0 24 24"
          stroke="currentColor"
          class="w-6 h-6"
          color="#DADDE1"
        >
          <path
            stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="2"
            d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"
          />
        </svg>
      </div>
    </div>
  </div>
</template>

<script>
export default {};
</script>

<style>
</style>