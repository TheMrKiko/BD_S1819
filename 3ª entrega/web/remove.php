<html>
    <body>
    <a href="list.php?table=<?=$_REQUEST['table']?>">< Back</a>
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

    $tableKeys = $tablesKeys[$tableName];

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

        $sql = $addQuery[0] . "DELETE FROM $tableName WHERE";
        $separator = " ";
        foreach ($tableKeys as $k) {
            $sql = $sql . $separator . $k . " = :" . $k;
            $separator = " and ";
        }

        $sql = $sql . ";";
        $executeSubst = $addQuery[1];

        foreach ($tableKeys as $k) {
            $executeSubst[":" . $k] = $_REQUEST[$k];
        }
        
        echo("<p>$sql</p>");

        $result = $db->beginTransaction();
        
        $result = $db->prepare($sql);
        
        $result->execute($executeSubst);

        $result = $db->commit();
        
        $db = null;
    }
    catch (PDOException $e)
    {
        echo("<p>ERRO: {$e->getMessage()}</p>");
    }
?>
    </body>
</html>
