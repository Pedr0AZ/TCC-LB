<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Perguntas</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        /* Estilos globais */
        body {
            font-family: Arial, sans-serif;
            background-color: #ffffff; /* Branco como cor principal */
            color: #333;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }

        h1 {
            color: #003366; /* Azul escuro para títulos */
            font-size: 2em;
            text-align: center;
            margin-top: 20px;
        }

        #question {
            font-size: 1.5em;
            color: #003366; /* Azul escuro para a pergunta */
            margin: 20px;
        }

        /* Botões */
        button {
            background-color: #003366; /* Azul como cor principal do botão */
            color: #ffffff;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            font-size: 1.2em;
            cursor: pointer;
            transition: background-color 0.3s ease;
            margin-top: 20px;
        }

        button:hover {
            background-color: #0055cc; /* Cor de hover para o botão */
        }

        /* Status e pontuação */
        #status, #score {
            font-size: 1.2em;
            margin: 10px;
        }
    </style>
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