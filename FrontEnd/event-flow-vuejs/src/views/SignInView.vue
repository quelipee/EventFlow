<template>
<div class="h-screen flex items-center justify-center">
  <div class="flex w-full max-w-4xl bg-white shadow-lg rounded-lg overflow-hidden">

    <div class="w-full md:w-1/2 p-8">

      <div class="flex justify-center mb-4">
        <span class="text-3xl font-bold text-indigo-600">📚</span>
      </div>

      <h2 class="text-2xl font-bold text-gray-900 text-center mb-2">Entre na sua conta</h2>

      <form action="" method="post" @submit.prevent="checkForm">
        <div class="mb-4">
          <label class="block text-gray-700 text-sm font-medium mb-2">Email</label>
          <input
          type="email"
          v-model="user.email"
          class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" placeholder="Enter your email">
        </div>

        <div class="mb-4">
          <label class="block text-gray-700 text-sm font-medium mb-2">Senha</label>
          <input
          type="password"
          v-model="user.password"
          class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" placeholder="Enter your password">
        </div>

        <div class="mb-3" v-if="errorLogin">
          <p class="text-red-400 text-sm text-center">{{errorLogin}}</p>
        </div>

        <div class="flex justify-between items-center mb-4">
          <label class="flex items-center text-sm text-gray-600">
            <input type="checkbox" class="mr-2"> Lembrar-me
          </label>
          <a href="#" class="text-indigo-600 text-sm hover:underline">Esqueceu a senha?</a>
        </div>

        <button class="w-full bg-indigo-600 text-white py-2 rounded-lg hover:bg-indigo-700 transition">
          Entrar
        </button>
      </form>

      <div class="flex items-center my-6">
        <div class="flex-1 border-t"></div>
        <p
          class="px-4 text-gray-700 text-sm font-semibold
          hover:text-gray-400"><router-link to="/register">Criar Conta</router-link></p>
        <div class="flex-1 border-t"></div>
      </div>
    </div>

    <div class="md:w-1/2 w-full">
      <img src="https://wallpaperaccess.com/full/4521595.jpg" class="w-full h-full object-cover" />
    </div>
  </div>
</div>

</template>
<script setup lang="ts">
import type { User } from '@/interfaces/type';
import router from '@/router';
import { ref } from 'vue';
import {signInAuthenticated} from "@/services/eventService.ts";

const errorLogin = ref(null);
const clearError = () =>{
  errorLogin.value = null;
};
const user = ref<User>({
    email: '',
    password: '',
});

const checkForm = async () => {
    await signInAuthenticated(user.value).then((response) => {
        router.replace('/homepage');
        console.log(response);
    }).catch((err) => {
        errorLogin.value = err.response.data.message;
        setTimeout(() => {
          clearError();
        },5000)
    })
}
</script>
