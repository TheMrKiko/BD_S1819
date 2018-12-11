-- Um Coordenador só pode solicitar vídeos de câmaras colocadas num local cujo
-- accionamento de meios esteja a ser (ou tenha sido) auditado por ele próprio

--on solicia
--must exist audita cujo acciona esteja relacionado com um processo de socorro que
--de um evento de emergencia nesse local


CREATE OR REPLACE FUNCTION chk_coord_local_on_solic_proc() 
RETURNS TRIGGER
AS $$
DECLARE morada_camara VARCHAR;
BEGIN
	SELECT morada_local INTO morada_camara FROM vigia WHERE num_camara = NEW.num_camara;
	IF EXISTS 
		(SELECT * FROM (audita NATURAL JOIN evento_emergencia) AS r
			WHERE r.morada_local = morada_camara
			AND r.id_coordenador = NEW.id_coordenador)
	THEN
		RETURN NEW;
	ELSE
		RETURN NULL;
	END IF;
END;
$$ LANGUAGE plpgsql;

DROP trigger IF EXISTS chk_coord_local_on_solic ON solicita;
CREATE trigger chk_coord_local_on_solic BEFORE INSERT ON solicita for each ROW EXECUTE procedure chk_coord_local_on_solic_proc();


-- Um Meio de Apoio só pode ser alocado a Processos de Socorro para os quais tenha
-- sido accionado.

--on alocado must exist um acciona

CREATE OR REPLACE FUNCTION chk_acciona_on_alocado_proc()
RETURNS TRIGGER
AS $$
BEGIN
	IF EXISTS
		(SELECT * FROM acciona
			WHERE num_meio = NEW.num_meio
			and nome_entidade = NEW.nome_entidade
			and num_processo_socorro = NEw.num_processo_socorro)
	THEN
		RETURN NEW;
	ELSE
		RETURN NULL;
	END IF;
END;
$$ LANGUAGE plpgsql;

DROP trigger IF EXISTS chk_acciona_on_alocado ON alocado;
CREATE trigger chk_acciona_on_alocado BEFORE INSERT ON alocado for each ROW EXECUTE procedure chk_acciona_on_alocado_proc();