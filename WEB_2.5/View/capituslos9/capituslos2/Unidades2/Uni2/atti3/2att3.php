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

        #pergunta-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-bottom: 20px;
        }

        #pergunta {
            font-size: 1.5em;
            color: #003366; /* Azul escuro para a pergunta */
            margin: 20px;
        }

        #imagem-pergunta {
            width: 200px;
            height: 200px;
            object-fit: contain;
            border-radius: 10px;
            margin-bottom: 20px;
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
                padding: 8px  16px;
            }
        }
    </style>
</head>
<body>
    <h1>Perguntas</h1>    

    <!-- Botão Voltar -->
    <a href="../sub-cap1.php"><button id="voltar">Voltar</button></a>

    <!-- Container da pergunta com imagem -->
    <div id="pergunta-container">
        <img id="imagem-pergunta" src="" alt="Imagem da pergunta">
        <h1 id="pergunta">Qual letra é formada com a mão fechada?</h1>
    </div>
    
    <!-- Imagens clicáveis -->
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
                pergunta: "Qual letra é formada com a mão fechada?",
                imagemPergunta: "A_teclado", // Imagem específica para a pergunta
                respostas: ["A_teclado", "B_teclado", "C_teclado", "D_teclado"],
                correta: 0,
                imagens: ["A_teclado", "B_teclado", "C_teclado", "D_teclado"]
            },
            {
                pergunta: "Qual é a letra B em libras?",
                imagemPergunta: "B_teclado", // Imagem específica para a pergunta
                respostas: ["B_teclado", "D_teclado", "C_teclado", "A_teclado"],
                correta: 0,
                imagens: ["B_teclado", "D_teclado", "C_teclado", "A_teclado"]
            },
            {
                pergunta: "Qual é a letra C em libras?",
                imagemPergunta: "C_teclado", // Imagem específica para a pergunta
                respostas: ["B_teclado", "C_teclado", "A_teclado", "D_teclado"],
                correta: 1,
                imagens: ["B_teclado", "C_teclado", "A_teclado", "D_teclado"]
            },
            {
                pergunta: "Qual é a letra D em libras?",
                imagemPergunta: "D_teclado", // Imagem específica para a pergunta
                respostas: ["A_teclado", "B_teclado", "D_teclado", "C_teclado"],
                correta: 2,
                imagens: ["A_teclado", "B_teclado", "D_teclado", "C_teclado"]
            },
            {
               // colocar mais perguntas    
            }
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

        function verificarResposta(img) {
            let resposta = perguntas[atual].respostas[img.alt];
            let correta = perguntas[atual].correta;

            if (img.alt == correta) {
                document.getElementById("proximo").style.display = "block"; // Mostra o botão de próxima pergunta

                document.getElementById("audio-acerto").play(); // Toca áudio de acerto
                alert("Parabéns, você acertou!");

            } else {
                document.getElementById("audio-erro").play(); // Toca áudio de erro
                alert("Erro, tente novamente!");
            }
        }

        function proximaPergunta() {
            atual++;
            if (atual >= perguntas.length) {
                document.getElementById("pergunta").innerHTML = "Parabéns, você concluiu todas as perguntas!";
                document.getElementById("imagens").style.display = "none"; // Esconde as imagens
                document.getElementById("imagem-pergunta").style.display = "none"; // Esconde a imagem da pergunta
                document.getElementById("voltarCapitulos").style.display = "block"; // Mostra o botão "Voltar para Capítulos"
            } else {
                document.getElementById("pergunta").innerHTML = perguntas[atual].pergunta;

                // Atualiza a imagem da pergunta
                document.getElementById("imagem-pergunta").style.display = "block"; // Exibe a imagem
                document.getElementById("imagem-pergunta").src = perguntas[atual].imagemPergunta ? `./img/${perguntas[atual].imagemPergunta}.png` : ""; // Define a imagem específica para a pergunta

                let imgs = document.querySelectorAll("#imagens img");
                for (let i = 0; i < imgs.length; i++) {
                    imgs[i].src = perguntas[atual].imagens.length > 0 ? `./img/${perguntas[atual].imagens[i]}.png` : ""; // Atualiza as imagens de resposta ou esconde se não houver
                    imgs[i].alt = i; // Atualiza o alt das imagens
                }

                document.getElementById("proximo").style.display = "none"; // Esconde o botão até o próximo acerto/erro
            }
            atualizarProgresso(); // Atualiza as bolinhas de progresso
        }

        function voltarPagina() {
            window.location.href = "capitulos.php";
        }

        // Exibe a imagem da primeira pergunta ao carregar
        window.onload = function() {
            inicializarProgresso();
            atualizarProgresso();
            
            // Exibe a imagem da primeira pergunta
            document.getElementById("imagem-pergunta").style.display = "block"; // Exibe a imagem
            document.getElementById("imagem-pergunta").src = perguntas[atual].imagemPergunta ? `./img/${perguntas[atual].imagemPergunta}.png` : ""; // Define a imagem da pergunta inicial
        }
    </script>
</body>
</html>
