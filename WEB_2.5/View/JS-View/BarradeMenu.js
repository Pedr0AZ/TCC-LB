document.addEventListener("DOMContentLoaded", () => {
  const sidebar = document.querySelector(".sidebar"); // Seleciona a barra lateral
  const toggleButton = document.getElementById("toggle-sidebar"); // Botão hambúrguer
  const sidebarHeader = document.querySelector(".sidebar-header"); // Header da barra lateral

  // Função para alternar o estado da barra lateral
  const toggleSidebar = () => {
    sidebar.classList.toggle("collapsed"); // Adiciona ou remove a classe 'collapsed'
  };

  // Adiciona evento de clique no botão hambúrguer
  toggleButton.addEventListener("click", toggleSidebar);

  // Adiciona evento de clique no header
  sidebarHeader.addEventListener("click", toggleSidebar);
});

// Adiciona funcionalidade de mostrar/ocultar submenus
expandBtns.forEach(button => {
  button.addEventListener("click", (e) => {
    const submenu = e.target.nextElementSibling;
    button.classList.toggle("open");
    submenu.style.display = submenu.style.display === "block" ? "none" : "block";
  });
});
;

// Efeitos de clique nos botões
const buttons = document.querySelectorAll("li");
buttons.forEach((button) => {
  button.addEventListener("mousedown", () => {
    button.style.transform = "scale(0.95)";
  });
  button.addEventListener("mouseup", () => {
    button.style.transform = "scale(1)";
  });
});
;
