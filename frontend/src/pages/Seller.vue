<template>
  <PageHeader
    title="Vendedor"
    subtitle="Listagem de vendedores"
    :buttons="[
      { label: 'Novo', action: openModal, variant: 'primary' }
    ]"
  />

  <DynamicFormModal
    v-model:isOpen="isModalOpen"
    title="Novo Vendedor"
    :fields="modalFields"
    submitLabel="Salvar"
    :onSubmit="handleSubmit"
  />
</template>

<script setup lang="ts">
import { ref } from 'vue'
import PageHeader from '../components/PageHeader.vue'
import DynamicFormModal from '../components/DynamicFormModal.vue'

const isModalOpen = ref(false)

const modalFields = [
  { name: 'name', label: 'Nome', placeholder: 'Digite o nome' },
  { name: 'email', label: 'Email', placeholder: 'Digite o email' }
]

const openModal = () => {
  isModalOpen.value = true
}

const handleSubmit = (data: Record<string, any>) => {
  console.log('Dados do vendedor:', data)
}
</script>
