<template>
  <div class="min-h-screen bg-gray-50">
    <div class="max-w-5xl mx-auto px-6 py-8">
      <h1 class="text-2xl font-bold text-gray-900 mb-6">Demandes de contact</h1>

      <div class="space-y-3">
        <div
          v-for="request in requests"
          :key="request.id"
          class="bg-white border border-gray-200 rounded-xl p-4"
        >
          <div class="flex items-center justify-between gap-3">
            <div>
              <p class="font-semibold text-gray-900">
                {{ request.player?.name || 'Joueur supprimé' }}
              </p>
              <p class="text-sm text-gray-500">
                De {{ request.requester?.name }} vers {{ request.recipient?.name }}
              </p>
              <p v-if="request.message_initial" class="text-sm text-gray-700 mt-2">
                "{{ request.message_initial }}"
              </p>
            </div>

            <div class="flex items-center gap-2">
              <span class="text-xs px-2 py-1 rounded-full font-semibold" :class="statusClass(request.status)">
                {{ labelStatus(request.status) }}
              </span>

              <template v-if="request.is_recipient && request.status === 'en_attente'">
                <button
                  class="text-xs bg-green-600 text-white px-3 py-1.5 rounded-lg"
                  @click="setStatus(request.id, 'acceptee')"
                >
                  Accepter
                </button>
                <button
                  class="text-xs bg-red-600 text-white px-3 py-1.5 rounded-lg"
                  @click="setStatus(request.id, 'refusee')"
                >
                  Refuser
                </button>
              </template>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { router } from '@inertiajs/vue3'

defineProps({
  currentUserId: Number,
  requests: Array,
})

function setStatus(id, status) {
  router.patch(`/contact-requests/${id}/status`, { status }, { preserveScroll: true })
}

function labelStatus(status) {
  return {
    en_attente: 'En attente',
    acceptee: 'Acceptée',
    refusee: 'Refusée',
    annulee: 'Annulée',
  }[status] || status
}

function statusClass(status) {
  return {
    en_attente: 'bg-yellow-100 text-yellow-700',
    acceptee: 'bg-green-100 text-green-700',
    refusee: 'bg-red-100 text-red-700',
    annulee: 'bg-gray-100 text-gray-700',
  }[status] || 'bg-gray-100 text-gray-700'
}
</script>
