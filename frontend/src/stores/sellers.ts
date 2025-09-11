import { defineStore } from "pinia"
import { ref } from "vue"
import { fetchSellers, type Seller } from "../services/sellerService"

export const useSellersStore = defineStore("sellers", () => {
  const sellers = ref<Seller[]>([])
  const isLoading = ref(false)

  async function loadSellers() {
    isLoading.value = true
    try {
      sellers.value = await fetchSellers()
    } finally {
      isLoading.value = false
    }
  }

  return { sellers, isLoading, loadSellers }
})