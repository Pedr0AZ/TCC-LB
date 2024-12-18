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

        #pergunta {
            font-size: 1.5em;
            color: #003366; /* Azul escuro para a pergunta */
            margin: 20px;
        }

        /* Estilo das linhas com imagens */
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

        /* Botão "Próxima Pergunta" */
        #proximo, #voltarCapitulos {
            background-color: #003366; /* Azul como cor principal do botão */
            color: #ffffff;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            font-size: 1.2em;
            cursor: pointer;
            transition: background-color 0.3s ease;
            margin-top: 20px;
            display: none; /* Oculto inicialmente */
        }

        #proximo:hover, #voltarCapitulos:hover {
            background-color: #0055cc; /* Cor de hover para o botão */
        }

        /* Bolinhas de progresso */
        .progress {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .progress div {
            width: 20px;
            height: 20px;
            border-radius: 50%;
            background-color: #cccccc; /* Cinza inicialmente */
            margin: 5px;
            transition: background-color 0.3s ease;
        }

        .progress .active {
            background-color: #ffcc00; /* Amarelo para perguntas já respondidas */
        }

        /* Botão "Voltar" */
        #voltar {
            position: absolute;
            top: 10px;
            left: 10px;
            background-color: #ffcc00; /* Amarelo como cor do botão */
            color: #003366; /* Azul escuro para o texto */
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            font-size: 1em;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        #voltar:hover {
            background-color: #ffaa00; /* Cor de hover para o botão "Voltar" */
        }

        /* Responsividade */
        @media (max-width: 600px) {
            .linha img {
                width: 100px;
                height: 80px;
            }

            #proximo, #voltarCapitulos {
                width: 80%;
                font-size: 1em;
            }

            #voltar {
                font-size: 0.9em;
                padding: 8px  16px;
            }
        }
    </style>
</head>
<body>
    <h1>Perguntas</h1>    

    <!-- Botão Voltar -->
    <a href="../3sub-cap1.php"><button id="voltar">Voltar</button></a>

    <!-- Pergunta -->
    <h1 id="pergunta">Qual é o número 0 em libras?</h1>
    
    <!-- Imagens clicáveis -->
    <div id="imagens">
      <div class="linha">
        <img src="./img/obrigado.jpg" alt="0" onclick="verificarResposta(this)">
        <img src="./img/oi.jpg" alt="1" onclick="verificarResposta(this)">
      </div>
      <div class="linha">
        <img src="./img/tchau.jpg" alt="2" onclick="verificarResposta(this)">
        <img src="./img/eu.jpg" alt="3" onclick="verificarResposta(this)">
      </div>
    </div>

    <!-- Botão para ir para outra pergunta -->
    <button id="proximo" onclick="proximaPergunta()">Próxima pergunta</button>

    <!-- Botão para voltar para capítulos -->
    <button id="voltarCapitulos" onclick="voltarPagina()">Voltar para Capítulos</button>

    <!-- Bolinhas de progresso -->
    <div class="progress" id="progresso"></div>

    <audio id="audio-acerto" src="YEASSSSS.m4a" type="audio/m4a"></audio>
    <audio id="audio-erro" src="FART ATTACK.m4a" type="audio/m4a"></audio>
    
    <script>
        let perguntas = [
            {
                pergunta: "Qual é a palavra OI em libras?",
                respostas: ["1", "2", "3", "0"],
                correta: 3,
                imagens: ["1", "2", "3", "0"]
            },
            {
                pergunta: "Qual é a palavra OBRIGADO em libras?",
                respostas: ["2", "1", "0", "3"],
                correta: 1,
                imagens: ["2", "1", "0", "3"]
            },
            {
                pergunta: "Qual é a palavra TCHAU em libras?",
                respostas: ["2", "0", "1", "3"],
                correta: 0,
                imagens: ["2", "0", "1", "3"]
            },
            {
                pergunta: "Qual é a palavra EU em libras?",
                respostas: ["0", "2", "3", "1"],
                correta: 2,
                imagens: ["0", "2", "3", "1"]
            },
            // Adicione mais perguntas aqui
        ];

        let atual = 0;

        // Inicializa as bolinhas de progresso
        function inicializarProgresso() {
            let progressoDiv = document.getElementById("progresso");
            progressoDiv.innerHTML = ''; // Limpa o conteúdo atual
            for (let i = 0; i < perguntas.length; i++) {
                let bolinha = document.createElement("div");
                progressoDiv.appendChild(bolinha);
            }
        }

        // Atualiza a cor das bolinhas com base na pergunta atual
        function atualizarProgresso() {
            let progressoDiv = document.getElementById("progresso").children;
            for (let i = 0; i < progressoDiv.length; i++) {
                if (i <= atual) {
                    progressoDiv[i].classList.add("active"); // Adiciona cor amarela às respondidas
                } else {
                    progressoDiv[i].classList.remove("active"); // Remove o amarelo das não respondidas
                }
            }
        }

        function atualizarProgressoEtapa(etapa) {
            let progresso = parseInt(localStorage.getItem(`progressoEtapa${etapa}`)) || 0; // Pega o progresso da etapa específica
            progresso += 25; // Aumenta 25% (ou ajuste conforme necessário)
            if (progresso > 100) progresso = 100; // Limita a 100%
            localStorage.setItem(`progressoEtapa${etapa}`, progresso); // Armazena o novo progresso
        }

        function verificarResposta(img) {
            let resposta = perguntas[atual].respostas[img.alt];
            let correta = perguntas[atual].correta;
        
            if (img.alt == correta) {
                document.getElementById("proximo").style.display = "block"; // Mostra o botão de próxima pergunta
                document.getElementById("audio-acerto").play(); // Toca áudio de acerto
                alert("Parabéns, você acertou!");
                
                atualizarProgressoEtapa(1); // Atualiza o progresso da Etapa 1 (25% a cada acerto)
            } else {
                document.getElementById("audio-erro").play(); // Toca áudio de erro
                alert("Erro, tente novamente!");
            }
        }
        function proximaPergunta() {
            atual++;
            if (atual >= perguntas.length) {
                atual = 0; // Volta para a primeira pergunta se terminar
                document.getElementById("proximo").style.display = "none"; // Esconde o botão "Próxima Pergunta"
                document.getElementById("voltarCapitulos").style.display = "block"; // Mostra o botão "Voltar para Capítulos"
            } else {
                document.getElementById("pergunta").innerHTML = perguntas[atual].pergunta;
                let imgs = document.querySelectorAll("#imagens img");
                for (let i = 0; i < imgs.length; i++) {
                    imgs[i].src = `./img/${perguntas[atual].imagens[i]}.jpg`; // Atualiza as imagens
                    imgs[i].alt = i; // Atualiza o alt das imagens
                }
                document.getElementById("proximo").style.display = "none"; // Esconde o botão até o próximo acerto/erro
            }
            atualizarProgresso(); // Atualiza as bolinhas de progresso
        }

        // Função do botão "Voltar"
        function voltarPagina() {
            window.history.back(); // Retorna para a página anterior
        }

        // Inicia com a primeira pergunta e define as bolinhas de progresso
        inicializarProgresso();
        atualizarProgresso();
    </script>
</body>
</html>