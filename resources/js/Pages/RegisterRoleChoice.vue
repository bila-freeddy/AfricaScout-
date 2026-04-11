<template>
  <div class="min-h-screen bg-input-background flex flex-col items-center justify-center px-6 py-12">

    <!-- Logo -->
    <div class="flex items-center gap-2 mb-10">
      <div class="w-10 h-10 bg-primary rounded-xl flex items-center justify-center">
        <span class="text-white font-bold text-lg">A</span>
      </div>
      <span class="font-bold text-xl text-foreground">AfricaScout</span>
    </div>

    <div class="w-full max-w-3xl">
      <h1 class="text-3xl font-bold text-foreground text-center mb-2">Créer votre compte</h1>
      <p class="text-center text-muted-foreground mb-10">Sélectionnez votre profil pour accéder au formulaire adapté.</p>

      <div class="grid grid-cols-1 md:grid-cols-3 gap-5">

        <!-- Joueur -->
        <a href="/inscription/joueur" class="bg-white border-2 border-border rounded-2xl p-6 hover:border-primary transition group">
          <div class="w-12 h-12 bg-primary/10 rounded-xl flex items-center justify-center mb-4 group-hover:bg-primary/20 transition">
            <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
            </svg>
          </div>
          <h2 class="font-bold text-foreground mb-2">Je suis un joueur</h2>
          <p class="text-sm text-muted-foreground mb-4">Créez votre profil et soyez visible par des centaines de recruteurs.</p>
          <ul class="space-y-1">
            <li v-for="f in joueurFeats" :key="f" class="flex items-center gap-2 text-xs text-muted-foreground">
              <svg class="w-3 h-3 text-primary flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
              {{ f }}
            </li>
          </ul>
          <div class="mt-4 flex items-center gap-1 text-primary text-sm font-medium">
            Commencer <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
          </div>
        </a>

        <!-- Agent/Recruteur -->
        <a href="/inscription/agent" class="bg-white border-2 border-border rounded-2xl p-6 hover:border-accent transition group">
          <div class="w-12 h-12 bg-accent/10 rounded-xl flex items-center justify-center mb-4 group-hover:bg-accent/20 transition">
            <svg class="w-6 h-6 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
            </svg>
          </div>
          <h2 class="font-bold text-foreground mb-2">Je suis agent / recruteur</h2>
          <p class="text-sm text-muted-foreground mb-4">Accédez à la base de données de talents africains.</p>
          <ul class="space-y-1">
            <li v-for="f in agentFeats" :key="f" class="flex items-center gap-2 text-xs text-muted-foreground">
              <svg class="w-3 h-3 text-accent flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
              {{ f }}
            </li>
          </ul>
          <div class="mt-4 flex items-center gap-1 text-accent text-sm font-medium">
            Commencer <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
          </div>
        </a>

        <!-- Club -->
        <a href="/inscription/club" class="bg-white border-2 border-border rounded-2xl p-6 hover:border-blue-500 transition group">
          <div class="w-12 h-12 bg-blue-50 rounded-xl flex items-center justify-center mb-4 group-hover:bg-blue-100 transition">
            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
            </svg>
          </div>
          <h2 class="font-bold text-foreground mb-2">Nous sommes un club</h2>
          <p class="text-sm text-muted-foreground mb-4">Gérez vos recrutements et trouvez les meilleurs talents.</p>
          <ul class="space-y-1">
            <li v-for="f in clubFeats" :key="f" class="flex items-center gap-2 text-xs text-muted-foreground">
              <svg class="w-3 h-3 text-blue-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
              {{ f }}
            </li>
          </ul>
          <div class="mt-4 flex items-center gap-1 text-blue-600 text-sm font-medium">
            Commencer <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
          </div>
        </a>

      </div>

      <p class="text-center text-sm text-muted-foreground mt-8">
        Déjà un compte ?
        <a href="/login" class="text-primary font-medium hover:underline">Se connecter</a>
      </p>
    </div>
  </div>
</template>

<script setup>
const joueurFeats = ['Profil visible par 450+ recruteurs', 'Upload de vidéos', 'Messagerie directe']
const agentFeats = ['2500+ profils de joueurs', 'Filtres avancés', 'Shortlists personnalisées']
const clubFeats = ['Gestion de l\'effectif', 'Offres de recrutement', 'Suivi des transferts']
</script>