//criado por Fernanda Modolo em 17/08
//alterado em 27/08 por Bruna Sousa

drop table if exists tipo;
drop table if exists cor;
drop table if exists itens_compra;
drop table if exists produtos;
drop table if exists compra;
drop table if exists cliente;

drop sequence if exists id_prod;
drop sequence if exists id_compra; 
drop sequence if exists id_cliente;  



create sequence id_cliente
increment 1
minvalue 1
maxvalue 9223372036854775807
start 1
cache 1;

create sequence id_prod
increment 1
minvalue 1
maxvalue 9223372036854775807
start 1
cache 1;

create sequence id_compra
increment 1
minvalue 1
maxvalue 9223372036854775807
start 1
cache 1;

create table cliente
(
	id_cliente integer not null default nextval ('id_cliente') ,
	nome character varying (100) not null,
	data_nasc date not null,
	telefone character varying(15) not null,
    CPF character varying(15) not null,
	endereco character varying (200) not null,
	cidade character varying (50) not null,
	email character varying (100) not null unique,
	senha character varying (50) not null,
	exclusao character varying (1) not null,
	data_exclusao date,
    primary key(id_cliente)
);

create table tipo
(
    id_tipo integer not null,
    nome_tipo varchar(50) not null,
    primary key(id_tipo)
);

INSERT INTO tipo
(
VALUES

    (1, 'Símbolo'),
    
    (2, 'Desenho')
);

create table cor
(
    id_cor integer not null,
    nome_cor varchar(50) not null,
    primary key(id_cor)
);

INSERT INTO cor
(
VALUES

    (1, 'Rosa'),
    
    (2, 'Azul')
);

CREATE TABLE produtos
(
    id_prod integer not null default nextval ('id_prod '),
    descricao varchar(80) not null,
    tipo integer not null,
    cor integer not null,
    preco numeric(6,2) not null,
    qtde_estoque integer not null,
    imagem varchar(200) not null,
    excluido varchar(1), 
    data_exclusao DATE,
    primary key(id_prod),
    foreign key(tipo) references tipo(id_tipo),
    foreign key(cor) references cor(id_cor)
    
);

