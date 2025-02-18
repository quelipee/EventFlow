<template>
    <div class="min-h-screen flex items-center justify-center bg-gray-50">
      <div class="w-full max-w-md bg-white rounded-lg shadow-md p-8">
        <div class="text-center mb-6">
          <span class="text-4xl font-bold text-indigo-600">📚</span>
        </div>

        <h2 class="text-2xl font-bold text-gray-800 text-center mb-4">Criar Conta</h2>

        <form class="space-x-4" method="POST" @submit.prevent="submitForm">

          <div class="mb-4">
            <label class="block text-gray-700 text-sm font-medium mb-2">Nome</label>
            <input
              type="text"
              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500"
              placeholder="Digite seu nome"
              v-model="user.name"
              required
            />
          </div>

          <div class="p-1">
            <label class="block text-gray-700 text-sm font-medium mb-2">Email</label>
            <input
              type="email"
              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500"
              placeholder="Digite seu e-mail"
              v-model="user.email"
              required
            />
          </div>

          <div class="p-1">
            <label class="block text-gray-700 text-sm font-medium mb-2">Senha</label>
            <input
              type="password"
              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500"
              placeholder="Digite sua senha"
              v-model="user.password"
              required
            />
          </div>

          <div class="p-1">
            <label class="block text-gray-700 text-sm font-medium mb-2">Confirmar Senha</label>
            <input
              type="password"
              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500"
              placeholder="Confirme sua senha"
              v-model="user.passwordRepeat"
              required
            />
          </div>

          <div class="p-1 flex items-center">
            <input
              type="checkbox"
              id="terms"
              class="mr-2"
              v-model="termsAccepted"
              required
            />
            <label for="terms" class="text-sm text-gray-600">Aceito os termos e condições</label>
          </div>

          <div class="p-1">
            <button
              type="submit"
              class="w-full bg-indigo-600 text-white py-2 px-4 rounded-lg hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500"
            >
              Criar Conta
            </button>
          </div>

          <div class="text-center">
            <p class="text-sm text-gray-600">
              Já tem uma conta?
              <a href="/login" class="text-indigo-600 hover:underline">Faça login</a>
            </p>
          </div>
        </form>
      </div>
    </div>
  </template>

  <script setup lang="ts">
  import type {User} from "@/interfaces/type.ts";
  import {ref} from "vue";
  import {signUpAuthenticated} from "@/services/eventService.ts";
  import router from "@/router";

  const user = ref<User>({
    name: '',
    email: '',
    password: '',
    passwordRepeat: ''
  });

  const submitForm = async () => {

    await signUpAuthenticated(user.value).then((response) => {
      router.replace('/homepage');
      console.log(response);
    }).catch((err) => {
      console.log(err);
    })
  }
  </script>

  <style scoped>
  /* Adicione seus estilos personalizados aqui, se necessário */
  </style>
