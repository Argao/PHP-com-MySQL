-- Active: 1713222171639@@127.0.0.1@3306@db_games
CREATE DATABASE db_games DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;


CREATE TABLE usuarios(
    usuario VARCHAR(10) NOT NULL,
    nome VARCHAR(30) NOT NULL,
    senha VARCHAR(60) NOT NULL,
    tipo VARCHAR(10) NOT NULL DEFAULT 'editor',
    PRIMARY KEY (usuario)
)engine=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE generos(
    cod INT(11) NOT NULL AUTO_INCREMENT,
    genero VARCHAR(20) NOT NULL,
    PRIMARY KEY (cod)
)engine=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE produtoras(
    cod INT(11) NOT NULL AUTO_INCREMENT,
    produtora VARCHAR(20) NOT NULL,
    pais VARCHAR(15) NOT NULL,
    PRIMARY KEY (cod)
)engine=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE jogos(
    cod INT(11) NOT NULL AUTO_INCREMENT,
    nome VARCHAR(40) NOT NULL,
    genero INT(11) NOT NULL,
    produtora INT(11) NOT NULL,
    descricao TEXT NOT NULL,
    nota DECIMAL(4,2) NOT NULL,
    capa VARCHAR(40) NOT NULL,
    PRIMARY KEY (cod),
    FOREIGN KEY (genero) REFERENCES generos(cod),
    FOREIGN KEY (produtora) REFERENCES produtoras(cod)
)engine=InnoDB DEFAULT CHARSET=utf8;