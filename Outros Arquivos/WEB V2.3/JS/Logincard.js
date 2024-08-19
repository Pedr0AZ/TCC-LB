document.getElementById("login-btn").addEventListener("click", function() {
    document.getElementById("overlay").style.display = "flex"; // Mostra o card de login
});

document.getElementById("overlay").addEventListener("click", function(event) {
    if (event.target === this) {
        this.style.display = "none"; // Oculta o card de login ao clicar fora dele
    }
});

document.getElementById("create-account-link").addEventListener("click", function() {
    document.getElementById("loginCard").classList.add("hidden");
    document.getElementById("signupCard").classList.remove("hidden");
});

document.getElementById("login-link").addEventListener("click", function() {
    document.getElementById("signupCard").classList.add("hidden");
    document.getElementById("loginCard").classList.remove("hidden");
});
