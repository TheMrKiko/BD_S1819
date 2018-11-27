drop table solicita cascade;
drop table audita cascade;
drop table coordenador cascade;
drop table acciona cascade;
drop table alocado cascade;
drop table transporta cascade;
drop table meio_socorro cascade;
drop table meio_apoio cascade;
drop table meio_combate cascade;
drop table meio cascade;
drop table entidade_meio cascade;
drop table processo_socorro cascade;
drop table evento_emergencia cascade;
drop table vigia cascade;
drop table localidade cascade;
drop table segmento_video cascade;
drop table video cascade;
drop table camera cascade;

create table camara 
    (num_camara char(5) not null unique,
     constraint pk_camara primary key(num_camara));

create table video
    (data_hora_inicio timestamp not null,
     data_hora_fim    timestamp not null,
     num_camara       char(5)   not null unique,
     constraint pk_video primary key(data_hora_inicio, num_camara),
     constraint fk_num_camara foreign key(num_camara) references camara(num_camara)
     constraint ck_data_hora check (data_hora_inicio < data_hora_fim));

create table segmento_video
    (num_segmento     char(5)    not null,
     duracao          varchar(5) not null,
     data_hora_inicio timestamp  not null,
     num_camara       char(5)    not null unique,
     constraint pk_segmento_video primary key(num_segmento, num_camara),
     constraint fk_data_hora_inicio foreign key(data_hora_inicio) references video(data_hora_inicio),
     constraint fk_num_camara foreign key(num_camara) references video(num_camara));

create table localidade
    (morada_local varchar(255) not null,
    constraint pk_morada_local primary key(morada_local));

create table vigia
    (morada_local varchar(255) not null,
     num_camara   char(5) not null unique,
     constraint pk_vigia primary key(morada_local, num_camara),
     constraint fk_morada_local foreign key(morada_local) references localidade(morada_local),
     constraint fk_num_camara   foreign key(num_camara)   references camara(num_camara));

create table processo_socorro
    (num_processo_socorro char(5) not null unique,
     constraint pk_num_processo_socorro primary key(num_processo_socorro));

create table evento_emergencia
    (num_telefone         char(9) not null,
     instante_chamada     timestamp not null,
     nome_pessoa          varchar(255) not null,
     morada_local         varchar(255) not null,
     num_processo_socorro char(5),
     constraint pk_evento_emergencia primary key(num_telefone, instante_chamada),
     constraint fk_morada_local         foreign key(morada_local)         references localidade(morada_local),
     constraint fk_num_processo_socorro foreign key(num_processo_socorro) references processo_socorro(num_processo_socorro));

create table entidade_meio
    (nome_entidade varchar(20) not null unique,
     constraint pk_nome_entidade primary key(nome_entidade));

create table meio
    (num_meio      char(5)     not null unique,
     nome_meio     varchar(20) not null,
     nome_entidade varchar(20) not null unique,
     constraint pk_meio primary key(num_meio, nome_entidade),
     constraint fk_nome_entidade foreign key(nome_entidade) references entidade_meio(nome_entidade));

create table meio_combate
    (num_meio      char(5)     not null unique,
     nome_entidade varchar(20) not null,
     constraint pk_meio_combate primary key(num_meio, nome_entidade),
     constraint fk_num_meio      foreign key(num_meio)      references meio(num_meio),
     constraint fk_nome_entidade foreign key(nome_entidade) references meio(nome_entidade));

create table meio_apoio
    (num_meio       char(5)    not null,
     nome_entidade  varchar(20) not null,
     constraint pk_apoio primary key(nome_entidade, num_meio),
     constraint fk_apoio_num  foreign key(num_meio)      references meio(num_meio),
     constraint fk_apoio_nome foreign key(nome_entidade) references meio(nome_entidade));

create table meio_socorro
    (num_meio       char(5)    not null,
     nome_entidade  varchar(20) not null,
     constraint pk_socorro primary key(nome_entidade, num_meio),
     constraint fk_socorro_num  foreign key(num_meio)      references meio(num_meio),
     constraint fk_socorro_nome foreign key(nome_entidade) references meio(nome_entidade));

create table transporta
    (num_meio             char(5)    not null,
     nome_entidade        varchar(20) not null,
     num_vitimas          int,
     num_processo_socorro char(5),
     constraint pk_transporta primary key(num_processo_socorro, nome_entidade, num_meio),
     constraint fk_transporta_num_meio foreign key(num_meio, nome_entidade) references meio_socorro(num_meio, nome_entidade),
     constraint fk_transporta_num_proc foreign key(num_processo_socorro) references processo_socorro(num_processo_socorro));
    
create table alocado
    (num_meio             char(5)    not null,
     nome_entidade        varchar(20) not null,     
     num_horas            decimal(5, 2),
     num_processo_socorro char(5),
     constraint pk_alocado primary key(num_processo_socorro, nome_entidade, num_meio),
     constraint fk_alocado_num_meio foreign key(num_meio, nome_entidade) references meio_apoio(num_meio, nome_entidade),
     constraint fk_alocado_num_proc foreign key(num_processo_socorro) references processo_socorro(num_processo_socorro));

create table acciona
    (num_meio             char(5)    not null,
     nome_entidade        varchar(20) not null,
     num_processo_socorro char(5),
     constraint pk_acciona primary key(num_processo_socorro, nome_entidade, num_meio),
     constraint fk_acciona_num_meio foreign key(num_meio)             references meio(num_meio),
     constraint fk_acciona_nome     foreign key(nome_entidade)        references meio(nome_entidade),
     constraint fk_acciona_num_proc foreign key(num_processo_socorro) references processo_socorro(num_processo_socorro));

create table coordenador
    (id_coordenador char(5) not null,
     constraint pk_coordenador primary key(id_coordenador));

create table audita
    (id_coordenador       char(5)    not null,
     num_meio             char(5)    not null,
     nome_entidade        varchar(20) not null,
     num_processo_socorro char(5),
     data_hora_inicio     timestamp,
     data_hora_fim        timestamp,
     data_auditoria       date,
     texto                varchar(100),
     constraint pk_audita primary key(id_coordenador, num_meio, nome_entidade, num_processo_socorro),
     constraint fk_audita_num_meio foreign key(num_meio, nome_entidade, num_processo_socorro) references acciona(num_meio, nome_entidade, num_processo_socorro),
     constraint fk_audita_id_coord foreign key(id_coordenador) references coordenador(id_coordenador));

create table solicita
    (id_coordenador         char(5)  not null,
     data_hora_inicio_video timestamp not null,
     num_camara             int       not null unique,
     data_hora_inicio       timestamp not null,
     data_hora_fim          timestamp not null,
     constraint pk_solicita primary key(id_coordenador, data_hora_inicio_video, num_camara)
     constraint fk_solicita_id_coord     foreign key(id_coordenador) references coordenador(id_coordenador),
     constraint fk_solicita_inicio_video foreign key(data_hora_inicio_video, num_camara) references video(data_hora_inicio, num_camara));
