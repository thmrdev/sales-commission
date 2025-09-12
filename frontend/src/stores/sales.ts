import { defineStore } from "pinia"
import { ref } from "vue"
import { fetchSales, createSaleService, type Sale } from "../services/saleService"

export const useSalesStore = defineStore("sales", () => {
  const sales = ref<Sale[]>([])
  const isLoading = ref(false)

  async function loadSales() {
    isLoading.value = true
    try {
      sales.value = await fetchSales()
    } finally {
      isLoading.value = false
    }
  }

  async function createSale(data: Partial<Sale>) {
      isLoading.value = true
      try {
        const newSale = await createSaleService(data)
        sales.value.push(newSale)
      } finally {
        isLoading.value = false
      }
    }

  return { sales, isLoading, loadSales, createSale }
})