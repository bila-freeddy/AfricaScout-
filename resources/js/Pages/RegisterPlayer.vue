<template>
  <div class="min-h-screen bg-input-background flex">

    <!-- Gauche -->
    <div class="hidden lg:flex lg:w-1/2 bg-primary flex-col justify-between p-12">
      <a href="/" class="flex items-center gap-2">
        <div class="w-10 h-10 bg-white/20 rounded-xl flex items-center justify-center">
          <span class="text-white font-bold text-lg">A</span>
        </div>
        <span class="text-white font-bold text-xl">AfricaScout</span>
      </a>
      <div>
        <h2 class="text-4xl font-bold text-white mb-4">Lancez votre carrière internationale</h2>
        <p class="text-white/80 text-lg mb-8">Rejoignez des milliers de joueurs africains visibles par des recruteurs du monde entier.</p>
        <div class="space-y-3">
          <div v-for="item in benefits" :key="item" class="flex items-center gap-3">
            <div class="w-6 h-6 bg-white/20 rounded-full flex items-center justify-center flex-shrink-0">
              <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
            </div>
            <span class="text-white/90 text-sm">{{ item }}</span>
          </div>
        </div>
      </div>
      <p class="text-white/50 text-sm">© 2026 AfricaScout</p>
    </div>

    <!-- Droite -->
    <div class="w-full lg:w-1/2 flex items-center justify-center p-8">
      <div class="w-full max-w-md">

        <div class="text-center mb-8">
          <h1 class="text-2xl font-bold text-foreground mb-2">Inscription Joueur</h1>
          <p class="text-muted-foreground text-sm">Créez votre profil gratuitement</p>
        </div>

        <!-- Erreurs globales -->
        <div v-if="Object.keys(form.errors).length" class="bg-red-50 border border-red-200 rounded-xl p-4 mb-4">
          <p v-for="(error, key) in form.errors" :key="key" class="text-red-700 text-sm">{{ error }}</p>
        </div>

        <form class="space-y-4" @submit.prevent="submit">
          <div>
            <label class="text-sm font-medium text-foreground block mb-1">Nom complet</label>
            <input v-model="form.name" type="text" required placeholder="Amadou Konaté"
              class="w-full px-4 py-3 bg-white border border-border rounded-xl text-sm focus:outline-none focus:border-primary transition"
              :class="form.errors.name ? 'border-red-400' : ''" />
            <p v-if="form.errors.name" class="text-red-500 text-xs mt-1">{{ form.errors.name }}</p>
          </div>

          <div>
            <label class="text-sm font-medium text-foreground block mb-1">Email</label>
            <input v-model="form.email" type="email" required placeholder="amadou@email.com"
              class="w-full px-4 py-3 bg-white border border-border rounded-xl text-sm focus:outline-none focus:border-primary transition"
              :class="form.errors.email ? 'border-red-400' : ''" />
            <p v-if="form.errors.email" class="text-red-500 text-xs mt-1">{{ form.errors.email }}</p>
          </div>

          <div>
            <label class="text-sm font-medium text-foreground block mb-1">Mot de passe</label>
            <input v-model="form.password" type="password" required placeholder="••••••••"
              class="w-full px-4 py-3 bg-white border border-border rounded-xl text-sm focus:outline-none focus:border-primary transition"
              :class="form.errors.password ? 'border-red-400' : ''" />
            <p v-if="form.errors.password" class="text-red-500 text-xs mt-1">{{ form.errors.password }}</p>
          </div>

          <div class="bg-amber-50 border border-amber-200 rounded-xl p-4">
            <p class="text-amber-800 text-xs font-medium mb-3">
              Pour garantir la crédibilité de la plateforme, nous vérifions que vous êtes bien un joueur libre.
            </p>
            <div class="space-y-3">
              <div>
                <label class="text-sm font-medium text-foreground block mb-1">Type de preuve</label>
                <select v-model="form.free_agent_proof_type" required
                  class="w-full px-4 py-3 bg-white border border-border rounded-xl text-sm focus:outline-none focus:border-primary">
                  <option value="">Sélectionner...</option>
                  <option value="attestation_club">Attestation de fin de contrat</option>
                  <option value="lettre_liberation">Lettre de libération</option>
                  <option value="document_federation">Document fédération</option>
                  <option value="autre">Autre document officiel</option>
                </select>
                <p v-if="form.errors.free_agent_proof_type" class="text-red-500 text-xs mt-1">{{ form.errors.free_agent_proof_type }}</p>
              </div>
              <div>
                <label class="text-sm font-medium text-foreground block mb-1">Référence du document</label>
                <input v-model="form.free_agent_proof_reference" type="text" required placeholder="Ex: ATT-2025-0042"
                  class="w-full px-4 py-3 bg-white border border-border rounded-xl text-sm focus:outline-none focus:border-primary" />
                <p v-if="form.errors.free_agent_proof_reference" class="text-red-500 text-xs mt-1">{{ form.errors.free_agent_proof_reference }}</p>
              </div>
            </div>
          </div>

          <button type="submit" :disabled="form.processing"
            class="w-full py-3 bg-primary text-white rounded-xl text-sm font-semibold hover:bg-primary-dark transition disabled:opacity-60">
            {{ form.processing ? 'Création en cours...' : 'Créer mon compte joueur' }}
          </button>
        </form>

        <p class="text-center text-sm text-muted-foreground mt-6">
          Déjà un compte ?
          <a href="/login" class="text-primary font-medium hover:underline">Se connecter</a>
        </p>
        <p class="text-center text-sm text-muted-foreground mt-2">
          <a href="/inscription" class="text-muted-foreground hover:underline">← Changer de profil</a>
        </p>
      </div>
    </div>
  </div>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3'

const form = useForm({
  name: '',
  email: '',
  password: '',
  free_agent_proof_type: '',
  free_agent_proof_reference: '',
})

const benefits = [
  'Profil visible par 450+ recruteurs actifs',
  'Upload de vidéos de vos performances',
  'Messagerie directe avec les clubs',
  'Statistiques de consultation de votre profil',
]

function submit() {
  form.post('/inscription/joueur')
}
</script>