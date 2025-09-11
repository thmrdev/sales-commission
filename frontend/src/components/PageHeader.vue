<template>
  <div class="border-b border-gray/200 pb-5 sm:flex sm:items-center sm:justify-between">
    <div>
      <h3 class="text-3xl font-bold mb-1">{{ title }}</h3>
      <p v-if="subtitle" class="mt-1 text-sm text-gray-900">{{ subtitle }}</p>
    </div>
    <div v-if="buttons.length" class="mt-3 flex sm:mt-0 sm:ml-4 space-x-3">
      <button
        v-for="(btn, index) in buttons"
        :key="index"
        :type="btn.type || 'button'"
        :class="[
          btn.variant === 'primary' ? 'bg-indigo-500 hover:bg-indigo-400 text-white' :
          btn.variant === 'secondary' ? 'bg-white/10 hover:bg-white/20 text-white' :
          btn.class || '',
          'inline-flex items-center rounded-md px-3 py-2 text-sm font-semibold focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500'
        ]"
        @click="btn.action"
      >
        {{ btn.label }}
      </button>
    </div>
  </div>
</template>

<script setup lang="ts">
interface ButtonProps {
  label: string
  action: () => void
  type?: 'button' | 'submit' | 'reset'
  variant?: 'primary' | 'secondary'
  class?: string
}

interface PageHeaderProps {
  title: string
  subtitle?: string
  buttons?: ButtonProps[]
}

const props = defineProps<PageHeaderProps>()

const buttons = props.buttons || []
const title = props.title
const subtitle = props.subtitle
</script>
