<template>
  <div class="min-h-screen bg-input-background flex">

    <!-- Gauche -->
    <div class="hidden lg:flex lg:w-1/2 bg-accent flex-col justify-between p-12">
      <a href="/" class="flex items-center gap-2">
        <div class="w-10 h-10 bg-white/20 rounded-xl flex items-center justify-center">
          <span class="text-white font-bold text-lg">A</span>
        </div>
        <span class="text-white font-bold text-xl">AfricaScout</span>
      </a>
      <div>
        <h2 class="text-4xl font-bold text-white mb-4">Découvrez les futurs champions africains</h2>
        <p class="text-white/80 text-lg mb-8">Accédez à la plus grande base de données de talents footballistiques africains.</p>
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
          <h1 class="text-2xl font-bold text-foreground mb-2">Inscription Agent / Recruteur</h1>
          <p class="text-muted-foreground text-sm">Compte professionnel avec vérification d'identité</p>
        </div>

        <div v-if="Object.keys(form.errors).length" class="bg-red-50 border border-red-200 rounded-xl p-4 mb-4">
          <p v-for="(error, key) in form.errors" :key="key" class="text-red-700 text-sm">{{ error }}</p>
        </div>

        <form class="space-y-4" @submit.prevent="submit">
          <div>
            <label class="text-sm font-medium text-foreground block mb-1">Nom complet</label>
            <input v-model="form.name" type="text" required placeholder="Jean Dupont"
              class="w-full px-4 py-3 bg-white border border-border rounded-xl text-sm focus:outline-none focus:border-accent transition" />
            <p v-if="form.errors.name" class="text-red-500 text-xs mt-1">{{ form.errors.name }}</p>
          </div>

          <div>
            <label class="text-sm font-medium text-foreground block mb-1">Email professionnel</label>
            <input v-model="form.email" type="email" required placeholder="jean@agence.com"
              class="w-full px-4 py-3 bg-white border border-border rounded-xl text-sm focus:outline-none focus:border-accent transition" />
            <p v-if="form.errors.email" class="text-red-500 text-xs mt-1">{{ form.errors.email }}</p>
          </div>

          <div>
            <label class="text-sm font-medium text-foreground block mb-1">Mot de passe</label>
            <input v-model="form.password" type="password" required placeholder="••••••••"
              class="w-full px-4 py-3 bg-white border border-border rounded-xl text-sm focus:outline-none focus:border-accent transition" />
            <p v-if="form.errors.password" class="text-red-500 text-xs mt-1">{{ form.errors.password }}</p>
          </div>

          <div>
            <label class="text-sm font-medium text-foreground block mb-1">Organisation / Agence <span class="text-muted-foreground font-normal">(optionnel)</span></label>
            <input v-model="form.organization_name" type="text" placeholder="Sport Agency Africa"
              class="w-full px-4 py-3 bg-white border border-border rounded-xl text-sm focus:outline-none focus:border-accent transition" />
          </div>

          <div class="bg-amber-50 border border-amber-200 rounded-xl p-4 space-y-3">
            <p class="text-amber-800 text-xs font-medium">Vérification professionnelle requise</p>
            <div>
              <label class="text-sm font-medium text-foreground block mb-1">Numéro de licence FIFA / nationale</label>
              <input v-model="form.license_number" type="text" required placeholder="FIFA-2025-XXXXX"
                class="w-full px-4 py-3 bg-white border border-border rounded-xl text-sm focus:outline-none focus:border-accent" />
              <p v-if="form.errors.license_number" class="text-red-500 text-xs mt-1">{{ form.errors.license_number }}</p>
            </div>
            <div>
              <label class="text-sm font-medium text-foreground block mb-1">Type de pièce d'identité</label>
              <select v-model="form.identity_document_type" required
                class="w-full px-4 py-3 bg-white border border-border rounded-xl text-sm focus:outline-none focus:border-accent">
                <option value="">Sélectionner...</option>
                <option value="passeport">Passeport</option>
                <option value="cni">Carte nationale d'identité</option>
                <option value="permis">Permis de conduire</option>
              </select>
              <p v-if="form.errors.identity_document_type" class="text-red-500 text-xs mt-1">{{ form.errors.identity_document_type }}</p>
            </div>
            <div>
              <label class="text-sm font-medium text-foreground block mb-1">Numéro du document</label>
              <input v-model="form.identity_document_reference" type="text" required placeholder="Ex: AB123456"
                class="w-full px-4 py-3 bg-white border border-border rounded-xl text-sm focus:outline-none focus:border-accent" />
              <p v-if="form.errors.identity_document_reference" class="text-red-500 text-xs mt-1">{{ form.errors.identity_document_reference }}</p>
            </div>
          </div>

          <button type="submit" :disabled="form.processing"
            class="w-full py-3 bg-accent text-white rounded-xl text-sm font-semibold hover:bg-accent-dark transition disabled:opacity-60">
            {{ form.processing ? 'Création en cours...' : 'Créer mon compte agent/recruteur' }}
          </button>
        </form>

        <p class="text-center text-sm text-muted-foreground mt-6">
          Déjà un compte ?
          <a href="/login" class="text-accent font-medium hover:underline">Se connecter</a>
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
  organization_name: '',
  license_number: '',
  identity_document_type: '',
  identity_document_reference: '',
})

const benefits = [
  'Accès à 2500+ profils de joueurs africains',
  'Filtres avancés par poste, âge, nationalité',
  'Messagerie directe et sécurisée',
  'Shortlists personnalisées illimitées',
]

function submit() {
  form.post('/inscription/agent')
}
</script>