<template>
    <header class="header text-white py-3">
      <div class="container mx-auto px-4">
        <nav class="flex items-center justify-between">
          <div class="flex items-center space-x-6">
            <h1 class="text-2xl font-bold">AnimeGO</h1>
            <div class="space-x-4">
              <a 
                v-for="item in menuItems" 
                :key="item.id"
                :href="item.link"
                class="hover:text-gray-300"
              >
                {{ item.text }}
              </a>
            </div>
          </div>
          <div class="flex items-center space-x-4">
            <button class="bg-blue-600 px-4 py-2 rounded" @click="loginWithVK">
              Войти через VK ID
            </button>
            <button class="bg-gray-700 px-4 py-2 rounded" @click="login">
              Войти
            </button>
          </div>
        </nav>
      </div>
    </header>
  </template>
  
  <script>
  export default {
    name: 'TheHeader',
    data() {
      return {
        menuItems: [
          { id: 1, text: 'Аниме', link: '#' },
          { id: 2, text: 'Манга', link: '#' },
          { id: 3, text: 'Персонажи', link: '#' },
          { id: 4, text: 'Случайное аниме', link: '#' }
        ]
      }
    },
    methods: {
      loginWithVK() {
        // Реализация входа через VK
        console.log('VK login')
      },
      login() {
        // Реализация обычного входа
        console.log('Regular login')
      }
    }
  }
  </script>
  
  <style scoped>
  .header {
    background: var(--dark-bg);
  }
  </style>