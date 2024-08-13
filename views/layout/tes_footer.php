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