INSERT INTO produtos
(
VALUES

    (default, 'Astral Áries Símbolo Rosa', 1, 1, 20, 20, 'aries_3.png', 'n'),
    
    (default, 'Astral Áries Símbolo Azul', 1, 2, 20, 20, 'aries_1.png', 'n'),
    
    (default, 'Astral Áries Desenho Rosa', 2, 1, 20, 20, 'aries_4.png', 'n'),
    
    (default, 'Astral Áries Desenho Azul', 2, 2, 20, 20, 'aries_2.png', 'n'),
    
    (default, 'Astral Touro Símbolo Rosa', 1, 1, 20, 20, 'touro_3.png', 'n'),
    
    (default, 'Astral Touro Símbolo Azul', 1, 2, 20, 20, 'touro_1.png', 'n'),
    
    (default, 'Astral Touro Desenho Rosa', 2, 1, 20, 20, 'touro_4.png', 'n'),
    
    (default, 'Astral Touro Desenho Azul', 2, 2, 20, 20, 'touro_2.png', 'n'),
    
    (default, 'Astral Gêmeos Símbolo Rosa', 1, 1, 20, 20, 'gemeos_3.png', 'n'),
    
    (default, 'Astral Gêmeos Símbolo Azul', 1, 2, 20, 20, 'gemeos_1.png', 'n'),
    
    (default, 'Astral Gêmeos Desenho Rosa', 2, 1, 20, 20, 'gemeos_4.png', 'n'),
    
    (default, 'Astral Gêmeos Desenho Azul', 2, 2, 20, 20, 'gemeos_2.png', 'n'),
    
    (default, 'Astral Câncer Símbolo Rosa', 1, 1, 20, 20, 'cancer_3.png', 'n'),
    
    (default, 'Astral Câncer Símbolo Azul', 1, 2, 20, 20, 'gemeos_1.png', 'n'),
    
    (default, 'Astral Câncer Desenho Rosa', 2, 1, 20, 20, 'gemeos_4.png', 'n'),
    
    (default, 'Astral Câncer Desenho Azul', 2, 2, 20, 20, 'gemeos_2.png', 'n'),
    
    (default, 'Astral Leão Símbolo Rosa', 1, 1, 20, 20, 'leao_3.png', 'n'),
    
    (default, 'Astral Leão Símbolo Azul', 1, 2, 20, 20, 'leao_1.png', 'n'),
    
    (default, 'Astral Leão Desenho Rosa', 2, 1, 20, 20, 'leao_4.png', 'n'),
    
    (default, 'Astral Leão Desenho Azul', 2, 2, 20, 20, 'leao_2.png', 'n'),
    
    (default, 'Astral Virgem Símbolo Rosa', 1, 1, 20, 20, 'virgem_3.png', 'n'),
    
    (default, 'Astral Virgem Símbolo Azul', 1, 2, 20, 20, 'virgem_1.png', 'n'),
    
    (default, 'Astral Virgem Desenho Rosa', 2, 1, 20, 20, 'virgem_4.png', 'n'),
    
    (default, 'Astral Virgem Desenho Azul', 2, 2, 20, 20, 'virgem_2.png', 'n'),
    
    (default, 'Astral Libra Símbolo Rosa', 1, 1, 20, 20, 'libra_3.png', 'n'),
    
    (default, 'Astral Libra Símbolo Azul', 1, 2, 20, 20, 'libra_1.png', 'n'),
    
    (default, 'Astral Libra Desenho Rosa', 2, 1, 20, 20, 'libra_4.png', 'n'),
    
    (default, 'Astral Libra Desenho Azul', 2, 2, 20, 20, 'libra_2.png', 'n'),
    
    (default, 'Astral Escorpião Símbolo Rosa', 1, 1, 20, 20, 'escorpiao_3.png', 'n'),
    
    (default, 'Astral Escorpião Símbolo Azul', 1, 2, 20, 20, 'escorpiao_1.png', 'n'),
    
    (default, 'Astral Escorpião Desenho Rosa', 2, 1, 20, 20, 'escorpiao_4.png', 'n'),
    
    (default, 'Astral Escorpião Desenho Azul', 2, 2, 20, 20, 'escorpiao_2.png', 'n'),
    
    (default, 'Astral Sagitário Símbolo Rosa', 1, 1, 20, 20, 'sagitario_3.png', 'n'),
    
    (default, 'Astral Sagitário Símbolo Azul', 1, 2, 20, 20, 'sagitario_1.png', 'n'),
    
    (default, 'Astral Sagitário Desenho Rosa', 2, 1, 20, 20, 'sagitario_4.png', 'n'),
    
    (default, 'Astral Sagitário Desenho Azul', 2, 2, 20, 20, 'sagitario_2.png', 'n'),
    
    (default, 'Astral Capricórnio Símbolo Rosa', 1, 1, 20, 20, 'capricornio_3.png', 'n'),
    
    (default, 'Astral Capricórnio Símbolo Azul', 1, 2, 20, 20, 'capricornio_1.png', 'n'),
    
    (default, 'Astral Capricórnio Desenho Rosa', 2, 1, 20, 20, 'capricornio_4.png', 'n'),
    
    (default, 'Astral Capricórnio Desenho Azul', 2, 2, 20, 20, 'capricornio_2.png', 'n'),
    
    (default, 'Astral Aquário Símbolo Rosa', 1, 1, 20, 20, 'aquario_3.png', 'n'),
    
    (default, 'Astral Aquário Símbolo Azul', 1, 2, 20, 20, 'aquario_1.png', 'n'),
    
    (default, 'Astral Aquário Desenho Rosa', 2, 1, 20, 20, 'aquario_4.png', 'n'),
    
    (default, 'Astral Aquário Desenho Azul', 2, 2, 20, 20, 'aquario_2.png', 'n'),
    
    (default, 'Astral Peixes Símbolo Rosa', 1, 1, 20, 20, 'peixes_3.png', 'n'),
    
    (default, 'Astral Peixes Símbolo Azul', 1, 2, 20, 20, 'peixes_1.png', 'n'),
    
    (default, 'Astral Peixes Desenho Rosa', 2, 1, 20, 20, 'peixes_4.png', 'n'),
    
    (default, 'Astral Peixes Desenho Azul', 2, 2, 20, 20, 'peixes_2.png', 'n'),
       
);

create table compra
(
	id_compra integer not null default nextval ('id_compra') ,
	id_cliente integer not null ,
	data_compra date not null,
    excluido varchar(1), 
    data_exclusao DATE,
    primary key(id_compra),
    foreign key(id_cliente) references cliente(id_cliente)
);

create table itens_compra
(
    id_compra integer not null,
    id_prod integer not null,
    quantidade integer not null,
    preco numeric(6,2) not null,
    excluido char(1),
    data_exclusao date,
    foreign key(id_prod) references produtos(id_prod),
    foreign key(id_compra) references compra(id_compra)
);
