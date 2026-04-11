<script setup>
import { ref, computed } from 'vue'
import { Link, useForm } from '@inertiajs/vue3'

const showPassword = ref(false)

const form = useForm({
  firstName: '',
  lastName: '',
  dateOfBirth: '',
  nationality: '',
  position: '',
  preferredFoot: '',
  height: '',
  weight: '',
  status: 'libre',
  currentClub: '',
  email: '',
  password: '',
  confirmPassword: '',
})

const clubRequired = computed(() => form.status !== 'libre')

const handleSubmit = () => {
  form.post(route('player.signup'), {
    onError: () => {},
  })
}
</script>

<template>
  <div class="min-h-screen bg-gradient-to-br from-primary/10 via-background to-accent/10">
    <div class="container mx-auto px-4 py-8">

      <!-- Header -->
      <div class="mb-8 text-center">
        <Link href="/" class="inline-block mb-4">
          <div class="flex items-center justify-center gap-2">
            <div class="w-10 h-10 bg-primary rounded-lg flex items-center justify-center">
              <svg class="w-6 h-6 text-primary-foreground" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M8 21h8m-4-4v4M6 3H4a2 2 0 00-2 2v3c0 3.314 2.686 6 6 6h8c3.314 0 6-2.686 6-6V5a2 2 0 00-2-2h-2M6 3V1m12 2V1M6 3h12" />
              </svg>
            </div>
            <span class="font-bold text-2xl">AfricaScout</span>
          </div>
        </Link>
        <h1 class="text-3xl md:text-4xl font-bold mb-2">Inscription Joueur</h1>
        <p class="text-muted-foreground">Créez votre profil et commencez votre carrière internationale</p>
      </div>

      <!-- Form -->
      <div class="max-w-4xl mx-auto bg-card rounded-xl shadow-lg p-6 md:p-8">
        <form @submit.prevent="handleSubmit" class="space-y-6">

          <!-- Informations personnelles -->
          <div>
            <h2 class="text-xl font-semibold mb-4 flex items-center gap-2">
              <!-- User icon -->
              <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2" />
                <circle cx="12" cy="7" r="4" />
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
                  class="w-full px-4 py-2 bg-input-background rounded-lg border border-border focus:outline-none focus:ring-2 focus:ring-primary"
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
                  class="w-full px-4 py-2 bg-input-background rounded-lg border border-border focus:outline-none focus:ring-2 focus:ring-primary"
                  required
                />
                <p v-if="form.errors.lastName" class="text-red-500 text-sm mt-1">{{ form.errors.lastName }}</p>
              </div>

              <div>
                <label for="dateOfBirth" class="block mb-2">
                  <!-- Calendar icon -->
                  <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2" />
                    <line x1="16" y1="2" x2="16" y2="6" />
                    <line x1="8" y1="2" x2="8" y2="6" />
                    <line x1="3" y1="10" x2="21" y2="10" />
                  </svg>
                  Date de naissance *
                </label>
                <input
                  id="dateOfBirth"
                  v-model="form.dateOfBirth"
                  type="date"
                  class="w-full px-4 py-2 bg-input-background rounded-lg border border-border focus:outline-none focus:ring-2 focus:ring-primary"
                  required
                />
                <p v-if="form.errors.dateOfBirth" class="text-red-500 text-sm mt-1">{{ form.errors.dateOfBirth }}</p>
              </div>

              <div>
                <label for="nationality" class="block mb-2">
                  <!-- MapPin icon -->
                  <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 2C8.134 2 5 5.134 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.866-3.134-7-7-7z" />
                    <circle cx="12" cy="9" r="2.5" />
                  </svg>
                  Nationalité *
                </label>
                <select
                  id="nationality"
                  v-model="form.nationality"
                  class="w-full px-4 py-2 bg-input-background rounded-lg border border-border focus:outline-none focus:ring-2 focus:ring-primary"
                  required
                >
                  <option value="">Sélectionnez un pays</option>
                  <option value="senegal">Sénégal</option>
                  <option value="cote-ivoire">Côte d'Ivoire</option>
                  <option value="nigeria">Nigeria</option>
                  <option value="cameroun">Cameroun</option>
                  <option value="ghana">Ghana</option>
                  <option value="maroc">Maroc</option>
                  <option value="algerie">Algérie</option>
                  <option value="tunisie">Tunisie</option>
                  <option value="egypte">Égypte</option>
                  <option value="autre">Autre</option>
                </select>
                <p v-if="form.errors.nationality" class="text-red-500 text-sm mt-1">{{ form.errors.nationality }}</p>
              </div>

            </div>
          </div>

          <!-- Informations sportives -->
          <div>
            <h2 class="text-xl font-semibold mb-4 flex items-center gap-2">
              <!-- Trophy icon -->
              <svg class="w-5 h-5 text-accent" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M8 21h8m-4-4v4M6 3H4a2 2 0 00-2 2v3c0 3.314 2.686 6 6 6h8c3.314 0 6-2.686 6-6V5a2 2 0 00-2-2h-2M6 3V1m12 2V1M6 3h12" />
              </svg>
              Informations Sportives
            </h2>
            <div class="grid md:grid-cols-2 gap-4">

              <div>
                <label for="position" class="block mb-2">Position *</label>
                <select
                  id="position"
                  v-model="form.position"
                  class="w-full px-4 py-2 bg-input-background rounded-lg border border-border focus:outline-none focus:ring-2 focus:ring-primary"
                  required
                >
                  <option value="">Sélectionnez une position</option>
                  <option value="gardien">Gardien de but</option>
                  <option value="defenseur-central">Défenseur central</option>
                  <option value="lateral-gauche">Latéral gauche</option>
                  <option value="lateral-droit">Latéral droit</option>
                  <option value="milieu-defensif">Milieu défensif</option>
                  <option value="milieu-central">Milieu central</option>
                  <option value="milieu-offensif">Milieu offensif</option>
                  <option value="ailier-gauche">Ailier gauche</option>
                  <option value="ailier-droit">Ailier droit</option>
                  <option value="attaquant">Attaquant</option>
                </select>
                <p v-if="form.errors.position" class="text-red-500 text-sm mt-1">{{ form.errors.position }}</p>
              </div>

              <div>
                <label for="preferredFoot" class="block mb-2">Pied fort *</label>
                <select
                  id="preferredFoot"
                  v-model="form.preferredFoot"
                  class="w-full px-4 py-2 bg-input-background rounded-lg border border-border focus:outline-none focus:ring-2 focus:ring-primary"
                  required
                >
                  <option value="">Sélectionnez</option>
                  <option value="gauche">Gauche</option>
                  <option value="droit">Droit</option>
                  <option value="deux-pieds">Deux pieds</option>
                </select>
                <p v-if="form.errors.preferredFoot" class="text-red-500 text-sm mt-1">{{ form.errors.preferredFoot }}</p>
              </div>

              <div>
                <label for="height" class="block mb-2">
                  <!-- Ruler icon -->
                  <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 6h18M3 12h18M3 18h18" />
                  </svg>
                  Taille (cm) *
                </label>
                <input
                  id="height"
                  v-model="form.height"
                  type="number"
                  placeholder="175"
                  min="140"
                  max="220"
                  class="w-full px-4 py-2 bg-input-background rounded-lg border border-border focus:outline-none focus:ring-2 focus:ring-primary"
                  required
                />
                <p v-if="form.errors.height" class="text-red-500 text-sm mt-1">{{ form.errors.height }}</p>
              </div>

              <div>
                <label for="weight" class="block mb-2">
                  <!-- Weight icon -->
                  <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <circle cx="12" cy="5" r="3" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.5 8h11l1.5 11H5L6.5 8z" />
                  </svg>
                  Poids (kg) *
                </label>
                <input
                  id="weight"
                  v-model="form.weight"
                  type="number"
                  placeholder="70"
                  min="50"
                  max="120"
                  class="w-full px-4 py-2 bg-input-background rounded-lg border border-border focus:outline-none focus:ring-2 focus:ring-primary"
                  required
                />
                <p v-if="form.errors.weight" class="text-red-500 text-sm mt-1">{{ form.errors.weight }}</p>
              </div>

            </div>
          </div>

          <!-- Statut professionnel -->
          <div>
            <h2 class="text-xl font-semibold mb-4 flex items-center gap-2">
              <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2" />
                <circle cx="9" cy="7" r="4" />
                <path stroke-linecap="round" stroke-linejoin="round" d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75" />
              </svg>
              Statut Professionnel
            </h2>
            <div class="grid md:grid-cols-2 gap-4">

              <div>
                <label for="status" class="block mb-2">Statut actuel *</label>
                <select
                  id="status"
                  v-model="form.status"
                  class="w-full px-4 py-2 bg-input-background rounded-lg border border-border focus:outline-none focus:ring-2 focus:ring-primary"
                  required
                >
                  <option value="libre">Libre (sans contrat)</option>
                  <option value="sous-contrat">Sous contrat</option>
                  <option value="avec-agent">Avec agent</option>
                </select>
                <p v-if="form.errors.status" class="text-red-500 text-sm mt-1">{{ form.errors.status }}</p>
              </div>

              <div>
                <label for="currentClub" class="block mb-2">
                  Club actuel <span v-if="clubRequired">*</span>
                </label>
                <input
                  id="currentClub"
                  v-model="form.currentClub"
                  type="text"
                  placeholder="Nom du club"
                  :required="clubRequired"
                  :disabled="!clubRequired"
                  class="w-full px-4 py-2 bg-input-background rounded-lg border border-border focus:outline-none focus:ring-2 focus:ring-primary disabled:opacity-50 disabled:cursor-not-allowed"
                />
                <p v-if="form.errors.currentClub" class="text-red-500 text-sm mt-1">{{ form.errors.currentClub }}</p>
              </div>

            </div>
          </div>

          <!-- Photos et vidéos -->
          <div>
            <h2 class="text-xl font-semibold mb-4 flex items-center gap-2">
              <svg class="w-5 h-5 text-accent" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
              </svg>
              Photos et Vidéos
            </h2>
            <div class="grid md:grid-cols-2 gap-4">
              <div>
                <label class="block mb-2">Photo de profil</label>
                <div class="border-2 border-dashed border-border rounded-lg p-6 text-center cursor-pointer hover:border-primary transition-colors">
                  <svg class="w-8 h-8 mx-auto mb-2 text-muted-foreground" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                  </svg>
                  <p class="text-sm text-muted-foreground">Cliquez pour télécharger</p>
                </div>
              </div>
              <div>
                <label class="block mb-2">Vidéo highlight</label>
                <div class="border-2 border-dashed border-border rounded-lg p-6 text-center cursor-pointer hover:border-primary transition-colors">
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
              <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
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
                  Email *
                </label>
                <input
                  id="email"
                  v-model="form.email"
                  type="email"
                  class="w-full px-4 py-2 bg-input-background rounded-lg border border-border focus:outline-none focus:ring-2 focus:ring-primary"
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
                      class="w-full px-4 py-2 bg-input-background rounded-lg border border-border focus:outline-none focus:ring-2 focus:ring-primary pr-10"
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
                    class="w-full px-4 py-2 bg-input-background rounded-lg border border-border focus:outline-none focus:ring-2 focus:ring-primary"
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
              class="w-full bg-primary text-primary-foreground py-3 rounded-lg hover:opacity-90 transition-opacity disabled:opacity-50 disabled:cursor-not-allowed"
            >
              {{ form.processing ? 'Création en cours...' : 'Créer mon profil joueur' }}
            </button>
            <p class="text-center mt-4 text-sm text-muted-foreground">
              Vous avez déjà un compte ?
              <Link href="/login" class="text-primary hover:underline">Se connecter</Link>
            </p>
          </div>

        </form>
      </div>

      <!-- Footer links -->
      <div class="mt-8 text-center space-y-2">
        <p class="text-sm text-muted-foreground">Vous êtes un recruteur ou un club ?</p>
        <div class="flex justify-center gap-4">
          <Link href="/recruiter/signup" class="text-accent hover:underline">Inscription Recruteur</Link>
          <Link href="/club/signup" class="text-accent hover:underline">Inscription Club</Link>
        </div>
      </div>

    </div>
  </div>
</template>