<template>
    <section class="mb-12">
      <h2 class="text-2xl font-bold mb-6">Аниме осеннего сезона</h2>
      <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6">
        <AnimeCard 
          v-for="anime in seasonalAnime"
          :key="anime.id"
          :anime="anime"
        />
      </div>
    </section>
  </template>
  
  <script>
  import AnimeCard from './AnimeCard.vue'
  
  export default {
    name: 'SeasonalAnime',
    components: {
      AnimeCard
    },
    data() {
      return {
        seasonalAnime: [
          {
            id: 1,
            title: 'Данданан',
            rating: 9.5,
            image: '/api/placeholder/200/300'
          },
          {
            id: 2,
            title: 'Блич: Тысячелетняя война',
            rating: 9.4,
            image: '/api/placeholder/200/300'
          },
          // Добавьте больше аниме здесь
        ]
      }
    }
  }
  </script>