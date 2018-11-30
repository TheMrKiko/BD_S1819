<html>
    <body>
    <a href="addform.php?<?=http_build_query($_REQUEST)?>">< Back</a>
<?php
    $tableName = $_REQUEST['table'];
    
    $additionalBeforeQueries = [
        "meio_socorro" =>
            "INSERT INTO meio VALUES(:num_meio, :nome_meio, :nome_entidade);&",
        "meio_apoio" =>
            "INSERT INTO meio VALUES(:num_meio, :nome_meio, :nome_entidade);&",
        "meio_combate" =>
            "INSERT INTO meio VALUES(:num_meio, :nome_meio, :nome_entidade);&"
    ];

    $additionalAfterQueries = [
        "processo_socorro" =>
            "&INSERT INTO evento_emergencia VALUES (:num_telefone, :instante_chamada, :nome_pessoa, :morada_local, :num_processo_socorro);"
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

    $addAfterQuery = "";
    if (array_key_exists($tableName, $additionalAfterQueries))
        $addAfterQuery = $additionalAfterQueries[$tableName];

    $addBeforeQuery = "";
    if (array_key_exists($tableName, $additionalBeforeQueries))
        $addBeforeQuery = $additionalBeforeQueries[$tableName];

    try
    {
        $host = "db.ist.utl.pt";
        $user ="ist186416";
        $password = "12345678";
        $dbname = $user;
        $db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = $addBeforeQuery . "INSERT INTO $tableName VALUES (";
        $separator = "";
        foreach ($namesCol as $c) {
            $sql = $sql . $separator . ":" . $c;
            $separator = ", ";
        }

        $sql = $sql . ");" . $addAfterQuery;        
        
        $sqlarray = explode("&", $sql);
        $result = $db->beginTransaction();

        foreach ($sqlarray as $query) {   
            //echo("<p>$query</p>");

            $executeSubst = [];
            $sql_string = explode(" ", $query);

            foreach ($sql_string as $split) {
                if ($split[0] == "(") $split = substr($split, 1, strlen($split) - 1);
                if ($split[0] == ":") {
                    $word = substr($split, 1);
                    if (substr($word, strlen($word) - 1, 1) == ";") $word = substr($word, 0, strlen($word) - 1);
                    if (substr($word, strlen($word) - 1, 1) == ",") $word = substr($word, 0, strlen($word) - 1);
                    if (substr($word, strlen($word) - 1, 1) == ")") $word = substr($word, 0, strlen($word) - 1);
                    $value = $_REQUEST[$word];
                    if ($value == "null") $value = null;
                    $executeSubst[":" . $word] = $value;
                }
            }
            $result = $db->prepare($query);
            
            $result->execute($executeSubst);
        }

        
        $result = $db->commit();
        
        echo("<p>Adicionado com sucesso!</p>");

        $db = null;
    }
    catch (PDOException $e)
    {
        echo("<p>ERRO: {$e->getMessage()}</p>");
    }
?>
    </body>
</html>
