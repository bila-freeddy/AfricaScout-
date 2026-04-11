<template>
  <section class="py-20 px-6 bg-gray-50">
    <div class="max-w-7xl mx-auto">
      <h2 class="text-4xl font-bold text-center text-gray-900 mb-3">Une plateforme pour tous</h2>
      <p class="text-center text-gray-500 text-lg mb-12">Que vous soyez joueur, recruteur ou club, AfricaScout est fait pour vous</p>

      <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div v-for="type in types" :key="type.title"
          class="group bg-white rounded-2xl p-8 border-2 border-transparent hover:border-primary transition-all hover:shadow-xl relative overflow-hidden">
          <div class="absolute top-0 right-0 w-32 h-32 rounded-full -mr-16 -mt-16 group-hover:scale-150 transition-transform duration-500"
            :style="`background: ${type.color}15`"></div>
          <div class="relative">
            <div class="w-14 h-14 rounded-2xl flex items-center justify-center mb-5 group-hover:scale-110 transition-transform"
              :style="`background: ${type.color}20`">
              <span class="text-2xl">{{ type.emoji }}</span>
            </div>
            <h3 class="text-2xl font-bold text-gray-900 mb-2">{{ type.title }}</h3>
            <p class="text-gray-500 mb-5">{{ type.desc }}</p>
            <ul class="space-y-2 mb-6">
              <li v-for="f in type.features" :key="f" class="flex items-start gap-2 text-sm text-gray-700">
                <svg class="w-4 h-4 mt-0.5 flex-shrink-0" :style="`color: ${type.color}`" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                {{ f }}
              </li>
            </ul>
            <a :href="type.link" class="inline-flex items-center gap-2 font-semibold text-sm transition-all" :style="`color: ${type.color}`">
              {{ type.cta }}
              <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script setup>
const types = [
  {
    emoji: '⚽',
    title: 'Joueurs',
    desc: 'Créez votre profil professionnel et soyez découvert par des recruteurs du monde entier.',
    color: '#22c55e',
    link: '/inscription/joueur',
    cta: 'Créer mon profil',
    features: ['Profil complet avec vidéos et stats', 'Visibilité auprès de 850+ recruteurs', 'Messages directs avec les clubs', 'Suivi de votre progression'],
  },
  {
    emoji: '🔍',
    title: 'Recruteurs & Agents',
    desc: 'Trouvez les meilleurs talents africains avec nos outils de recherche avancés.',
    color: '#f97316',
    link: '/inscription/agent',
    cta: 'Commencer à recruter',
    features: ['Accès à 8 500+ profils de joueurs', 'Filtres avancés et recommandations', 'Messagerie sécurisée', 'Statistiques détaillées'],
  },
  {
    emoji: '🏟️',
    title: 'Clubs',
    desc: 'Gérez vos effectifs et publiez vos offres de recrutement en toute simplicité.',
    color: '#22c55e',
    link: '/inscription/club',
    cta: 'Inscrire mon club',
    features: ['Gestion complète de vos joueurs', "Publication d'offres de recrutement", 'Dashboard analytique', 'Visibilité internationale'],
  },
]
</script>