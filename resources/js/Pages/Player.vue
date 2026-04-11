<template>
  <div class="min-h-screen bg-gray-50 font-sans">

    <!-- NAVBAR -->
    <nav class="bg-white border-b border-gray-100 px-6 py-4">
      <div class="max-w-7xl mx-auto flex items-center justify-between">
        <div class="flex items-center gap-2">
          <div class="w-8 h-8 bg-green-500 rounded-lg flex items-center justify-center">
            <span class="text-white font-bold text-sm">A</span>
          </div>
          <span class="font-bold text-gray-900 text-lg">AfricaScout</span>
        </div>
        <div class="flex items-center gap-4">
          <button class="relative">
            <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
            </svg>
          </button>
          <div class="w-8 h-8 rounded-full bg-green-500 flex items-center justify-center text-white text-xs font-bold">U</div>
        </div>
      </div>
    </nav>

    <!-- BACK -->
    <div class="max-w-7xl mx-auto px-6 py-4">
      <a href="/" class="flex items-center gap-1 text-sm text-gray-500 hover:text-gray-900">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
        </svg>
        Retour à l'accueil
      </a>
    </div>

    <!-- HERO JOUEUR -->
    <div class="bg-gradient-to-r from-green-50 to-white border-b border-gray-100 px-6 py-8">
      <div class="max-w-7xl mx-auto flex items-start gap-6">
        <div class="w-24 h-24 rounded-full bg-gray-200 flex items-center justify-center text-2xl font-bold text-gray-500 flex-shrink-0">
          {{ player.initials }}
        </div>
        <div class="flex-1">
          <div class="flex items-center gap-3 mb-2">
            <h1 class="text-2xl font-bold text-gray-900">{{ player.name }}</h1>
            <span :class="statusClass" class="text-xs font-semibold px-3 py-1 rounded-full">{{ player.status }}</span>
          </div>
          <div class="flex items-center gap-4 text-sm text-gray-500 mb-3">
            <span class="flex items-center gap-1">
              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/></svg>
              {{ player.nationality }}
            </span>
            <span class="flex items-center gap-1">
              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
              {{ player.age }} ans
            </span>
            <span class="flex items-center gap-1">
              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
              {{ player.position }}
            </span>
          </div>
          <div v-if="player.available" class="flex items-center gap-2 text-green-600 text-sm font-medium">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
            Disponible immédiatement
          </div>
        </div>
      </div>
    </div>

    <!-- CONTENU -->
    <div class="max-w-7xl mx-auto px-6 py-8 grid grid-cols-1 lg:grid-cols-3 gap-6">

      <!-- COLONNE GAUCHE -->
      <div class="lg:col-span-2 space-y-6">

        <!-- Infos personnelles -->
        <div class="bg-white rounded-2xl border border-gray-200 p-6">
          <h2 class="font-semibold text-gray-900 mb-4">Informations personnelles</h2>
          <div class="grid grid-cols-2 gap-y-4">
            <div>
              <div class="text-xs text-gray-400 mb-1">Taille</div>
              <div class="font-semibold text-gray-900">{{ player.height }} cm</div>
            </div>
            <div>
              <div class="text-xs text-gray-400 mb-1">Poids</div>
              <div class="font-semibold text-gray-900">{{ player.weight }} kg</div>
            </div>
            <div>
              <div class="text-xs text-gray-400 mb-1">Pied fort</div>
              <div class="font-semibold text-gray-900">{{ player.foot }}</div>
            </div>
            <div>
              <div class="text-xs text-gray-400 mb-1">Position</div>
              <div class="font-semibold text-gray-900">{{ player.position }}</div>
            </div>
          </div>
        </div>

        <!-- Vidéos -->
        <div class="bg-white rounded-2xl border border-gray-200 p-6">
          <div class="flex items-center gap-2 mb-1">
            <svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.069A1 1 0 0121 8.882v6.236a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
            <h2 class="font-semibold text-gray-900">Vidéos ({{ player.videos.length }}/3)</h2>
          </div>
          <p class="text-xs text-green-500 mb-4">Highlights et performances</p>
          <div class="space-y-3">
            <div v-for="video in player.videos" :key="video.title" class="flex items-center gap-3 p-3 bg-gray-50 rounded-xl">
              <div class="w-9 h-9 bg-green-100 rounded-lg flex items-center justify-center flex-shrink-0">
                <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
              </div>
              <div class="flex-1">
                <div class="text-sm font-medium text-gray-900">{{ video.title }}</div>
                <a :href="video.desc" target="_blank" class="text-xs text-green-600 hover:underline">Voir la vidéo</a>
              </div>
              <a :href="video.desc" target="_blank" class="text-sm text-gray-500 hover:text-gray-900 font-medium">Ouvrir</a>
            </div>
          </div>
          <form v-if="currentUser?.role === 'club'" class="mt-4 grid grid-cols-1 md:grid-cols-3 gap-2" @submit.prevent="uploadVideo">
            <input v-model="videoForm.title" type="text" required placeholder="Titre de la vidéo" class="border border-gray-200 rounded-lg px-3 py-2 text-sm" />
            <input v-model="videoForm.video_url" type="url" required placeholder="https://..." class="border border-gray-200 rounded-lg px-3 py-2 text-sm" />
            <button type="submit" class="bg-green-600 text-white rounded-lg px-3 py-2 text-sm font-semibold hover:bg-green-700">
              Ajouter (Club)
            </button>
          </form>
        </div>

        <!-- Stats -->
        <div class="bg-white rounded-2xl border border-gray-200 p-6">
          <div class="flex items-center gap-2 mb-4">
            <svg class="w-4 h-4 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
            <h2 class="font-semibold text-gray-900">Statistiques de la saison</h2>
          </div>
          <div class="grid grid-cols-5 gap-3">
            <div class="text-center p-3 bg-green-50 rounded-xl">
              <div class="text-2xl font-bold text-green-600">{{ player.stats.matchs }}</div>
              <div class="text-xs text-gray-500 mt-1">Matchs</div>
            </div>
            <div class="text-center p-3 bg-orange-50 rounded-xl">
              <div class="text-2xl font-bold text-orange-500">{{ player.stats.buts }}</div>
              <div class="text-xs text-gray-500 mt-1">Buts</div>
            </div>
            <div class="text-center p-3 bg-green-50 rounded-xl">
              <div class="text-2xl font-bold text-green-600">{{ player.stats.passes }}</div>
              <div class="text-xs text-gray-500 mt-1">Passes D.</div>
            </div>
            <div class="text-center p-3 bg-yellow-50 rounded-xl">
              <div class="text-2xl font-bold text-yellow-500">{{ player.stats.jaunes }}</div>
              <div class="text-xs text-gray-500 mt-1">C. Jaunes</div>
            </div>
            <div class="text-center p-3 bg-red-50 rounded-xl">
              <div class="text-2xl font-bold text-red-500">{{ player.stats.rouges }}</div>
              <div class="text-xs text-gray-500 mt-1">C. Rouges</div>
            </div>
          </div>
        </div>

        <!-- Documents -->
        <div class="bg-white rounded-2xl border border-gray-200 p-6">
          <div class="flex items-center gap-2 mb-4">
            <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
            <h2 class="font-semibold text-gray-900">Documents</h2>
          </div>
          <div class="space-y-3">
            <div v-for="doc in documents" :key="doc.name" class="flex items-center gap-3 p-3 bg-gray-50 rounded-xl">
              <div class="w-9 h-9 bg-green-100 rounded-lg flex items-center justify-center flex-shrink-0">
                <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
              </div>
              <div class="flex-1">
                <div class="text-sm font-medium text-gray-900">{{ doc.name }}</div>
                <div class="text-xs text-gray-400">{{ doc.type }}</div>
              </div>
              <button class="text-sm text-gray-500 hover:text-gray-900 font-medium">Télécharger</button>
            </div>
          </div>
        </div>

      </div>

      <!-- COLONNE DROITE -->
      <div class="space-y-4">

        <!-- Statut joueur -->
        <div class="bg-green-50 rounded-2xl border border-green-200 p-5">
          <div class="flex items-center gap-2 mb-2">
            <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
            <span class="font-semibold text-green-800">Joueur {{ player.status }}</span>
          </div>
          <p class="text-sm text-green-700 mb-4">Ce joueur est actuellement libre de tout engagement et disponible immédiatement pour signature avec un club.</p>
          <button
            class="w-full py-2.5 rounded-xl text-sm font-semibold transition flex items-center justify-center gap-2"
            :class="requestState.disabled ? 'bg-gray-300 text-gray-700 cursor-not-allowed' : 'bg-green-500 text-white hover:bg-green-600'"
            :disabled="requestState.disabled || contactForm.processing"
            @click="sendContactRequest"
          >
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
            {{ requestState.label }}
          </button>
          <a href="/contact-requests" class="mt-3 block text-center text-sm text-green-700 hover:underline">
            Voir toutes les demandes de contact
          </a>
        </div>

        <!-- Actions rapides -->
        <div class="bg-white rounded-2xl border border-gray-200 p-5">
          <h3 class="font-semibold text-gray-900 mb-3">Actions rapides</h3>
          <div class="space-y-2">
            <button class="w-full flex items-center gap-3 p-3 hover:bg-gray-50 rounded-xl text-sm text-gray-700 transition">
              <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/></svg>
              Ajouter à ma shortlist
            </button>
            <button class="w-full flex items-center gap-3 p-3 hover:bg-gray-50 rounded-xl text-sm text-gray-700 transition">
              <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
              Demander un contact
            </button>
            <button class="w-full flex items-center gap-3 p-3 hover:bg-gray-50 rounded-xl text-sm text-gray-700 transition">
              <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
              Télécharger le profil
            </button>
          </div>
        </div>

        <!-- Profils similaires -->
        <div class="bg-white rounded-2xl border border-gray-200 p-5">
          <h3 class="font-semibold text-gray-900 mb-3">Profils similaires</h3>
          <div class="space-y-3">
            <div v-for="p in similarPlayers" :key="p.id" class="flex items-center gap-3">
              <div class="w-9 h-9 rounded-full bg-gray-200 flex items-center justify-center text-xs font-bold text-gray-500 flex-shrink-0">
                {{ p.initials }}
              </div>
              <div class="flex-1">
                <div class="text-sm font-medium text-gray-900">{{ p.name }}</div>
                <div class="text-xs text-gray-400">{{ p.position }}</div>
              </div>
              <a :href="`/player/${p.id}`" class="text-xs text-green-600 hover:underline">Voir</a>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
