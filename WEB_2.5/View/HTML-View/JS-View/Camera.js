// Acessando os elementos HTML
const video = document.getElementById('camera');
const canvas = document.getElementById('canvas');
const captureButton = document.getElementById('capture');

// Função para acessar a câmera
function startCamera() {
    // Verifica se o navegador suporta a API getUserMedia
    if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
        navigator.mediaDevices.getUserMedia({ video: true })
            .then(function(stream) {
                // Define a stream de vídeo para o elemento <video>
                video.srcObject = stream;
                video.play();
            })
            .catch(function(err) {
                console.log("O acesso à câmera falhou: " + err);
            });
    }
}

// Iniciar a câmera quando a página carregar
window.onload = startCamera;

// Capturar imagem do vídeo e desenhar no canvas
captureButton.addEventListener('click', function() {
    canvas.width = video.videoWidth;
    canvas.height = video.videoHeight;
    const context = canvas.getContext('2d');
    context.drawImage(video, 0, 0, canvas.width, canvas.height);

    // Exibir a imagem capturada
    const image = canvas.toDataURL('image/png');
    const link = document.createElement('a');
    link.href = image;
    link.download = 'captura.png';
    link.click();
});
