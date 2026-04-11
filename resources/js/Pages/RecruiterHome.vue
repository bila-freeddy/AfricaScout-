<template>
  <div class="min-h-screen bg-input-background">
    <!-- NAVBAR -->
    <nav class="bg-white border-b border-border sticky top-0 z-10 px-6 py-4">
      <div class="max-w-7xl mx-auto flex items-center justify-between">
        <a href="/" class="flex items-center gap-2">
          <div class="w-9 h-9 bg-accent rounded-xl flex items-center justify-center">
            <span class="text-white font-bold">A</span>
          </div>
          <span class="font-bold text-xl text-foreground">AfricaScout</span>
        </a>
        <div class="flex items-center gap-3">
          <a href="/recruiter/dashboard" class="flex items-center gap-2 px-4 py-2 hover:bg-muted rounded-lg text-sm text-foreground transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
            Mon Dashboard
          </a>
          <button class="p-2 hover:bg-muted rounded-lg relative">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
            <span class="absolute top-1.5 right-1.5 w-2 h-2 bg-accent rounded-full"></span>
          </button>
          <a href="/messages" class="p-2 hover:bg-muted rounded-lg">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
          </a>
          <div class="w-8 h-8 rounded-full bg-accent flex items-center justify-center text-white text-xs font-bold">R</div>
        </div>
      </div>
    </nav>

    <div class="max-w-7xl mx-auto px-6 py-8">
      <!-- Titre -->
      <div class="mb-6">
        <h1 class="text-3xl font-bold text-foreground mb-1">Découvrez les talents africains</h1>
        <p class="text-muted-foreground">Explorez les profils de joueurs et trouvez votre prochain champion</p>
      </div>

      <!-- Recherche & Filtres -->
      <div class="bg-white rounded-2xl border border-border p-5 mb-6">
        <div class="flex gap-3">
          <div class="flex-1 relative">
            <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-muted-foreground" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            <input v-model="search" type="text" placeholder="Rechercher par nom, position, nationalité..." class="w-full pl-10 pr-4 py-3 bg-input-background rounded-xl border border-border text-sm focus:outline-none focus:border-accent" />
          </div>
          <button @click="showFilters = !showFilters" class="px-5 py-3 bg-accent text-white rounded-xl text-sm font-medium flex items-center gap-2 hover:bg-accent-dark transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/></svg>
            Filtres
          </button>
        </div>
        <div v-if="showFilters" class="grid grid-cols-2 md:grid-cols-4 gap-3 mt-4 pt-4 border-t border-border">
          <select v-model="filters.position" class="px-3 py-2 bg-input-background border border-border rounded-xl text-sm">
            <option value="">Tous postes</option>
            <option v-for="p in positions" :key="p">{{ p }}</option>
          </select>
          <select v-model="filters.age" class="px-3 py-2 bg-input-background border border-border rounded-xl text-sm">
            <option value="">Tous âges</option>
            <option value="18-21">18-21 ans</option>
            <option value="22-25">22-25 ans</option>
            <option value="26+">26+ ans</option>
          </select>
          <select v-model="filters.nationality" class="px-3 py-2 bg-input-background border border-border rounded-xl text-sm">
            <option value="">Toutes nationalités</option>
            <option v-for="n in nationalities" :key="n">{{ n }}</option>
          </select>
          <select v-model="filters.status" class="px-3 py-2 bg-input-background border border-border rounded-xl text-sm">
            <option value="">Tous statuts</option>
            <option>Libre</option>
            <option>Sous contrat</option>
            <option>Avec agent</option>
          </select>
        </div>
      </div>

      <!-- Stats -->
      <div class="grid grid-cols-3 gap-4 mb-6">
        <div class="bg-white rounded-xl border border-border p-4 flex items-center gap-3">
          <div class="w-10 h-10 bg-accent/10 rounded-xl flex items-center justify-center">
            <svg class="w-5 h-5 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
          </div>
          <div>
            <div class="text-2xl font-bold text-foreground">{{ filteredPlayers.length }}</div>
            <div class="text-xs text-muted-foreground">Joueurs disponibles</div>
          </div>
        </div>
        <div class="bg-white rounded-xl border border-border p-4 flex items-center gap-3">
          <div class="w-10 h-10 bg-primary/10 rounded-xl flex items-center justify-center">
            <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
          </div>
          <div>
            <div class="text-2xl font-bold text-foreground">{{ saved.length }}</div>
            <div class="text-xs text-muted-foreground">Joueurs sauvegardés</div>
          </div>
        </div>
        <div class="bg-white rounded-xl border border-border p-4 flex items-center gap-3">
          <div class="w-10 h-10 bg-accent/10 rounded-xl flex items-center justify-center">
            <svg class="w-5 h-5 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
          </div>
          <div>
            <div class="text-2xl font-bold text-foreground">143</div>
            <div class="text-xs text-muted-foreground">Profils consultés</div>
          </div>
        </div>
      </div>

      <!-- Grille joueurs -->
      <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-5">
        <div v-for="player in filteredPlayers" :key="player.id" class="bg-white rounded-2xl border border-border overflow-hidden hover:shadow-md transition">
          <!-- Avatar -->
          <div class="relative h-52 bg-gradient-to-br from-primary/20 to-accent/20 flex items-center justify-center">
            <div class="w-24 h-24 rounded-full bg-white/50 flex items-center justify-center text-3xl font-bold text-foreground">
              {{ player.initials }}
            </div>
            <button @click="toggleSave(player.id)"
              :class="saved.includes(player.id) ? 'bg-primary text-white' : 'bg-white/80 text-muted-foreground'"
              class="absolute top-3 right-3 p-2 rounded-xl transition">
              <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>
            </button>
            <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/60 to-transparent p-4">
              <h3 class="text-white font-bold">{{ player.name }}</h3>
              <p class="text-white/80 text-xs">{{ player.nationality }} · {{ player.age }} ans</p>
            </div>
          </div>
          <div class="p-4">
            <div class="flex items-center justify-between mb-3">
              <span class="text-xs bg-accent/10 text-accent px-3 py-1 rounded-full font-medium">{{ player.position }}</span>
              <span :class="statusClass(player.status)" class="text-xs px-2 py-1 rounded-full font-medium">{{ player.status }}</span>
            </div>
            <div class="grid grid-cols-3 gap-2 mb-4">
              <div class="text-center">
                <div class="font-bold text-primary">{{ player.stats.matchs }}</div>
                <div class="text-xs text-muted-foreground">Matchs</div>
              </div>
              <div class="text-center">
                <div class="font-bold text-accent">{{ player.stats.buts }}</div>
                <div class="text-xs text-muted-foreground">Buts</div>
              </div>
              <div class="text-center">
                <div class="font-bold text-primary">{{ player.stats.passes }}</div>
                <div class="text-xs text-muted-foreground">Passes</div>
              </div>
            </div>
            <div class="flex gap-2">
              <a :href="`/player/${player.id}`" class="flex-1 py-2 bg-muted text-foreground rounded-xl text-xs font-medium text-center hover:bg-muted/80 transition">
                Voir profil
              </a>
              <a href="/messages" class="px-3 py-2 bg-accent text-white rounded-xl hover:bg-accent-dark transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
              </a>
            </div>
          </div>
        </div>
      </div>

      <div class="text-center mt-8">
        <button class="px-6 py-3 bg-white border border-border rounded-xl text-sm text-foreground hover:bg-muted transition">
          Charger plus de joueurs
        </button>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, computed } from 'vue'

