create database bdtcc;

use bdtcc;

create table usuarios (
    nome varchar(30) primary key,
    email varchar(50),
    senha varchar(50),
    apelido varchar(20)
)