<template>
    <div class="min-h-screen bg-gray-50 flex flex-col items-center">
      <HeaderBackHome/>

      <main v-show="loading" class="w-full max-w-4xl mx-auto p-6 bg-white shadow-lg rounded-lg mt-6">
        <h2 class="text-xl font-semibold text-gray-700 mb-4">Editar Evento</h2>
        <form @submit.prevent="editEvent(event)" class="space-y-4">
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
  import HeaderBackHome from "@/components/headers/HeaderBackHome.vue";
  import { ref, onMounted } from 'vue';
  import { useRoute, useRouter } from 'vue-router';
  import {eventStore} from "@/stores/eventStore.js";
  import type {EventStore} from "@/interfaces/type.ts";
  import {editEventPut} from "@/services/eventService.ts";

  const route = useRoute();
  const router = useRouter();
  const storeEvent = eventStore();
  const loading = ref(false);
  const errorLogin = ref(null);
  const clearError = () =>{
    errorLogin.value = null;
  };
  const event = ref<EventStore>({
    title: '',
    description: '',
    eventStart: '',
    eventEnd: ''
  });

  onMounted(async () => {
    await storeEvent.getAllEventStore();
    storeEvent.event.forEach((evt) => {
      if (evt.id == route.params.id){
        console.log(evt);
        event.value.id = evt.id;
        event.value.title = evt.title;
        event.value.description = evt.description;
        event.value.eventStart = evt.eventStart;
        event.value.eventEnd = evt.eventEnd;
        loading.value = true;
      }
    });
  });

  const editEvent = async (event : EventStore) => {
    await editEventPut(event).then(() => {
      router.replace('/homepage');
    }).catch((err) => {
      errorLogin.value = err.response.data.message;
      setTimeout(() => {
        clearError();
      },5000);
    });
  }
  </script>

