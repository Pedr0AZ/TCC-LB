<?php
include (__DIR__ . '/../Model/conexao.php');  //se der erro, tire o __DIR__
session_start();
include 'TopMenu.php';
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Configurações da Conta</title>
    <link rel="stylesheet" href="CSS/ConfigConta.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>

    <button class="back-button" onclick="window.history.back();">
        <i class="fas fa-arrow-left"></i>
    </button>


    <div class="container">
        <!-- Painel Esquerdo: Dados da Conta -->
        <div class="left-panel">
            <h2>Informações da Conta</h2>
            <div class="profile-section">
                <img class="profile" src="CSS/IMAGEM/PNG/perfil2.png" alt="Perfil Atual">
                <p class="username">Nome de Usuário: <span style="font-weight: bold"><?php echo $_SESSION['usuario_nome'] ?></span></p>
            </div>
            <div class="info">
                <label>Email:</label>
                <?php echo "<p>" . $_SESSION['usuario_email'] . "</p>"; ?>
            </div>
            <div class="info">
                <label>Senha:</label>
                <div class="password-container">
                    <input type="password" id="senha-display" value="<?php echo $_SESSION['usuario_senha'] ?>" readonly>
                    <span onclick="toggleSenha('senha-display', this)" class="eye-icon"></span>
                </div>
            </div>
            <div class="button-container">
                <button type="submit" class="blue-btn">Alterar Foto</button>
                <button type="submit" id="cancel-photo" class="red-btn hidden">Cancelar</button>
                <button type="submit" id="save-photo" class="yellow-btn hidden" style="font-weight:bold">Salvar Alterações</button>
            </div>
        </div>

        <div class="vertical-line"></div>

        <!-- Painel Direito: Alterar Configurações -->
        <div class="right-panel">
            <h2>Configurações</h2>

                <!-- Sub Painel de opções -->
                <div class="options">
                    <a id="alterar-link" class="options-link"><p>Alterar Informações</p> <span>></span></a>
                    <a id="sair-link" href="../Controller/PHP-Controller/logout.php" class="options-link"><p>Sair da Conta</p> <span>></span></a>
                    <a id="deletar-link" class="options-link"><p>Apagar Conta</p> <span>></span></a>
                    </div>

                <!-- Sub Painel de trocar a senha -->
                <div class="new-passwd hidden">
                    <form action="../Controller/PHP-Controller/edit.php" method="POST" >
                    <div class="input-container">
                        <label for="nome">Nome de Exibição:</label>
                        <input type="text" id="nome" name="nome" autocomplete="off">
                        <div class="error-message" id="error-nome"></div>
                    </div>
                    <div class="input-container">
                        <label for="email">Email:</label>
                        <input type="text" id="email" name="email" autocomplete="off">
                        <div class="error-message" id="error-email"></div>
                    </div>
                    <div class="input-container">
                        <label for="nova-senha">Nova Senha:</label>
                        <div class="input-container-senha">
                            <input type="password" id="nova-senha" name="nova-senha" autocomplete="off">
                            <span onclick="toggleSenha('nova-senha', this)" class="eye-icon"></span>
                        </div> 
                        <div class="error-message" id="error-senha"></div>
                    </div>
                    <div class="input-container">
                        <label for="confirmar-senha">Confirmar Nova Senha:</label>
                        <div class="input-container-senha">
                            <input type="password" id="confirmar-senha" name="confirmar-senha" autocomplete="off">
                            <span onclick="toggleSenha('confirmar-senha', this)" class="eye-icon"></span>
                        </div> 
                        <div class="error-message" id="error-confirmar"></div>
                    </div>
                        <!-- <div class="input-container">
                            <label for="imagem-perfil">Imagem de Perfil:</label>
                            <input type="file" name="imagem-perfil" id="imagem-perfil" accept="image/*" onchange="previewImagem()">
                            <img id="preview" class="profile-preview" src="" alt="Pré-visualização da Imagem" style="display:none;">
                        </div> -->
                        <div class="button-container">
                            <button type="submit" id="cancel-data" class="red-btn">Cancelar</button>
                            <button type="submit" id="save-data" class="yellow-btn">Salvar Alterações</button>
                        </div>

                    </form>
                </div>


                <div id="config-overlay" class="hidden">

                    <div id="deletar" class="card">  <!-- Card de Excluir conta ;_; -->
                        <h2>Excluir Conta</h2>
                        <?php
                            if (isset($_SESSION['mensagem_delete'])) {
                                if (isset($_GET['status']) && $_GET['status'] === 'success') {
                                    echo '<p style="font-weight: bold; color: green;">' . $_SESSION['mensagem_delete'] . '</p>';
                                    echo '<p style="margin-top: 8px;">Você será redirecionado para a página inicial em breve...</p><br>';
                                    echo '<meta http-equiv="refresh" content="4;url=Index.php">'; 
                                    session_destroy();
                                } else if (isset($_GET['status']) && $_GET['status'] === 'error') {
                                    echo '<p style="font-weight: bold; color:red;">' . $_SESSION['mensagem_delete'] . '</p>' . '<br>';
                                } else if (isset($_GET['status']) && $_GET['status'] === 'invalid') {
                                    echo '<p style="font-weight: bold; color:orange;">' . $_SESSION['mensagem_delete'] . '</p>' . '<br>';
                                }
                            }
                        ?>
                        <p>Tem certeza de que deseja excluir sua conta?<br>Essa ação é <spam style="font-weight: bold">irreversível</spam>.</p>
                            <form action="../Controller/PHP-Controller/delete.php" method="POST" class="form">
                                <button type="submit" class="btn btn-danger" id="delete-btn">Excluir</button>
                                <button type="button" class="btn btn-cancel" id="cancel-btn">Cancelar</button>
                            </form>
                    </div>
                </div>        
        </div>
    </div>

    <script src="JS-View/toggleSenha.js"></script>
    <script src="JS-View/Config.js"></script>
    <script src="JS-View/ConfigCard.js"></script>
</body>
</html>
