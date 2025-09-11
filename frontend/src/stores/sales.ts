import { defineStore } from "pinia"
import { ref } from "vue"
import { fetchSales, type Sale } from "../services/saleService"

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

  return { sales, isLoading, loadSales }
})