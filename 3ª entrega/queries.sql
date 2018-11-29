--1--
print('Qual é o processo de socorro que envolveu maior nu ́mero de meios distintos');
select * from 
    (select num_processo_socorro, count(*) from acciona group by num_processo_socorro) as c 
        cross join 
            (select max(count) from 
                (select num_processo_socorro, count(*) from acciona group by num_processo_socorro) as b) as a 
                    where (count = max);

--2--
print();
select  * from 
    (select * from 
        (select nome_entidade, count(*) from 
            (select * from (acciona natural join evento_emergencia) as b 
                where instante_chamada > '2018-06-21 00:00:00' and instante_chamada < '2018-09-22 23:59:59') as c group by nome_entidade) as b 
                    cross join 
                        (select max(count) from 
                            (select nome_entidade, count(*) from 
                                (select * from 
                                    (acciona natural join evento_emergencia) as b where instante_chamada > '2018-06-21 00:00:00' and instante_chamada < '2018-09-22 23:59:59') as c group by nome_entidade) as d) as e) as ahhhhhh
                                        where count = max;

--3--
select num_processo_socorro from 
    (evento_emergencia natural join 
        (select num_processo_socorro from acciona 
            except 
                select num_processo_socorro from (acciona natural join audita)) as b) 
                    where (morada_local = 'Oliveira do Hospital' and instante_chamada > '2018-01-01 00:00:00' and instante_chamada < '2018-12-31 23:59:59');


--4--
select count(*) from 
    (select * from (vigia natural join segmento_video natural join video) as b 
        where (duracao > 60 and morada_local = 'Monchique' and
            data_hora_inicio > '2018-08-01 00:00:00' and data_hora_fim < '2018-08-31 23:59:59')) as a;

--5--
select * from 
    (meio_combate natural join 
        (select num_meio from meio_combate except select num_meio from  
            (select num_meio from acciona except select num_meio from 
                (select num_meio from acciona except select num_meio from meio_apoio) as b) as c) as marrucho);

--6--
select nome_entidade from meio_combate where not exists 
    (select num_processo_socorro from processo_socorro except 
        select num_processo_socorro from (acciona natural join processo_socorro));