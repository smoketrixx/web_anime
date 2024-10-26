import { createStore } from 'vuex'

export default createStore({
  state: {
    user: null,
    currentSeason: 'Осень 2024',
    animeList: [],
    schedule: [],
    updates: []
  },
  mutations: {
    SET_USER(state, user) {
      state.user = user
    },
    SET_ANIME_LIST(state, list) {
      state.animeList = list
    },
    SET_SCHEDULE(state, schedule) {
      state.schedule = schedule
    },
    SET_UPDATES(state, updates) {
      state.updates = updates
    }
  },
  actions: {
    async fetchAnimeList({ commit }) {
      // Здесь будет API запрос
      const response = await fetch('/api/anime')
      const data = await response.json()
      commit('SET_ANIME_LIST', data)
    },
    async fetchSchedule({ commit }) {
      // Здесь будет API запрос
      const response = await fetch('/api/schedule')
      const data = await response.json()
      commit('SET_SCHEDULE', data)
    }
  },
  getters: {
    isAuthenticated: state => !!state.user,
    currentSeasonAnime: state => state.animeList.filter(anime => anime.season === state.currentSeason)
  }
})