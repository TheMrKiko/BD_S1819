drop table camera cascade;
drop table video cascade;
drop table segmento_video cascade;
drop table localidade cascade;
drop table vigia cascade;
drop table evento_emergencia cascade;
drop table processo_socorro cascade;
drop table entidade_meio cascade;
drop table meio cascade;
drop table meio_combate cascade;


create table camara 
    (num_camara char(5) not null unique,
     constraint pk_customer primary key (num_camara)
    );

create table video
    (data_hora_inicio timestamp not null,
     data_hora_fim timestamp not null,
     num_camara char(5) not null unique,
     constraint pk_data_hora_inicio primary key(data_hora_inicio),
     constraint fk_num_camara foreign key(num_camara) references camara(num_camara)));

create table segmento_video
    (num_segmento char(5) not null,
     duracao varchar(5) not null,
     data_hora_inicio timestamp not null,
     num_camara char(5) not null unique,
     constraint pk_data_hora_inicio foreign key(data_hora_inicio) references video(data_hora_inicio),
     constraint fk_num_camara foreign key(num_camara) references video(num_camara);
    );

create table localidade
    (morada_local varchar(255) not null,
    constraint pk_morada_local primary key(morada_local)
    );

create table vigia
    (morada_local varchar(255) not null,
     num_camara char(5) not null unique,
     constraint fk_morada_local foreign key(morada_local) references localidade(morada_local),
     constraint fk_num_camara foreign key(num_camara) references camara(num_camara);
    );

create table evento_emergencia
    (num_telefone char(9) not null,
     instante_chamada timestamp not null,
     nome_pessoa varchar(255) not null,
     morada_local varchar(255) not null,
     num_processo_socorro char(5),
     constraint pk_evento_emergencia primary key(num_telefone, instante_chamada),
     constraint fk_morada_local foreign key(morada_local) references localidade(morada_local),
     constraint fk_num_processo_socorro foreign key(num_processo_socorro) references processo_socorro(num_processo_socorro)
    );

create table processo_socorro
    (num_processo_socorro char(5) not null,
     constraint pk_num_processo_socorro primary key(num_processo_socorro)
    );

create table entidade_meio
    (nome_entidade varchar(20) not null,
     constraint pk_nome_entidade primary key(nome_entidade)
    );

create table meio
    (num_meio char(5) not null unique,
     nome_meio varchar(20) not null,
     nome_entidade varchar(20) not null,
     constraint pk_num_meio primary key num_meio,
     constraint fk_nome_entidade foreign key nome_entidade references entidade_meio(nome_entidade)
    );

create table meio_combate
    (num_meio char(5) not null unique,
     nome_entidade varchar(20) not null,
     constraint fk_num_meio foreign key num_meio references meio(num_meio),
     constraint fk_nome_entidade foreign key nome_entidade references meio(nome_entidade)
    );