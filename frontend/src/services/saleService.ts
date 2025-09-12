import http from "../api/http"

export interface Seller {
  id: number
  name: string
  email: string
}

export interface Sale {
  id: number
  seller: Seller
  amount: number
  sale_date: string
}

export async function fetchSales(): Promise<Sale[]> {
  const { data } = await http.get<Sale[]>("/sales")
  return data
}

export async function createSaleService(payload: Partial<Sale>): Promise<Sale> {
  const { data } = await http.post('/sales', payload)
  return data
}
