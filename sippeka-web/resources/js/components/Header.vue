<template>
    <header id="header" class="header d-flex align-items-center fixed-top">
      <div class="container-fluid container-xl position-relative d-flex align-items-center">
        <a :href="route('home')" class="logo d-flex align-items-center me-auto">
          <img :src="asset('assets/user/img/silastri/logo_jatim.png')" alt="">
          <h1 class="sitename">SIPPEKA</h1>
        </a>
  
        <nav id="navmenu" class="navmenu">
          <ul>
            <li><a href="#hero" class="active">Beranda</a></li>
            <li><a href="#about">Tentang Kami</a></li>
            <li><a href="#features">Layanan</a></li>
            <li><a href="#services">Pengumuman</a></li>
            <template v-if="auth.user">
              <li class="mobile-only">
                <a :href="route('user.dashboard', { username: auth.user.username })">{{ auth.user.username }}</a>
              </li>
              <li class="mobile-only">
                <form :action="route('auth.logout')" method="POST">
                  <input type="hidden" name="_token" :value="csrf">
                  <button type="submit" class="logout-btn">Keluar</button>
                </form>
              </li>
            </template>
            <template v-else>
              <li class="mobile-only"><a :href="route('auth.login')">Masuk</a></li>
              <li class="mobile-only"><a :href="route('auth.register')">Buat Akun</a></li>
            </template>
          </ul>
          <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>
  
        <div class="auth-buttons d-none d-xl-flex">
          <template v-if="auth.user">
            <a class="btn-getstarted" :href="route('user.dashboard', { username: auth.user.username })">
              {{ auth.user.username }}
            </a>
            <form :action="route('auth.logout')" method="POST" class="d-inline">
              <input type="hidden" name="_token" :value="csrf">
              <button class="btn btn-getstarted" type="submit">Keluar</button>
            </form>
          </template>
          <template v-else>
            <a class="btn-getstarted" :href="route('auth.login')">Masuk</a>
            <a class="btn-getstarted" :href="route('auth.register')">Buat Akun</a>
          </template>
        </div>
      </div>
    </header>
</template>
  
<script setup>
  import { usePage } from '@inertiajs/vue3'
  import { route } from 'ziggy-js'
  
  const page = usePage()
  const auth = page.props.auth || {}
  const csrf = page.props.csrf || ''
</script>
  
<style scoped>
  /* Style dari Blade tinggal kamu copas langsung ke sini */
  .auth-buttons {
    display: flex;
    align-items: center;
    gap: 10px;
  }
  .logout-btn {
    background: none;
    font-family: 'Inter', sans-serif;
    border: none;
    font-size: 17px;
    text-decoration: none;
    cursor: pointer;
    padding: 10px 20px;
    margin: 0;
  }
  .auth-buttons button {
    padding: 10px 20px;
  }
  @media (max-width: 1024px) {
    .mobile-only {
      display: block;
      text-align: left;
    }
    .navmenu ul li {
      margin-bottom: 15px;
    }
  }
  @media (min-width: 1025px) {
    .auth-buttons {
      display: flex;
      align-items: center;
    }
    .mobile-only {
      display: none;
    }
  }
</style>
  