<template>
  <div class="min-h-screen bg-input-background">
    <!-- NAVBAR -->
    <nav class="bg-white border-b border-border px-6 py-4">
      <div class="max-w-7xl mx-auto flex items-center justify-between">
        <div class="flex items-center gap-2">
          <div class="w-9 h-9 bg-primary rounded-xl flex items-center justify-center">
            <span class="text-white font-bold">A</span>
          </div>
          <span class="font-bold text-xl text-foreground">AfricaScout</span>
        </div>
        <div class="flex items-center gap-3">
          <a href="/player/1" class="text-sm text-muted-foreground hover:text-foreground">Voir mon profil</a>
          <div class="w-8 h-8 rounded-full bg-primary flex items-center justify-center text-white text-xs font-bold">AK</div>
        </div>
      </div>
    </nav>

    <div class="max-w-7xl mx-auto px-6 py-8">
      <!-- Bienvenue -->
      <div class="mb-8 flex items-center justify-between">
        <div>
          <h1 class="text-2xl font-bold text-foreground mb-1">Bonjour, Amadou 👋</h1>
          <p class="text-muted-foreground text-sm">Voici un aperçu de votre profil aujourd'hui</p>
        </div>
        <a href="/player/1" class="px-4 py-2 bg-primary text-white rounded-xl text-sm font-medium hover:bg-primary-dark transition">
          Voir mon profil public
        </a>
      </div>

      <!-- Stats cards -->
      <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
        <div v-for="stat in stats" :key="stat.label" class="bg-white rounded-2xl border border-border p-4">
          <div class="text-xs text-muted-foreground mb-1">{{ stat.label }}</div>
          <div :class="stat.color" class="text-2xl font-bold">{{ stat.value }}</div>
          <div class="text-xs text-muted-foreground mt-1">{{ stat.sub }}</div>
        </div>
      </div>

      <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Colonne principale -->
        <div class="lg:col-span-2 space-y-6">

          <!-- Complétion profil -->
          <div class="bg-white rounded-2xl border border-border p-6">
            <h2 class="font-semibold text-foreground mb-4">Complétion du profil</h2>
            <div class="flex items-center justify-between mb-2">
              <span class="text-sm text-muted-foreground">Profil complété à</span>
              <span class="text-sm font-bold text-primary">65%</span>
            </div>
            <div class="w-full bg-muted rounded-full h-2 mb-4">
              <div class="bg-primary h-2 rounded-full" style="width: 65%"></div>
            </div>
            <div class="space-y-2">
              <div v-for="item in checklist" :key="item.label" class="flex items-center gap-3 text-sm">
                <div :class="item.done ? 'bg-primary' : 'bg-muted'" class="w-5 h-5 rounded-full flex items-center justify-center flex-shrink-0">
                  <svg v-if="item.done" class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                </div>
                <span :class="item.done ? 'text-foreground' : 'text-muted-foreground'">{{ item.label }}</span>
              </div>
            </div>
          </div>

          <!-- Mes stats -->
          <div class="bg-white rounded-2xl border border-border p-6">
            <h2 class="font-semibold text-foreground mb-4">Statistiques de la saison</h2>
            <div class="grid grid-cols-5 gap-3">
              <div class="text-center p-3 bg-green-50 rounded-xl">
                <div class="text-xl font-bold text-primary">32</div>
                <div class="text-xs text-muted-foreground">Matchs</div>
              </div>
              <div class="text-center p-3 bg-orange-50 rounded-xl">
                <div class="text-xl font-bold text-accent">4</div>
                <div class="text-xs text-muted-foreground">Buts</div>
              </div>
              <div class="text-center p-3 bg-green-50 rounded-xl">
                <div class="text-xl font-bold text-primary">8</div>
                <div class="text-xs text-muted-foreground">Passes D.</div>
              </div>
              <div class="text-center p-3 bg-yellow-50 rounded-xl">
                <div class="text-xl font-bold text-yellow-500">6</div>
                <div class="text-xs text-muted-foreground">C. Jaunes</div>
              </div>
              <div class="text-center p-3 bg-red-50 rounded-xl">
                <div class="text-xl font-bold text-red-500">0</div>
                <div class="text-xs text-muted-foreground">C. Rouges</div>
              </div>
            </div>
          </div>

          <!-- Vidéos -->
          <div class="bg-white rounded-2xl border border-border p-6">
            <div class="flex items-center justify-between mb-4">
              <h2 class="font-semibold text-foreground">Mes vidéos (2/3)</h2>
              <button class="text-xs text-primary font-medium hover:underline">+ Ajouter</button>
            </div>
            <div class="space-y-3">
              <div v-for="v in videos" :key="v.title" class="flex items-center gap-3 p-3 bg-input-background rounded-xl">
                <div class="w-9 h-9 bg-primary/10 rounded-lg flex items-center justify-center flex-shrink-0">
                  <svg class="w-4 h-4 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/></svg>
                </div>
                <div class="flex-1">
                  <div class="text-sm font-medium text-foreground">{{ v.title }}</div>
                  <div class="text-xs text-muted-foreground">{{ v.views }} vues</div>
                </div>
                <button class="text-xs text-muted-foreground hover:text-red-500">Supprimer</button>
              </div>
            </div>
          </div>

        </div>

        <!-- Colonne droite -->
        <div class="space-y-4">

          <!-- Statut -->
          <div class="bg-white rounded-2xl border border-border p-5">
            <h3 class="font-semibold text-foreground mb-3">Mon statut</h3>
            <div class="space-y-2">
              <button v-for="s in statuts" :key="s.value"
                @click="statut = s.value"
                :class="statut === s.value ? s.activeClass : 'border-border text-muted-foreground'"
                class="w-full py-2.5 border-2 rounded-xl text-sm font-medium transition text-left px-4">
                {{ s.label }}
              </button>
            </div>
          </div>

          <!-- Recruteurs intéressés -->
          <div class="bg-white rounded-2xl border border-border p-5">
            <h3 class="font-semibold text-foreground mb-3">Recruteurs intéressés</h3>
            <div class="space-y-3">
              <div v-for="r in recruteurs" :key="r.name" class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-full bg-accent/10 flex items-center justify-center text-xs font-bold text-accent">
                  {{ r.initials }}
                </div>
                <div class="flex-1">
                  <div class="text-sm font-medium text-foreground">{{ r.name }}</div>
                  <div class="text-xs text-muted-foreground">{{ r.club }}</div>
                </div>
                <a href="/messages" class="text-xs text-primary font-medium hover:underline">Message</a>
              </div>
            </div>
          </div>

          <!-- Plan actuel -->
          <div class="bg-primary/5 border-2 border-primary rounded-2xl p-5">
            <h3 class="font-semibold text-foreground mb-1">Plan actuel : Gratuit</h3>
            <p class="text-xs text-muted-foreground mb-3">Passez au plan Pro pour plus de visibilité</p>
            <a href="/player/signup" class="block w-full text-center bg-primary text-white py-2.5 rounded-xl text-sm font-semibold hover:bg-primary-dark transition">
              Passer au Pro — 80$/mois
            </a>
          </div>

        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue'

