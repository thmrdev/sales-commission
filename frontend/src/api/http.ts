import axios from 'axios'
import { useAuthStore } from '../stores/auth'

const baseURL = import.meta.env.VITE_API_BASE_URL || 'http://localhost:8000/api/v1'

const http = axios.create({
  baseURL,
  withCredentials: true, 
})

http.interceptors.request.use((config) => {
  const auth = useAuthStore()
  if (auth.token) {
    config.headers.Authorization = `Bearer ${auth.token}`
  }
  return config
}, (error) => {
  return Promise.reject(error)
})

http.interceptors.response.use(
  (response) => response,
  (error) => {
    const auth = useAuthStore()
    if (error.response?.status === 401) {
      auth.logout()
      window.location.href = '/login'
    }
    return Promise.reject(error)
  }
)

export default http
