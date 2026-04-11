<template>
  <div class="min-h-screen bg-input-background flex">

    <!-- Gauche -->
    <div class="hidden lg:flex lg:w-1/2 flex-col justify-between p-12" style="background: linear-gradient(135deg, #22c55e 0%, #f97316 100%);">
      <div class="flex items-center gap-2">
        <div class="w-10 h-10 bg-white/20 rounded-xl flex items-center justify-center">
          <span class="text-white font-bold text-lg">A</span>
        </div>
        <span class="text-white font-bold text-xl">AfricaScout</span>
      </div>
      <div>
        <h2 class="text-4xl font-bold text-white mb-4">Bienvenue sur AfricaScout</h2>
        <p class="text-white/80 text-lg mb-8">La plateforme N°1 pour connecter les talents africains au football mondial.</p>
        <div class="space-y-4">
          <div v-for="item in features" :key="item" class="flex items-center gap-3">
            <div class="w-6 h-6 bg-white/20 rounded-full flex items-center justify-center flex-shrink-0">
              <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/>
              </svg>
            </div>
            <span class="text-white/90 text-sm">{{ item }}</span>
          </div>
        </div>
      </div>
      <div class="flex gap-6 text-white/60 text-sm">
        <span>2500+ Joueurs</span>
        <span>450+ Recruteurs</span>
        <span>85+ Clubs</span>
      </div>
    </div>

    <!-- Droite -->
    <div class="w-full lg:w-1/2 flex items-center justify-center p-8">
      <div class="w-full max-w-md">

        <!-- Logo mobile -->
        <div class="flex items-center gap-2 justify-center mb-8 lg:hidden">
          <div class="w-9 h-9 bg-primary rounded-xl flex items-center justify-center">
            <span class="text-white font-bold">A</span>
          </div>
          <span class="font-bold text-xl text-foreground">AfricaScout</span>
        </div>

        <div class="text-center mb-8">
          <h1 class="text-2xl font-bold text-foreground mb-2">Connexion</h1>
          <p class="text-muted-foreground text-sm">Accédez à votre espace personnel</p>
        </div>

        <!-- Erreur globale -->
        <div v-if="form.errors.email" class="bg-red-50 border border-red-200 text-red-700 text-sm px-4 py-3 rounded-xl mb-4">
          {{ form.errors.email }}
        </div>

        <div class="space-y-4">
          <div>
            <label class="text-sm font-medium text-foreground block mb-1">Email</label>
            <input
              v-model="form.email"
              type="email"
              placeholder="votre@email.com"
              autocomplete="email"
              class="w-full px-4 py-3 bg-white border border-border rounded-xl text-sm focus:outline-none focus:border-primary transition"
              :class="form.errors.email ? 'border-red-400' : ''"
            />
          </div>

          <div>
            <div class="flex items-center justify-between mb-1">
              <label class="text-sm font-medium text-foreground">Mot de passe</label>
              <a href="#" class="text-xs text-primary hover:underline">Mot de passe oublié ?</a>
            </div>
            <input
              v-model="form.password"
              type="password"
              placeholder="••••••••"
              autocomplete="current-password"
              class="w-full px-4 py-3 bg-white border border-border rounded-xl text-sm focus:outline-none focus:border-primary transition"
            />
          </div>

          <div class="flex items-center gap-2">
            <input v-model="form.remember" type="checkbox" id="remember" class="w-4 h-4 accent-primary" />
            <label for="remember" class="text-sm text-muted-foreground">Se souvenir de moi</label>
          </div>

          <button
            @click="submit"
            :disabled="form.processing"
            class="w-full py-3 bg-primary text-white rounded-xl text-sm font-semibold hover:bg-primary-dark transition disabled:opacity-60 disabled:cursor-not-allowed"
          >
            <span v-if="form.processing">Connexion en cours...</span>
            <span v-else>Se connecter</span>
          </button>
        </div>

        <!-- Séparateur -->
        <div class="flex items-center gap-3 my-6">
          <div class="flex-1 h-px bg-border"></div>
          <span class="text-xs text-muted-foreground">Pas encore de compte ?</span>
          <div class="flex-1 h-px bg-border"></div>
        </div>

        <!-- Liens inscription -->
        <div class="grid grid-cols-3 gap-2">
          <a href="/inscription/joueur" class="py-2.5 border border-border rounded-xl text-xs font-medium text-center text-foreground hover:bg-muted transition">
            Joueur
          </a>
          <a href="/inscription/agent" class="py-2.5 border border-border rounded-xl text-xs font-medium text-center text-foreground hover:bg-muted transition">
            Recruteur
          </a>
          <a href="/inscription/club" class="py-2.5 border border-border rounded-xl text-xs font-medium text-center text-foreground hover:bg-muted transition">
            Club
          </a>
        </div>

        <p class="text-center text-xs text-muted-foreground mt-6">
          En vous connectant, vous acceptez nos
          <a href="#" class="text-primary hover:underline">conditions d'utilisation</a>
        </p>
      </div>
    </div>
  </div>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3'

const form = useForm({
  email: '',
  password: '',
  remember: false,
})

const features = [
  '2500+ profils de joueurs africains',
  'Recruteurs et agents du monde entier',
  'Messagerie sécurisée intégrée',
  'Transferts et commissions gérés en ligne',
]

function submit() {
  form.post('/login', {
    onFinish: () => form.reset('password'),
  })
}
</script>