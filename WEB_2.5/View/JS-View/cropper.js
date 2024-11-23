// Variável global do cropper
var cropper;

document.getElementById('imagem-perfil').addEventListener('change', function(event) {
    var file = event.target.files[0];
    var reader = new FileReader();

    reader.onload = function(e) {
        var image = document.getElementById('preview');
        image.src = e.target.result;

        // Destruir o cropper anterior se já houver
        if (cropper) {
            cropper.destroy();
        }

        // Inicializar o Cropper.js
        cropper = new Cropper(image, {
            aspectRatio: 1,
            preview: '.preview',
            responsive: true,
            cropBoxResizable: false
        });

        // Exibir a área de recorte
        document.getElementById('imagem-overlay').classList.remove('hidden');
    };

    reader.readAsDataURL(file);
});

// Lógica do botão de "prosseguir" para cortar e enviar a imagem
document.getElementById('proceed-crop').addEventListener('click', function() {
    if (!cropper) {
        console.error("O Cropper não foi inicializado.");
        return; // Garantir que o cropper foi inicializado antes de continuar
    }

    var croppedCanvas = cropper.getCroppedCanvas();

    // Verificar se a área cortada existe
    if (!croppedCanvas) {
        console.error("Erro ao cortar a imagem.");
        return;
    }

    var croppedImage = croppedCanvas.toDataURL('image/png');
    document.getElementById('foto-cortada').value = croppedImage;

    // Envia o formulário para upload da imagem cortada
    document.getElementById('form-upload-foto').submit();
});

// Lógica do botão de "cancelar" o crop
document.getElementById('cancel-crop').addEventListener('click', function() {
    document.getElementById('imagem-overlay').classList.add('hidden');
});
