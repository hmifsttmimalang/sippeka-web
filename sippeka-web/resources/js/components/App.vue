<template>
    <div id="app">
      <!-- Header -->
      <Header />
  
      <!-- Main Content -->
      <main>
        <router-view />
      </main>
  
      <!-- Footer -->
      <Footer />
  
      <!-- Scroll Top -->
      <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center">
        <i class="bi bi-arrow-up-short"></i>
      </a>
  
      <!-- Preloader -->
      <div id="preloader"></div>
    </div>
</template>
  
<script setup>
  import Header from './components/Header.vue'
  import Footer from './components/Footer.vue'
</script>
  
<style>
  /* Add any global styles if needed */
</style>
  