<template>
    <main class="main">
      <!-- Hero Section -->
      <section id="hero" class="hero section">
        <div class="hero-bg">
          <img :src="asset('assets/user/img/hero-bg-light.webp')" alt="" />
        </div>
        <div class="container text-center">
          <div class="d-flex flex-column justify-content-center align-items-center">
            <h1 data-aos="fade-up">Selamat datang di <span>SIPPEKA</span></h1>
            <p data-aos="fade-up" data-aos-delay="100">Sistem Informasi Pendaftaran Pelatihan Pekerja</p>
            <div class="d-flex" data-aos="fade-up" data-aos-delay="200">
              <a href="#about" class="btn-get-started">Selengkapnya</a>
              <a
                href="https://youtu.be/fXYErrQAdVg?si=Fz8_QiY4QM5HdHYF"
                class="glightbox btn-watch-video d-flex align-items-center"
              >
                <i class="bi bi-play-circle"></i><span>Watch Video</span>
              </a>
            </div>
            <img
              :src="asset('assets/user/img/hero-services-img.webp')"
              class="img-fluid hero-img"
              alt=""
              data-aos="zoom-out"
              data-aos-delay="300"
            />
          </div>
        </div>
      </section>
  
      <!-- Featured Services Section -->
      <section id="featured-services" class="featured-services section">
        <div class="container">
          <div class="row gy-4">
            <ServiceItem
              icon="bi-briefcase"
              title="Balai Latihan Kerja"
              description="Fasilitas yang disediakan pemerintah dalam memberikan pelatihan keterampilan kepada masyarakat."
              :delay="100"
            />
            <ServiceItem
              icon="bi-card-checklist"
              title="Visi"
              description="Menjadi pusat unggulan pengembangan keterampilan tenaga kerja yang kompeten dan profesional."
              :delay="200"
            />
            <ServiceItem
              icon="bi-bar-chart"
              title="Misi"
              description="Menyediakan pelatihan berkualitas, bekerja sama dengan industri, dan mendukung penempatan kerja, sembari meningkatkan profesionalisme staf dan instruktur."
              :delay="300"
            />
          </div>
        </div>
      </section>
  
      <!-- About Section -->
      <section id="about" class="about section">
        <div class="container">
          <div class="row gy-4">
            <div class="col-lg-6 content" data-aos="fade-up" data-aos-delay="100">
              <p class="who-we-are">Tentang Kami</p>
              <h3>SILASTRI UPT BLK SINGOSARI</h3>
              <p class="fst-italic">
                Balai Latihan Kerja milik pemerintah di bawah naungan Direktorat Jenderal Pembinaan Pelatihan dan
                Produktivitas Kementerian Ketenagakerjaan Republik Indonesia...
              </p>
              <ul>
                <li><i class="bi bi-check-circle"></i> Penyediaan Program Pelatihan Berbasis Kebutuhan Industri.</li>
                <li><i class="bi bi-check-circle"></i> Fokus pada Pemberdayaan Masyarakat Melalui Pendidikan Keterampilan.</li>
                <li><i class="bi bi-check-circle"></i> Kolaborasi dengan Industri dan Pemerintah.</li>
              </ul>
            </div>
            <div class="col-lg-6 about-images" data-aos="fade-up" data-aos-delay="200">
              <div class="row gy-4">
                <div class="col-lg-6">
                  <img :src="asset('assets/user/img/about-company-1.jpg')" class="img-fluid" alt="" />
                </div>
                <div class="col-lg-6">
                  <img :src="asset('assets/user/img/about-company-2.jpg')" class="img-fluid mb-4" alt="" />
                  <img :src="asset('assets/user/img/about-company-3.jpg')" class="img-fluid" alt="" />
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
  
      <!-- Clients Section -->
      <section id="clients" class="clients section">
        <div class="container" data-aos="fade-up">
          <div class="row gy-4">
            <ClientLogo src="logo_jatim.png" />
            <ClientLogo src="logo_disnakertrans.png" />
            <ClientLogo src="logo_berakhlak.png" />
            <ClientLogo src="logo_bangga.png" />
            <ClientLogo src="logo_zona_integritas.png" />
          </div>
        </div>
      </section>
  
      <!-- Features Section -->
      <FeaturesSection />
  
      <!-- Features Details Section -->
      <FeaturesDetailsSection />
  
      <!-- Services Section (Pengumuman) -->
      <AnnouncementSection />
    </main>
</template>
  
<script setup>
  import ServiceItem from '../components/ServiceItem.vue'
  import ClientLogo from '../components/ClientLogo.vue'
  import FeaturesSection from '../components/FeaturesSection.vue'
  import FeaturesDetailsSection from '../components/FeaturesDetailsSection.vue'
  import AnnouncementSection from '../components/AnouncementSection.vue'
  
  // Asset helper to resolve public asset paths (Laravel mix/Vite compatible)
  const asset = (path) => `/storage/${path.replace(/^\/+/, '')}`
</script>
  