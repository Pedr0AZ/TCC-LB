<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Etapas</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="ssub-cap5.css"> <!-- Link para o arquivo CSS separado -->
</head>
<body>

    <div class="container">
        <div class="back-link"> 
            <i class="fas fa-arrow-left"></i>
            <a href="../../capitulos.php">Voltar</a>
        </div>
    </div>

    <div class="header">
        <h1>Agora, selecione uma etapa!</h1>
        <p>Alfabeto 1</p>
        <p>Unidade - 5</p>
    </div>

    <div class="cards">
        <div class="card">
            <div class="stars">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
            </div>
            <h2>Etapa - 1</h2>
            <a href="atti/att_uni5.php">Continuar</a>
            <p class="text-cor-por mt-2" id="progresso1">0%</p>
        </div>

        <div class="card">
            <div class="stars">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
            </div>
            <h2>Etapa - 2</h2>
            <a href="atti2/att2_uni5.php">Continuar </a>
            <p class="text-cor-por mt-2" id="progresso2">0%</p>
        </div>

        <div class="card">
            <div class="stars">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
            </div>
            <h2>Etapa - 3</h2>
            <a href="atti/att3_uni5.php">Continuar</a>
            <p class="text-cor-por mt-2" id="progresso3">0%</p>
        </div>


    
    <button onclick="zerarProgresso()">Zerar Progresso</button>

    <script>
        function concluirEtapa(etapa) {
            let progressoEtapa;
            switch (etapa) {
                case 1:
                    progressoEtapa = 100; // Etapa 1 concluída
                    localStorage.setItem('progressoUnidade5Etapa1', progressoEtapa);
                    break;
                case 2:
                    progressoEtapa = 100; // Etapa 2 concluída
                    localStorage.setItem('progressoUnidade5Etapa2', progressoEtapa);
                    break;
                case 3:
                    progressoEtapa = 100; // Etapa 3 concluída
                    localStorage.setItem('progressoUnidade5Etapa3', progressoEtapa);
                    break;
            }
            atualizarProgressoUnidade();
            atualizarPorcentagem();
        }
    
        function atualizarProgressoUnidade() {
            const progresso1 = parseInt(localStorage.getItem('progressoUnidade5Etapa1')) || 0;
            const progresso2 = parseInt(localStorage.getItem('progressoUnidade5Etapa2')) || 0;
            const progresso3 = parseInt(localStorage.getItem('progressoUnidade5Etapa3')) || 0;
    
            // Cálculo total da unidade 5
            const progressoTotalUnidade3 = Math.round((progresso1 * 0.33) + (progresso2 * 0.33) + (progresso3 * 0.34));
            
            // Salvar no localStorage o progresso da Unidade 5
            localStorage.setItem('progressoUnidade5', progressoTotalUnidade5);
        }
    
        function atualizarPorcentagem() {
            for (let i = 1; i <= 3; i++) { 
                let progresso = parseInt(localStorage.getItem(`progressoUnidade5Etapa${i}`)) || 0;
                document.getElementById(`progresso${i}`).textContent = `${progresso}%`; 
            }
        }
    
        function zerarProgresso() {
            for (let i = 1; i <= 3; i++) {
                localStorage.removeItem(`progressoUnidade5Etapa${i}`); 
            }
            atualizarPorcentagem();
            alert("Progresso zerado!"); 
        }
    
        window.onload = atualizarPorcentagem;
    </script>
</body>
</html>
