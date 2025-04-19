<template>
    <section id="features-details" class="features-details section">
      <div class="container">
        <div class="row gy-4 justify-content-between features-item" v-for="(item, index) in details" :key="index">
          <div class="col-lg-6" data-aos="fade-up" :data-aos-delay="100">
            <img :src="asset(item.img)" class="img-fluid" alt="" />
          </div>
          <div class="col-lg-5 d-flex align-items-center" data-aos="fade-up" :data-aos-delay="200">
            <div class="content">
              <h3>{{ item.title }}</h3>
              <p>{{ item.description }}</p>
              <a :href="item.link" class="btn more-btn">{{ item.buttonText }}</a>
            </div>
          </div>
        </div>
      </div>
    </section>
  </template>
  
  <script setup>
  const details = [
    {
      img: 'features-1.jpg',
      title: 'Segera daftarkan diri anda',
      description:
        'Keuntungan selama mengikuti pelatihan kerja di Balai Latihan Kerja Silastri sebagai investasi yang berharga untuk pengembangan keterampilan dan meningkatkan peluang dalam dunia kerja.',
      link: '/pendaftaran',
      buttonText: 'Daftar',
    },
    {
      img: 'features-2.jpg',
      title: 'Informasi Pelatihan',
      description: 'Informasi seputar jurusan yang tersedia, tata cara pendaftaran dan jadwal tes di UPT BLK Singosari Malang.',
      link: '/info-pelatihan',
      buttonText: 'Cek Disini!',
    },
  ]
  </script>
  