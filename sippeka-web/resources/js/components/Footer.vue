<template>
    <footer id="footer" class="footer position-relative light-background">
      <div class="container footer-top">
        <div class="row">
          <div class="col-lg-6 col-md-6 footer-about">
            <a :href="route('home')" class="logo d-flex align-items-center">
              <span class="sitename">SIPPEKA</span>
            </a>
            <div class="footer-contact pt-3">
              <p>Jl. Raya Singosari, Song Song, Ardimulyo,</p>
              <p>Kec. Singosari, Kabupaten Malang, Jawa Timur, 65153</p>
              <p class="mt-3"><strong>Telepon Kantor :</strong> <span>0341 - 458055</span></p>
              <p class="mt-3"><strong>WhatsApp:</strong> <span>08233435222</span></p>
              <p><strong>Email:</strong> <span>blk.singosari.jatim@gmail.com</span></p>
            </div>
  
            <div class="social-links d-flex mt-4">
              <a href="#"><i class="bi bi-twitter-x"></i></a>
              <a href="#"><i class="bi bi-facebook"></i></a>
              <a href="#"><i class="bi bi-instagram"></i></a>
              <a href="#"><i class="bi bi-linkedin"></i></a>
            </div>
          </div>
  
          <div class="col-lg-6 col-md-6 footer-newsletter">
            <h4>Informasi Terkini</h4>
            <p>Daftarkan email anda untuk mendapatkan informasi terkini di UPT BLK Singosari.</p>
            <form @submit.prevent class="php-email-form">
              <div class="d-flex w-100 gap-2">
                <label for="newsletter1" class="visually-hidden">Alamat email</label>
                <input id="newsletter1" type="text" class="form-control" placeholder="Alamat email" v-model="email">
                <button class="btn btn-primary" type="button" @click="subscribe">Subscribe</button>
              </div>
            </form>
          </div>
        </div>
      </div>
  
      <div class="container copyright text-center mt-4">
        <p>2024 © <span>Copyright</span><strong class="px-1 sitename">SIPPEKA</strong><span>All Rights Reserved</span></p>
        <div class="credits">
          Designed by <a href="https://bootstrapmade.com/" target="_blank">SIPPEKA</a>
        </div>
      </div>
    </footer>
</template>
  
<script setup>
  import { ref } from 'vue'
  import { route } from 'ziggy-js'
  
  const email = ref('')
  
  const subscribe = () => {
    if (!email.value) {
      alert('Silakan isi alamat email terlebih dahulu.')
      return
    }
    // Kirim ke endpoint real jika ada
    alert(`Terima kasih telah berlangganan, ${email.value}!`)
    email.value = ''
  }
</script>
  
<style scoped>
  /* Jika ada style spesifik, tambahkan di sini atau ambil dari main.css */
</style>
  