<template>
    <div class="mb-8">
      <nav class="space-x-4 text-gray-600">
        <a 
          v-for="item in navItems" 
          :key="item.id"
          :href="item.link"
          class="hover:text-gray-900"
        >
          {{ item.text }}
        </a>
      </nav>
    </div>
  </template>
  
  <script>
  export default {
    name: 'TopNavigation',
    data() {
      return {
        navItems: [
          { id: 1, text: 'Онгоинги', link: '#' },
          { id: 2, text: '2024 год', link: '#' },
          { id: 3, text: '2023 год', link: '#' }
        ]
      }
    }
  }
  </script>