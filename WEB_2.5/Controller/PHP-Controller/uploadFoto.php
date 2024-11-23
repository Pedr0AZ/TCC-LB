<?php
session_start();
include_once('../Model/conexao.php');

// Verifique se a imagem foi recebida
if (isset($_POST['foto'])) {
    // Dados da imagem
    $fotoData = $_POST['foto'];
    $fotoData = str_replace('data:image/png;base64,', '', $fotoData);
    $fotoData = str_replace(' ', '+', $fotoData);
    $fotoDecoded = base64_decode($fotoData);

    // Caminho para salvar a imagem
    $fileName = 'foto_' . uniqid() . '.png';
    $filePath = '../uploads/' . $fileName;

    // Salvar a imagem
    if (file_put_contents($filePath, $fotoDecoded)) {
        // Sucesso
        $response = array(
            'success' => true,
            'message' => 'Imagem salva com sucesso!',
            'file' => $filePath
        );
    } else {
        // Erro
        $response = array(
            'success' => false,
            'message' => 'Erro ao salvar a imagem.'
        );
    }
} else {
    $response = array(
        'success' => false,
        'message' => 'Nenhuma imagem recebida.'
    );
}

echo json_encode($response);
?>
