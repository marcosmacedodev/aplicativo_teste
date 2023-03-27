CREATE DATABASE IF NOT EXISTS teste;

CREATE TABLE IF NOT EXISTS teste.colaboradores(
    colaborador_ID INT NOT NULL AUTO_INCREMENT,
    nome VARCHAR(16) NOT NULL,
    sobrenome VARCHAR(16),
    usuario VARCHAR(16) NOT NULL UNIQUE,
    senha VARCHAR(32) NOT NULL,
    email VARCHAR(32) NOT NULL,
    /*0 Desativado, 1 Ativado*/
    status INT NOT NULL,
    /*0 - Normal, 1 - Fornecedor, 2 - Administrador*/
    tipo INT NOT NULL,
    PRIMARY KEY(colaborador_ID),
    CHECK (LENGTH(senha) >= 8)
);

CREATE TABLE IF NOT EXISTS teste.fornecedores(
    fornecedor_ID INT NOT NULL AUTO_INCREMENT,
    cnpj VARCHAR(14) NOT NULL UNIQUE,
    razao_social VARCHAR(16) NOT NULL,
    nome_fantasia VARCHAR(16) NOT NULL,
    colaborador_ID INT NOT NULL,
    contato VARCHAR(16) NOT NULL,
    atividade VARCHAR(16) NOT NULL,
    status INT NOT NULL,
    descricao VARCHAR(32) NOT NULL,
    PRIMARY KEY(fornecedor_ID),
    FOREIGN KEY(colaborador_ID) REFERENCES teste.colaboradores(colaborador_ID)
);

CREATE TABLE IF NOT EXISTS teste.produtos(
    produto_ID INT NOT NULL AUTO_INCREMENT,
    produto_nome VARCHAR(16) NOT NULL,
    descricao VARCHAR(32) NOT NULL,
    status INT NOT NULL,
    preco DECIMAL NOT NULL,
    estoque INT NOT NULL,
    colaborador_ID INT NOT NULL,
    fornecedor_ID INT NOT NULL,
    PRIMARY KEY(produto_ID),
    FOREIGN KEY(colaborador_ID) REFERENCES teste.colaboradores(colaborador_ID),
    FOREIGN KEY(fornecedor_ID) REFERENCES teste.fornecedores(fornecedor_ID)
);

CREATE TABLE IF NOT EXISTS teste.pedidos(
    pedido_ID INT NOT NULL AUTO_INCREMENT,
    colaborador_ID INT NOT NULL,
    num_pedido VARCHAR(8) NOT NULL UNIQUE,
    fornecedor_ID INT NOT NULL,
    data TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    status INT NOT NULL,
    observacao TEXT,
    PRIMARY KEY(pedido_ID),
    FOREIGN KEY(colaborador_ID) REFERENCES teste.colaboradores(colaborador_ID),
    FOREIGN KEY(fornecedor_ID) REFERENCES teste.fornecedores(fornecedor_ID)
);

CREATE TABLE IF NOT EXISTS teste.items(
    item_ID INT NOT NULL AUTO_INCREMENT,
    nome_item VARCHAR(16) NOT NULL,
    quantidade INT NOT NULL,
    valor_unitario DECIMAL NOT NULL,
    produto_ID INT NOT NULL,
    pedido_ID INT NOT NULL,
    PRIMARY KEY(item_ID),
    FOREIGN KEY(produto_ID) REFERENCES teste.produtos(produto_ID),
    FOREIGN KEY(pedido_ID) REFERENCES teste.pedidos(pedido_ID)
);

INSERT INTO teste.colaboradores(nome, sobrenome, usuario, senha, email, tipo, status) VALUES('Nome', 'Sobrenome', 'admin', md5('123456'), 'usuario@mail.com.br', 2, 1);