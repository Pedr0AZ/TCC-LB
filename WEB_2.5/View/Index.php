<?php session_start(); ?>

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
            <ul class="nav-links">
                <li><a href="Mda.html" id="Mda-btn">Atividades</a></li>
                <li><a href="#" id="login-btn">Login</a></li>
            </ul>
        </nav>
    </header>

      
      <div class="banner">
        <div class="banner-text">
          <h1>Aprenda Libras de forma <br> 
                    prática!</h1>
          <a href="Mda.html"><button class="buttonBanner"><span>Começar</span></button></a>
          
        </div>
      </div>
      
      <div class="section">
        <div class="text-content">
            <h2>Aprenda Libras com facilidade</h2>
            <p>Procurando uma maneira de saber Libras de forma online e prática ao mesmo tempo? Nosso site pode te satisfazer! Possuindo um escaner de mãos e mais outras formas ditaticas que te auxiliam no aprendizado de Libras! O SinaLibras te traz um aprendizado simples e objetiva. </p>
            <button class="cta-button">Comece já!</button>
        </div>
        <div class="image-content">
            <img src="CSS/IMAGEM/PNG/Logo-SinaLibras.png" alt="Descrição da imagem">
        </div>
    </div>
    <div class="section">
        <div class="image-content">
            <img src="CSS/IMAGEM/PNG/Logo-SinaLibras.png" alt="Descrição da imagem">
        </div>
        <div class="text-content">
            <h2>Faça login para salvar seu progresso!</h2>
            <p>você não precisa de uma conta para aprender com o nosso site, mas se possuir uma, seu progresso irá ser salvo, uma conta pode te ajudar a saber onde você parou na atividade e como está evoluindo com o passar das atividades completas.</p>
            <button class="cta-button">Descobrir agora</button>
        </div>
    </div>
    

    <div id="overlay" class="hidden">
        <!-- Card de Login -->
        <div id="loginCard">
            <form action="../Controller/PHP-Controller/login.php" method="POST" class="form">
                <div class="flex-column">
                    <h1>Login</h1>
                    <br>
                    <?php
                      if (isset($_SESSION['mensagem_login'])){
                        if ($_SESSION['mensagem_login'] === "Senha incorreta, por favor tente novamente"
                         || $_SESSION['mensagem_login'] === "Email não encontrado" ) {
                            echo '<div id="error-message">' . $_SESSION['mensagem_login'] . '</div>';
                            echo "<br>";
                            unset($_SESSION['mensagem_login']);  // Remove a mensagem da sessão
                        }else {
                            echo $_SESSION['mensagem_login'];
                            echo "<br> <br>";
                            //echo '<div class="mensagem">' . $_SESSION['mensagem_cadastro'] . '</div>';
                            unset($_SESSION['mensagem_login']);  // Remove a mensagem da sessão
                        }
                      }
                    ?>
                    <label>E-mail </label>
                    <div class="inputForm">
                        <input placeholder="E-mail" class="input" type="text" name="email" id="email" > 
                    </div>
                </div>
                <div class="flex-column">
                    <label>Senha </label>
                    <div class="inputForm">       
                        <input placeholder="Senha" class="input" type="password" name="senha" id="senha" > 
                    </div>
                </div>
                <div class="flex-row">
                    <span class="span">Esqueceu sua senha?</span> 
                </div>
                <input type="submit" class="button9-submit" value="Entrar" id="login-submit">
                <p class="p">Não tem uma conta?<span class="span" id="create-account-link">Criar conta</span></p> 
                <p class="p line">Ou cadastre-se com:</p> 
                <div class="flex-row">
                    <button class="btn9 google"> 
                        <svg xml:space="preserve" style="enable-background:new 0 0 512 512;" viewBox="0 0 512 512" y="0px" x="0px" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns="http://www.w3.org/2000/svg" id="Layer_1" width="20" version="1.1">
                            <path d="M113.47,309.408L95.648,375.94l-65.139,1.378C11.042,341.211,0,299.9,0,256
                                c0-42.451,10.324-82.483,28.624-117.732h0.014l57.992,10.632l25.404,57.644c-5.317,15.501-8.215,32.141-8.215,49.456
                                C103.821,274.792,107.225,292.797,113.47,309.408z" style="fill:#FBBB00;"></path>
                            <path d="M507.527,208.176C510.467,223.662,512,239.655,512,256c0,18.328-1.927,36.206-5.598,53.451
                                c-12.462,58.683-45.025,109.925-90.134,146.187l-0.014-0.014l-73.044-3.727l-10.338-64.535
                                c29.932-17.554,53.324-45.025,65.646-77.911h-136.89V208.176h138.887L507.527,208.176L507.527,208.176z" style="fill:#518EF8;"></path>
                            <path d="M416.253,455.624l0.014,0.014C372.396,490.901,316.666,512,256,512
                                c-97.491,0-182.252-54.491-225.491-134.681l82.961-67.91c21.619,57.698,77.278,98.771,142.53,98.771
                                c28.047,0,54.323-7.582,76.87-20.818L416.253,455.624z" style="fill:#28B446;"></path>
                            <path d="M419.404,58.936l-82.933,67.896c-23.335-14.586-50.919-23.012-80.471-23.012
                                c-66.729,0-123.429,42.957-143.965,102.724l-83.397-68.276h-0.014C71.23,56.123,157.06,0,256,0
                                C318.115,0,375.068,22.126,419.404,58.936z" style="fill:#F14336;"></path>
                        </svg>
                        Google
                    </button>
                    <button id="go-to-mda" class="button9-submit">Ir para o Menu de Atividades</button>
                </div>
            </form>
        </div>

        <!-- Card de Cadastro -->
        <div id="signupCard" class="hidden">
            <form action="../Controller/PHP-Controller/cadastro.php" method="POST" class="form">
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
                    <label>Nome </label>
                    <div class="inputForm">
                        <input placeholder="Nome" class="input" type="text" name="nome" id="nome" > 
                    </div>
                </div>
                <div class="flex-column">
                    <label>E-mail </label>
                    <div class="inputForm">
                        <input placeholder="E-mail" class="input" type="text" name="email" id="email" > 
                    </div>
                </div>
                <div class="flex-column">
                    <label>Senha </label>
                    <div class="inputForm">       
                        <input placeholder="Senha" class="input" type="password" name="senha" id="senha" > 
                    </div>
                </div>
                <div class="flex-row">
                    <label>Já tem uma conta?<span class="span" id="login-link">Login</span> </label>
                </div>
                <input type="submit" class="button9-submit" value="Cadastrar" id="signup-submit">
            </form>
        </div>
    </div>

    <script src="JS-View/Logincard.js"></script>
</body>
</html>
