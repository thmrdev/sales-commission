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

  <div class="p-6">
    <h1 class="text-xl font-bold mb-4"></h1>
    <div v-if="isLoading" class="text-gray-500">Carregando...</div>
    <table v-else class="min-w-full bg-white shadow rounded-lg">
      <thead>
        <tr class="bg-gray-100 text-left">
          <th class="py-2 px-4">ID</th>
          <th class="py-2 px-4">Vendedor</th>
          <th class="py-2 px-4">Valor</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="sale in sales" :key="sale.id" class="border-b">
          <td class="py-2 px-4">{{ sale.id }}</td>
          <td class="py-2 px-4">{{ sale.seller.name }}</td>
          <td class="py-2 px-4">{{ formatCurrency(sale.amount) }}</td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script setup lang="ts">
import { ref, onMounted, computed } from 'vue'
import PageHeader from '../components/PageHeader.vue'
import DynamicFormModal from '../components/DynamicFormModal.vue'
import { useSalesStore } from "../stores/sales"
import { useSellersStore } from "../stores/sellers"
import { storeToRefs } from 'pinia'

const isModalOpen = ref(false)

const salesStore = useSalesStore()
const { sales, isLoading } = storeToRefs(salesStore)
const { loadSales, createSale } = salesStore

const sellersStore = useSellersStore()
const { sellers: sellersList, isLoading: sellersLoading } = storeToRefs(sellersStore)
const { loadSellers } = sellersStore

onMounted(async () => {
  await loadSellers()
  loadSales()
})

const sellerOptions = computed(() =>
  sellersList.value.map(s => ({ label: s.name, value: s.id }))
)

const modalFields = computed(() => [
  { name: 'seller_id', label: 'Vendedor', placeholder: 'Selecione o vendedor', type: 'select', options: sellerOptions.value },
  { name: 'amount', label: 'R$', placeholder: 'Informe o valor' }
])

const openModal = () => {
  isModalOpen.value = true
}

const handleSubmit = async (data: Record<string, any>) => {
  try {
    const payload = {
      seller_id: data.seller_id,
      amount: parseCurrency(data.amount),
      sale_date: new Date().toISOString().split('T')[0]
    }
    await salesStore.createSale(payload)
    isModalOpen.value = false
    loadSales()
  } catch (error) {
    console.error('Erro ao criar venda:', error)
  }
}

const formatCurrency = (value: number) => {
  return value.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' })
}

function parseCurrency(value: string): number {
  return Number(value.replace(/\./g, '').replace(',', '.'))
}
</script>

