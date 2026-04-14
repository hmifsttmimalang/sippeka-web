<main class="main">
    <style>
        .hidden { display: none; }
        .countdown-box {
            background: #fff;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.05);
            margin-top: -50px;
            position: relative;
            z-index: 10;
        }
    </style>

    <!-- Hero Section -->
    <section id="hero" class="hero section">
        <div class="hero-bg">
            <img src="{{ asset('assets/user/img/gambar_blk.jpeg') }}" alt="">
        </div>
        <div class="container text-center">
            <div class="d-flex flex-column justify-content-center align-items-center">
                <h1 data-aos="fade-up">Pengumuman Hasil Seleksi</h1>
                <p data-aos="fade-up" data-aos-delay="100">Informasi mencakup nilai tes ujian, tes wawancara, serta status seleksi.</p>
                <img src="{{ asset('assets/user/img/pengumuman_icon.png') }}" class="img-fluid hero-img" alt="" data-aos="zoom-out" data-aos-delay="300">
            </div>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="fw-bold" data-aos="fade-up">Hasil Peserta Seleksi</h2>
            </div>

            @if ($pengumumanWaktu)
                @if (!$isPassed)
                    <div id="countdownBox" class="countdown-box text-center mb-5" data-aos="zoom-in">
                        <h4 class="text-muted mb-4">Pengumuman Hasil Seleksi Akan Dibuka Dalam:</h4>
                        <div id="countdownInner">
                            <!-- JS will inject compartmentalized timer here -->
                            <div class="h3 fw-bold text-primary">Memuat Hitung Mundur...</div>
                        </div>
                        <p class="mt-4 small text-muted">Hasil akan diumumkan secara serentak pada: <br> 
                           <span class="fw-bold">{{ \Carbon\Carbon::parse($pengumumanWaktu)->translatedFormat('d F Y, H:i') }} WIB</span>
                        </p>
                    </div>
                @endif

                <div id="resultArea" class="{{ $isPassed ? '' : 'hidden' }}">
                    <div class="table-responsive" data-aos="fade-up">
                        <table class="table table-bordered table-hover align-middle">
                            <thead class="table-dark text-center">
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Keahlian</th>
                                    <th>Nilai Tes</th>
                                    <th>Wawancara</th>
                                    <th>Rata-Rata</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($listPendaftar as $index => $item)
                                    @php
                                        $rataRata = ($item->nilai_keahlian !== null && $item->nilai_wawancara !== null)
                                            ? ($item->nilai_keahlian + $item->nilai_wawancara) / 2
                                            : null;
                                    @endphp
                                    <tr class="text-center">
                                        <td>{{ $listPendaftar->firstItem() + $index }}</td>
                                        <td class="text-start fw-bold">{{ $item->nama }}</td>
                                        <td class="text-start">{{ $item->skill->nama ?? $item->keahlian }}</td>
                                        <td>{{ $item->nilai_keahlian !== null ? number_format($item->nilai_keahlian, 1) : '-' }}</td>
                                        <td>{{ $item->nilai_wawancara !== null ? number_format($item->nilai_wawancara, 1) : '-' }}</td>
                                        <td class="fw-bold">{{ $rataRata !== null ? number_format($rataRata, 1) : '-' }}</td>
                                        <td class="text-center">
                                            @php
                                                $statusLabel = $item->status;
                                                $badgeClass = match($statusLabel) {
                                                    'Lulus' => 'bg-success',
                                                    'Gagal' => 'bg-danger',
                                                    'Sedang Diproses' => 'bg-warning',
                                                    default => 'bg-secondary'
                                                };
                                            @endphp
                                            <span class="badge {{ $badgeClass }} px-3 py-1">
                                                {{ $statusLabel }}
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-4">
                        {{ $listPendaftar->links() }}
                    </div>
                </div>
            @else
                <div class="text-center py-5" data-aos="fade-up">
                    <i class="bi bi-clock-history text-muted display-1"></i>
                    <p class="mt-3 text-muted">Belum ada pengumuman hasil seleksi yang diatur oleh panitia.</p>
                </div>
            @endif
        </div>
    </section>

    @if ($pengumumanWaktu)
    <style>
        .timer-unit {
            background: linear-gradient(135deg, #007bff, #0056b3);
            color: white;
            padding: 15px;
            border-radius: 12px;
            min-width: 90px;
            box-shadow: 0 4px 15px rgba(0, 123, 255, 0.3);
            margin: 0 8px;
        }
        .timer-val {
            font-size: 2.5rem;
            font-weight: 800;
            display: block;
            line-height: 1;
        }
        .timer-label {
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            opacity: 0.8;
            margin-top: 5px;
        }
        @media (max-width: 576px) {
            .timer-unit { min-width: 70px; padding: 10px; margin: 0 4px; }
            .timer-val { font-size: 1.5rem; }
        }
    </style>
    <script>
        document.addEventListener('livewire:navigated', () => initCountdown());
        document.addEventListener('DOMContentLoaded', () => initCountdown());

        function initCountdown() {
            let targetStr = "{{ \Carbon\Carbon::parse($pengumumanWaktu)->toIso8601String() }}";
            let targetDate = new Date(targetStr).getTime();
            if (isNaN(targetDate)) return;

            let countdownBox = document.getElementById('countdownBox');
            let countdownInner = document.getElementById('countdownInner');
            let resultArea = document.getElementById('resultArea');

            let timer = setInterval(function() {
                let now = new Date().getTime();
                let diff = targetDate - now;

                if (diff < 0) {
                    clearInterval(timer);
                    if(countdownBox) countdownBox.remove();
                    if(resultArea) resultArea.classList.remove('hidden');
                    return;
                }

                let d = Math.floor(diff / (1000 * 60 * 60 * 24));
                let h = Math.floor((diff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                let m = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
                let s = Math.floor((diff % (1000 * 60)) / 1000);

                countdownInner.innerHTML = `
                    <div class="d-flex justify-content-center flex-wrap gap-2">
                        <div class="timer-unit"><span class="timer-val">${d}</span><div class="timer-label">Hari</div></div>
                        <div class="timer-unit"><span class="timer-val">${h}</span><div class="timer-label">Jam</div></div>
                        <div class="timer-unit"><span class="timer-val">${m}</span><div class="timer-label">Menit</div></div>
                        <div class="timer-unit"><span class="timer-val">${s}</span><div class="timer-label">Detik</div></div>
                    </div>
                `;
            }, 1000);
        }
    </script>
    @endif
</main>
