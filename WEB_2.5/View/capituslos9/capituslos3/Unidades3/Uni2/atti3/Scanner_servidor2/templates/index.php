<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Perguntas</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <h1>Bem-vindo ao Sistema de Perguntas!</h1>
    <p id="question"></p>

    <button id="start">Iniciar Scanner</button>
    <button id="stop">Parar Scanner</button>
    <p id="status"></p>
    <p id="score"></p>

    <script>
        $(document).ready(function() {
            function updateQuestion() {
                $.get('/get-current-question', function(data) {
                    $('#question').text(`Pergunta: ${data.current_question}`);
                });
            }

            // Atualiza a pontuação do servidor
            function updateScore() {
                $.get('/get-score', function(data) {
                    $('#score').text(`Pontuação: ${data.score}`);
                });
            }

            // Iniciar o script do scanner
            $('#start').click(function() {
                $.post('/run-script', function(data) {
                    $('#status').text(data.status);
                });
            });

            // Parar o script do scanner
            $('#stop').click(function() {
                $.post('/stop-script', function(data) {
                    $('#status').text(data.status);
                });
            });

            // Atualiza a pergunta e a pontuação a cada 2 segundos
            setInterval(updateQuestion, 2000);
            setInterval(updateScore, 2000);
        });
    </script>
</body>
</html>
