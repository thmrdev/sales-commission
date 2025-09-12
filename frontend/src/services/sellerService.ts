import http from "../api/http"

export interface Seller {
  id: number
  name: string
  email: string
}

export async function fetchSellers(): Promise<Seller[]> {
  const { data } = await http.get<Seller[]>("/sellers")
  return data
}

export async function createSellerService(payload: Partial<Seller>): Promise<Seller> {
  const { data } = await http.post('/sellers', payload)
  return data
}
