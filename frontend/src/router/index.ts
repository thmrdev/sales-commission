import { createRouter, createWebHistory } from 'vue-router'
import { useAuthStore } from '../stores/auth'

// Layouts
import AuthLayout from '../layouts/AuthLayout.vue'
import DefaultLayout from '../layouts/DefaultLayout.vue'

// Pages
import Login from '../pages/Login.vue'
import Dashboard from '../pages/Dashboard.vue'
import Seller from '../pages/Seller.vue'
import Sale from '../pages/Sale.vue'

const routes = [
  {
    path: '/login',
    component: AuthLayout,
    children: [{ path: '', component: Login }],
  },
  {
    path: '/',
    component: DefaultLayout,
    meta: { requiresAuth: true },
    children: [
      { path: '', component: Dashboard },
      { path: 'sellers', component: Seller },
      { path: 'sales', component: Sale },
      { path: ':pathMatch(.*)*', redirect: '/' },
    ],
  },
  { path: '/:pathMatch(.*)*', redirect: '/login' },
]

const router = createRouter({
  history: createWebHistory(),
  routes,
})

router.beforeEach((to, from, next) => {
  const auth = useAuthStore()

  if (to.meta.requiresAuth && !auth.isAuthenticated()) {
    next('/login')
  } else if (to.path === '/login' && auth.isAuthenticated()) {
    next('/')
  } else {
    next()
  }
})

export default router
