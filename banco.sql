CREATE DATABASE IF NOT EXISTS aula_sql_injection CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE aula_sql_injection;

DROP TABLE IF EXISTS produtos;
DROP TABLE IF EXISTS usuarios;

CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    senha VARCHAR(100) NOT NULL,
    perfil VARCHAR(50) NOT NULL
);

INSERT INTO usuarios (nome, email, senha, perfil) VALUES
('Administrador', 'admin@teste.com', '123456', 'admin'),
('Aluno Teste', 'aluno@teste.com', '123456', 'usuario'),
('Maria Suporte', 'maria@teste.com', 'abc123', 'suporte');

CREATE TABLE produtos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    categoria VARCHAR(100) NOT NULL,
    preco DECIMAL(10,2) NOT NULL
);

INSERT INTO produtos (nome, categoria, preco) VALUES
('Notebook Técnico', 'Informática', 3500.00),
('Mouse USB', 'Periféricos', 49.90),
('Roteador Wi-Fi', 'Redes', 199.90),
('Switch 8 portas', 'Redes', 159.90),
('HD Externo', 'Armazenamento', 299.90);
