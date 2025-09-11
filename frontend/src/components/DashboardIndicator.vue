<template>
  <div class="bg-gray-800 rounded-lg p-5 flex flex-col justify-between shadow-md hover:shadow-lg transition-shadow duration-200">
    <div class="flex items-center justify-between">
      <div>
        <p class="text-sm font-medium text-gray-400">{{ title }}</p>
        <p class="mt-1 text-2xl font-semibold text-white">{{ value }}</p>
      </div>
      <div v-if="icon" class="text-white text-3xl">
        <component :is="icon" />
      </div>
    </div>
    <p v-if="subtitle" class="mt-2 text-sm text-gray-400">{{ subtitle }}</p>
  </div>
</template>

<script setup lang="ts">
import { defineProps } from 'vue'

interface Props {
  title: string
  value: string | number
  subtitle?: string
  icon?: any
}

defineProps<Props>()
</script>
