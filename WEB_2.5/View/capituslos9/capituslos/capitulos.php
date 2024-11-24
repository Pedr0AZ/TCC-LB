<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
  <style>
    .hidden-menu {
      display: none;
    }

    .visible-menu {
      display: block;
    }
  </style>
</head>

  <body class="bg-gray-100">
    <div class="container mx-auto p-8">
      <h1 class="text-xl font-semibold mb-6">Selecione a unidade</h1>
      <div class="flex">
        <div class="w-1/4">
          <div class="bg-white p-4 rounded-lg shadow-md">
            <img alt="Capa da unidade" class="w-full mb-4" height="300" src="img/logo.jpeg" width="200"/>
            <h2 class="text-lg font-semibold">Alfabeto 1</h2>
            <p class="text-gray-500 mb-2">Continue assim! </p>
            <p class="text-gray-500"><span class="text-yellow-500 font-semibold">Você consegue</span></p>
          </div>

        </div>
        <div class="w-3/4 pl-8">
          <div class="grid grid-cols-2 gap-4">
            <div class="bg-white p-4 rounded-lg shadow-md">
              <h3 class="text-lg font-semibold">Unidade - 1</h3>
              <p class="text-gray-500">0/9 <i class="fas fa-star text-yellow-500"></i></p>
              <a href='Unidades\Uni1\sub-cap1.php'><button class="text-white bg-blue-900 rounded-full px-4 py-1 mt-2">Continuar!</button></a>
              <p class="text-blue-500 mt-2">0%</p>
            </div>

            <div class="bg-white p-4 rounded-lg shadow-md">
              <h3 class="text-lg font-semibold">Unidade - 2</h3>
              <p class="text-gray-500">0/9 <i class="fas fa-star text-yellow-500"></i></p>
              <a href="Unidades\Uni2\sub-cap2.php"><button class="text-white bg-blue-900 rounded-full px-4 py-1 mt-2">Continuar!</button></a>
              <p class="text-blue-500 mt-2">0%</p>
            </div>
            
            <!-- Unidade 3 -->
            <div class="bg-white p-4 rounded-lg shadow-md">
              <h3 class="text-lg font-semibold">Unidade 3</h3>
              <p class="text-gray-500">
                0/9
                <i class="fas fa-star text-yellow-500"></i>
              </p>
              <a href="Unidades\Uni3\sub-cap3.php"><button class="text-white bg-blue-900 rounded-full px-4 py-1 mt-2">Continuar!</button></a>
              <p class="text-blue-500 mt-2">0%</p>
            </div>

            <!-- Unidade 4 -->
            <div class="bg-white p-4 rounded-lg shadow-md">
              <h3 class="text-lg font-semibold">Unidade 4</h3>
              <p class="text-gray-500">
                0/9
                <i class="fas fa-star text-yellow-500"></i>
              </p>
              <a href="Unidades\Uni4\sub-cap4.php"><button class="text-white bg-blue-900 rounded-full px-4 py-1 mt-2">Continuar!</button></a>
              <p class="text-blue-500 mt-2">0%</p>
            </div>
            
            <!-- Unidade 5 -->
            <div class="bg-white p-4 rounded-lg shadow-md">
              <h3 class="text-lg font-semibold">Unidade 5</h3>
              <p class="text-gray-500">
                0/24
                <i class="fas fa-star text-yellow-500"></i>
              </p>
              <a href="Unidades\Uni5\sub-cap5.php"><button class="text-white bg-blue-900 rounded-full px-4 py-1 mt-2">Continuar!</button></a>
              <p class="text-blue-500 mt-2">0%</p>
            </div>

            <!-- Unidade 6 -->
            <div class="bg-white p-4 rounded-lg shadow-md">
              <h3 class="text-lg font-semibold">Unidade 6</h3>
              <p class="text-gray-500">
                0/21
                <i class="fas fa-star text-yellow-500"></i>
              </p>
              <a href="Unidades\Uni6\sub-cap6.php"><button class="text-white bg-blue-900 rounded-full px-4 py-1 mt-2">Continuar!</button></a>
              <p class="text-blue-500 mt-2">0%</p>
            </div>
            




          </div>
        </div>
      </div>
    </div>
    
    <script>
      function atualizarProgressoCapitulos() {
        // Recuperar progresso das etapas da Unidade 1
        const progresso1 = parseInt(localStorage.getItem('progressoEtapa1')) || 0;
        const progresso2 = parseInt(localStorage.getItem('progressoEtapa2')) || 0;
        const progresso3 = parseInt(localStorage.getItem('progressoEtapa3')) || 0;
    
        // Recuperar progresso das etapas da Unidade 2
        const progressoUnidade2Etapa1 = parseInt(localStorage.getItem('progressoUnidade2Etapa1')) || 0;
        const progressoUnidade2Etapa2 = parseInt(localStorage.getItem('progressoUnidade2Etapa2')) || 0;
        const progressoUnidade2Etapa3 = parseInt(localStorage.getItem('progressoUnidade2Etapa3')) || 0;
    
        // Recuperar progresso das etapas da Unidade 3
        const progressoUnidade3Etapa1 = parseInt(localStorage.getItem('progressoUnidade3Etapa1')) || 0;
        const progressoUnidade3Etapa2 = parseInt(localStorage.getItem('progressoUnidade3Etapa2')) || 0;
        const progressoUnidade3Etapa3 = parseInt(localStorage.getItem('progressoUnidade3Etapa3')) || 0;
    
        // Recuperar progresso das etapas da Unidade 4
        const progressoUnidade4Etapa1 = parseInt(localStorage.getItem('progressoUnidade4Etapa1')) || 0;
        const progressoUnidade4Etapa2 = parseInt(localStorage.getItem('progressoUnidade4Etapa2')) || 0;
        const progressoUnidade4Etapa3 = parseInt(localStorage.getItem('progressoUnidade4Etapa3')) || 0;
    
        // Recuperar progresso das etapas da Unidade 5
        const progressoUnidade5Etapa1 = parseInt(localStorage.getItem('progressoUnidade5Etapa1')) || 0;
        const progressoUnidade5Etapa2 = parseInt(localStorage.getItem('progressoUnidade5Etapa2')) || 0;
        const progressoUnidade5Etapa3 = parseInt(localStorage.getItem('progressoUnidade5Etapa3')) || 0;
    
        // Recuperar progresso das etapas da Unidade 6
        const progressoUnidade6Etapa1 = parseInt(localStorage.getItem('progressoUnidade6Etapa1')) || 0;
        const progressoUnidade6Etapa2 = parseInt(localStorage.getItem('progressoUnidade6Etapa2')) || 0;
        const progressoUnidade6Etapa3 = parseInt(localStorage.getItem('progressoUnidade6Etapa3')) || 0;
    
        // Recalcular o progresso total da Unidade 1
        const progressoTotalUnidade1 = Math.round((progresso1 * 0.33) + (progresso2 * 0.33) + (progresso3 * 0.34));
    
        // Recalcular o progresso total da Unidade 2
        const progressoTotalUnidade2 = Math.round((progressoUnidade2Etapa1 * 0.33) + (progressoUnidade2Etapa2 * 0.33) + (progressoUnidade2Etapa3 * 0.34));
    
        // Recalcular o progresso total da Unidade 3
        const progressoTotalUnidade3 = Math.round((progressoUnidade3Etapa1 * 0.33) + (progressoUnidade3Etapa2 * 0.33) + (progressoUnidade3Etapa3 * 0.34));
    
        // Recalcular o progresso total da Unidade 4
        const progressoTotalUnidade4 = Math.round((progressoUnidade4Etapa1 * 0.33) + (progressoUnidade4Etapa2 * 0.33) + (progressoUnidade4Etapa3 * 0.34));
    
        // Recalcular o progresso total da Unidade 5
        const progressoTotalUnidade5 = Math.round((progressoUnidade5Etapa1 * 0.33) + (progressoUnidade5Etapa2 * 0.33) + (progressoUnidade5Etapa3 * 0.34));
    
        // Recalcular o progresso total da Unidade 6
        const progressoTotalUnidade6 = Math.round((progressoUnidade6Etapa1 * 0.33) + (progressoUnidade6Etapa2 * 0.33) + (progressoUnidade6Etapa3 * 0.34));
    
        // Atualizar o progresso no localStorage para todas as unidades
        localStorage.setItem('progressoUnidade1', progressoTotalUnidade1);
        localStorage.setItem('progressoUnidade2', progressoTotalUnidade2);
        localStorage.setItem('progressoUnidade3', progressoTotalUnidade3);
        localStorage.setItem('progressoUnidade4', progressoTotalUnidade4);
        localStorage.setItem('progressoUnidade5', progressoTotalUnidade5);
        localStorage.setItem('progressoUnidade6', progressoTotalUnidade6);
    
        // Atualizar o elemento na página de capítulo 1
        const elementoProgressoUnidade1 = document.querySelector('.grid .bg-white:nth-child(1) .text-blue-500.mt-2');
        if (elementoProgressoUnidade1) {
          elementoProgressoUnidade1.textContent = `${progressoTotalUnidade1}%`;
        }
    
        // Atualizar o elemento na página de capítulo 2
        const elementoProgressoUnidade2 = document.querySelector('.grid .bg-white:nth-child(2) .text-blue-500.mt-2');
        if (elementoProgressoUnidade2) {
          elementoProgressoUnidade2.textContent = `${progressoTotalUnidade2}%`;
        }
    
        // Atualizar o elemento na página de capítulo 3
        const elementoProgressoUnidade3 = document.querySelector('.grid .bg-white:nth-child(3) .text-blue-500.mt-2');
        if (elementoProgressoUnidade3) {
          elementoProgressoUnidade3.textContent = `${progressoTotalUnidade3}%`;
        }
    
        // Atualizar o elemento na página de capítulo 4
        const elementoProgressoUnidade4 = document.querySelector('.grid .bg-white:nth-child(4) .text-blue-500.mt-2');
        if (elementoProgressoUnidade4) {
          elementoProgressoUnidade4.textContent = `${progressoTotalUnidade4}%`;
        }
    
        // Atualizar o elemento na página de capítulo 5
        const elementoProgressoUnidade5 = document.querySelector('.grid .bg-white:nth-child(5) .text-blue-500.mt-2');
        if (elementoProgressoUnidade5) {
          elementoProgressoUnidade5.textContent = `${progressoTotalUnidade5}%`;
        }
    
        // Atualizar o elemento na página de capítulo 6
        const elementoProgressoUnidade6 = document.querySelector('.grid .bg-white:nth-child(6) .text-blue-500.mt-2');
        if (elementoProgressoUnidade6) {
          elementoProgressoUnidade6.textContent = `${progressoTotalUnidade6}%`;
        }
      }
    
      // Chamar a função ao carregar a página
      window.onload = atualizarProgressoCapitulos;
    </script>
    
    
  </body>
</html>
