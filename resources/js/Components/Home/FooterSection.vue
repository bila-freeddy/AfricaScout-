<template>
  <footer class="bg-gray-900 text-white py-16 px-6">
    <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-4 gap-8">
      <div>
        <div class="flex items-center gap-2 mb-4">
          <div class="w-8 h-8 bg-primary rounded-lg flex items-center justify-center">
            <span class="text-white font-bold text-sm">A</span>
          </div>
          <span class="font-bold text-white text-lg">AfricaScout</span>
        </div>
        <p class="text-gray-400 text-sm mb-4">La plateforme qui connecte les talents africains avec le football mondial.</p>
        <div class="flex gap-3">
          <a v-for="social in socials" :key="social.name" href="#" class="w-8 h-8 bg-gray-800 hover:bg-primary rounded-lg flex items-center justify-center transition-colors text-xs text-gray-400 hover:text-white">
            {{ social.icon }}
          </a>
        </div>
      </div>

      <div v-for="col in columns" :key="col.title">
        <h4 class="font-semibold mb-4 text-sm text-white">{{ col.title }}</h4>
        <ul class="space-y-2">
          <li v-for="link in col.links" :key="link.label">
            <a :href="link.href" class="text-gray-400 hover:text-white text-sm transition-colors">{{ link.label }}</a>
          </li>
        </ul>
      </div>
    </div>

    <div class="max-w-7xl mx-auto border-t border-gray-800 mt-12 pt-8 flex flex-col md:flex-row justify-between items-center gap-4">
      <p class="text-gray-500 text-sm">© 2026 AfricaScout. Tous droits réservés.</p>
      <div class="flex gap-6">
        <a href="#" class="text-gray-500 hover:text-white text-sm transition-colors">Conditions d'utilisation</a>
        <a href="#" class="text-gray-500 hover:text-white text-sm transition-colors">Confidentialité</a>
        <a href="#" class="text-gray-500 hover:text-white text-sm transition-colors">Contact</a>
      </div>
    </div>
  </footer>
</template>

<script setup>
const socials = [
  { name: 'Twitter', icon: 'X' },
  { name: 'Facebook', icon: 'f' },
  { name: 'Instagram', icon: 'in' },
  { name: 'LinkedIn', icon: 'li' },
]

const columns = [
  {
    title: 'Plateforme',
    links: [
      { label: 'Fonctionnalités', href: '#features' },
      { label: 'Joueurs', href: '#players' },
      { label: 'Tarifs', href: '#pricing' },
    ],
  },
  {
    title: "S'inscrire",
    links: [
      { label: 'Joueur', href: '/inscription/joueur' },
      { label: 'Recruteur', href: '/inscription/agent' },
      { label: 'Club', href: '/inscription/club' },
    ],
  },
  {
    title: 'Support',
    links: [
      { label: "Centre d'aide", href: '#' },
      { label: 'Contact', href: '#' },
      { label: 'Confidentialité', href: '#' },
    ],
  },
]
</script>