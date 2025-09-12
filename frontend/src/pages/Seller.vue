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

  <div class="p-6">
    <h1 class="text-xl font-bold mb-4"></h1>
    <div v-if="isLoading" class="text-gray-500">Carregando...</div>
    <table v-else class="min-w-full bg-white shadow rounded-lg">
      <thead>
        <tr class="bg-gray-100 text-left">
          <th class="py-2 px-4">ID</th>
          <th class="py-2 px-4">Nome</th>
          <th class="py-2 px-4">E-mail</th>
          <th class="py-2 px-4">Ações</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="seller in sellers" :key="seller.id" class="border-b">
          <td class="py-2 px-4">{{ seller.id }}</td>
          <td class="py-2 px-4">{{ seller.name }}</td>
          <td class="py-2 px-4">{{ seller.email }}</td>
          <td class="py-2 px-4 w-32">
            <div class="flex justify-center">
              <button
                @click="handleResend(seller.id)"
                :disabled="isResending === seller.id"
                class="truncate bg-blue-500 text-white text-sm px-2 py-1 rounded hover:bg-blue-600 disabled:opacity-50"
                style="max-width: 100%;"
              >
                {{ isResending === seller.id ? 'Enviando...' : 'Reenviar' }}
              </button>
            </div>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script setup lang="ts">
import { ref, onMounted, watch } from 'vue'
import PageHeader from '../components/PageHeader.vue'
import DynamicFormModal from '../components/DynamicFormModal.vue'
import { useSellersStore } from "../stores/sellers"
import { storeToRefs } from 'pinia'
import http from '../api/http'

const isResending = ref<number | null>(null)

const isModalOpen = ref(false)
const formData = ref({ name: '', email: '' })

const sellersStore = useSellersStore()
const { sellers, isLoading } = storeToRefs(sellersStore)
const { loadSellers } = sellersStore

onMounted(() => {
  loadSellers()
})

const modalFields = [
  { name: 'name', label: 'Nome', placeholder: 'Digite o nome' },
  { name: 'email', label: 'Email', placeholder: 'Digite o email' }
]

watch(isModalOpen, (newVal) => {
  if (newVal) {
    formData.value = { name: '', email: '' }
  }
})

const openModal = () => {
  isModalOpen.value = true
}

const handleSubmit = async (data: Record<string, any>) => {
  try {
    await sellersStore.createSeller(data)
    isModalOpen.value = false
    loadSellers()
  } catch (error) {
    console.error('Erro ao criar vendedor:', error)
  }
}

const handleResend = async (sellerId: number) => {
  try {
    isResending.value = sellerId
    // Chamada para seu endpoint
    http.post(`/daily-seller-report`, { seller_id: sellerId})
    // Pode exibir um toast de sucesso aqui
    console.log(`Email reenviado para seller ${sellerId}`)
  } catch (error) {
    console.error('Erro ao reenviar email:', error)
  } finally {
    isResending.value = null
  }
}
</script>
