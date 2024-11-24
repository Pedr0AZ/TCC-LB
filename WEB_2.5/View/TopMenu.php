<?php

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SinaLibras</title>
    <link rel="stylesheet" type="text/css" href="CSS/Index.css">
    <link rel="website icon" type="icon" href="CSS/IMAGEM/Favicon/favicon.ico">
</head>

<body>
    <header>
            <nav class="navbar">
                <div class="logo">
                    <a href="Index.php">SinaLibras</a>
                </div>
                <div class="end">
                    <ul class="nav-links">
                        <li><a href="Mda.php" id="Mda-btn">Atividades</a></li>
                            <li><a href="#" id="login-btn">Login</a></li>
                    </ul>
                    <?php if (isset($_SESSION['logado']) && $_SESSION['logado'] === true): ?>
                        <div class="perfil" id="perfil">
                            <img src="CSS/IMAGEM/PNG/perfil2.png" class="user-pic" alt="Foto de perfil">
                        </div>
                    <?php endif; ?>
                </div>
            </nav>
    </header>

    <!-- DropDown Menu do Perfil -->
    <div id="perfilMenu-wrap" class="hidden">
        <div id="perfilMenu">
            <div class= "user-info">
                <div class="profile">
                    <img src="CSS/IMAGEM/PNG/perfil2.png" class="user-pic" alt="Foto de perfil">
                </div>
                <?php
                echo '<div class="perfilNome">' . "<h3>" . $_SESSION['usuario_nome'] . "</h3>" . '</div>';
                ?>
                <hr>
            </div>
            <div class="info-background">
                <ul class=perfilMenu-link>
                    <li><a href="#">Alterar Imagem</a></li>
                    <li><a href="ConfigConta.php">Configurações</a></li>
                    <li><a href="../Controller/PHP-Controller/logout.php" style="color: red">Sair da Conta</a></li>
                </ul>
            </div>
        </div>
    </div>

    <div id="overlay" class="hidden">
        <!-- Card de Login -->
        <div id="loginCard">
            <form action="../Controller/PHP-Controller/login.php?return_url=<?php echo urlencode($_SERVER['REQUEST_URI']); ?>" method="POST" class="form">
                <div class="flex-column">
                    <h1>Login</h1>
                    <br>
                    <?php
                      if (isset($_SESSION['mensagem_login'])){
                        if ($_SESSION['mensagem_login'] === "Login realizado com sucesso!" ) {
                            echo '<div id="message" style="color: green;">' . $_SESSION['mensagem_login'] . '</div>';
                            echo "<br>";
                            unset($_SESSION['mensagem_login']);  
                        }else {
                            echo '<div id="message" style="color: red;">' . $_SESSION['mensagem_login'] . '</div>';
                            echo "<br> <br>";
                            unset($_SESSION['mensagem_login']); 
                        }
                      }
                    ?>
                    <label for="email">E-mail </label>
                    <div class="inputForm">
                        <input placeholder="E-mail" class="input" type="text" name="email" id="email" > 
                    </div>
                </div>
                <div class="flex-column">
                    <label for="senha">Senha </label>
                    <div class="inputForm">       
                        <input placeholder="Senha" class="input" type="password" name="senha" id="senha" >
                        <span onclick="toggleSenha('senha', this)" class="eye-icon"></span>
                    </div>
                </div>
                <div class="flex-row">
                    <span class="span">Esqueceu sua senha?</span> 
                </div>
                <input type="submit" class="button9-submit" value="Entrar" id="login-submit">
                <div class="p" id="login-p"><p>Não tem uma conta?<span class="span" id="create-account-link">Criar conta</span></p></div>
                <div class="flex-row">
                    <button id="go-to-mda" class="button-mda hidden">Ir para o Menu de Atividades</button>
                </div>
            </form>
        </div>

        <!-- Card de Cadastro -->
        <div id="signupCard" class="hidden">
            <form action="../Controller/PHP-Controller/cadastro.php?return_url=<?php echo urlencode($_SERVER['REQUEST_URI']); ?>" method="POST" class="form">
                <div class="flex-column">
                    <h1>Cadastro</h1>
                    <br>
                    <?php
                      if (isset($_SESSION['mensagem_cadastro'])) {
                        echo $_SESSION['mensagem_cadastro'];
                        echo "<br> <br>";
                        //echo '<div class="mensagem">' . $_SESSION['mensagem_cadastro'] . '</div>';
                        unset($_SESSION['mensagem_cadastro']);  // Remove a mensagem da sessão
                      }
                    ?>
                    <label for="nome">Nome </label>
                    <div class="inputForm">
                        <input placeholder="Nome" class="input" type="text" name="nome" id="nome" > 
                    </div>
                </div>
                <div class="flex-column">
                    <label for="email">E-mail </label>
                    <div class="inputForm">
                        <input placeholder="E-mail" class="input" type="text" name="email" id="email" > 
                    </div>
                </div>
                <div class="flex-column">
                    <label for="senha">Senha </label>
                    <div class="inputForm">       
                        <input placeholder="Senha" class="input" type="password" name="senha" id="senha2" >
                        <span onclick="toggleSenha('senha2', this)" class="eye-icon"></span>
                    </div>
                </div>
                <div class="flex-row">
                    <p>Já tem uma conta?<span class="span" id="login-link">Login</span> </p>
                </div>
                <input type="submit" class="button9-submit" value="Cadastrar" id="signup-submit">
            </form>
        </div>
    </div>

    <script src="JS-View/Logincard.js"></script>
    <script src="JS-View/toggleSenha.js"></script>
</body>
</html>
