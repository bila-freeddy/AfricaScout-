<script setup>
import { ref, computed } from 'vue'
import { Link, useForm } from '@inertiajs/vue3'

const showPassword = ref(false)
const selectedUserType = ref(null)

const userTypes = [
  {
    type: 'player',
    label: 'Joueur',
    gradient: 'from-primary to-primary/80',
  },
  {
    type: 'recruiter',
    label: 'Recruteur',
    gradient: 'from-accent to-accent/80',
  },
  {
    type: 'club',
    label: 'Club',
    gradient: 'from-primary to-accent',
  },
]

const form = useForm({
  email: '',
  password: '',
  remember: false,
  user_type: null,
})

const canSubmit = computed(() => selectedUserType.value !== null && !form.processing)

const handleLogin = () => {
  if (!selectedUserType.value) return
  form.user_type = selectedUserType.value
  form.post(route('login'), {
    onError: () => {},
  })
}
</script>

<template>
  <div class="min-h-screen bg-muted/30 flex">

    <!-- Left Side - Image and Branding (desktop only) -->
    <div class="hidden lg:flex lg:w-1/2 relative overflow-hidden">
      <div class="absolute inset-0">
        <img
          src="https://images.unsplash.com/photo-1705859939155-922daebad09e?w=1200"
          alt="African football stadium"
          class="w-full h-full object-cover"
        />
        <div class="absolute inset-0 bg-gradient-to-br from-primary/90 via-primary/70 to-accent/90" />
      </div>

      <div class="relative z-10 flex flex-col justify-between p-12 text-white">
        <Link href="/" class="flex items-center gap-3 group">
          <div class="w-12 h-12 bg-white/20 backdrop-blur-sm rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform">
            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M8 21h8m-4-4v4M6 3H4a2 2 0 00-2 2v3c0 3.314 2.686 6 6 6h8c3.314 0 6-2.686 6-6V5a2 2 0 00-2-2h-2M6 3V1m12 2V1M6 3h12" />
            </svg>
          </div>
          <span class="text-2xl font-bold">AfricaScout</span>
        </Link>

        <div class="space-y-6">
          <div class="flex items-center gap-2">
            <svg class="w-8 h-8 text-accent" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M5 3l.5 2L7 5.5 5.5 6 5 8l-.5-2L3 5.5 4.5 5 5 3zm14 0l.5 2 1.5.5-1.5.5L19 8l-.5-2-1.5-.5 1.5-.5L19 3zm-7 4l1 4 4 1-4 1-1 4-1-4-4-1 4-1 1-4z" />
            </svg>
            <h1 class="text-4xl font-bold leading-tight">Connectez-vous à votre avenir</h1>
          </div>
          <p class="text-xl text-white/90 max-w-md">
            La plateforme qui connecte les talents africains avec les opportunités mondiales
          </p>
          <div class="grid grid-cols-3 gap-4 pt-8">
            <div class="bg-white/10 backdrop-blur-sm rounded-lg p-4">
              <div class="text-3xl font-bold mb-1">5000+</div>
              <div class="text-sm text-white/80">Joueurs</div>
            </div>
            <div class="bg-white/10 backdrop-blur-sm rounded-lg p-4">
              <div class="text-3xl font-bold mb-1">500+</div>
              <div class="text-sm text-white/80">Recruteurs</div>
            </div>
            <div class="bg-white/10 backdrop-blur-sm rounded-lg p-4">
              <div class="text-3xl font-bold mb-1">200+</div>
              <div class="text-sm text-white/80">Clubs</div>
            </div>
          </div>
        </div>

        <div class="text-white/70 text-sm">© 2024 AfricaScout. Tous droits réservés.</div>
      </div>
    </div>

    <!-- Right Side - Login Form -->
    <div class="flex-1 flex items-center justify-center p-6 lg:p-12">
      <div class="w-full max-w-md">

        <!-- Mobile Logo -->
        <Link href="/" class="flex lg:hidden items-center justify-center gap-2 mb-8">
          <div class="w-10 h-10 bg-gradient-to-br from-primary to-accent rounded-lg flex items-center justify-center">
            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M8 21h8m-4-4v4M6 3H4a2 2 0 00-2 2v3c0 3.314 2.686 6 6 6h8c3.314 0 6-2.686 6-6V5a2 2 0 00-2-2h-2M6 3V1m12 2V1M6 3h12" />
            </svg>
          </div>
          <span class="text-2xl font-bold">AfricaScout</span>
        </Link>

        <div class="bg-card rounded-2xl shadow-xl p-8 border border-border">

          <div class="text-center mb-8">
            <h2 class="text-3xl font-bold mb-2">Bon retour !</h2>
            <p class="text-muted-foreground">Connectez-vous pour accéder à votre espace</p>
          </div>

          <!-- User Type Selection -->
          <div class="mb-6">
            <label class="block text-sm font-medium mb-3">Je me connecte en tant que</label>
            <div class="grid grid-cols-3 gap-2">
              <button
                v-for="userType in userTypes"
                :key="userType.type"
                type="button"
                :class="[
                  'relative p-4 rounded-xl border-2 transition-all',
                  selectedUserType === userType.type
                    ? 'border-primary bg-primary/5 shadow-md'
                    : 'border-border hover:border-primary/50 hover:bg-muted'
                ]"
                @click="selectedUserType = userType.type"
              >
                <div
                  :class="[
                    'w-10 h-10 mx-auto mb-2 rounded-lg flex items-center justify-center',
                    selectedUserType === userType.type
                      ? `bg-gradient-to-br ${userType.gradient}`
                      : 'bg-muted'
                  ]"
                >
                  <!-- Users icon (player) -->
                  <template v-if="userType.type === 'player'">
                    <svg :class="['w-5 h-5', selectedUserType === userType.type ? 'text-white' : 'text-muted-foreground']" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2" />
                      <circle cx="9" cy="7" r="4" />
                      <path stroke-linecap="round" stroke-linejoin="round" d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75" />
                    </svg>
                  </template>
                  <!-- Target icon (recruiter) -->
                  <template v-else-if="userType.type === 'recruiter'">
                    <svg :class="['w-5 h-5', selectedUserType === userType.type ? 'text-white' : 'text-muted-foreground']" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                      <circle cx="12" cy="12" r="10" /><circle cx="12" cy="12" r="6" /><circle cx="12" cy="12" r="2" />
                    </svg>
                  </template>
                  <!-- Building icon (club) -->
                  <template v-else>
                    <svg :class="['w-5 h-5', selectedUserType === userType.type ? 'text-white' : 'text-muted-foreground']" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M3 21V7l9-4 9 4v14M9 21v-6h6v6" />
                    </svg>
                  </template>
                </div>
                <div :class="['text-xs font-medium', selectedUserType === userType.type ? 'text-primary' : 'text-muted-foreground']">
                  {{ userType.label }}
                </div>
              </button>
            </div>
            <p v-if="form.errors.user_type" class="text-red-500 text-sm mt-2">{{ form.errors.user_type }}</p>
          </div>

          <!-- Form -->
          <form @submit.prevent="handleLogin" class="space-y-5">

            <!-- Email -->
            <div>
              <label for="email" class="block text-sm font-medium mb-2">Email</label>
              <div class="relative">
                <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-5 h-5 text-muted-foreground" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg>
                <input
                  id="email"
                  v-model="form.email"
                  type="email"
                  placeholder="votre@email.com"
                  required
                  class="w-full pl-10 pr-4 py-3 bg-input-background rounded-lg border border-border focus:outline-none focus:ring-2 focus:ring-primary transition-all"
                />
              </div>
              <p v-if="form.errors.email" class="text-red-500 text-sm mt-1">{{ form.errors.email }}</p>
            </div>

            <!-- Password -->
            <div>
              <label for="password" class="block text-sm font-medium mb-2">Mot de passe</label>
              <div class="relative">
                <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-5 h-5 text-muted-foreground" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                  <rect x="3" y="11" width="18" height="11" rx="2" ry="2" />
                  <path stroke-linecap="round" stroke-linejoin="round" d="M7 11V7a5 5 0 0110 0v4" />
                </svg>
                <input
                  id="password"
                  v-model="form.password"
                  :type="showPassword ? 'text' : 'password'"
                  placeholder="••••••••"
                  required
                  class="w-full pl-10 pr-12 py-3 bg-input-background rounded-lg border border-border focus:outline-none focus:ring-2 focus:ring-primary transition-all"
                />
                <button
                  type="button"
                  class="absolute right-3 top-1/2 -translate-y-1/2 text-muted-foreground hover:text-foreground transition-colors"
                  @click="showPassword = !showPassword"
                >
                  <svg v-if="showPassword" class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                  </svg>
                  <svg v-else class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                  </svg>
                </button>
              </div>
              <p v-if="form.errors.password" class="text-red-500 text-sm mt-1">{{ form.errors.password }}</p>
            </div>

            <!-- Remember & Forgot -->
            <div class="flex items-center justify-between text-sm">
              <label class="flex items-center gap-2 cursor-pointer">
                <input
                  v-model="form.remember"
                  type="checkbox"
                  class="w-4 h-4 rounded border-border text-primary focus:ring-2 focus:ring-primary"
                />
                <span class="text-muted-foreground">Se souvenir de moi</span>
              </label>
              <Link href="/forgot-password" class="text-primary hover:underline font-medium">
                Mot de passe oublié ?
              </Link>
            </div>

            <!-- Submit -->
            <button
              type="submit"
              :disabled="!canSubmit"
              :class="[
                'w-full py-3 rounded-lg font-semibold flex items-center justify-center gap-2 transition-all',
                canSubmit
                  ? 'bg-gradient-to-r from-primary to-accent text-white hover:shadow-lg hover:scale-[1.02]'
                  : 'bg-muted text-muted-foreground cursor-not-allowed'
              ]"
            >
              <template v-if="form.processing">
                <svg class="w-5 h-5 animate-spin" fill="none" viewBox="0 0 24 24">
                  <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" />
                  <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z" />
                </svg>
                <span>Connexion...</span>
              </template>
              <template v-else>
                <span>Se connecter</span>
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                </svg>
              </template>
            </button>

          </form>

          <!-- Divider -->
          <div class="relative my-6">
            <div class="absolute inset-0 flex items-center">
              <div class="w-full border-t border-border" />
            </div>
            <div class="relative flex justify-center text-sm">
              <span class="px-4 bg-card text-muted-foreground">Nouveau sur AfricaScout ?</span>
            </div>
          </div>

          <!-- Signup Links -->
          <div class="space-y-2">
            <Link href="/player/signup" class="w-full py-2.5 px-4 border border-border rounded-lg hover:bg-muted transition-colors flex items-center justify-between group">
              <div class="flex items-center gap-2">
                <svg class="w-4 h-4 text-primary" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2" /><circle cx="9" cy="7" r="4" />
                  <path stroke-linecap="round" stroke-linejoin="round" d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75" />
                </svg>
                <span class="text-sm font-medium">S'inscrire comme joueur</span>
              </div>
              <svg class="w-4 h-4 text-muted-foreground group-hover:text-primary group-hover:translate-x-1 transition-all" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6" />
              </svg>
            </Link>

            <Link href="/recruiter/signup" class="w-full py-2.5 px-4 border border-border rounded-lg hover:bg-muted transition-colors flex items-center justify-between group">
              <div class="flex items-center gap-2">
                <svg class="w-4 h-4 text-accent" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                  <circle cx="12" cy="12" r="10" /><circle cx="12" cy="12" r="6" /><circle cx="12" cy="12" r="2" />
                </svg>
                <span class="text-sm font-medium">S'inscrire comme recruteur</span>
              </div>
              <svg class="w-4 h-4 text-muted-foreground group-hover:text-accent group-hover:translate-x-1 transition-all" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6" />
              </svg>
            </Link>

            <Link href="/club/signup" class="w-full py-2.5 px-4 border border-border rounded-lg hover:bg-muted transition-colors flex items-center justify-between group">
              <div class="flex items-center gap-2">
                <svg class="w-4 h-4 text-primary" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M3 21V7l9-4 9 4v14M9 21v-6h6v6" />
                </svg>
                <span class="text-sm font-medium">S'inscrire comme club</span>
              </div>
              <svg class="w-4 h-4 text-muted-foreground group-hover:text-primary group-hover:translate-x-1 transition-all" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6" />
              </svg>
            </Link>
          </div>

        </div>

        <!-- Demo Hint -->
        <div class="mt-6 text-center">
          <p class="text-xs text-muted-foreground">
            Mode démo : Sélectionnez un type de compte et connectez-vous avec n'importe quel email
          </p>
        </div>

      </div>
    </div>

  </div>
</template>