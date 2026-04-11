<template>
  <div class="min-h-screen bg-gray-50 px-6 py-10">
    <div class="max-w-2xl mx-auto bg-white border border-gray-200 rounded-2xl p-6">
      <h1 class="text-2xl font-bold text-gray-900 mb-1">Inscription Club</h1>
      <p class="text-sm text-gray-500 mb-6">Compte club avec vérification administrative.</p>

      <form class="space-y-3" @submit.prevent="submit">
        <input v-model="form.name" type="text" required placeholder="Nom du responsable" class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm" />
        <input v-model="form.email" type="email" required placeholder="Email officiel du club" class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm" />
        <input v-model="form.password" type="password" required placeholder="Mot de passe" class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm" />
        <input v-model="form.club_name" type="text" required placeholder="Nom du club" class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm" />
        <input v-model="form.country" type="text" required placeholder="Pays du club" class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm" />
        <input v-model="form.registration_number" type="text" required placeholder="Numéro d'enregistrement du club" class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm" />
        <input v-model="form.identity_document_type" type="text" required placeholder="Type de document légal" class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm" />
        <input v-model="form.identity_document_reference" type="text" required placeholder="Référence du document" class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm" />

        <button type="submit" class="w-full bg-blue-600 text-white rounded-lg py-2.5 text-sm font-semibold hover:bg-blue-700">
          Créer notre compte club
        </button>
      </form>
    </div>
  </div>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3'

const form = useForm({
  name: '',
  email: '',
  password: '',
  club_name: '',
  country: '',
  registration_number: '',
  identity_document_type: '',
  identity_document_reference: '',
})

function submit() {
  form.post('/inscription/club')
}
</script>
