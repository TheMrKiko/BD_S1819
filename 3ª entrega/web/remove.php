<html>
    <body>
<?php
    $tableName = $_REQUEST['table'];

    $additionalQueries = [
        "acciona" => ["", []]
    ];

    $tableKeys = [
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

    $addQuery = ["", []];
    if (in_array($tableName, $additionalQueries))
        $addQuery = $additionalQueries[$tableName];

    try
    {
        $host = "db.ist.utl.pt";
        $user ="ist186416";
        $password = "12345678";
        $dbname = $user;
        $db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = $addQuery[0] . "DELETE FROM $tableName WHERE";
        foreach ($tableKeys[$tableName] as $k) {
            $sql = $sql . " " . $k . " = :" . $k;
        }

        $sql = $sql . ";";
        $executeSubst = $addQuery[1];
        
        foreach ($tableKeys[$tableName] as $k) {
            $executeSubst[":" . $k] = $_REQUEST[$k];
        }
        
        echo("<p>$sql</p>");

        //$result = $db->prepare($sql);
        //$result->execute([':balance' => $balance, ':account_number' => $account_number]);
        
        $db = null;
    }
    catch (PDOException $e)
    {
        echo("<p>ERROR: {$e->getMessage()}</p>");
    }
?>
    </body>
</html>
