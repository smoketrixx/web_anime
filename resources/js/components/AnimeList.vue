<template>
    <div>
        <header class="header text-white py-3">
            <div class="container mx-auto px-4">
                <nav class="flex items-center justify-between">
                    <div class="flex items-center space-x-6">
                        <h1 class="text-2xl font-bold">AnimeGO</h1>
                        <div class="space-x-4">
                            <a href="#" class="hover:text-gray-300">Аниме</a>
                            <a href="#" class="hover:text-gray-300">Манга</a>
                            <a href="#" class="hover:text-gray-300">Персонажи</a>
                            <a href="#" class="hover:text-gray-300">Случайное аниме</a>
                        </div>
                    </div>
                    <div class="flex items-center space-x-4">
                        <button class="bg-blue-600 px-4 py-2 rounded">Войти через VK ID</button>
                        <button class="bg-gray-700 px-4 py-2 rounded">Войти</button>
                    </div>
                </nav>
            </div>
        </header>

        <main class="container mx-auto px-4 py-8">
            <section class="mb-12">
                <h2 class="text-2xl font-bold mb-6">Аниме осеннего сезона</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6">
                    <div class="anime-card bg-white rounded-lg overflow-hidden shadow-lg" v-for="anime in animes" :key="anime.id">
                        <div class="relative">
                            <img :src="anime.poster" alt="Аниме постер" class="w-full h-auto">
                            <span class="rating">★ {{ anime.rating }}</span>
                        </div>
                        <div class="p-4">
                            <h3 class="title font-semibold">{{ anime.title }}</h3>
                        </div>
                    </div>
                </div>
            </section>
        </main>
    </div>
</template>

<script>
export default {
    data() {
        return {
            animes: []
        };
    },
    mounted() {
        fetch('YOUR_API_ENDPOINT')
            .then(response => response.json())
            .then(data => {
                this.animes = data;
            });
    }
};
</script>

<style scoped>
/* Ваши стили */
</style>
