<template>
  <section class="pt-32 pb-20 px-6" style="background: linear-gradient(180deg, #f0fdf4 0%, #ffffff 100%);">
    <div class="max-w-4xl mx-auto text-center">

      <div class="inline-flex items-center gap-2 bg-primary/10 px-4 py-2 rounded-full mb-6">
        <svg class="w-4 h-4 text-primary" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
        <span class="text-sm font-medium text-primary">Plateforme N°1 de Scouting en Afrique</span>
      </div>

      <h1 class="text-5xl md:text-6xl font-bold mb-6 leading-tight">
        <span class="text-primary">Connectez les talents africains</span><br />
        <span class="text-secondary">au football mondial</span>
      </h1>

      <p class="text-gray-500 text-xl mb-10 max-w-2xl mx-auto">
        AfricaScout met en relation les joueurs africains avec des recruteurs, agents et clubs du monde entier. Votre carrière commence ici.
      </p>

      <div class="flex flex-col sm:flex-row items-center justify-center gap-4 mb-16">
        <a href="/inscription/joueur" class="group px-8 py-4 bg-primary text-white rounded-xl font-semibold text-lg hover:bg-primary-dark transition flex items-center gap-2">
          Je suis Joueur
          <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        </a>
        <a href="/inscription/agent" class="group px-8 py-4 bg-secondary text-white rounded-xl font-semibold text-lg hover:bg-secondary-dark transition flex items-center gap-2">
          Je recrute des talents
          <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        </a>
      </div>

      <div class="grid grid-cols-2 md:grid-cols-4 gap-6 max-w-3xl mx-auto">
        <div v-for="stat in stats" :key="stat.label" class="bg-white rounded-2xl p-4 shadow-sm border border-gray-100">
          <div class="text-3xl font-bold text-primary mb-1">{{ stat.value }}</div>
          <div class="text-sm text-gray-500">{{ stat.label }}</div>
        </div>
      </div>

    </div>
  </section>
</template>

<script setup>
const stats = [
  { value: '8 500+', label: 'Joueurs actifs' },
  { value: '850+', label: 'Recruteurs' },
  { value: '320+', label: 'Clubs partenaires' },
  { value: '1 200+', label: 'Transferts réussis' },
]
</script>