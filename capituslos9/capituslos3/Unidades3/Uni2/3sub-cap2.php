<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Etapas</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="2ssub-cap2.css"> <!-- Link para o arquivo CSS separado -->
</head>
<body>

    <div class="container">
        <div class="back-link">
            <i class="fas fa-arrow-left"></i>
            <a href="../../capitulos2.php">Voltar</a>
        </div>
    </div>

    <div class="header">
        <h1>Agora, selecione uma etapa!</h1>
        <p>Números 1</p>
        <p>Unidade - 2</p>
    </div>

    <div class="cards">
        <div class="card">
            <div class="stars">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
            </div>
            <h2>Etapa - 1</h2>
            <a href="atti/2att.php">Continuar</a>
            <p class="text-cor-por mt-2" id="progresso1">0%</p>
        </div>

        <div class="card">
            <div class="stars">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
            </div>
            <h2>Etapa - 2</h2>
            <a href="atti2/2att2.php">Continuar </a>
            <p class="text-cor-por mt-2" id="progresso2">0%</p>
        </div>

        <div class="card">
            <div class="stars">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
            </div>
            <h2>Etapa - 3</h2>
            <a href="atti/2att3.php">Continuar</a>
            <p class="text-cor-por mt-2" id="progresso3">0%</p>
        </div>


    
    <button onclick="zerarProgresso()">Zerar Progresso</button>

    <script>
        function atualizarPorcentagem() {
            for (let i = 1; i <= 4; i++) { 
                let progresso = parseInt(localStorage.getItem(`progressoEtapa${i}`)) || 0;
                document.getElementById(`progresso${i}`).textContent = `${progresso}%`; 
            }
        }
        
        function zerarProgresso() {
            for (let i = 1; i <= 4; i++) {
                localStorage.removeItem(`progressoEtapa${i}`); 
            }
            atualizarPorcentagem();
            alert("Progresso zerado!"); 
        }

        window.onload = atualizarPorcentagem;
    </script>
</body>
</html>
