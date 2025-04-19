<template>
    <section id="features" class="features section">
      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Layanan</h2>
        <p>Apa yang didapat selama mengikuti pelatihan?</p>
      </div>
  
      <!-- Tab Content -->
      <div class="container">
        <div class="row justify-content-between">
          <div class="col-lg-5 d-flex align-items-center">
            <ul class="nav nav-tabs" data-aos="fade-up" data-aos-delay="100">
              <li class="nav-item" v-for="(item, index) in features" :key="index">
                <a class="nav-link" :class="{ active: index === 0 }" data-bs-toggle="tab" :data-bs-target="'#features-tab-' + (index + 1)">
                  <i :class="item.icon"></i>
                  <div>
                    <h4 class="d-none d-lg-block">{{ item.title }}</h4>
                    <p>{{ item.description }}</p>
                  </div>
                </a>
              </li>
            </ul>
          </div>
  
          <div class="col-lg-6">
            <div class="tab-content" data-aos="fade-up" data-aos-delay="200">
              <div
                v-for="(item, index) in features"
                :key="index"
                class="tab-pane fade"
                :class="{ 'active show': index === 0 }"
                :id="'features-tab-' + (index + 1)"
              >
                <img :src="asset(item.img)" alt="" class="img-fluid" />
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
</template>
  
<script setup>
  const features = [
    {
      icon: 'bi bi-binoculars',
      title: 'Peningkatan Keterampilan dan Kompetensi',
      description: 'Dengan Pelatihan yang berkualitas sesuai dengan kebutuhan industri, dapat langsung diterapkan di tempat kerja.',
      img: 'tabs-1.jpg',
    },
    {
      icon: 'bi bi-box-seam',
      title: 'Kesempatan Penempatan Kerja',
      description: 'Dengan jaringan industri yang dimiliki peserta dapat berkesempatan penempatan kerja setelah menyelesaikan pelatihan.',
      img: 'tabs-2.jpg',
    },
    {
      icon: 'bi bi-brightness-high',
      title: 'Meningkatkan Networking',
      description: 'Peserta dapat membangun jaringan profesional yang dapat mendukung perkembangan karir mereka di masa depan.',
      img: 'tabs-3.jpg',
    },
  ]
</script>
  