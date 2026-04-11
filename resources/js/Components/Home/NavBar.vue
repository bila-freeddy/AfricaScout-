<template>
  <nav :class="['fixed top-0 left-0 right-0 z-50 transition-all duration-300', scrolled ? 'bg-white shadow-md' : 'bg-white border-b border-gray-100']" class="px-6 py-4">
    <div class="max-w-7xl mx-auto flex items-center justify-between">

      <a href="/" class="flex items-center gap-2">
        <div class="w-9 h-9 bg-primary rounded-xl flex items-center justify-center">
          <span class="text-white font-bold">A</span>
        </div>
        <span class="font-bold text-xl text-gray-900">AfricaScout</span>
      </a>

      <div class="hidden md:flex items-center gap-8">
        <a href="#features" class="text-gray-600 hover:text-primary text-sm transition-colors">Fonctionnalités</a>
        <a href="#players" class="text-gray-600 hover:text-primary text-sm transition-colors">Joueurs</a>
        <a href="#testimonials" class="text-gray-600 hover:text-primary text-sm transition-colors">Témoignages</a>
        <a href="#pricing" class="text-gray-600 hover:text-primary text-sm transition-colors">Tarifs</a>
      </div>

      <div class="hidden md:flex items-center gap-3">
        <a href="/login" class="text-gray-600 hover:text-gray-900 text-sm font-medium px-4 py-2 hover:bg-gray-50 rounded-lg transition">Connexion</a>
        <a href="/inscription" class="bg-primary text-white px-5 py-2 rounded-lg text-sm font-semibold hover:bg-primary-dark transition">S'inscrire</a>
      </div>

      <button class="md:hidden p-2 hover:bg-gray-100 rounded-lg" @click="mobileOpen = !mobileOpen">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path v-if="mobileOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
          <path v-else stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
        </svg>
      </button>
    </div>

    <div v-if="mobileOpen" class="md:hidden pt-4 pb-6 space-y-3 border-t border-gray-100 mt-4">
      <a href="#features" class="block py-2 text-gray-600 hover:text-primary text-sm" @click="mobileOpen = false">Fonctionnalités</a>
      <a href="#players" class="block py-2 text-gray-600 hover:text-primary text-sm" @click="mobileOpen = false">Joueurs</a>
      <a href="#testimonials" class="block py-2 text-gray-600 hover:text-primary text-sm" @click="mobileOpen = false">Témoignages</a>
      <a href="#pricing" class="block py-2 text-gray-600 hover:text-primary text-sm" @click="mobileOpen = false">Tarifs</a>
      <div class="pt-2 space-y-2">
        <a href="/Login" class="block text-center border border-gray-200 py-2 rounded-xl text-sm hover:bg-gray-50 transition">Connexion</a>
        <a href="/inscription" class="block text-center bg-primary text-white py-2 rounded-xl text-sm font-semibold hover:bg-primary-dark transition">S'inscrire</a>
      </div>
    </div>
  </nav>
</template>

<script setup>
import { ref, onMounted, onUnmounted } from 'vue'

const mobileOpen = ref(false)
const scrolled = ref(false)

const handleScroll = () => { scrolled.value = window.scrollY > 50 }
onMounted(() => window.addEventListener('scroll', handleScroll))
onUnmounted(() => window.removeEventListener('scroll', handleScroll))
</script>