</template>

<script setup>
import { computed } from 'vue'
import { useForm } from '@inertiajs/vue3'

const props = defineProps({
  player: Object,
  contactRequest: Object,
  currentUser: Object,
})

const statusClass = {
  'Libre': 'bg-green-100 text-green-700',
  'Sous contrat': 'bg-orange-100 text-orange-700',
  'Avec agent': 'bg-blue-100 text-blue-700',
}[props.player.status] || 'bg-gray-100 text-gray-700'

const documents = [
  { name: 'CV Sportif', type: 'PDF' },
  { name: 'Certificat médical', type: 'PDF' },
]

const similarPlayers = [
  { id: 2, initials: 'KM', name: 'Kwame Mensah', position: 'Attaquant' },
  { id: 3, initials: 'YB', name: 'Youssef Benali', position: 'Gardien de but' },
  { id: 4, initials: 'EO', name: 'Emmanuel Okafor', position: 'Défenseur central' },
]

const contactForm = useForm({
  player_id: props.player.id,
  message_initial: 'Bonjour, je souhaite entrer en contact concernant ce joueur.',
})

const videoForm = useForm({
  title: '',
  video_url: '',
})

const requestState = computed(() => {
  const status = props.contactRequest?.status
  if (status === 'en_attente') return { label: 'Demande en attente', disabled: true }
  if (status === 'acceptee') return { label: 'Demande acceptée', disabled: true }
  if (status === 'refusee') return { label: 'Demande refusée', disabled: false }
  return { label: 'Contacter le joueur', disabled: false }
})

function sendContactRequest() {
  if (requestState.value.disabled || contactForm.processing) return
  contactForm.post('/contact-requests', { preserveScroll: true })
}

function uploadVideo() {
  if (props.currentUser?.role !== 'club') return
  videoForm.post(`/players/${props.player.id}/videos`, {
    preserveScroll: true,
    onSuccess: () => videoForm.reset(),
  })
}
</script>