// Função para abrir o menu lateral
function openNav() {
    // Define a largura do elemento do "side-menu" 
    document.getElementById("side-menu").style.width = "250px";
    // Define a margem esquerda do elemento do "main", movendo o conteúdo principal para a direita
    document.getElementById("main").style.marginLeft = "250px";
}

// Função para fechar o menu lateral
function closeNav() {
    // Define a largura do elemento do "side-menu", ocultando o menu
    document.getElementById("side-menu").style.width = "0";
    // Define a margem esquerda do elemento do "main", retornando o conteúdo principal à sua posição original
    document.getElementById("main").style.marginLeft = "0";
}

// Adiciona um  evento ao elemento do "checkbox"
document.getElementById("checkbox").addEventListener("change", function() {
    // Verifica se o checkbox está marcado
    if(this.checked) {
        // Se marcado, abre o menu lateral
        openNav();
    } else {
        // Se não marcado, também chama a função openNav() (podia se chamar closeNav() para fechar o menu)
        openNav();
    }
});
