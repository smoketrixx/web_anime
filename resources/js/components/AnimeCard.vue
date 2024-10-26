<template>
    <div class="anime-card bg-white rounded-lg overflow-hidden shadow-lg">
      <div class="relative">
        <img :src="anime.image" :alt="anime.title" class="w-full h-auto">
        <span class="rating">★ {{ anime.rating }}</span>
      </div>
      <div class="p-4">
        <h3 class="title font-semibold">{{ anime.title }}</h3>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    name: 'AnimeCard',
    props: {
      anime: {
        type: Object,
        required: true
      }
    }
  }
  </script>
  
  <style scoped>
  .anime-card {
    transition: transform 0.2s;
  }
  
  .anime-card:hover {
    transform: translateY(-5px);
  }
  
  .rating {
    position: absolute;
    top: 10px;
    left: 10px;
    background: rgba(0, 0, 0, 0.7);
    color: #ffd700;
    padding: 2px 8px;
    border-radius: 4px;
  }
  
  .title {
    color: var(--primary-color);
  }
  </style>