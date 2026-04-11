<template>
  <div class="min-h-screen bg-input-background">
    <nav class="bg-white border-b border-border sticky top-0 z-10 px-6 py-4">
      <div class="max-w-7xl mx-auto flex items-center justify-between">
        <a href="/" class="flex items-center gap-2">
          <div class="w-9 h-9 bg-primary rounded-xl flex items-center justify-center">
            <span class="text-white font-bold">A</span>
          </div>
          <span class="font-bold text-xl text-foreground">AfricaScout</span>
        </a>
        <div class="flex items-center gap-3">
          <a href="/club/dashboard" class="flex items-center gap-2 px-4 py-2 hover:bg-muted rounded-lg text-sm text-foreground transition">
            Mon Dashboard
          </a>
          <a href="/messages" class="p-2 hover:bg-muted rounded-lg">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
          </a>
          <div class="w-8 h-8 rounded-full bg-primary flex items-center justify-center text-white text-xs font-bold">FC</div>
        </div>
      </div>
    </nav>

    <div class="max-w-7xl mx-auto px-6 py-8">
      <div class="mb-6">
        <h1 class="text-3xl font-bold text-foreground mb-1">Trouvez vos futurs joueurs</h1>
        <p class="text-muted-foreground">Explorez les talents africains disponibles pour votre club</p>
      </div>

      <!-- Actions rapides -->
      <div class="grid grid-cols-3 gap-4 mb-6">
        <button class="bg-primary text-white rounded-2xl p-4 text-left hover:bg-primary-dark transition">
          <div class="font-semibold mb-1">+ Publier une offre</div>
          <div class="text-xs text-white/80">Recrutement ciblé</div>
        </button>
        <a href="/club/dashboard" class="bg-white border border-border rounded-2xl p-4 text-left hover:bg-muted transition">
          <div class="font-semibold text-foreground mb-1">Mes joueurs</div>
          <div class="text-xs text-muted-foreground">Gérer l'effectif</div>
        </a>
        <a href="/messages" class="bg-white border border-border rounded-2xl p-4 text-left hover:bg-muted transition">
          <div class="font-semibold text-foreground mb-1">Messages</div>
          <div class="text-xs text-muted-foreground">3 non lus</div>
        </a>
      </div>

      <!-- Recherche -->
      <div class="bg-white rounded-2xl border border-border p-5 mb-6">
        <div class="flex gap-3">
          <div class="flex-1 relative">
            <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-muted-foreground" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            <input v-model="search" type="text" placeholder="Rechercher par nom, position, nationalité..." class="w-full pl-10 pr-4 py-3 bg-input-background rounded-xl border border-border text-sm focus:outline-none focus:border-primary" />
          </div>
          <select v-model="filterPoste" class="px-4 py-3 bg-input-background border border-border rounded-xl text-sm">
            <option value="">Tous postes</option>
            <option v-for="p in positions" :key="p">{{ p }}</option>
          </select>
          <select v-model="filterStatut" class="px-4 py-3 bg-input-background border border-border rounded-xl text-sm">
            <option value="">Tous statuts</option>
            <option>Libre</option>
            <option>Avec agent</option>
            <option>Sous contrat</option>
          </select>
        </div>
      </div>

      <div class="mb-4">
        <span class="font-semibold text-foreground">{{ filteredPlayers.length }} joueurs trouvés</span>
      </div>

      <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-5">
        <div v-for="player in filteredPlayers" :key="player.id" class="bg-white rounded-2xl border border-border overflow-hidden hover:shadow-md transition">
          <div class="relative h-44 bg-gradient-to-br from-primary/10 to-accent/10 flex items-center justify-center">
            <div class="w-20 h-20 rounded-full bg-white/60 flex items-center justify-center text-2xl font-bold text-foreground">
              {{ player.initials }}
            </div>
            <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/60 to-transparent p-3">
              <h3 class="text-white font-bold text-sm">{{ player.name }}</h3>
              <p class="text-white/80 text-xs">{{ player.nationality }} · {{ player.age }} ans</p>
            </div>
          </div>
          <div class="p-4">
            <div class="flex items-center justify-between mb-3">
              <span class="text-xs bg-accent/10 text-accent px-3 py-1 rounded-full font-medium">{{ player.position }}</span>
              <span :class="statusClass(player.status)" class="text-xs px-2 py-1 rounded-full font-medium">{{ player.status }}</span>
            </div>
            <div class="grid grid-cols-3 gap-2 mb-3 text-center">
              <div>
                <div class="font-bold text-primary text-sm">{{ player.stats.matchs }}</div>
                <div class="text-xs text-muted-foreground">Matchs</div>
              </div>
              <div>
                <div class="font-bold text-accent text-sm">{{ player.stats.buts }}</div>
                <div class="text-xs text-muted-foreground">Buts</div>
              </div>
              <div>
                <div class="font-bold text-primary text-sm">{{ player.stats.passes }}</div>
                <div class="text-xs text-muted-foreground">Passes</div>
              </div>
            </div>
            <div class="flex gap-2">
              <a :href="`/player/${player.id}`" class="flex-1 py-2 bg-muted text-foreground rounded-xl text-xs font-medium text-center hover:bg-muted/80 transition">
                Voir profil
              </a>
              <a href="/messages" class="px-3 py-2 bg-primary text-white rounded-xl hover:bg-primary-dark transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, computed } from 'vue'

const props = defineProps({ players: Array })
const search = ref('')
const filterPoste = ref('')
const filterStatut = ref('')
const positions = ['Gardien de but','Défenseur central','Milieu défensif','Milieu offensif','Ailier droit','Attaquant']

function statusClass(s) {
  return { 'Libre': 'bg-primary/10 text-primary', 'Sous contrat': 'bg-accent/10 text-accent', 'Avec agent': 'bg-blue-100 text-blue-600' }[s]
}

const filteredPlayers = computed(() => props.players.filter(p => {
  if (search.value && !p.name.toLowerCase().includes(search.value.toLowerCase())) return false
  if (filterPoste.value && p.position !== filterPoste.value) return false
  if (filterStatut.value && p.status !== filterStatut.value) return false
  return true
}))
</script>