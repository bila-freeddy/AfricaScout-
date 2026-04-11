<template>
  <section id="testimonials" class="py-20 px-6 bg-white">
    <div class="max-w-7xl mx-auto">
      <div class="text-center mb-12">
        <div class="inline-flex items-center gap-2 bg-primary/10 px-4 py-2 rounded-full mb-4">
          <svg class="w-4 h-4 text-primary" fill="currentColor" viewBox="0 0 24 24"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>
          <span class="text-sm font-medium text-primary">Témoignages</span>
        </div>
        <h2 class="text-4xl font-bold text-gray-900 mb-3">Ce qu'ils disent de nous</h2>
        <p class="text-gray-500 text-lg">Des milliers d'utilisateurs nous font confiance</p>
      </div>

      <div class="grid md:grid-cols-3 gap-6">
        <div v-for="t in testimonials" :key="t.name"
          class="bg-gray-50 rounded-2xl p-8 border border-gray-100 hover:shadow-lg transition-all">
          <div class="flex items-center gap-1 mb-4">
            <svg v-for="i in 5" :key="i" class="w-5 h-5 text-secondary" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
          </div>
          <p class="text-gray-600 mb-6 italic text-sm leading-relaxed">"{{ t.content }}"</p>
          <div class="flex items-center gap-3">
            <div class="w-12 h-12 rounded-full bg-primary/20 flex items-center justify-center font-bold text-primary text-sm">
              {{ t.initials }}
            </div>
            <div>
              <div class="font-semibold text-gray-900 text-sm">{{ t.name }}</div>
              <div class="text-xs text-gray-500">{{ t.role }}</div>
            </div>
          </div>
        </div>
      </div>

      <!-- Partenaires -->
      <div class="mt-16 text-center">
        <p class="text-xs text-gray-400 uppercase tracking-wider mb-6">Ils nous font confiance</p>
        <div class="flex flex-wrap justify-center items-center gap-8">
          <span v-for="p in partners" :key="p" class="text-gray-400 font-semibold hover:text-gray-700 transition-colors cursor-pointer">{{ p }}</span>
        </div>
      </div>
    </div>
  </section>
</template>

<script setup>
const testimonials = [
  {
    initials: 'PD',
    name: 'Pierre Dubois',
    role: 'Recruteur — FC Lyon',
    content: "AfricaScout m'a permis de découvrir des talents exceptionnels. En 6 mois, j'ai recruté 3 joueurs qui font maintenant partie de notre équipe première.",
  },
  {
    initials: 'YK',
    name: 'Youssef Kante',
    role: 'Joueur Professionnel',
    content: "Grâce à AfricaScout, j'ai été contacté par plusieurs clubs européens. Aujourd'hui je joue en Ligue 2 française. Un rêve devenu réalité !",
  },
  {
    initials: 'AC',
    name: 'AC Casablanca',
    role: 'Club Professionnel',
    content: "Une plateforme indispensable pour gérer nos effectifs et trouver de nouveaux talents. L'interface est intuitive et les outils sont puissants.",
  },
]

const partners = ['FC Barcelone', 'Real Madrid', 'Manchester United', 'Paris SG', 'Bayern Munich', 'AC Milan']
</script>