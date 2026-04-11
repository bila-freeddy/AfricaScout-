<template>
  <div class="min-h-screen bg-input-background">
    <nav class="bg-white border-b border-border px-6 py-4">
      <div class="max-w-7xl mx-auto flex items-center justify-between">
        <div class="flex items-center gap-2">
          <div class="w-9 h-9 bg-primary rounded-xl flex items-center justify-center">
            <span class="text-white font-bold">A</span>
          </div>
          <span class="font-bold text-xl text-foreground">AfricaScout</span>
          <span class="text-muted-foreground text-sm ml-2">Tableau de bord Club</span>
        </div>
        <div class="flex items-center gap-4">
          <a href="/messages" class="flex items-center gap-1 text-sm text-muted-foreground hover:text-foreground">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
            Messages
          </a>
          <div class="w-8 h-8 rounded-full bg-primary flex items-center justify-center text-white text-xs font-bold">FC</div>
        </div>
      </div>
    </nav>

    <!-- TABS -->
    <div class="bg-white border-b border-border px-6">
      <div class="max-w-7xl mx-auto flex">
        <button v-for="tab in tabs" :key="tab" @click="activeTab = tab"
          :class="activeTab === tab ? 'border-b-2 border-primary text-primary font-medium' : 'text-muted-foreground'"
          class="px-4 py-3 text-sm transition">
          {{ tab }}
        </button>
      </div>
    </div>

    <div class="max-w-7xl mx-auto px-6 py-8 flex gap-6">
      <!-- Sidebar filtres -->
      <div class="w-64 flex-shrink-0">
        <div class="bg-white rounded-2xl border border-border p-5">
          <div class="flex items-center gap-2 mb-4">
            <svg class="w-4 h-4 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/></svg>
            <span class="font-semibold text-foreground">Filtres</span>
          </div>
          <div class="space-y-4">
            <div>
              <label class="text-xs font-medium text-muted-foreground block mb-1">Poste</label>
              <select v-model="filters.poste" class="w-full border border-border rounded-xl px-3 py-2 text-sm bg-white">
                <option value="">Tous les postes</option>
                <option v-for="p in positions" :key="p">{{ p }}</option>
              </select>
            </div>
            <div>
              <label class="text-xs font-medium text-muted-foreground block mb-1">Nationalité</label>
              <select v-model="filters.nationalite" class="w-full border border-border rounded-xl px-3 py-2 text-sm bg-white">
                <option value="">Toutes nationalités</option>
                <option v-for="n in nationalities" :key="n">{{ n }}</option>
              </select>
            </div>
            <div>
              <label class="text-xs font-medium text-muted-foreground block mb-1">Statut</label>
              <select v-model="filters.statut" class="w-full border border-border rounded-xl px-3 py-2 text-sm bg-white">
                <option value="">Tous statuts</option>
                <option>Libre</option>
                <option>Sous contrat</option>
                <option>Avec agent</option>
              </select>
            </div>
            <button @click="filters = { poste: '', nationalite: '', statut: '' }" class="w-full border border-border text-muted-foreground py-2 rounded-xl text-sm hover:bg-muted transition">
              Réinitialiser
            </button>
          </div>
        </div>
      </div>

      <!-- Contenu principal -->
      <div class="flex-1">
        <div class="relative mb-4">
          <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-muted-foreground" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
          <input v-model="search" type="text" placeholder="Rechercher un joueur..." class="w-full pl-10 pr-4 py-3 bg-white border border-border rounded-xl text-sm focus:outline-none focus:border-primary" />
        </div>

        <div class="mb-4">
          <span class="font-semibold text-foreground">{{ filteredPlayers.length }} joueurs trouvés</span>
        </div>

        <div class="grid xl:grid-cols-2 gap-4">
          <div v-for="player in filteredPlayers" :key="player.id" class="bg-white rounded-2xl border border-border p-5 hover:border-primary/30 transition">
            <div class="flex items-start gap-3 mb-4">
              <div class="w-12 h-12 rounded-full bg-muted flex items-center justify-center text-sm font-bold text-muted-foreground flex-shrink-0">
                {{ player.initials }}
              </div>
              <div class="flex-1">
                <div class="flex items-center justify-between">
                  <h3 class="font-semibold text-foreground">{{ player.name }}</h3>
                  <button class="text-muted-foreground hover:text-yellow-400 transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/></svg>
                  </button>
                </div>
                <p class="text-sm text-muted-foreground mb-2">{{ player.position }}</p>
                <div class="flex flex-wrap gap-1">
                  <span class="text-xs bg-muted text-muted-foreground px-2 py-0.5 rounded-full">{{ player.nationality }}</span>
                  <span class="text-xs bg-muted text-muted-foreground px-2 py-0.5 rounded-full">{{ player.age }} ans</span>
                  <span class="text-xs bg-muted text-muted-foreground px-2 py-0.5 rounded-full">{{ player.foot }}</span>
                  <span :class="statusClass(player.status)" class="text-xs px-2 py-0.5 rounded-full font-medium">{{ player.status }}</span>
                </div>
              </div>
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
            <a :href="`/player/${player.id}`" class="block w-full text-center border border-border text-foreground py-2 rounded-xl text-sm hover:bg-muted transition">
              Voir le profil complet
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, computed } from 'vue'

const props = defineProps({ players: Array })
const tabs = ['Recherche', 'Mes Joueurs', 'Offres']
const activeTab = ref('Recherche')
const search = ref('')
const filters = ref({ poste: '', nationalite: '', statut: '' })
const positions = ['Gardien de but','Défenseur central','Milieu défensif','Milieu offensif','Ailier droit','Attaquant']
const nationalities = ['Mali','Ghana','Maroc','Nigeria','Sénégal',"Côte d'Ivoire"]

function statusClass(s) {
  return { 'Libre': 'bg-primary/10 text-primary', 'Sous contrat': 'bg-accent/10 text-accent', 'Avec agent': 'bg-blue-100 text-blue-600' }[s]
}

const filteredPlayers = computed(() => props.players.filter(p => {
  if (search.value && !p.name.toLowerCase().includes(search.value.toLowerCase())) return false
  if (filters.value.poste && p.position !== filters.value.poste) return false
  if (filters.value.nationalite && p.nationality !== filters.value.nationalite) return false
  if (filters.value.statut && p.status !== filters.value.statut) return false
  return true
}))
</script>