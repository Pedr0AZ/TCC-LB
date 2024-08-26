<?php
include_once '../../Model/conexao.php';

//precisa fazer com que o botão de cadastrar redirecione pro index e só deixa a mensagem lá
//tbm tire a mensagem de conexão feita com sucesso do conexao.php
//por conta do SESSION o index vai ficar index.php, aí vai ter que alterar o final dos Indexs declarados

try {
    // Verifica se os dados foram enviados via POST
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $nome = trim($_POST['nome']);
        $email = trim($_POST['email']);
        $senha = trim($_POST['senha']);

        // Validação básica dos dados
        if (empty($nome) || empty($email) || empty($senha)) {
            echo "Por favor, preencha todos os campos obrigatórios.";
            exit();
        }

        // Verifica se o email já está cadastrado
        $sql = "SELECT COUNT(*) FROM usuarios WHERE email = :email";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        if ($stmt->fetchColumn() > 0) {
            echo "O email já está cadastrado.";
            exit();
        }

        // Insere os dados no banco de dados
        $sql = "INSERT INTO usuarios (nome, email, senha) VALUES (:nome, :email, :senha)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':senha', password_hash($senha, PASSWORD_DEFAULT)); // Use hash para armazenar a senha

        if ($stmt->execute()) {
            echo "Cadastro realizado com sucesso!";
            exit();
        } else {
            throw new Exception("Erro ao realizar o cadastro.");
        }
    }
} catch (Exception $e) {
    echo "Erro: " . $e->getMessage();
    exit();
}
?>
