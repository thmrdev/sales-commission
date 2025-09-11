<template>
  <div class="flex flex-col gap-y-5 overflow-y-auto border-r border-white/10 bg-gray-900 px-6 w-64 min-h-screen max-h-screen">
    <div class="flex h-16 items-center shrink-0">
      <img class="h-8 w-auto" src="https://tailwindcss.com/plus-assets/img/logos/mark.svg?color=indigo&shade=500" alt="Logo" />
    </div>

    <nav class="flex-1 flex flex-col">
      <ul role="list" class="flex flex-1 flex-col gap-y-7">
        <li v-for="item in navigation" :key="item.name">
          <router-link
            v-if="!item.children"
            :to="item.href"
            class="flex items-center gap-x-3 rounded-md p-2 text-sm font-semibold"
            :class="$route.path === item.href ? 'bg-white/5 text-white' : 'text-gray-400 hover:bg-white/5 hover:text-white'"
          >
            <component :is="item.icon" class="w-6 h-6" />
            {{ item.name }}
          </router-link>

          <Disclosure v-else as="div" v-slot="{ open }">
            <DisclosureButton
              class="flex w-full items-center gap-x-3 rounded-md p-2 text-left text-sm font-semibold"
              :class="open ? 'bg-white/5 text-white' : 'text-gray-400 hover:bg-white/5 hover:text-white'"
            >
              <component :is="item.icon" class="w-6 h-6" />
              {{ item.name }}
              <ChevronRightIcon :class="[open ? 'rotate-90' : '', 'ml-auto w-5 h-5 transition-transform duration-200']" />
            </DisclosureButton>

            <DisclosurePanel as="ul" class="mt-1 px-2">
              <li v-for="subItem in item.children" :key="subItem.name">
                <router-link
                  :to="subItem.href"
                  class="block py-2 pl-9 pr-2 rounded-md text-sm"
                  :class="$route.path === subItem.href ? 'bg-white/5 text-white' : 'text-gray-400 hover:bg-white/5 hover:text-white'"
                >
                  {{ subItem.name }}
                </router-link>
              </li>
            </DisclosurePanel>
          </Disclosure>
        </li>
      </ul>
    </nav>
  </div>
</template>

<script setup lang="ts">
import { Disclosure, DisclosureButton, DisclosurePanel } from '@headlessui/vue'
import { ChevronRightIcon } from '@heroicons/vue/20/solid'
import { HomeIcon, UsersIcon, DocumentDuplicateIcon, ChartPieIcon } from '@heroicons/vue/24/outline'

const navigation = [
  { name: 'Dashboard', href: '/', icon: HomeIcon },
  { name: 'Vendedores', href: '/sellers', icon: UsersIcon },
  { name: 'Vendas', href: '/sales', icon: DocumentDuplicateIcon },
  // {
  //   name: 'Relatórios', icon: ChartPieIcon, children: [
  //     { name: 'Fechamento diário', href: '/relatorios/diario' }
  //   ]
  // }
]
</script>
