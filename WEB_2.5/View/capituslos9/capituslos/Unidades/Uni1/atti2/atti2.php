<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Att</title>
    <style>
        /* Estilos globais */
        body {
            font-family: Arial, sans-serif;
            background-color: #ffffff;
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
            color: #003366;
            font-size: 2em;
            text-align: center;
            margin-top: 20px;
        }

        #pergunta-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-bottom: 20px;
        }

        #pergunta {
            font-size: 1.5em;
            color: #003366;
            margin: 20px;
        }

        #imagem-pergunta {
            width: 200px;
            height: 200px;
            object-fit: contain;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        .linha {
            display: flex;
            justify-content: space-around;
            width: 100%;
            max-width: 600px;
            margin: 10px 0;
        }

        .linha img {
            width: 180px;
            height: 150px;
            object-fit: cover;
            margin: 10px;
            cursor: pointer;
            border-radius: 10px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .linha img:hover {
            transform: scale(1.05);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        #proximo, #voltarCapitulos, #voltarInicio {
            background-color: #003366;
            color: #ffffff;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            font-size: 1.2em;
            cursor: pointer;
            transition: background-color 0.3s ease;
            margin-top: 20px;
            display: none;
        }

        #proximo:hover, #voltarCapitulos:hover, #voltarInicio:hover {
            background-color: #0055cc;
        }

        .progress {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .progress div {
            width: 20px;
            height: 20px;
            border-radius: 50%;
            background-color: #cccccc;
            margin: 5px;
            transition: background-color 0.3s ease;
        }

        .progress .active {
            background-color: #ffcc00;
        }

        #voltar {
            position: absolute;
            top: 10px;
            left: 10px;
            background-color: #ffcc00;
            color: #003366;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            font-size: 1em;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        #voltar:hover {
            background-color: #ffaa00;
        }

        @media (max-width: 600px) {
            .linha img {
                width: 100px;
                height: 80px;
            }

            #imagem-pergunta {
                width: 150px;
                height: 150px;
            }

            #proximo, #voltarCapitulos {
                width: 80%;
                font-size: 1em;
            }

            #voltar {
                font-size: 0.9em;
                padding: 8px 16px;
            }
        }
    </style>
</head>
<body>
    <h1>Perguntas</h1>

    <a href="../sub-cap1.html"><button id="voltar">Voltar</button></a>

    <div id="pergunta-container">
        <img id="imagem-pergunta" src="" alt="Imagem da pergunta">
        <h1 id="pergunta">Qual letra é formada com a mão fechada?</h1>
    </div>

    <div id="imagens">
        <div class="linha">
            <img src="./img/A_teclado.png" alt="0" onclick="verificarResposta(this)">
            <img src="./img/B_teclado.png" alt="1" onclick="verificarResposta(this)">
        </div>
        <div class="linha">
            <img src="./img/C_teclado.png" alt="2" onclick="verificarResposta(this)">
            <img src="./img/D_teclado.png" alt="3" onclick="verificarResposta(this)">
        </div>
    </div>

    <div id="feedback"></div>
    <a href="../../../capitulos.php"><button id="voltarCapitulos">Voltar aos Capítulos</button></a>
    <a href="atti2.php"><button id="voltarInicio">Reiniciar</button></a>

    <div class="progress">
        <div class="active"></div>
        <div></div>
        <div></div>
        <div></div>
    </div>
    <button id="proximo" onclick="proximaPergunta()">Próxima Pergunta</button>

    <script>
        let progresso = parseInt(localStorage.getItem('progressoEtapa2')) || 0;
        let perguntas = [
            {
                imagem: './img/A.png',
                pergunta: 'Qual letra é formada com a mão fechada?',
                respostaCorreta: 0
            },
            {
                imagem: './img/C.png',
                pergunta: 'Qual letra tem a forma arredondada?',
                respostaCorreta: 2
            },
            {
                imagem: './img/B.png',
                pergunta: 'Qual letra é formada com os dedos esticados?',
                respostaCorreta: 1
            },
            {
                imagem: './img/D.png',
                pergunta: 'Qual letra é formada com um ok?',
                respostaCorreta: 3
            }
        ];
    
        let perguntaAtual = 0;

        // Função para exibir a pergunta e imagem
        function mostrarPergunta() {
            let pergunta = perguntas[perguntaAtual];
            document.getElementById('imagem-pergunta').src = pergunta.imagem;
            document.getElementById('pergunta').textContent = pergunta.pergunta;
            document.getElementById('feedback').textContent = '';
            document.getElementById('proximo').style.display = 'none';
        }
    
        // Função para verificar a resposta
        function verificarResposta(elemento) {
            let resposta = parseInt(elemento.alt);
            let pergunta = perguntas[perguntaAtual];
            
            if (resposta === pergunta.respostaCorreta) {
                document.getElementById('feedback').textContent = 'Correto!';
                progresso += 25;
                if (progresso > 100) progresso = 100;
                localStorage.setItem('progressoEtapa2', progresso);
                atualizarProgresso();
                document.getElementById('proximo').style.display = 'block';
            } else {
                document.getElementById('feedback').textContent = 'Incorreto. Tente novamente.';
            }
        }

        // Função para passar para a próxima pergunta
        function proximaPergunta() {
            perguntaAtual++;
            if (perguntaAtual < perguntas.length) {
                mostrarPergunta();
            } else {
                alert('Você concluiu todas as perguntas!');
                document.getElementById('proximo').style.display = 'none';
                document.getElementById('voltarCapitulos').style.display = 'block';
                document.getElementById('voltarInicio').style.display = 'block';

                progresso = 0;
                localStorage.setItem('progressoEtapa2', progresso);
                atualizarProgresso();
            }
        }
    
        // Função para atualizar o progresso das bolinhas
        function atualizarProgresso() {
            const bolinhas = document.querySelectorAll('.progress div');
            let progressoAtual = Math.floor(progresso / 25);
            bolinhas.forEach((bolinha, index) => {
                if (index < progressoAtual) {
                    bolinha.classList.add('active');
                } else {
                    bolinha.classList.remove('active');
                }
            });
        }

        window.onload = function() {
            mostrarPergunta();
            atualizarProgresso();
        };
    </script>
</body>
</html>