-- UNION
select tipo, ano, mes, count(*)
    from (d_tempo natural join d_meio natural join
        (select * from factos where id_evento = '15') as a) 
    group by tipo, ano, mes
union
select tipo, ano, null, count(*) 
    from (d_tempo natural join d_meio natural join
        (select * from factos where id_evento = '15') as a) 
    group by tipo, ano
union
select tipo, null, null, count(*) 
    from (d_tempo natural join d_meio natural join
        (select * from factos where id_evento = '15') as a) 
    group by tipo
union
select null, null, null, count(*) 
    from (d_tempo natural join d_meio natural join
        (select * from factos where id_evento = '15') as a)
order by tipo, ano, mes;

-- ROLLUP
select tipo, ano, mes, count(*)
    from (d_tempo natural join d_meio natural join
    (select * from factos where id_evento = '15') as a)
group by rollup (tipo, ano, mes)
order by tipo, ano, mes;
