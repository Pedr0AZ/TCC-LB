<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Etapas</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="ssub-cap2.css"> <!-- Link para o arquivo CSS separado -->
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
            <a href="atti/att.php">Continuar</a>

            <p class="text-cor-por mt-2" id="progresso1">0%</p>
        </div>

        <div class="card">
            <div class="stars">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
            </div>
            <h2>Etapa - 2</h2>
            <a href="atti2/att2.php">Continuar </a>
            <p class="text-cor-por mt-2" id="progresso2">0%</p>
        </div>

        <div class="card">
            <div class="stars">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
            </div>
            <h2>Etapa - 3</h2>
            <a href="http://127.0.0.1:5002">Continuar</a>
            <p class="text-cor-por mt-2" id="progresso3">0%</p>
        </div>


    

    <script>
        function concluirEtapa(etapa) {
            let progressoEtapa;
            switch (etapa) {
                case 1:
                    progressoEtapa = 100; // Etapa 1 concluída
                    localStorage.setItem('progressoUnidade2Etapa1', progressoEtapa);
                    break;
                case 2:
                    progressoEtapa = 100; // Etapa 2 concluída
                    localStorage.setItem('progressoUnidade2Etapa2', progressoEtapa);
                    break;
                case 3:
                    progressoEtapa = 100; // Etapa 3 concluída
                    localStorage.setItem('progressoUnidade2Etapa3', progressoEtapa);
                    break;
            }
            atualizarProgressoUnidade();
            atualizarPorcentagem();
        }
    
        function atualizarProgressoUnidade() {
            const progresso1 = parseInt(localStorage.getItem('progressoUnidade2Etapa1')) || 0;
            const progresso2 = parseInt(localStorage.getItem('progressoUnidade2Etapa2')) || 0;
            const progresso3 = parseInt(localStorage.getItem('progressoUnidade2Etapa3')) || 0;
    
            // Cálculo total da unidade 2
            const progressoTotalUnidade2 = Math.round((progresso1 * 0.33) + (progresso2 * 0.33) + (progresso3 * 0.34));
            
            // Salvar no localStorage o progresso da Unidade 2
            localStorage.setItem('progressoUnidade2', progressoTotalUnidade2);
        }
    
        function atualizarPorcentagem() {
            for (let i = 1; i <= 3; i++) { 
                let progresso = parseInt(localStorage.getItem(`progressoUnidade2Etapa${i}`)) || 0;
                document.getElementById(`progresso${i}`).textContent = `${progresso}%`; 
            }
        }
    
        function zerarProgresso() {
            for (let i = 1; i <= 3; i++) {
                localStorage.removeItem(`progressoUnidade2Etapa${i}`); 
            }
            atualizarPorcentagem();
            alert("Progresso zerado!"); 
        }
    
        window.onload = atualizarPorcentagem;
    </script>
</body>
</html>
