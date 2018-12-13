drop table d_evento;
drop table d_meio;
drop table d_tempo;
drop table factos;

create table d_evento
    (id_evento serial,
    num_telefone char(9) not null,
    instante_chamada timestamp not null,
    constraint pk_id_evento primary key(id_evento)
    );

create table d_meio
    (id_meio serial,
    num_meio char(5) not null,
    nome_meio varchar(255) not null,
    nome_entidade varchar(20) not null,
    tipo varchar(20) not null,
    constraint pk_id_meio primary key (id_meio)
    );

create table d_tempo
    (id_tempo serial,
     dia int not null,
     mes int not null,
     ano int not null,
     constraint pk_id_tempo primary key(id_tempo)
    );

create table factos
    (id_tempo serial,
     id_meio serial,
     id_evento serial,
     constraint pk_factos primary key(id_tempo, id_meio, id_evento),
     constraint fk_tempo foreign key (id_tempo) references d_tempo(id_tempo),
     constraint fk_meio foreign key (id_meio) references d_meio(id_meio),
     constraint fk_evento foreign key (id_evento) references d_evento(id_evento)
    );
--select data_hora_inicio, data_hora_fim
--from video V, vigia I
--where V.num_camara = I.num_camara
--and V.num_camara = '10'
--and I.morada_local = 'Loures'
--select sum(num_vitimas)
--from transporta T, evento_emergencia E
--where T.num_processo_socorro = E.num_processo_socorro
--group by num_telefone, instante_chamada