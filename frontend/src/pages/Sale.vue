<template>
  <PageHeader
    title="Vendas"
    subtitle="Listagem de vendas"
    :buttons="[
      { label: 'Novo', action: openModal, variant: 'primary' }
    ]"
  />

  <DynamicFormModal
    v-model:isOpen="isModalOpen"
    title="Nova venda"
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

const sellers = [
  { label: 'João Silva', value: 1 },
  { label: 'Maria Souza', value: 2 },
  { label: 'Carlos Pereira', value: 3 }
]

const modalFields = [
  { name: 'seller_id', label: 'Vendedor', placeholder: 'Selecione o vendedor', type: 'select', options: sellers },
  { name: 'amount', label: 'R$', placeholder: 'Informe o valor' }
]

const openModal = () => {
  isModalOpen.value = true
}

const handleSubmit = (data: Record<string, any>) => {
  console.log('Dados da venda:', data)
}
</script>
