import { defineStore } from 'pinia'
import { ref } from 'vue'

interface User {
  id: number
  name: string
  email: string
  is_admin: boolean
  [key: string]: any
}

export const useAuthStore = defineStore('auth', () => {
  const user = ref<User | null>(JSON.parse(localStorage.getItem('user') || 'null'))
  const token = ref<string | null>(localStorage.getItem('access_token'))

  const isAuthenticated = () => !!token.value
  const isAdmin = () => user.value?.is_admin === true

  const login = (data: { user: User; access_token: string }) => {
    user.value = data.user
    token.value = data.access_token
    localStorage.setItem('user', JSON.stringify(data.user))
    localStorage.setItem('access_token', data.access_token)
  }

  const logout = () => {
    user.value = null
    token.value = null
    localStorage.removeItem('user')
    localStorage.removeItem('access_token')
  }

  return { user, token, isAuthenticated, isAdmin, login, logout }
})
