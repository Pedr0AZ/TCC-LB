create database bdtcc;

use bdtcc;

create table usuarios (
    email varchar(50),
    nome varchar(30) primary key,
    senha varchar(50),
    apelido varchar(20)
)