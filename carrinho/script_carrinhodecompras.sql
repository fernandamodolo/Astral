-- Script do banco de dados "carrinho" - Prof. Vitor Simeão

DROP TABLE IF EXISTS itemvenda;
DROP TABLE IF EXISTS venda;
DROP TABLE IF EXISTS produto;


CREATE TABLE produto
(
    codproduto SERIAL NOT NULL,
    descricao VARCHAR(80) NOT NULL,
    qtde INTEGER NOT NULL,
    preco NUMERIC(10,2) NOT NULL,
    imagem VARCHAR,
    excluido BOOLEAN,
    CONSTRAINT pk_codproduto PRIMARY KEY (codproduto)
);

-- Produtos

INSERT INTO produto VALUES (DEFAULT,'Bicicleta Caloi',33,2500.00,'bicicleta_caloi.jpg','f');
INSERT INTO produto VALUES (DEFAULT,'iPhone 6s',3,1420.00,'iphone6s.jpg','f');
INSERT INTO produto VALUES (DEFAULT,'Micro-ondas Electrolux',150,214.20,'microondas_electrolux.jpg','f');
INSERT INTO produto VALUES (DEFAULT,'Notebook Dell Inspiron',200,1800.00,'notebook_dell_inspiron.jpg', 'f');

CREATE TABLE venda
(
	codvenda SERIAL NOT NULL,
	datavenda DATE NOT NULL,
	excluido BOOLEAN,
	CONSTRAINT pk_venda PRIMARY KEY (codvenda)
);

CREATE TABLE itemvenda
(
	codvenda INTEGER NOT NULL,
	codproduto INTEGER NOT NULL,
	qtde INTEGER NOT NULL,
	preco NUMERIC(10,2) NOT NULL,
	excluido BOOLEAN,
	CONSTRAINT pk_itemvenda PRIMARY KEY (codvenda, codproduto),
	CONSTRAINT fK_venda FOREIGN KEY (codvenda) REFERENCES venda (codvenda),
	CONSTRAINT fk_produto FOREIGN KEY (codproduto) REFERENCES produto (codproduto)
);

-- Venda 1

INSERT INTO venda VALUES (DEFAULT,NOW(),'f');

INSERT INTO itemvenda VALUES (CURRVAL('venda_codvenda_seq'),1,1,2500.00,'f');
INSERT INTO itemvenda VALUES (CURRVAL('venda_codvenda_seq'),3,2,214.20,'f');

-- Venda 2

INSERT INTO venda VALUES (DEFAULT,NOW(),'f');

INSERT INTO itemvenda VALUES (CURRVAL('venda_codvenda_seq'),1,1,2500.00,'f');
INSERT INTO itemvenda VALUES (CURRVAL('venda_codvenda_seq'),2,2,2500.00,'f');