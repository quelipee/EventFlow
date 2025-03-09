<template>
  <div class="min-h-screen bg-gray-50 flex flex-col items-center">
    <Header/>
    <main class="w-full max-w-7xl mx-auto p-4">

      <NewEvent @click="addEvent"/>

      <div class="grid grid-rows-1 sm:grid-cols-2 lg:grid-cols-3 gap-3 p-1">
        <Events v-for="event in sortedEvents"
                :key="event.id"
                :id="event.id"
                :title="event.title"
                :description="event.description"
                :eventStart="event.formattedDateStart"
                :eventEnd="event.formattedDateEnd"
                :eventStartTime="event.eventStart"
                :eventEndTime="event.eventEnd"
                @editEvent="editEvent"
                @deleteEvent="deleteEvent"
        />
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
import NewEvent from "@/components/event/NewEvent.vue";
import {eventStore} from "@/stores/eventStore.js";
import Header from "@/components/headers/Header.vue";
import {computed, onMounted} from "vue";
import router from "@/router";
import {destroyEventDelete} from "@/services/eventService.ts";
import {ref} from "vue";
import type {EventStore} from "@/interfaces/type.ts";
import Events from "@/components/event/Events.vue";

const showModal = ref(false);
const eventToDelete = ref();

const storeEvent = eventStore();
onMounted(async () => {
  await storeEvent.getAllEventStore();
   storeEvent.event.forEach((evt) => {
     console.log(typeof(evt.eventStart));
   });
});

const editEvent = (event : EventStore) => {
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
const sortedEvents = computed(() => {
  return [...storeEvent.event].sort((a,b) =>
    new Date(a.eventStart).getTime() - new Date(b.eventStart).getTime()).map(evt => ({
    ...evt,
    formattedDateStart: new Intl.DateTimeFormat('pt-BR').format(new Date(evt.eventStart)),
    formattedDateEnd: new Intl.DateTimeFormat('pt-BR').format(new Date(evt.eventEnd))
  })).filter(evt =>
    evt.status != 'INATIVO'
  );
});

</script>
