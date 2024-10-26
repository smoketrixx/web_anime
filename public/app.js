import { createApp } from 'vue';
import AnimeList from './components/AnimeList.vue';

const app = createApp({});
app.component('anime-list', AnimeList);
app.mount('#app');