const props = defineProps({ players: Array })
const search = ref('')
const showFilters = ref(false)
const saved = ref([])
const filters = ref({ position: '', age: '', nationality: '', status: '' })

const positions = ['Gardien de but','Défenseur central','Latéral droit','Milieu défensif','Milieu offensif','Ailier droit','Attaquant']
const nationalities = ['Mali','Ghana','Maroc','Nigeria','Sénégal',"Côte d'Ivoire",'Cameroun','Tunisie']

function toggleSave(id) {
  saved.value.includes(id) ? saved.value = saved.value.filter(i => i !== id) : saved.value.push(id)
}

function statusClass(s) {
  return { 'Libre': 'bg-primary/10 text-primary', 'Sous contrat': 'bg-muted text-muted-foreground', 'Avec agent': 'bg-blue-100 text-blue-600' }[s]
}

const filteredPlayers = computed(() => props.players.filter(p => {
  if (search.value && !p.name.toLowerCase().includes(search.value.toLowerCase()) && !p.position.toLowerCase().includes(search.value.toLowerCase())) return false
  if (filters.value.position && p.position !== filters.value.position) return false
  if (filters.value.nationality && p.nationality !== filters.value.nationality) return false
  if (filters.value.status && p.status !== filters.value.status) return false
  return true
}))
</script>