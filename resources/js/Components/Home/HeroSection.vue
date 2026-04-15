<script setup>
const stats = [
  { value: '8 500+', label: 'Joueurs actifs' },
  { value: '850+', label: 'Recruteurs' },
  { value: '320+', label: 'Clubs partenaires' },
  { value: '1 200+', label: 'Transferts réussis' },
]
</script>

<template>
  <section class="relative min-h-screen flex items-center justify-center overflow-hidden">
    <div class="absolute inset-0">
      <img src="https://images.unsplash.com/photo-1759156207348-0010a9fc013c?w=1920" alt="Stadium" class="w-full h-full object-cover" />
      <div class="absolute inset-0 bg-gradient-to-br from-primary/95 via-primary/85 to-accent/90" />
      <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-transparent to-transparent" />
    </div>

    <div class="absolute top-20 left-10 w-32 h-32 bg-accent/20 rounded-full blur-3xl animate-pulse pointer-events-none" />
    <div class="absolute bottom-20 right-10 w-40 h-40 bg-white/10 rounded-full blur-3xl animate-pulse delay-500 pointer-events-none" />

    <div class="relative z-10 container mx-auto px-4 py-32 text-center text-white">
      <div class="inline-flex items-center gap-2 px-4 py-2 bg-white/10 backdrop-blur-sm rounded-full mb-6">
        <svg class="w-4 h-4 text-accent fill-current" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
        <span class="text-sm font-medium">Plateforme N°1 de Scouting en Afrique</span>
      </div>

      <h1 class="text-5xl md:text-7xl font-bold mb-6 leading-tight">
        Votre Carrière de <span class="text-transparent bg-clip-text bg-gradient-to-r from-accent to-yellow-400">Footballeur</span> Commence Ici
      </h1>

      <p class="text-xl text-white/90 mb-8 max-w-2xl mx-auto">
        AfricaScout connecte les talents africains avec les plus grands clubs et recruteurs du monde entier.
      </p>

      <div class="flex flex-col sm:flex-row gap-4 justify-center mb-12">
        <a href="/player/signup" class="group px-8 py-4 bg-white text-primary rounded-xl font-semibold text-lg hover:shadow-2xl hover:scale-105 transition-all flex items-center justify-center gap-2">
          Je suis Joueur
          <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
        </a>
        <a href="/recruiter/signup" class="group px-8 py-4 bg-accent text-white rounded-xl font-semibold text-lg hover:shadow-2xl hover:scale-105 transition-all flex items-center justify-center gap-2">
          Je recrute des talents
          <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
        </a>
      </div>

      <div class="grid grid-cols-2 md:grid-cols-4 gap-6 max-w-3xl mx-auto">
        <div v-for="stat in stats" :key="stat.label" class="bg-white/10 backdrop-blur-sm rounded-xl p-4 hover:bg-white/20 transition-all">
          <div class="text-3xl font-bold text-accent mb-1">{{ stat.value }}</div>
          <div class="text-sm text-white/80">{{ stat.label }}</div>
        </div>
      </div>
    </div>

    <div class="absolute bottom-8 left-1/2 -translate-x-1/2 animate-bounce z-10">
      <div class="w-6 h-10 border-2 border-white/50 rounded-full flex items-start justify-center p-2">
        <div class="w-1.5 h-3 bg-white/50 rounded-full" />
      </div>
    </div>
  </section>
</template>