<template>
  <PageHeader
    title="Dashboard"
    subtitle="Todos os indicadores mostram dados do dia anterior (D-1)"
  />

  <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mb-6 mt-6">
    <IndicadoresCard
      title="Total de vendedores"
      :value="totalSeller"
      subtitle="Dados do dia anterior (D-1)"
    />
    <IndicadoresCard
      title="Total de vendas (R$)"
      :value="totalSales"
      subtitle="Dados do dia anterior (D-1)"
    />
    <IndicadoresCard
      title="Total de comissões (R$)"
      :value="totalCommission"
      subtitle="Dados do dia anterior (D-1)"
    />
  </div>
</template>

<script setup lang="ts">
import PageHeader from '../components/PageHeader.vue'
import IndicadoresCard from '../components/DashboardIndicator.vue'
import { ref, computed } from 'vue'

const sales = ref([
  { seller: 'João', amount: 1200, commission: 120 },
  { seller: 'Maria', amount: 800, commission: 80 },
  { seller: 'Carlos', amount: 1500, commission: 150 }
])

const totalSales = computed(() => sales.value.length)
const totalAmount = computed(() => sales.value.reduce((sum, s) => sum + s.amount, 0))
const totalCommission = computed(() => sales.value.reduce((sum, s) => sum + s.commission, 0))

const currency = (val: number) => `R$ ${val.toLocaleString('pt-BR', { minimumFractionDigits: 2 })}`
</script>
