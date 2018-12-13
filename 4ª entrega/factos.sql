drop table factos;
drop table d_evento;
drop table d_meio;
drop table d_tempo;

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
    (id_tempo int not null,
     id_meio int not null,
     id_evento int not null,
     constraint pk_factos primary key(id_tempo, id_meio, id_evento),
     constraint fk_tempo foreign key (id_tempo) references d_tempo(id_tempo),
     constraint fk_meio foreign key (id_meio) references d_meio(id_meio),
     constraint fk_evento foreign key (id_evento) references d_evento(id_evento)
    );

insert into d_evento (num_telefone, instante_chamada)
select num_telefone, instante_chamada from evento_emergencia;

insert into d_meio (num_meio, nome_meio, nome_entidade, tipo)
select num_meio, nome_meio, nome_entidade, 'apoio' from meio natural join meio_apoio;
insert into d_meio (num_meio, nome_meio, nome_entidade, tipo)
select num_meio, nome_meio, nome_entidade, 'combate' from meio natural join meio_combate;
insert into d_meio (num_meio, nome_meio, nome_entidade, tipo)
select num_meio, nome_meio, nome_entidade, 'socorro' from meio natural join meio_socorro;

insert into d_tempo (dia, mes, ano) values(22, 4, 2005);
insert into d_tempo (dia, mes, ano) values(15, 2, 2009);
insert into d_tempo (dia, mes, ano) values(29, 2, 2018);
insert into d_tempo (dia, mes, ano) values(27, 8, 1998);
insert into d_tempo (dia, mes, ano) values(28, 8, 1996);
insert into d_tempo (dia, mes, ano) values(1, 10, 1999);
insert into d_tempo (dia, mes, ano) values(7, 8, 1997);
insert into d_tempo (dia, mes, ano) values(27, 1, 1999);
insert into d_tempo (dia, mes, ano) values(3, 7, 2007);
insert into d_tempo (dia, mes, ano) values(3, 9, 2018);
insert into d_tempo (dia, mes, ano) values(9, 8, 1998);
insert into d_tempo (dia, mes, ano) values(4, 7, 2000);
insert into d_tempo (dia, mes, ano) values(11, 9, 2001);
insert into d_tempo (dia, mes, ano) values(24, 7, 2015);

insert into factos
select id_tempo, id_meio, id_evento from d_evento cross join d_meio cross join d_tempo;

--select data_hora_inicio, data_hora_fim
--from video V, vigia I
--where V.num_camara = I.num_camara
--and V.num_camara = '10'
--and I.morada_local = 'Loures'
--select sum(num_vitimas)
--from transporta T, evento_emergencia E
--where T.num_processo_socorro = E.num_processo_socorro
--group by num_telefone, instante_chamada