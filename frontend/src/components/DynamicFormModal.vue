<template>
  <transition name="fade">
    <div v-if="isOpen" class="fixed inset-0 z-50 flex items-center justify-center bg-black/50">
      <div class="bg-gray-900 w-full max-w-lg rounded-lg shadow-lg p-6">
        <div class="flex justify-between items-center mb-4">
          <h3 class="text-lg font-semibold text-white">{{ title }}</h3>
          <button @click="close" class="text-gray-400 hover:text-white">&times;</button>
        </div>

        <form @submit.prevent="handleSubmit" class="space-y-4">
          <div v-for="field in fields" :key="field.name" class="flex flex-col">
            <label class="text-sm text-gray-300 mb-1">{{ field.label }}</label>

            <input
              v-if="!field.type || field.type === 'text'"
              v-model="formData[field.name]"
              :placeholder="field.placeholder"
              class="px-3 py-2 rounded bg-gray-800 text-white border border-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500"
            />

            <select
              v-else-if="field.type === 'select'"
              v-model="formData[field.name]"
              class="px-3 py-2 rounded bg-gray-800 text-white border border-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500"
            >
              <option v-for="option in field.options" :key="option.value" :value="option.value">
                {{ option.label }}
              </option>
            </select>

            <div v-else-if="field.type === 'checkbox'" class="flex items-center gap-2">
              <input type="checkbox" v-model="formData[field.name]" class="rounded bg-gray-800" />
              <span class="text-gray-300 text-sm">{{ field.label }}</span>
            </div>
          </div>

          <div class="flex justify-end gap-3 mt-4">
            <button type="button" @click="close" class="px-4 py-2 rounded bg-gray-700 text-white hover:bg-gray-600">
              Cancelar
            </button>
            <button type="submit" class="px-4 py-2 rounded bg-indigo-500 text-white hover:bg-indigo-400">
              {{ submitLabel }}
            </button>
          </div>
        </form>
      </div>
    </div>
  </transition>
</template>

<script setup lang="ts">
import { reactive, toRefs } from 'vue'

interface Field {
  name: string
  label: string
  type?: 'text' | 'select' | 'checkbox'
  placeholder?: string
  options?: { label: string; value: any }[]
}

interface Props {
  isOpen: boolean
  title: string
  fields: Field[]
  submitLabel?: string
  onSubmit: (data: Record<string, any>) => void
  onClose?: () => void
}

const props = defineProps<Props>()
const emit = defineEmits<{
  (e: 'update:isOpen', value: boolean): void
}>()

const formData = reactive<Record<string, any>>({})

// Inicializa os campos
props.fields.forEach(f => {
  if (f.type === 'checkbox') formData[f.name] = false
  else formData[f.name] = ''
})

const submitLabel = props.submitLabel || 'Gravar'

const close = () => {
  emit('update:isOpen', false)
  props.onClose?.()
}

const handleSubmit = () => {
  props.onSubmit({ ...formData })
  close()
}
</script>
