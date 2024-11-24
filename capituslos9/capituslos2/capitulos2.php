<!DOCTYPE html>
<html>

<head>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
  <link rel="stylesheet" href="capitulo2.css"> 
</head>

  <body class="bg-gray-100">
    <div class="container mx-auto p-8">
      <h1 class="text-xl font-semibold mb-6">Selecione a unidade</h1>
      <div class="flex">
        <div class="w-1/4">
          <div class="bg-white p-4 rounded-lg shadow-md">
            <img alt="Capa da unidade" class="w-full mb-4" height="300" src="img/logo.jpeg" width="200"/>
            <h2 class="text-lg font-semibold">Numeros 1</h2>
            <p class="text-gray-500 mb-2">Você completou <span class="text-yellow-500 font-semibold">0%</span> deste livro.</p>
            <p class="text-gray-500">Continue assim!</p>
          </div>

        </div>
        <div class="w-3/4 pl-8">
          <div class="grid grid-cols-2 gap-4">
            <div class="bg-white p-4 rounded-lg shadow-md">
              <h3 class="text-lg font-semibold">Unidade - 1</h3>
              <p class="text-gray-500">0/24 <i class="fas fa-star text-yellow-500"></i></p>
              <a href='Unidades2\Uni1\2sub-cap1.php'><button class="text-white bg-blue-900 rounded-full px-4 py-1 mt-2">Continuar!</button></a>
              <p class="text-blue-500 mt-2">0%</p>
            </div>

            <div class="bg-white p-4 rounded-lg shadow-md">
              <h3 class="text-lg font-semibold">Unidade - 2</h3>
              <p class="text-gray-500">0/24 <i class="fas fa-star text-yellow-500"></i></p>
              <a href="Unidades2\Uni2\2sub-cap2.php"><button class="text-white bg-blue-900 rounded-full px-4 py-1 mt-2">Continuar!</button></a>
              <p class="text-blue-500 mt-2">0%</p>
            </div>
            
            <!-- Unidade 3 -->
            <div class="bg-white p-4 rounded-lg shadow-md">
              <h3 class="text-lg font-semibold">Unidade 3</h3>
              <p class="text-gray-500">
                0/30
                <i class="fas fa-star text-yellow-500"></i>
              </p>
              <a href="Unidades2\Uni3\sub-cap3.php"><button class="text-white bg-blue-900 rounded-full px-4 py-1 mt-2">Continuar!</button></a>
              <p class="text-blue-500 mt-2">0%</p>
            </div>






          </div>
        </div>
      </div>
    </div>
  </body>
</html>
