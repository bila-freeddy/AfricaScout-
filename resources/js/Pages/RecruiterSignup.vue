<script setup>
import { ref } from 'vue'
import { Link, useForm } from '@inertiajs/vue3'

const showPassword = ref(false)

const positions = ['Gardien', 'Défenseur', 'Milieu', 'Attaquant', 'Polyvalent']
const regions = [
  "Afrique de l'Ouest",
  'Afrique du Nord',
  'Afrique Centrale',
  "Afrique de l'Est",
  'Afrique Australe',
  "Toute l'Afrique",
]

const form = useForm({
  firstName: '',
  lastName: '',
  company: '',
  jobTitle: '',
  country: '',
  licenseNumber: '',
  yearsExperience: '',
  specialization: [],
  targetRegions: [],
  email: '',
  password: '',
  confirmPassword: '',
})

const toggleCheckbox = (field, value) => {
  const arr = form[field]
  if (arr.includes(value)) {
    form[field] = arr.filter((v) => v !== value)
  } else {
    form[field] = [...arr, value]
  }
}

const handleSubmit = () => {
  form.post(route('recruiter.signup'), {
    onError: () => {},
  })
}
</script>

<template>
  <div class="min-h-screen bg-gradient-to-br from-accent/10 via-background to-primary/10">
    <div class="container mx-auto px-4 py-8">

      <!-- Header -->
      <div class="mb-8 text-center">
        <Link href="/" class="inline-block mb-4">
          <div class="flex items-center justify-center gap-2">
            <div class="w-10 h-10 bg-accent rounded-lg flex items-center justify-center">
              <svg class="w-6 h-6 text-accent-foreground" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M8 21h8m-4-4v4M6 3H4a2 2 0 00-2 2v3c0 3.314 2.686 6 6 6h8c3.314 0 6-2.686 6-6V5a2 2 0 00-2-2h-2M6 3V1m12 2V1M6 3h12" />
              </svg>
            </div>
            <span class="font-bold text-2xl">AfricaScout</span>
          </div>
        </Link>
        <h1 class="text-3xl md:text-4xl font-bold mb-2">Inscription Recruteur / Agent</h1>
        <p class="text-muted-foreground">Découvrez les meilleurs talents africains</p>
      </div>

      <!-- Form -->
      <div class="max-w-4xl mx-auto bg-card rounded-xl shadow-lg p-6 md:p-8">
        <form @submit.prevent="handleSubmit" class="space-y-6">

          <!-- Informations personnelles -->
          <div>
            <h2 class="text-xl font-semibold mb-4 flex items-center gap-2">
              <!-- Building2 icon -->
              <svg class="w-5 h-5 text-accent" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16M3 21h18M9 21v-8h6v8" />
              </svg>
              Informations Personnelles
            </h2>
            <div class="grid md:grid-cols-2 gap-4">

              <div>
                <label for="firstName" class="block mb-2">Prénom *</label>
                <input
                  id="firstName"
                  v-model="form.firstName"
                  type="text"
                  class="w-full px-4 py-2 bg-input-background rounded-lg border border-border focus:outline-none focus:ring-2 focus:ring-accent"
                  required
                />
                <p v-if="form.errors.firstName" class="text-red-500 text-sm mt-1">{{ form.errors.firstName }}</p>
              </div>

              <div>
                <label for="lastName" class="block mb-2">Nom *</label>
                <input
                  id="lastName"
                  v-model="form.lastName"
                  type="text"
                  class="w-full px-4 py-2 bg-input-background rounded-lg border border-border focus:outline-none focus:ring-2 focus:ring-accent"
                  required
                />
                <p v-if="form.errors.lastName" class="text-red-500 text-sm mt-1">{{ form.errors.lastName }}</p>
              </div>

            </div>
          </div>

          <!-- Informations professionnelles -->
          <div>
            <h2 class="text-xl font-semibold mb-4 flex items-center gap-2">
              <!-- Award icon -->
              <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <circle cx="12" cy="8" r="6" />
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.477 12.89L17 22l-5-3-5 3 1.523-9.11" />
              </svg>
              Informations Professionnelles
            </h2>
            <div class="grid md:grid-cols-2 gap-4">

              <div>
                <label for="company" class="block mb-2">Entreprise / Agence *</label>
                <input
                  id="company"
                  v-model="form.company"
                  type="text"
                  placeholder="Nom de votre agence"
                  class="w-full px-4 py-2 bg-input-background rounded-lg border border-border focus:outline-none focus:ring-2 focus:ring-accent"
                  required
                />
                <p v-if="form.errors.company" class="text-red-500 text-sm mt-1">{{ form.errors.company }}</p>
              </div>

              <div>
                <label for="jobTitle" class="block mb-2">Poste *</label>
                <input
                  id="jobTitle"
                  v-model="form.jobTitle"
                  type="text"
                  placeholder="Ex: Agent sportif, Recruteur"
                  class="w-full px-4 py-2 bg-input-background rounded-lg border border-border focus:outline-none focus:ring-2 focus:ring-accent"
                  required
                />
                <p v-if="form.errors.jobTitle" class="text-red-500 text-sm mt-1">{{ form.errors.jobTitle }}</p>
              </div>

              <div>
                <label for="country" class="block mb-2">
                  <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 2C8.134 2 5 5.134 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.866-3.134-7-7-7z" />
                    <circle cx="12" cy="9" r="2.5" />
                  </svg>
                  Pays d'opération *
                </label>
                <select
                  id="country"
                  v-model="form.country"
                  class="w-full px-4 py-2 bg-input-background rounded-lg border border-border focus:outline-none focus:ring-2 focus:ring-accent"
                  required
                >
                  <option value="">Sélectionnez un pays</option>
                  <option value="france">France</option>
                  <option value="espagne">Espagne</option>
                  <option value="angleterre">Angleterre</option>
                  <option value="allemagne">Allemagne</option>
                  <option value="italie">Italie</option>
                  <option value="portugal">Portugal</option>
                  <option value="belgique">Belgique</option>
                  <option value="pays-bas">Pays-Bas</option>
                  <option value="usa">États-Unis</option>
                  <option value="autre">Autre</option>
                </select>
                <p v-if="form.errors.country" class="text-red-500 text-sm mt-1">{{ form.errors.country }}</p>
              </div>

              <div>
                <label for="licenseNumber" class="block mb-2">Numéro de licence professionnelle</label>
                <input
                  id="licenseNumber"
                  v-model="form.licenseNumber"
                  type="text"
                  placeholder="Optionnel"
                  class="w-full px-4 py-2 bg-input-background rounded-lg border border-border focus:outline-none focus:ring-2 focus:ring-accent"
                />
              </div>

              <div>
                <label for="yearsExperience" class="block mb-2">
                  <!-- Calendar icon -->
                  <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2" />
                    <line x1="16" y1="2" x2="16" y2="6" />
                    <line x1="8" y1="2" x2="8" y2="6" />
                    <line x1="3" y1="10" x2="21" y2="10" />
                  </svg>
                  Années d'expérience *
                </label>
                <select
                  id="yearsExperience"
                  v-model="form.yearsExperience"
                  class="w-full px-4 py-2 bg-input-background rounded-lg border border-border focus:outline-none focus:ring-2 focus:ring-accent"
                  required
                >
                  <option value="">Sélectionnez</option>
                  <option value="0-2">0-2 ans</option>
                  <option value="3-5">3-5 ans</option>
                  <option value="6-10">6-10 ans</option>
                  <option value="10+">Plus de 10 ans</option>
                </select>
                <p v-if="form.errors.yearsExperience" class="text-red-500 text-sm mt-1">{{ form.errors.yearsExperience }}</p>
              </div>

            </div>
          </div>

          <!-- Spécialisation -->
          <div>
            <h2 class="text-xl font-semibold mb-4 flex items-center gap-2">
              <!-- Target icon -->
              <svg class="w-5 h-5 text-accent" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <circle cx="12" cy="12" r="10" />
                <circle cx="12" cy="12" r="6" />
                <circle cx="12" cy="12" r="2" />
              </svg>
              Spécialisation
            </h2>
            <div class="space-y-4">

              <div>
                <label class="block mb-3">Positions recherchées *</label>
                <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                  <label
                    v-for="position in positions"
                    :key="position"
                    class="flex items-center gap-2 cursor-pointer"
                  >
                    <input
                      type="checkbox"
                      :checked="form.specialization.includes(position)"
                      class="w-4 h-4 accent-accent"
                      @change="toggleCheckbox('specialization', position)"
                    />
                    <span>{{ position }}</span>
                  </label>
                </div>
                <p v-if="form.errors.specialization" class="text-red-500 text-sm mt-1">{{ form.errors.specialization }}</p>
              </div>

              <div>
                <label class="block mb-3">Régions cibles en Afrique *</label>
                <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                  <label
                    v-for="region in regions"
                    :key="region"
                    class="flex items-center gap-2 cursor-pointer"
                  >
                    <input
                      type="checkbox"
                      :checked="form.targetRegions.includes(region)"
                      class="w-4 h-4 accent-accent"
                      @change="toggleCheckbox('targetRegions', region)"
                    />
                    <span>{{ region }}</span>
                  </label>
                </div>
                <p v-if="form.errors.targetRegions" class="text-red-500 text-sm mt-1">{{ form.errors.targetRegions }}</p>
              </div>

            </div>
          </div>

          <!-- Documents -->
          <div>
            <h2 class="text-xl font-semibold mb-4 flex items-center gap-2">
              <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
              </svg>
              Documents
            </h2>
            <div class="grid md:grid-cols-2 gap-4">
              <div>
                <label class="block mb-2">Photo de profil</label>
                <div class="border-2 border-dashed border-border rounded-lg p-6 text-center cursor-pointer hover:border-accent transition-colors">
                  <svg class="w-8 h-8 mx-auto mb-2 text-muted-foreground" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                  </svg>
                  <p class="text-sm text-muted-foreground">Cliquez pour télécharger</p>
                </div>
              </div>
              <div>
                <label class="block mb-2">Licence professionnelle (optionnel)</label>
                <div class="border-2 border-dashed border-border rounded-lg p-6 text-center cursor-pointer hover:border-accent transition-colors">
                  <svg class="w-8 h-8 mx-auto mb-2 text-muted-foreground" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                  </svg>
                  <p class="text-sm text-muted-foreground">Cliquez pour télécharger</p>
                </div>
              </div>
            </div>
          </div>

          <!-- Informations de compte -->
          <div>
            <h2 class="text-xl font-semibold mb-4 flex items-center gap-2">
              <svg class="w-5 h-5 text-accent" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <rect x="3" y="11" width="18" height="11" rx="2" ry="2" />
                <path stroke-linecap="round" stroke-linejoin="round" d="M7 11V7a5 5 0 0110 0v4" />
              </svg>
              Informations de Compte
            </h2>
            <div class="space-y-4">

              <div>
                <label for="email" class="block mb-2">
                  <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                  </svg>
                  Email professionnel *
                </label>
                <input
                  id="email"
                  v-model="form.email"
                  type="email"
                  class="w-full px-4 py-2 bg-input-background rounded-lg border border-border focus:outline-none focus:ring-2 focus:ring-accent"
                  required
                />
                <p v-if="form.errors.email" class="text-red-500 text-sm mt-1">{{ form.errors.email }}</p>
              </div>

              <div class="grid md:grid-cols-2 gap-4">
                <div>
                  <label for="password" class="block mb-2">Mot de passe *</label>
                  <div class="relative">
                    <input
                      id="password"
                      v-model="form.password"
                      :type="showPassword ? 'text' : 'password'"
                      class="w-full px-4 py-2 bg-input-background rounded-lg border border-border focus:outline-none focus:ring-2 focus:ring-accent pr-10"
                      required
                    />
                    <button
                      type="button"
                      class="absolute right-3 top-1/2 -translate-y-1/2 text-muted-foreground hover:text-foreground"
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

                <div>
                  <label for="confirmPassword" class="block mb-2">Confirmer le mot de passe *</label>
                  <input
                    id="confirmPassword"
                    v-model="form.confirmPassword"
                    :type="showPassword ? 'text' : 'password'"
                    class="w-full px-4 py-2 bg-input-background rounded-lg border border-border focus:outline-none focus:ring-2 focus:ring-accent"
                    required
                  />
                  <p v-if="form.errors.confirmPassword" class="text-red-500 text-sm mt-1">{{ form.errors.confirmPassword }}</p>
                </div>
              </div>

            </div>
          </div>

          <!-- Submit -->
          <div class="pt-4">
            <button
              type="submit"
              :disabled="form.processing"
              class="w-full bg-accent text-accent-foreground py-3 rounded-lg hover:opacity-90 transition-opacity disabled:opacity-50 disabled:cursor-not-allowed"
            >
              {{ form.processing ? 'Création en cours...' : 'Créer mon compte recruteur' }}
            </button>
            <p class="text-center mt-4 text-sm text-muted-foreground">
              Vous avez déjà un compte ?
              <Link href="/login" class="text-accent hover:underline">Se connecter</Link>
            </p>
          </div>

        </form>
      </div>

      <!-- Footer links -->
      <div class="mt-8 text-center space-y-2">
        <p class="text-sm text-muted-foreground">Vous êtes un joueur ou un club ?</p>
        <div class="flex justify-center gap-4">
          <Link href="/player/signup" class="text-primary hover:underline">Inscription Joueur</Link>
          <Link href="/club/signup" class="text-primary hover:underline">Inscription Club</Link>
        </div>
      </div>

    </div>
  </div>
</template>