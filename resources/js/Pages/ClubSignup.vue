<script setup>
import { ref } from 'vue'
import { Link, useForm } from '@inertiajs/vue3'

const showPassword = ref(false)

const form = useForm({
  clubName: '',
  country: '',
  league: '',
  division: '',
  foundedYear: '',
  stadium: '',
  contactFirstName: '',
  contactLastName: '',
  contactPosition: '',
  contactPhone: '',
  email: '',
  password: '',
  confirmPassword: '',
})

const handleSubmit = () => {
  form.post(route('club.signup'), {
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
              <!-- Trophy icon -->
              <svg class="w-6 h-6 text-primary-foreground" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M8 21h8m-4-4v4M6 3H4a2 2 0 00-2 2v3c0 3.314 2.686 6 6 6h8c3.314 0 6-2.686 6-6V5a2 2 0 00-2-2h-2M6 3V1m12 2V1M6 3h12" />
              </svg>
            </div>
            <span class="font-bold text-2xl">AfricaScout</span>
          </div>
        </Link>
        <h1 class="text-3xl md:text-4xl font-bold mb-2">Inscription Club</h1>
        <p class="text-muted-foreground">Recrutez les meilleurs talents africains pour votre équipe</p>
      </div>

      <!-- Form -->
      <div class="max-w-4xl mx-auto bg-card rounded-xl shadow-lg p-6 md:p-8">
        <form @submit.prevent="handleSubmit" class="space-y-6">

          <!-- Informations du club -->
          <div>
            <h2 class="text-xl font-semibold mb-4 flex items-center gap-2">
              <!-- Shield icon -->
              <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z" />
              </svg>
              Informations du Club
            </h2>
            <div class="grid md:grid-cols-2 gap-4">

              <div class="md:col-span-2">
                <label for="clubName" class="block mb-2">
                  <!-- Building icon -->
                  <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 21V7l9-4 9 4v14M9 21v-6h6v6" />
                  </svg>
                  Nom du club *
                </label>
                <input
                  id="clubName"
                  v-model="form.clubName"
                  type="text"
                  placeholder="Ex: FC Exemple"
                  class="w-full px-4 py-2 bg-input-background rounded-lg border border-border focus:outline-none focus:ring-2 focus:ring-primary"
                  required
                />
                <p v-if="form.errors.clubName" class="text-red-500 text-sm mt-1">{{ form.errors.clubName }}</p>
              </div>

              <div>
                <label for="country" class="block mb-2">
                  <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 2C8.134 2 5 5.134 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.866-3.134-7-7-7z" />
                    <circle cx="12" cy="9" r="2.5" />
                  </svg>
                  Pays *
                </label>
                <select
                  id="country"
                  v-model="form.country"
                  class="w-full px-4 py-2 bg-input-background rounded-lg border border-border focus:outline-none focus:ring-2 focus:ring-primary"
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
                  <option value="senegal">Sénégal</option>
                  <option value="cote-ivoire">Côte d'Ivoire</option>
                  <option value="maroc">Maroc</option>
                  <option value="autre">Autre</option>
                </select>
                <p v-if="form.errors.country" class="text-red-500 text-sm mt-1">{{ form.errors.country }}</p>
              </div>

              <div>
                <label for="league" class="block mb-2">Ligue / Championnat *</label>
                <input
                  id="league"
                  v-model="form.league"
                  type="text"
                  placeholder="Ex: Ligue 1, Premier League"
                  class="w-full px-4 py-2 bg-input-background rounded-lg border border-border focus:outline-none focus:ring-2 focus:ring-primary"
                  required
                />
                <p v-if="form.errors.league" class="text-red-500 text-sm mt-1">{{ form.errors.league }}</p>
              </div>

              <div>
                <label for="division" class="block mb-2">Division *</label>
                <select
                  id="division"
                  v-model="form.division"
                  class="w-full px-4 py-2 bg-input-background rounded-lg border border-border focus:outline-none focus:ring-2 focus:ring-primary"
                  required
                >
                  <option value="">Sélectionnez</option>
                  <option value="1">Division 1 / Élite</option>
                  <option value="2">Division 2</option>
                  <option value="3">Division 3</option>
                  <option value="4">Division 4 ou inférieure</option>
                  <option value="amateur">Amateur</option>
                </select>
                <p v-if="form.errors.division" class="text-red-500 text-sm mt-1">{{ form.errors.division }}</p>
              </div>

              <div>
                <label for="foundedYear" class="block mb-2">Année de création</label>
                <input
                  id="foundedYear"
                  v-model="form.foundedYear"
                  type="number"
                  placeholder="1950"
                  min="1800"
                  max="2026"
                  class="w-full px-4 py-2 bg-input-background rounded-lg border border-border focus:outline-none focus:ring-2 focus:ring-primary"
                />
                <p v-if="form.errors.foundedYear" class="text-red-500 text-sm mt-1">{{ form.errors.foundedYear }}</p>
              </div>

              <div>
                <label for="stadium" class="block mb-2">Stade</label>
                <input
                  id="stadium"
                  v-model="form.stadium"
                  type="text"
                  placeholder="Nom du stade"
                  class="w-full px-4 py-2 bg-input-background rounded-lg border border-border focus:outline-none focus:ring-2 focus:ring-primary"
                />
                <p v-if="form.errors.stadium" class="text-red-500 text-sm mt-1">{{ form.errors.stadium }}</p>
              </div>

            </div>
          </div>

          <!-- Personne de contact -->
          <div>
            <h2 class="text-xl font-semibold mb-4 flex items-center gap-2">
              <!-- Users icon -->
              <svg class="w-5 h-5 text-accent" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2" />
                <circle cx="9" cy="7" r="4" />
                <path stroke-linecap="round" stroke-linejoin="round" d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75" />
              </svg>
              Personne de Contact
            </h2>
            <div class="grid md:grid-cols-2 gap-4">

              <div>
                <label for="contactFirstName" class="block mb-2">Prénom *</label>
                <input
                  id="contactFirstName"
                  v-model="form.contactFirstName"
                  type="text"
                  class="w-full px-4 py-2 bg-input-background rounded-lg border border-border focus:outline-none focus:ring-2 focus:ring-primary"
                  required
                />
                <p v-if="form.errors.contactFirstName" class="text-red-500 text-sm mt-1">{{ form.errors.contactFirstName }}</p>
              </div>

              <div>
                <label for="contactLastName" class="block mb-2">Nom *</label>
                <input
                  id="contactLastName"
                  v-model="form.contactLastName"
                  type="text"
                  class="w-full px-4 py-2 bg-input-background rounded-lg border border-border focus:outline-none focus:ring-2 focus:ring-primary"
                  required
                />
                <p v-if="form.errors.contactLastName" class="text-red-500 text-sm mt-1">{{ form.errors.contactLastName }}</p>
              </div>

              <div>
                <label for="contactPosition" class="block mb-2">Poste dans le club *</label>
                <select
                  id="contactPosition"
                  v-model="form.contactPosition"
                  class="w-full px-4 py-2 bg-input-background rounded-lg border border-border focus:outline-none focus:ring-2 focus:ring-primary"
                  required
                >
                  <option value="">Sélectionnez</option>
                  <option value="president">Président</option>
                  <option value="directeur-sportif">Directeur sportif</option>
                  <option value="recruteur">Recruteur</option>
                  <option value="entraineur">Entraîneur</option>
                  <option value="responsable-recrutement">Responsable recrutement</option>
                  <option value="autre">Autre</option>
                </select>
                <p v-if="form.errors.contactPosition" class="text-red-500 text-sm mt-1">{{ form.errors.contactPosition }}</p>
              </div>

              <div>
                <label for="contactPhone" class="block mb-2">
                  <!-- Phone icon -->
                  <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                  </svg>
                  Téléphone *
                </label>
                <input
                  id="contactPhone"
                  v-model="form.contactPhone"
                  type="tel"
                  placeholder="+33 6 12 34 56 78"
                  class="w-full px-4 py-2 bg-input-background rounded-lg border border-border focus:outline-none focus:ring-2 focus:ring-primary"
                  required
                />
                <p v-if="form.errors.contactPhone" class="text-red-500 text-sm mt-1">{{ form.errors.contactPhone }}</p>
              </div>

            </div>
          </div>

          <!-- Logo du club -->
          <div>
            <h2 class="text-xl font-semibold mb-4 flex items-center gap-2">
              <!-- Upload icon -->
              <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
              </svg>
              Logo du Club
            </h2>
            <div class="max-w-md">
              <label class="block mb-2">Logo officiel</label>
              <div class="border-2 border-dashed border-border rounded-lg p-8 text-center cursor-pointer hover:border-primary transition-colors">
                <svg class="w-10 h-10 mx-auto mb-2 text-muted-foreground" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                </svg>
                <p class="text-sm text-muted-foreground">Cliquez pour télécharger le logo</p>
                <p class="text-xs text-muted-foreground mt-1">Format recommandé : PNG ou SVG</p>
              </div>
            </div>
          </div>

          <!-- Informations de compte -->
          <div>
            <h2 class="text-xl font-semibold mb-4 flex items-center gap-2">
              <!-- Lock icon -->
              <svg class="w-5 h-5 text-accent" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <rect x="3" y="11" width="18" height="11" rx="2" ry="2" />
                <path stroke-linecap="round" stroke-linejoin="round" d="M7 11V7a5 5 0 0110 0v4" />
              </svg>
              Informations de Compte
            </h2>
            <div class="space-y-4">

              <div>
                <label for="email" class="block mb-2">
                  <!-- Mail icon -->
                  <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                  </svg>
                  Email du club *
                </label>
                <input
                  id="email"
                  v-model="form.email"
                  type="email"
                  placeholder="contact@votreclub.com"
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
                      <!-- Eye / EyeOff -->
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
              {{ form.processing ? 'Création en cours...' : 'Créer le compte club' }}
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
        <p class="text-sm text-muted-foreground">Vous êtes un joueur ou un recruteur ?</p>
        <div class="flex justify-center gap-4">
          <Link href="/player/signup" class="text-primary hover:underline">Inscription Joueur</Link>
          <Link href="/recruiter/signup" class="text-accent hover:underline">Inscription Recruteur</Link>
        </div>
      </div>

    </div>
  </div>
</template>