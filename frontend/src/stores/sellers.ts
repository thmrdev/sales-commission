import { defineStore } from "pinia"
import { ref } from "vue"
import { fetchSellers, createSellerService, type Seller } from "../services/sellerService"

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

  async function createSeller(data: Partial<Seller>) {
    isLoading.value = true
    try {
      const newSeller = await createSellerService(data)
      sellers.value.push(newSeller)
    } finally {
      isLoading.value = false
    }
  }

  return { sellers, isLoading, loadSellers, createSeller }
})