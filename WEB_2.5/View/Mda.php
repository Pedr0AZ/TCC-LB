<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SinaLibras</title>
    <link rel="stylesheet" type="text/css" href="CSS/Mda.css">
    <link rel="stylesheet" type="text/css" href="CSS/Parte2Mda.css">
    <link rel="website icon" type="icon" href="CSS/IMAGEM/Favicon/favicon.ico">
</head>

<body>
<div class="sidebar collapsed">
    <div class="sidebar-header">
        <button id="toggle-sidebar">☰</button>
    </div>
    <ul class="sidebar-menu">
        <li>
            <button class="expand-btn">
                <i class="fas fa-folder"></i>
                <span>Topo</span>
                <i class="fas fa-chevron-down"></i>
            </button>
        </li>
        <li>
            <button class="expand-btn">
                <i class="fas fa-folder"></i>
                <span>Atividades</span>
                <i class="fas fa-chevron-down"></i>
            </button>
        </li>
        <li>
            <button class="expand-btn">
                <i class="fas fa-folder"></i>
                <span>Aprendizado</span>
                <i class="fas fa-chevron-down"></i>
            </button>
        </li>
    </ul>
</div>


    <div class="content">
        <!-- Seção 1: Início -->
        <div class="section" id="inicio">
            <h1>Bem-vindo ao SinaLibras!</h1>
            <img src="IMAGEM/exemplo1.jpg" alt="Imagem do início" class="section-img">
            <p>
                Explore um mundo de aprendizado com a tecnologia de Libras. Navegue pelas atividades e recursos
                exclusivos para melhorar suas habilidades.
            </p>
            <a href="#atividades" class="btn-sessão">Descubra as atividades →</a>
        </div>

        <script src="JS-View/BarradeMenu.js"></script>

</body>
<?php include "TopMenu.php"; ?>

</html>