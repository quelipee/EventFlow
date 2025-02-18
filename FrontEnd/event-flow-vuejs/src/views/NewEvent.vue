<template>
  <div class="min-h-screen bg-gray-50 flex flex-col items-center">

    <header class="w-full bg-indigo-600 text-white p-4">
      <div class="max-w-7xl mx-auto flex justify-between items-center">
        <h1 class="text-2xl font-bold">Adicionar Evento</h1>
        <button
          @click="homepage"
          class="bg-white text-indigo-600 py-2 px-4 rounded-lg hover:bg-gray-100">
          Voltar
        </button>
      </div>
    </header>

    <main class="w-full max-w-7xl mx-auto p-6 bg-white rounded-lg shadow-lg mt-6">
      <h2 class="text-xl font-semibold text-indigo-600 mb-4">Novo Evento</h2>

      <form @submit.prevent="addEvent" class="space-y-4">
        <div>
          <label class="block text-gray-700 font-medium">Título do Evento</label>
          <input v-model="event.title" type="text" class="w-full p-2 border rounded-lg" required>
        </div>

        <div>
          <label class="block text-gray-700 font-medium">Descrição</label>
          <textarea v-model="event.description" class="w-full p-2 border rounded-lg" required></textarea>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
          <div>
            <label class="block text-gray-700 font-medium">Data de Inicio</label>
            <input v-model="event.eventStart" type="datetime-local" class="w-full p-2 border rounded-lg" required>
          </div>
          <div>
            <label class="block text-gray-700 font-medium">Data de Termino</label>
            <input v-model="event.eventEnd" type="datetime-local" class="w-full p-2 border rounded-lg" required>
          </div>
        </div>

        <div class="mb-3" v-if="errorLogin">
          <p class="text-red-400 text-sm text-center">{{errorLogin}}</p>
        </div>

        <div class="flex justify-end">
          <button type="submit" class="bg-indigo-600 text-white py-2 px-4 rounded-lg hover:bg-indigo-700">
            Adicionar Evento
          </button>
        </div>
      </form>
    </main>
  </div>
</template>

<script lang="ts" setup>
import router from "@/router/index.js";
import {ref} from "vue";
import {EventStore} from "@/interfaces/type.ts";
import {addEventPost} from "@/services/eventService.ts";

const event = ref<EventStore>({
  title: '',
  description: '',
  eventEnd: '',
  eventStart: '',
});

const errorLogin = ref(null);
const clearError = () =>{
  errorLogin.value = null;
};
const addEvent = async () => {
  console.log(event.value);
  await addEventPost(event.value).then(()=>{
    router.replace('/homepage');
  }).catch((err) => {
    errorLogin.value = err.response.data.message;
    setTimeout(() => {
      clearError();
    },5000);
  });
}
const homepage = () => {
  router.replace('/homepage')
}

</script>


