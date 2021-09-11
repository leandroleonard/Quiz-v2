create table perguntas(
    id int primary key auto_increment,
    pergunta text not null,
    cod_pergunta varchar(35) not null unique
);

create table respostas(
    id int primary key auto_increment,
    resposta text not null,
    cod_pergunta varchar(35) not null,
    cod_resposta varchar(35) not null,
    tipo char(1) not null
);

create table pontuacao(
    jogador varchar(45) not null,
    pontos int not null,
    updated_at datetime
)