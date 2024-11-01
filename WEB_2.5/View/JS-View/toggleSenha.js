function toggleSenha(inputId, eyeIcon) {
    const senhaField = document.getElementById(inputId);
    if (senhaField.type === "password") {
        senhaField.type = "text";
        eyeIcon.classList.add("active");
    } else {
        senhaField.type = "password";
        eyeIcon.classList.remove("active");
    }
}

function previewImagem() {
    const input = document.getElementById("imagem-perfil");
    const preview = document.getElementById("preview");
    const file = input.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
            preview.style.display = "block";
        };
        reader.readAsDataURL(file);
    }
}