drop table if exists item_venda;
drop table if exists venda; 
drop table if exists cliente;
drop table if exists flor;
drop table if exists usuario;


drop sequence if exists id_cliente;
drop sequence if exists id_flor;
drop sequence if exists id_venda;


create sequence id_cliente
minvalue 1
maxvalue 9223372036854775807
start 1
cache 1;

create sequence id_flor
minvalue 1
maxvalue 9223372036854775807
start 1
cache 1;

create sequence id_venda
minvalue 1
maxvalue 9223372036854775807
start 1
cache 1;

create table usuario
(
    login varchar(50) not null,
    senha varchar(10) not null,
    primary key(login)
);
insert into usuario
(
    Values 
    ('floral_adm@gmail','floral123')

);

create table cliente
(
    id_cliente integer not null default nextval  ('id_cliente'),
    nome varchar(100) not null,
    cpf char(11) not null,
    tel char(15) not null, 
    dt_nasc date not null,
    email varchar(50) not null,
    senha varchar(10) not null,
    primary key(cpf)

);

create table flor
(
    id_flor integer not null default nextval ('id_flor'),
    nome varchar (100) not null,
    cor varchar (20) not null,
    preco numeric(6,2) not null,
    primary key(id_flor)
);

create table venda
 (
     id_venda integer not null default nextval  ('id_venda'),
     cpf_cli char(11) not null,
     data_venda date not null,
     total_venda numeric(6,2) not null,
     mess_cartao varchar(100),
     endereco varchar (200) not null,
     primary key(id_venda),
     foreign key(cpf_cli) references cliente(cpf)
 );
 
 create table item_venda
 (
     id_venda integer not null,
     id_flor integer not null, 
     foreign key(id_venda) references venda(id_venda),
     foreign key (id_flor) references flor(id_flor)
 );
 
