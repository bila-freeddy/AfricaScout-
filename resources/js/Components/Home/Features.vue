<template>
  <section id="features" class="py-20 px-6 bg-gray-50">
    <div class="max-w-7xl mx-auto">
      <div class="text-center mb-12">
        <h2 class="text-4xl font-bold text-gray-900 mb-3">Pourquoi choisir AfricaScout ?</h2>
        <p class="text-gray-500 text-lg">Les fonctionnalités qui font la différence</p>
      </div>

      <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
        <div v-for="feature in features" :key="feature.title"
          class="group bg-white rounded-2xl p-6 hover:shadow-lg transition-all border border-gray-100">
          <div class="w-12 h-12 rounded-xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform text-2xl"
            :style="`background: ${feature.color}15`">
            {{ feature.emoji }}
          </div>
          <h3 class="text-lg font-semibold text-gray-900 mb-2">{{ feature.title }}</h3>
          <p class="text-gray-500 text-sm">{{ feature.description }}</p>
        </div>
      </div>
    </div>
  </section>
</template>

<script setup>
const features = [
  { emoji: '🌍', title: 'Portée mondiale', description: 'Connectez-vous avec des clubs et recruteurs dans plus de 50 pays à travers le monde.', color: '#22c55e' },
  { emoji: '🔒', title: '100% Sécurisé', description: 'Vos données sont protégées avec les plus hauts standards de sécurité et chiffrement.', color: '#f97316' },
  { emoji: '⚡', title: 'Rapide & Efficace', description: 'Interface intuitive et réactive pour une expérience utilisateur optimale sur tous les appareils.', color: '#22c55e' },
  { emoji: '🔍', title: 'Recherche avancée', description: 'Filtres puissants pour trouver exactement le profil que vous cherchez en quelques secondes.', color: '#f97316' },
  { emoji: '💬', title: 'Messagerie intégrée', description: 'Communiquez directement et en toute sécurité avec les autres utilisateurs de la plateforme.', color: '#22c55e' },
  { emoji: '📊', title: 'Analytics & Stats', description: 'Suivez vos performances et votre visibilité avec des statistiques détaillées et en temps réel.', color: '#f97316' },
]
</script>