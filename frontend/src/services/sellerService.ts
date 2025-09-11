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
