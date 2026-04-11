<template>
  <div class="min-h-screen bg-gray-50 font-sans">

    <!-- NAVBAR -->
    <nav class="bg-white border-b border-gray-100 px-6 py-4">
      <div class="max-w-7xl mx-auto flex items-center justify-between">
        <div class="flex items-center gap-2">
          <div class="w-8 h-8 bg-green-500 rounded-lg flex items-center justify-center">
            <span class="text-white font-bold text-sm">A</span>
          </div>
          <span class="font-bold text-gray-900">AfricaScout</span>
          <span class="text-gray-400 text-sm ml-2">Tableau de bord Recruteur</span>
        </div>
        <div class="flex items-center gap-4">
          <button class="flex items-center gap-1 text-sm text-gray-600">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
            Messages
          </button>
          <div class="w-8 h-8 rounded-full bg-green-500 flex items-center justify-center text-white text-xs font-bold">R</div>
        </div>
      </div>
    </nav>

    <!-- TABS -->
    <div class="bg-white border-b border-gray-100 px-6">
      <div class="max-w-7xl mx-auto flex gap-0">
        <button v-for="tab in tabs" :key="tab" @click="activeTab = tab"
          :class="activeTab === tab ? 'border-b-2 border-green-500 text-green-600 font-medium' : 'text-gray-500 hover:text-gray-700'"
          class="flex items-center gap-2 px-4 py-3 text-sm transition">
          {{ tab }}
        </button>
      </div>
    </div>

    <!-- CONTENU -->
    <div class="max-w-7xl mx-auto px-6 py-6 flex gap-6">

      <!-- SIDEBAR FILTRES -->
      <div class="w-64 flex-shrink-0">
        <div class="bg-white rounded-2xl border border-gray-200 p-5">
          <div class="flex items-center gap-2 mb-4">
            <svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/></svg>
            <span class="font-semibold text-gray-900">Filtres</span>
          </div>

          <div class="space-y-4">
            <div>
              <label class="text-xs font-medium text-gray-500 mb-1 block">Poste</label>
              <select v-model="filters.poste" class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm text-gray-700 bg-white">
                <option value="">Tous les postes</option>
                <option>Attaquant</option>
                <option>Milieu défensif</option>
                <option>Milieu offensif</option>
                <option>Ailier droit</option>
                <option>Défenseur central</option>
                <option>Gardien de but</option>
              </select>
            </div>
            <div>
              <label class="text-xs font-medium text-gray-500 mb-1 block">Nationalité</label>
              <select v-model="filters.nationalite" class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm text-gray-700 bg-white">
                <option value="">Toutes nationalités</option>
                <option>Mali</option>
                <option>Ghana</option>
                <option>Maroc</option>
                <option>Nigeria</option>
                <option>Sénégal</option>
                <option>Côte d'Ivoire</option>
              </select>
            </div>
            <div>
              <label class="text-xs font-medium text-gray-500 mb-1 block">Âge</label>
              <div class="flex items-center gap-2">
                <input v-model="filters.ageMin" type="number" min="16" max="40" class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm" placeholder="18" />
                <span class="text-gray-400">-</span>
                <input v-model="filters.ageMax" type="number" min="16" max="40" class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm" placeholder="35" />
              </div>
            </div>
            <div>
              <label class="text-xs font-medium text-gray-500 mb-1 block">Pied fort</label>
              <select v-model="filters.pied" class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm text-gray-700 bg-white">
                <option value="">Tous</option>
                <option>Droit</option>
                <option>Gauche</option>
                <option>Les deux</option>
              </select>
            </div>
            <div>
              <label class="text-xs font-medium text-gray-500 mb-1 block">Statut</label>
              <select v-model="filters.statut" class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm text-gray-700 bg-white">
                <option value="">Tous statuts</option>
                <option>Libre</option>
                <option>Sous contrat</option>
                <option>Avec agent</option>
              </select>
            </div>
            <button @click="resetFilters" class="w-full border border-gray-200 text-gray-600 py-2 rounded-lg text-sm hover:bg-gray-50 transition">
              Réinitialiser les filtres
            </button>
          </div>
        </div>
      </div>

      <!-- LISTE JOUEURS -->
      <div class="flex-1">
        <!-- Recherche -->
        <div class="relative mb-4">
          <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
          <input v-model="search" type="text" placeholder="Rechercher un joueur par nom ou poste..." class="w-full pl-10 pr-4 py-3 border border-gray-200 rounded-xl text-sm bg-white focus:outline-none focus:border-green-400" />
        </div>

        <!-- Résultats -->
        <div class="mb-4">
          <span class="font-semibold text-gray-900">{{ filteredPlayers.length }} joueurs trouvés</span>
          <span class="text-gray-400 text-sm ml-2">0 joueur dans votre shortlist</span>
        </div>

        <div class="grid grid-cols-1 xl:grid-cols-2 gap-4">
          <div v-for="player in filteredPlayers" :key="player.id"
            class="bg-white rounded-2xl border border-gray-200 p-5 hover:border-green-300 transition">
            <div class="flex items-start gap-3 mb-4">
              <div class="w-12 h-12 rounded-full bg-gray-200 flex items-center justify-center text-sm font-bold text-gray-500 flex-shrink-0">
                {{ player.initials }}
              </div>
              <div class="flex-1">
                <div class="flex items-center justify-between">
                  <h3 class="font-semibold text-gray-900">{{ player.name }}</h3>
                  <button class="text-gray-300 hover:text-yellow-400 transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/></svg>
                  </button>
                </div>
                <div class="text-sm text-gray-500 mb-2">{{ player.position }}</div>
                <div class="flex flex-wrap gap-1">
                  <span class="text-xs bg-gray-100 text-gray-600 px-2 py-0.5 rounded-full">{{ player.nationality }}</span>
                  <span class="text-xs bg-gray-100 text-gray-600 px-2 py-0.5 rounded-full">{{ player.age }} ans</span>
                  <span class="text-xs bg-gray-100 text-gray-600 px-2 py-0.5 rounded-full">{{ player.foot }}</span>
                  <span :class="statusBadge(player.status)" class="text-xs px-2 py-0.5 rounded-full font-medium">{{ player.status }}</span>
                </div>
              </div>
            </div>
            <div class="grid grid-cols-3 gap-2 mb-4">
              <div class="text-center">
                <div class="text-lg font-bold text-green-600">{{ player.stats.matchs }}</div>
                <div class="text-xs text-gray-400">Matchs</div>
              </div>
              <div class="text-center">
                <div class="text-lg font-bold text-orange-500">{{ player.stats.buts }}</div>
                <div class="text-xs text-gray-400">Buts</div>
              </div>
              <div class="text-center">
                <div class="text-lg font-bold text-green-600">{{ player.stats.passes }}</div>
                <div class="text-xs text-gray-400">Passes</div>
              </div>
            </div>
            <a :href="`/player/${player.id}`" class="block w-full text-center border border-gray-200 text-gray-700 py-2 rounded-lg text-sm hover:bg-gray-50 transition">
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
const filters = ref({ poste: '', nationalite: '', ageMin: '', ageMax: '', pied: '', statut: '' })

function resetFilters() {
  filters.value = { poste: '', nationalite: '', ageMin: '', ageMax: '', pied: '', statut: '' }
  search.value = ''
}

function statusBadge(status) {
  return {
    'Libre': 'bg-green-100 text-green-700',
    'Sous contrat': 'bg-orange-100 text-orange-700',
    'Avec agent': 'bg-blue-100 text-blue-700',
  }[status] || 'bg-gray-100 text-gray-600'
}

const filteredPlayers = computed(() => {
  return props.players.filter(p => {
    if (search.value && !p.name.toLowerCase().includes(search.value.toLowerCase()) && !p.position.toLowerCase().includes(search.value.toLowerCase())) return false
    if (filters.value.poste && p.position !== filters.value.poste) return false
    if (filters.value.nationalite && p.nationality !== filters.value.nationalite) return false
    if (filters.value.pied && p.foot !== filters.value.pied) return false
    if (filters.value.statut && p.status !== filters.value.statut) return false
    if (filters.value.ageMin && p.age < parseInt(filters.value.ageMin)) return false
    if (filters.value.ageMax && p.age > parseInt(filters.value.ageMax)) return false
    return true
  })
})
</script>