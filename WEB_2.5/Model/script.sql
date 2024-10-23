CREATE DATABASE bdtcc;

USE bdtcc;

CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,  
    nome VARCHAR(30) NOT NULL,          
    email VARCHAR(50) NOT NULL UNIQUE,  
    senha VARCHAR(255) NOT NULL        
);

criar uma outra tabela das atividades(pra salvar o progresso) com uma foreign key do usuario