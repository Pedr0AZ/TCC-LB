document.getElementById('imagem-perfil').addEventListener('change', function(event) {
    var file = event.target.files[0];
    var reader = new FileReader();
    
    reader.onload = function(e) {
        var image = document.getElementById('preview');
        image.src = e.target.result;

        // Inicializa o Cropper.js
        var cropper = new Cropper(image, {
            aspectRatio: 1,
            preview: '.preview',
            responsive: true,
            cropBoxResizable: false
        });

        // Mostrar a área de recorte
        document.getElementById('imagem-overlay').classList.remove('hidden');

        // Agora o cropper pode ser usado
        document.getElementById('proceed-crop').addEventListener('click', function() {
            var croppedCanvas = cropper.getCroppedCanvas();
            var croppedImage = croppedCanvas.toDataURL('image/png');
            document.getElementById('foto-cortada').value = croppedImage;

            // Envia o formulário para upload da imagem cortada
            var formData = new FormData();
            formData.append('foto', croppedImage);

            var xhr = new XMLHttpRequest();
            xhr.open('POST', '../Controller/PHP-Controller/uploadFoto.php', true);

            xhr.onload = function () {
                if (xhr.status === 200) {
                    var response = JSON.parse(xhr.responseText);
                    if (response.success) {
                        // Imagem carregada com sucesso
                        alert("Imagem carregada com sucesso!");
                    } else {
                        // Caso de erro
                        alert("Erro ao carregar a imagem: " + response.message);
                    }
                }
            };

            xhr.send(formData);
        });
    };

    reader.readAsDataURL(file);
});

document.getElementById('cancel-crop').addEventListener('click', function() {
    document.getElementById('imagem-overlay').classList.add('hidden');
});

document.getElementById('alterar-foto-btn').addEventListener('click', function() {
    // Quando o botão de alterar foto é clicado, abre o input de arquivo
    document.getElementById('imagem-perfil').click();
});