const statut = ref('Libre')

const stats = [
  { label: 'Vues du profil', value: '1 247', color: 'text-primary', sub: 'Ce mois-ci' },
  { label: 'Recruteurs intéressés', value: '8', color: 'text-accent', sub: 'Cette semaine' },
  { label: 'Messages reçus', value: '3', color: 'text-primary', sub: 'Non lus' },
  { label: 'Shortlists', value: '12', color: 'text-accent', sub: 'Recruteurs' },
]

const checklist = [
  { label: 'Photo de profil ajoutée', done: false },
  { label: 'Informations personnelles complètes', done: true },
  { label: 'Au moins 1 vidéo uploadée', done: true },
  { label: 'Statistiques de la saison renseignées', done: true },
  { label: 'Documents uploadés (CV sportif)', done: false },
  { label: 'Profil vérifié', done: false },
]

const videos = [
  { title: 'Highlights Saison 2025/26', views: 342 },
  { title: 'Compétences défensives', views: 189 },
]

const statuts = [
  { value: 'Libre', label: '🟢 Libre — disponible immédiatement', activeClass: 'border-primary bg-primary/5 text-primary' },
  { value: 'Sous contrat', label: '🟠 Sous contrat', activeClass: 'border-accent bg-accent/5 text-accent' },
  { value: 'Avec agent', label: '🔵 Représenté par un agent', activeClass: 'border-blue-500 bg-blue-50 text-blue-600' },
]

const recruteurs = [
  { initials: 'JD', name: 'Jean Dupont', club: 'FC Lyon B' },
  { initials: 'MK', name: 'Mohamed Khalil', club: 'Agent FIFA' },
  { initials: 'PW', name: 'Peter Walsh', club: 'Brighton FC' },
]
</script>