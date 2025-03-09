<template>
    <div
      class="bg-white p-6 rounded-xl shadow-lg">
      <p class="items-start flex justify-end text-sm px-3 py-1 text-gray-600 font-semibold p-2">
        {{ eventStart }} - {{ eventEnd }}
      </p>
      <h3 class="text-xl font-semibold text-indigo-600">{{ title }}</h3>
      <p class="text-gray-600 mt-2">{{ description }}</p>

      <div class="mt-4 flex justify-between items-center">
        <span class="bg-blue-400 text-white py-1 px-3 rounded-md font-bold text-xs">DURAÇÃO : {{ eventStartTime.slice(11,16) }} - {{ eventEndTime.slice(11,16) }}</span>
        <div class="flex flex-col space-y-2">
          <button @click="$emit('editEvent', { id,title, description, eventStart, eventEnd })" class="hover:bg-green-800 ml-2 bg-green-500 text-white py-1 px-3 rounded-md text-xs">EDITAR</button>
          <button @click="$emit('deleteEvent', id)" class="hover:bg-red-800 ml-2 bg-red-500 text-white py-1 px-3 rounded-md text-xs">DELETAR</button>
        </div>
      </div>

  </div>
</template>
<script setup lang="ts">
import type { CardEvent } from "@/interfaces/type.ts";

defineProps<CardEvent>();
defineEmits(['editEvent','deleteEvent'])
</script>

