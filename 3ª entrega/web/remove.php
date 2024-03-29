<html>
    <body>
    <a href="list.php?<?=http_build_query($_REQUEST)?>">< Back</a>
    <h3>Remover entrada de <i><?=$_REQUEST['table']?></i></h3>
<?php
    $tableName = $_REQUEST['table'];

    $additionalQueries = [
        "entidade_meio" =>
            "DELETE FROM transporta WHERE num_processo_socorro = :num_processo_socorro;&
            DELETE FROM acciona WHERE num_processo_socorro = :num_processo_socorro;&
            DELETE FROM alocado WHERE num_processo_socorro = :num_processo_socorro;&
            DELETE FROM meio_combate WHERE nome_entidade = :nome_entidade;&
            DELETE FROM meio_socorro WHERE nome_entidade = :nome_entidade;&
            DELETE FROM meio_apoio WHERE nome_entidade = :nome_entidade;&
            DELETE FROM meio WHERE nome_entidade = :nome_entidade;&",
        "meio" =>
            "DELETE FROM transporta WHERE num_processo_socorro = :num_processo_socorro;&
            DELETE FROM acciona WHERE num_processo_socorro = :num_processo_socorro;&
            DELETE FROM alocado WHERE num_processo_socorro = :num_processo_socorro;&
            DELETE FROM meio_combate WHERE nome_entidade = :nome_entidade;&
            DELETE FROM meio_socorro WHERE nome_entidade = :nome_entidade;&
            DELETE FROM meio_apoio WHERE nome_entidade = :nome_entidade;&",
        "meio_socorro" =>
            "DELETE FROM transporta WHERE num_meio = :num_meio and nome_entidade = :nome_entidade;&",
        "meio_apoio" =>
            "DELETE FROM alocado WHERE num_meio = :num_meio and nome_entidade = :nome_entidade;&",
        "localidade" =>
            "DELETE FROM evento_emergencia WHERE morada_local = :morada_local;&
            DELETE FROM vigia WHERE morada_local = :morada_local;&",
        "processo_socorro" =>
            "DELETE FROM audita WHERE num_processo_socorro = :num_processo_socorro;&
            DELETE FROM transporta WHERE num_processo_socorro = :num_processo_socorro;&
            DELETE FROM acciona WHERE num_processo_socorro = :num_processo_socorro;&
            DELETE FROM alocado WHERE num_processo_socorro = :num_processo_socorro;&
            DELETE FROM evento_emergencia WHERE num_processo_socorro = :num_processo_socorro;&"
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

    $addQuery = "";
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

        $sql = $addQuery . "DELETE FROM $tableName WHERE";
        $separator = " ";
        foreach ($tableKeys as $k) {
            $sql = $sql . $separator . $k . " = :" . $k;
            $separator = " and ";
        }

        $sql = $sql . ";";

        $sqlarray = explode("&", $sql);
        $result = $db->beginTransaction();
        
        foreach ($sqlarray as $query) {   
            //echo("<p>$query</p>");

            $executeSubst = [];
            $sql_string = explode(" ", $query);

            foreach ($sql_string as $split) {
                if ($split[0] == ":") {
                    $word = substr($split, 1);
                    if (substr($word, strlen($word) - 1, 1) == ";") $word = substr($word, 0, strlen($word) - 1);
                    $executeSubst[":" . $word] = $_REQUEST[$word];
                }
            }
            $result = $db->prepare($query);
            
            $result->execute($executeSubst);
        }
        
        $result = $db->commit();

        echo("<p>Removido com sucesso!</p>");
        
        $db = null;
    }
    catch (PDOException $e)
    {
        echo("<p>ERRO: {$e->getMessage()}</p>");
    }
?>
    </body>
</html>
