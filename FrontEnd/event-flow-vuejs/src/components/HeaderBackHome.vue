
<template>
  <header class="w-full bg-indigo-600 text-white p-4">
    <div class="max-w-7xl mx-auto flex justify-between items-center">
      <h1 class="text-2xl font-bold">Editar Evento</h1>
      <div>
        <button
          @click="homepage"
          class="bg-white text-indigo-600 py-2 px-4 rounded-lg hover:bg-gray-100">
          Voltar
        </button>
      </div>
    </div>
  </header>
</template>
<script setup lang="ts">
import router from "@/router";

const homepage = () => {
  router.replace('/homepage')
}
</script>
