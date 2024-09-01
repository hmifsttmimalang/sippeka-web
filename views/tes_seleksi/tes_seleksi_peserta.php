<body>
  <div class="container mt-5">
    <div class="row">
      <div class="col-md-8">
        <div class="card">
          <div class="card-body">
            <div class="question-container">
              <div class="d-flex justify-content-between mb-3">
                <?php $currentQuestion = 1; ?>
                <h5>Soal No. <span id="current-question-number"><?= $currentQuestion; ?></span></h5>
                <span class="badge badge-info mb-2 justify-content-center timer" id="timer" style="height:30px; line-height:25px;">
                  <i class="bi bi-clock-fill"></i>
                  <span id="timer-text">1 jam 30 menit 00 detik</span>
                </span>
              </div>
              <hr class="sidebar-divider">
              <?php foreach ($questions as $question) : ?>
                <div id="question-<?= $question['id'] ?>" class="question" style="display: <?= $currentQuestion == $question['id'] ? 'block' : 'none'; ?>">
                  <p><?= $question['soal'] ?></p>
                  <div class="option-container">
                    <button class="btn btn-outline-primary option-btn">A</button>
                    <span><?= $question['pilihan_a'] ?></span>
                  </div>
                  <div class="option-container">
                    <button class="btn btn-outline-primary option-btn">B</button>
                    <span><?= $question['pilihan_b'] ?></span>
                  </div>
                  <div class="option-container">
                    <button class="btn btn-outline-primary option-btn">C</button>
                    <span><?= $question['pilihan_c'] ?></span>
                  </div>
                  <div class="option-container">
                    <button class="btn btn-outline-primary option-btn">D</button>
                    <span><?= $question['pilihan_d'] ?></span>
                  </div>
                  <div class="option-container">
                    <button class="btn btn-outline-primary option-btn">E</button>
                    <span><?= $question['pilihan_e'] ?></span>
                  </div>
                </div>
              <?php endforeach; ?>
              <hr class="sidebar-divider">
              <div class="navigation-buttons">
                <button class="btn btn-secondary" id="prev-question">Sebelumnya</button>
                <button class="btn btn-secondary" id="next-question">Selanjutnya</button>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card">
          <div class="card-body">
            <div class="mb-3 d-flex justify-content-center">
              <span class="badge badge-success mb-2" id="completed-badge" style="height: 30px; line-height: 25px;">
              </span>
            </div>
            <hr class="sidebar-divider">
            <div class="question-nav mb-3">
              <?php $i = 1;
              foreach ($questions as $item) : ?>
                <button class="btn btn-outline-primary" id="question-<?= $item['id']; ?>-nav"><?= $i++; ?></button>
              <?php endforeach; ?>
            </div>
            <hr class="sidebar-divider">
            <form action="/seleksi_peserta" method="post">
              <input type="hidden" name="userAnswers" value='<?= isset($_SESSION['userAnswers']) ? json_encode($_SESSION['userAnswers']) : json_encode([]); ?>'>
              <button class="btn btn-danger btn-block" id="finish-test">Akhiri Ujian</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>