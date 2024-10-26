<template>
    <div class="app">
      <TheHeader />
      <main class="container mx-auto px-4 py-8">
        <TopNavigation />
        <MainDescription />
        <SeasonalAnime />
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
          <AnimeUpdates />
          <AnimeSchedule />
          <RecentAnime />
        </div>
      </main>
    </div>
  </template>
  
  <script>
  import TheHeader from './components/TheHeader.vue'
  import TopNavigation from './components/TopNavigation.vue'
  import MainDescription from './components/MainDescription.vue'
  import SeasonalAnime from './components/SeasonalAnime.vue'
  import AnimeUpdates from './components/AnimeUpdates.vue'
  import AnimeSchedule from './components/AnimeSchedule.vue'
  import RecentAnime from './components/RecentAnime.vue'
  
  export default {
    name: 'App',
    components: {
      TheHeader,
      TopNavigation,
      MainDescription,
      SeasonalAnime,
      AnimeUpdates,
      AnimeSchedule,
      RecentAnime
    }
  }
  </script>
  
  <style>
  :root {
    --primary-color: #ff4757;
    --dark-bg: #2f3542;
  }
  
  body {
    background: #f1f2f6;
  }
  </style>