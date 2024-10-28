<?php
include "../../Model/conexao.php";
include "TopMenu.php";
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SinaLibras</title>
    <link rel="stylesheet" type="text/css" href="CSS/Index.css">
    <link rel="website icon" type="icon" href="CSS/IMAGEM/Favicon/favicon.ico">
</head>
<body>
    <div class="section"> <!-- esse section faz com que o TopMenu não se sobreponha ao texto -->
        <div class="text-content">
        <h2>Faça login para salvar seu progresso!</h2>
            <p>você não precisa de uma conta para aprender com o nosso site, mas se possuir uma, seu progresso irá ser salvo, uma conta pode te ajudar a saber onde você parou na atividade e como está evoluindo com o passar das atividades completas.</p>
            <button class="cta-button">Descobrir agora</button>
        </div>
        <div class="text-content">
            <?php
            echo "<p>" . $_SESSION['usuario_id'] . "</p>";
            echo "<p>" . $_SESSION['usuario_nome'] . "</p>";
            echo "<p>" . $_SESSION['usuario_senha'] . "</p>";
            echo "<p>" . $_SESSION['senha_hash'] . "</p>";
            echo "<p>" . $_SESSION['usuario_email'] . "</p>";
            ?>
            <br><br><br>
            <form action="../Controller/PHP-Controller/logout.php" method="POST">
                <button type="submit" class="cta-button">Logout Teste</button>
            </form>
        </div>
    </div>

</body>
</html>