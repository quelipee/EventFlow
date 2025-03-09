
<template>
  <header class="w-full bg-indigo-600 text-white p-4">
    <div class="max-w-7xl mx-auto flex justify-between items-center">
      <h1 class="text-2xl font-bold">Dashboard</h1>
      <div>
        <button @click="logout" class="bg-white text-indigo-600 py-2 px-4 rounded-lg hover:bg-gray-100">
          Log out
        </button>
      </div>
    </div>
  </header>
</template>

<script setup lang="ts">
import {logoutUserEvent} from "@/services/eventService.ts";
import router from "@/router";

const logout = async () => {
  try {
    await logoutUserEvent();
    await router.replace('/');
  }catch (err){
    console.log(err)
  }
}
</script>
