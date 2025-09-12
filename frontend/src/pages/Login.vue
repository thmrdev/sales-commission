<template>
  <div class="flex min-h-full flex-1 items-center justify-center px-4 py-12 sm:px-6 lg:px-8 bg-gray-900">
    <div class="w-full max-w-sm space-y-10">
      <div>
        <img
          class="mx-auto h-10 w-auto"
          src="https://tailwindcss.com/plus-assets/img/logos/mark.svg?color=indigo&shade=500"
          alt="Your Company"
        />
        <h2 class="mt-10 text-center text-2xl/9 font-bold tracking-tight text-white">
          SC - Sales Commission
        </h2>
      </div>

      <form @submit.prevent="handleLogin" class="space-y-6">
        <div class="space-y-4">
          <input
            v-model="email"
            type="email"
            autocomplete="email"
            required
            placeholder="Email address"
            class="block w-full rounded-md bg-white/5 px-3 py-2 text-base text-white outline-1 -outline-offset-1 outline-gray-700 placeholder:text-gray-500 focus:outline-2 focus:outline-indigo-500 sm:text-sm/6"
          />

          <input
            v-model="password"
            type="password"
            autocomplete="current-password"
            required
            placeholder="Password"
            class="block w-full rounded-md bg-white/5 px-3 py-2 text-base text-white outline-1 -outline-offset-1 outline-gray-700 placeholder:text-gray-500 focus:outline-2 focus:outline-indigo-500 sm:text-sm/6"
          />
        </div>

        <button
          type="submit"
          :disabled="loading"
          class="flex w-full justify-center rounded-md bg-indigo-500 px-3 py-2 text-sm font-semibold text-white hover:bg-indigo-400 disabled:opacity-50 disabled:cursor-not-allowed focus:outline-2 focus:outline-offset-2 focus:outline-indigo-500"
        >
          <span v-if="!loading">Sign in</span>
          <span v-else>Loading...</span>
        </button>

        <p v-if="errorMessage" class="text-red-500 text-center">{{ errorMessage }}</p>
      </form>
    </div>
  </div>
</template>

<script setup lang="ts">
import { ref } from 'vue'
import { useRouter } from 'vue-router'
import { useAuthStore } from '../stores/auth'
import axios from '../api/http'

const auth = useAuthStore()
const router = useRouter()

const email = ref('')
const password = ref('')
const errorMessage = ref('')
const loading = ref(false)

const handleLogin = async () => {
  errorMessage.value = ''
  loading.value = true
  try {
    const response = await axios.post('/login', {
      email: email.value,
      password: password.value,
    })

    auth.login(response.data)

    router.push('/')
  } catch (err: any) {
    errorMessage.value = err.response?.data?.message || 'Erro ao logar'
  } finally {
    loading.value = false
  }
}
</script>
