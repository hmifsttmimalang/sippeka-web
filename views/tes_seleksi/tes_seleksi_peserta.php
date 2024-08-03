<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tes Seleksi Peserta</title>
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.css" rel="stylesheet">

  <style>
    body{
      background-color: #F9F9FF;
      color:#444444;
    }
    .question-container {
      border: 1px solid #ddd;
      padding: 20px;
      border-radius: 5px;
      margin-bottom: 20px;
    }
    .option-btn {
      display: inline-block;
      margin-right: 10px;
    }
    .option-container {
      display: flex;
      align-items: center;
      margin-bottom: 10px;
    }
    .timer {
      font-weight: bold;
      display: flex;
      align-items: center;
    }
    .timer i {
      margin-right: 8px;
    }
    .navigation-buttons {
      display: flex;
      justify-content: space-between;
      margin-top: 20px;
    }
    .question-nav button {
      margin-right: 5px;
      margin-bottom: 10px;
    }
  </style>
</head>
<body>

<div class="container mt-5">
  <div class="row">
    <div class="col-md-8">
      <div class="question-container">
        <div class="d-flex justify-content-between mb-3">
          <h5>Soal No. 1</h5>
          <span class="badge badge-info mb-2 justify-content-center timer" id="timer" style="height:30px; line-height:25px;">
            <i class="bi bi-clock-fill"></i>
            <span id="timer-text">1 jam, 30 menit, 00 detik</span>
          </span>
        </div>
        <hr class="sidebar-divider">
        <p>Kelipatan persekutuan dari 4 dan 7 adalah ......</p>
        <div class="option-container">
          <button class="btn btn-outline-primary option-btn">A</button>
          <span>48</span>
        </div>
        <div class="option-container">
          <button class="btn btn-outline-primary option-btn">B</button>
          <span>32</span>
        </div>
        <div class="option-container">
          <button class="btn btn-outline-primary option-btn">C</button>
          <span>28</span>
        </div>
        <div class="option-container">
          <button class="btn btn-outline-primary option-btn">D</button>
          <span>26</span>
        </div>
        <div class="option-container">
            <button class="btn btn-outline-primary option-btn">D</button>
            <span>93</span>
          </div>
        <hr class="sidebar-divider">
        <div class="navigation-buttons">
            <button class="btn btn-secondary">Sebelumnya</button>
            <button class="btn btn-secondary">Selanjutnya</button>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card">
        <div class="card-body">
            <div class="mb-3 d-flex justify-content-center">
                <span class="badge badge-success mb-2" style="height: 30px; line-height: 25px;">
                    1 Dikerjakan
                </span>
            </div>
            <hr class="sidebar-divider">
          <div class="question-nav mb-3">
            <button class="btn btn-primary">1</button>
            <button class="btn btn-secondary">2</button>
            <button class="btn btn-light">3</button>
            <button class="btn btn-light">4</button>
            <button class="btn btn-light">5</button>
            <button class="btn btn-light">6</button>
            <button class="btn btn-light">7</button>
            <button class="btn btn-primary">8</button>
            <button class="btn btn-light">9</button>
            <button class="btn btn-light">10</button>
          </div>
          <hr class="sidebar-divider"> 
          <a class="btn btn-danger btn-block" href="/user">Akhiri Ujian</a>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
  $(document).ready(function() {
    // Set the countdown time in seconds (1 hour 30 minutes = 5400 seconds)
    var countdownTime = 5400;

    function updateTimer() {
      var hours = Math.floor(countdownTime / 3600);
      var minutes = Math.floor((countdownTime % 3600) / 60);
      var seconds = countdownTime % 60;

      // Format the time as "HH jam, MM menit, SS detik"
      var formattedTime = hours + ' jam, ' + 
                          (minutes < 10 ? '0' : '') + minutes + ' menit, ' + 
                          (seconds < 10 ? '0' : '') + seconds + ' detik';

      $('#timer-text').text(formattedTime);

      // Decrement the countdown time
      countdownTime--;

      // Check if the countdown is over
      if (countdownTime < 0) {
        clearInterval(timerInterval);
        alert('Waktu pengerjaan telah habis!');
        // Optionally, you can submit the form or perform any other action here
      }
    }

    // Update the timer every second
    var timerInterval = setInterval(updateTimer, 1000);
  });
</script>
</body>
</html>
