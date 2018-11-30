<html>
    <body>
        <a href="list.php?table=<?=$_REQUEST['table']?>">< Back</a>
        <h3>Adicionar entrada para <?=$_REQUEST['table']?></h3>
        <form action="add.php" method="post">
            <p><input type="hidden" name="table" value="<?=$_REQUEST['table']?>"/></p>
            <?php

                $tableName = $_REQUEST['table'];

                $collumnNames = [
                    "camara" => ["num_camara"],
                    "video" => ["data_hora_inicio", "data_hora_fim", "num_camara"],
                    "segmento_video" => ["num_segmento", "duracao", "data_hora_inicio", "num_camara"],
                    "localidade" => ["morada_local"],
                    "vigia" => ["morada_local", "num_camara"],
                    "processo_socorro" => ["num_processo_socorro"],
                    "evento_emergencia" => ["num_telefone", "instante_chamada", "nome_pessoa", "morada_local", "num_processo_socorro"],
                    "entidade_meio" => ["nome_entidade"],
                    "meio" => ["num_meio", "nome_meio", "nome_entidade"],
                    "meio_combate" => ["num_meio", "nome_entidade"],
                    "meio_apoio" => ["num_meio", "nome_entidade"],
                    "meio_socorro" => ["num_meio", "nome_entidade"],
                    "transporta" => ["num_meio", "nome_entidade", "num_vitimas", "num_processo_socorro"],
                    "alocado" => ["num_meio", "nome_entidade", "num_horas", "num_processo_socorro"],
                    "acciona" => ["num_meio", "nome_entidade", "num_processo_socorro"],
                    "coordenador" => ["id_coordenador"],
                    "audita" => ["id_coordenador", "num_meio", "nome_entidade", "num_processo_socorro", "data_hora_inicio", "data_hora_fim", "data_auditoria", "texto"],
                    "solicita" => ["id_coordenador", "data_hora_inicio_video", "num_camara", "data_hora_inicio", "data_hora_fim"]
                ];

                $namesCol = $collumnNames[$tableName];

                foreach ($namesCol as $field) {
                    echo("<p>$field: <input type='text' name='$field'/></p>");
                }

            ?>
            <p><input type="submit" value="Adicionar"/></p>
        </form>
    </body>
</html>
