<html>
    <body>
    <a href="editform.php?<?=http_build_query($_REQUEST)?>">< Back</a>
<?php
    $tableName = $_REQUEST['table'];

    $additionalQueries = [
        "evento_emergencia" => ["", []]
    ];

    $tablesKeys = [
        "camara" => ["num_camara"],
        "video" => ["data_hora_inicio", "num_camara"],
        "segmento_video" => ["num_segmento", "data_hora_inicio", "num_camara"],
        "localidade" => ["morada_local"],
        "vigia" => ["morada_local", "num_camara"],
        "processo_socorro" => ["num_processo_socorro"],
        "evento_emergencia" => ["num_telefone", "instante_chamada"],
        "entidade_meio" => ["nome_entidade"],
        "meio" => ["num_meio", "nome_entidade"],
        "meio_combate" => ["num_meio", "nome_entidade"],
        "meio_apoio" => ["num_meio", "nome_entidade"],
        "meio_socorro" => ["num_meio", "nome_entidade"],
        "transporta" => ["num_meio", "nome_entidade", "num_processo_socorro"],
        "alocado" => ["num_meio", "nome_entidade", "num_processo_socorro"],
        "acciona" => ["num_meio", "nome_entidade", "num_processo_socorro"],
        "coordenador" => ["id_coordenador"],
        "audita" => ["id_coordenador", "num_meio", "nome_entidade", "num_processo_socorro"],
        "solicita" => ["id_coordenador", "data_hora_inicio_video", "num_camara"]
    ];

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

    $tableKeys = $tablesKeys[$tableName];
    $namesCol = $collumnNames[$tableName];

    $addQuery = ["", []];
    if (array_key_exists($tableName, $additionalQueries))
        $addQuery = $additionalQueries[$tableName];

    try
    {
        $host = "db.ist.utl.pt";
        $user ="ist186416";
        $password = "12345678";
        $dbname = $user;
        $db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = $addQuery[0] . "UPDATE $tableName SET";

        $separator = " ";
        foreach ($namesCol as $c) {
            $sql = $sql . $separator . $c . " = :" . $c;
            $separator = ", ";
        }

        $separator = " WHERE ";
        foreach ($namesCol as $c) {
            $sql = $sql . $separator . $c . " = :" . $c . "_old";
            $separator = " and ";
        }

        $sql = $sql . ";";
        $executeSubst = $addQuery[1];

        foreach ($namesCol as $c) {
            $value = $_REQUEST[$c];
            if ($value == "null") $value = null;
            $executeSubst[":" . $c] = $value;

            $value = $_REQUEST[$c . "+old"];
            if ($value == "null") $value = null;
            $executeSubst[":" . $c . "_old"] = $value;
        }
        
        $sqlarray = explode("&", $sql);
        $result = $db->beginTransaction();

        foreach ($sqlarray as $query) {
            //echo("<p>$query</p>");

            $result = $db->prepare($query);
            
            $result->execute($executeSubst);
        }

        $result = $db->commit();

        echo("<p>Editado com sucesso!</p>");
        
        $db = null;
    }
    catch (PDOException $e)
    {
        echo("<p>ERRO: {$e->getMessage()}</p>");
    }
?>
    </body>
</html>
