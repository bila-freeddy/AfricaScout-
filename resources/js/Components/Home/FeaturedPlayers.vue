<script setup>
const players = [
  { id: 1, name: 'Amadou Diallo',   position: 'Attaquant', country: 'Sénégal',       image: 'https://images.unsplash.com/photo-1695190348327-4392e091c54b?w=400', stats: { Buts: 24, Passes: 12 } },
  { id: 2, name: 'Kwame Mensah',    position: 'Milieu',    country: 'Ghana',          image: 'https://images.unsplash.com/photo-1510597026538-da2e86b8588a?w=400', stats: { Buts: 8,  Passes: 15 } },
  { id: 3, name: 'Ibrahim Traoré',  position: 'Défenseur', country: "Côte d'Ivoire", image: 'https://images.unsplash.com/photo-1579952363873-27f3bade9f55?w=400', stats: { Buts: 3,  Passes: 5  } },
  { id: 4, name: 'Mohamed El Fassi',position: 'Gardien',   country: 'Maroc',          image: 'https://images.unsplash.com/photo-1628779238951-3eaf4b5e0c56?w=400', stats: { Arrêts: 142, CSC: 18 } },
]
</script>

<template>
  <section id="players" class="py-20 px-6 bg-white">
    <div class="max-w-7xl mx-auto">
      <div class="text-center mb-12">
        <div class="inline-flex items-center gap-2 bg-accent/10 px-4 py-2 rounded-full mb-4">
          <svg class="w-4 h-4 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/></svg>
          <span class="text-sm font-medium text-accent">Joueurs Vedettes</span>
        </div>
        <h2 class="text-4xl font-bold text-gray-900 mb-3">Les Talents Qui Font Rêver</h2>
        <p class="text-gray-500 text-lg">Découvrez quelques-uns des joueurs exceptionnels sur AfricaScout</p>
      </div>

      <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-5">
        <div v-for="player in players" :key="player.id" class="group bg-white rounded-2xl border border-gray-100 overflow-hidden hover:shadow-xl transition-all cursor-pointer">
          <div class="relative h-56 overflow-hidden">
            <img :src="player.image" :alt="player.name" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" />
            <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-transparent"></div>
            <div class="absolute top-3 right-3 bg-accent text-white text-xs px-3 py-1 rounded-full font-medium">{{ player.position }}</div>
            <div class="absolute bottom-0 left-0 right-0 p-4">
              <h3 class="text-white font-bold">{{ player.name }}</h3>
              <p class="text-white/80 text-sm">{{ player.country }}</p>
            </div>
          </div>
          <div class="p-4 bg-gray-50">
            <div class="flex justify-around text-center">
              <div v-for="(value, key) in player.stats" :key="key">
                <div class="text-xl font-bold text-primary">{{ value }}</div>
                <div class="text-xs text-gray-400 capitalize">{{ key }}</div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="text-center mt-10">
        <a href="/inscription" class="inline-flex items-center gap-2 px-8 py-3 bg-primary text-white rounded-xl font-semibold hover:bg-primary-dark transition">
          Voir tous les joueurs
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        </a>
      </div>
    </div>
  </section>
</template>