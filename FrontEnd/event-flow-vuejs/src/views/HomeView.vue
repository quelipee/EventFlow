<template>
  <div class="min-h-screen bg-gray-50 flex flex-col items-center">

    <header class="w-full bg-indigo-600 text-white p-4">
      <div class="max-w-7xl mx-auto flex justify-between items-center">
        <h1 class="text-2xl font-bold">Dashboard</h1>
        <div>
          <button class="bg-white text-indigo-600 py-2 px-4 rounded-lg hover:bg-gray-100">
            Log out
          </button>
        </div>
      </div>
    </header>

    <!-- Main Content -->
    <main class="w-full max-w-7xl mx-auto p-4">
      <div class="flex items-center justify-end p-2">
        <button
          @click="addEvent"
          class="bg-gray-400 py-1 px-3 rounded-md
          shadow-2xl text-white font-semibold hover:bg-gray-600">Novo Evento</button>
      </div>
      <!-- Events Grid (Cards) -->
      <div
        v-for="event in eventComputed"
        :key="event.id"
        class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 p-1">
        <!-- Event Card -->
        <div class="bg-white p-6 rounded-lg shadow-lg">
          <div class="flex justify-between">
            <h3 class="text-xl font-semibold text-indigo-600">{{ event.title }}</h3>
            <p class="text-sm bg-gray-400 border rounded-full px-3 py-1 text-white font-semibold">
              {{ event.formattedDateStart }} - {{ event.formattedDateEnd }}
            </p>
          </div>
          <p class="text-gray-600 mt-2">{{ event.description }}</p>
          <div class="mt-4 flex justify-between items-center">
            <div>
              <span class="bg-blue-500 text-white py-1 px-3 rounded-full text-xs">{{ event.eventStart.slice(11) }}</span>
              <span class="bg-green-500 ml-2 text-white py-1 px-3 rounded-full text-xs">{{ event.eventEnd.slice(11) }}</span>
            </div>
            <div class="flex flex-col space-y-2">
              <button @click="editEvent(event)" class="hover:bg-green-800 ml-2 bg-green-500 text-white py-1 px-3 rounded-full text-xs">EDITAR</button>
              <button @click="deleteEvent(event.id)" class="hover:bg-red-800 ml-2 bg-red-500 text-white py-1 px-3 rounded-full text-xs">DELETAR</button>
            </div>
          </div>
        </div>

      </div>
    </main>
  </div>

  <div v-if="showModal" class="fixed inset-0 bg-gray-800 bg-opacity-50 flex justify-center items-center">
    <div class="bg-white p-6 rounded-lg shadow-lg w-1/3">
      <h2 class="text-xl font-semibold text-gray-800 mb-4">Tem certeza que deseja excluir este evento?</h2>
      <p class="text-gray-600 mb-4">Esta ação não pode ser desfeita.</p>

      <div class="flex justify-end">
        <button @click="confirmDelete" class="bg-red-500 text-white py-2 px-4 rounded-lg mr-2">Deletar</button>
        <button @click="cancelDelete" class="bg-gray-500 text-white py-2 px-4 rounded-lg">Cancelar</button>
      </div>
    </div>
  </div>

</template>

<script lang="ts" setup>
import {eventStore} from "@/stores/eventStore.js";
import {computed, onMounted} from "vue";
import router from "@/router";
import {destroyEventDelete} from "@/services/eventService.ts";
import {ref} from "vue";

const showModal = ref(false);
const eventToDelete = ref(null);

const storeEvent = eventStore();
onMounted(async () => {
  await storeEvent.getAllEventStore();
   storeEvent.event.forEach((evt) => {
     console.log(typeof(evt.eventStart));
   });
});
const eventComputed = computed(() => {
  return storeEvent.event.map(evt =>{
    return {
      ...evt,
      formattedDateStart: new Intl.DateTimeFormat('pt-BR').format(new Date(evt.eventStart)),
      formattedDateEnd: new Intl.DateTimeFormat('pt-BR').format(new Date(evt.eventEnd))
    }
  });
});

const editEvent = (event) => {
    router.replace({
    name: 'editEvent',
    params: {
      id: event.id,
    }
  });
};

const deleteEvent = async (eventId : number) => {
  showModal.value = true;
  eventToDelete.value = eventId;
}

const confirmDelete = async () => {
  await destroyEventDelete(eventToDelete.value);
  showModal.value = false;
  await  storeEvent.getAllEventStore();
}

const cancelDelete = () => {
  showModal.value = false;
}

const addEvent = () => {
  router.replace('/newEvent');
}

</script>
