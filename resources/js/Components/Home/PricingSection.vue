<template>
  <section id="pricing" class="py-20 px-6 bg-gray-50">
    <div class="max-w-7xl mx-auto">
      <h2 class="text-4xl font-bold text-center text-gray-900 mb-3">Tarifs transparents</h2>
      <p class="text-center text-gray-500 text-lg mb-12">Choisissez le plan adapté à vos besoins</p>

      <div class="grid grid-cols-1 md:grid-cols-3 gap-6 max-w-5xl mx-auto">
        <div v-for="plan in plans" :key="plan.name"
          :class="['bg-white rounded-2xl p-6 transition-all hover:shadow-lg', plan.featured ? 'border-2 border-secondary relative' : 'border border-gray-200']">
          <span v-if="plan.featured" class="absolute -top-3 left-1/2 -translate-x-1/2 bg-secondary text-white text-xs font-bold px-4 py-1 rounded-full">
            Le plus populaire
          </span>
          <h3 class="font-bold text-gray-900 mb-1">{{ plan.name }}</h3>
          <p class="text-gray-500 text-sm mb-4">{{ plan.desc }}</p>
          <div class="mb-6">
            <span class="text-4xl font-bold text-gray-900">{{ plan.price }}</span>
            <span class="text-gray-500 text-sm">/mois</span>
          </div>
          <ul class="space-y-3 mb-8">
            <li v-for="f in plan.features" :key="f" class="flex items-center gap-2 text-sm text-gray-700">
              <svg class="w-4 h-4 flex-shrink-0" :class="plan.featured ? 'text-secondary' : 'text-primary'" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
              {{ f }}
            </li>
          </ul>
          <a :href="plan.link"
            :class="['block w-full text-center py-2.5 rounded-xl text-sm font-semibold transition', plan.featured ? 'bg-secondary text-white hover:bg-secondary-dark' : 'border border-gray-300 text-gray-700 hover:bg-gray-50']">
            {{ plan.cta }}
          </a>
        </div>
      </div>
    </div>
  </section>
</template>

<script setup>
const plans = [
  {
    name: 'Starter',
    desc: 'Pour les joueurs en début de carrière',
    price: '25$',
    featured: false,
    link: '/inscription/joueur',
    cta: 'Choisir Starter',
    features: ['Profil joueur complet', 'Jusqu\'à 2 vidéos', 'Statistiques de base', 'Messagerie limitée'],
  },
  {
    name: 'Pro',
    desc: 'Pour les joueurs sérieux',
    price: '80$',
    featured: true,
    link: '/inscription/joueur',
    cta: 'Choisir Pro',
    features: ['Tout du plan Starter', 'Jusqu\'à 3 vidéos', 'Statistiques avancées', 'Messagerie illimitée', 'Profil mis en avant'],
  },
  {
    name: 'Elite',
    desc: 'Pour les professionnels et clubs',
    price: '250$',
    featured: false,
    link: '/inscription/club',
    cta: 'Choisir Elite',
    features: ['Tout du plan Pro', 'Vidéos illimitées', 'Analyses vidéo IA', 'Support prioritaire', 'Gestion multi-joueurs'],
  },
]
</script>