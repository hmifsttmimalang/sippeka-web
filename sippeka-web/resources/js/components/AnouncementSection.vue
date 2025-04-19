<template>
    <section id="services" class="features-details section">
      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Pengumuman</h2>
        <p>Hasil seleksi pengumuman peserta pelatihan pada tahun 2024!</p>
      </div>
  
      <div class="container">
        <div class="row gy-4 justify-content-between features-item">
          <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
            <img :src="asset('assets/user/img/features-1.jpg')" class="img-fluid" alt="" />
          </div>
  
          <div class="col-lg-5 d-flex align-items-center" data-aos="fade-up" data-aos-delay="200">
            <div class="content">
              <h3>Pengumuman Seleksi Peserta</h3>
              <p>
                Hasil seleksi peserta adalah informasi yang akurat! Informasi ini memuat data dari hasil tes ujian dan tes wawancara dengan menampilkan nilai yang diperoleh selama mengikuti seleksi pendaftaran.
              </p>
              <a href="{{ route('hasil-pengumuman') }}" class="btn more-btn">Lihat</a>
            </div>
          </div>
        </div>
      </div>
    </section>
</template>
  
<script setup>
  const asset = (path) => `/assets/${path}`; // Assume public folder path
</script>
  