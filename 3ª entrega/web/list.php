<html>
    <style>
        td {text-align: center;}
    </style>
    <body>
    <h3><?php
        echo("Lista <i>" . $_REQUEST['table'] . "</i>");
    ?></h3>

<?php
    $tableName = $_REQUEST['table'];

    $tablePermissions = [
        "camara" => [],
        "video" => [],
        "segmento_video" => [],
        "localidade" => ["a", "r"],
        "vigia" => [],
        "processo_socorro" => ["a", "r"],
        "evento_emergencia" => ["a", "r"],
        "entidade_meio" => ["a", "r"],
        "meio" => ["a", "r"],
        "meio_combate" => ["a", "r", "e"],
        "meio_apoio" => ["a", "r", "e"],
        "meio_socorro" => ["a", "r", "e"],
        "transporta" => [],
        "alocado" => [],
        "acciona" => [],
        "coordenador" => [],
        "audita" => [],
        "solicita" => []
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

    /* $collumnDesignations = [
        "localidade" => ["Morada Local"],
        "acciona" => ["Num Meio", "Nome Entidade", "Num Processo Socorro"]
    ]; */

    //$designatCol = $collumnDesignations[$tableName];
    $namesCol = $collumnNames[$tableName];
    $canAdd = in_array("a", $tablePermissions[$tableName]);
    $canEdit = in_array("e", $tablePermissions[$tableName]);
    $canRem = in_array("r", $tablePermissions[$tableName]);

    try
    {
        $host = "db.ist.utl.pt";
        $user ="ist186416";
        $password = "12345678";
        $dbname = $user;
    
        $db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
     
        $sql = "SELECT * from $tableName";
        
        $result = $db->prepare($sql);
        $result->execute();
    
        echo("<table border=\"0\" cellspacing=\"5\">\n");

        echo("<tr>\n");

        //foreach($designatCol as $c)
        foreach($namesCol as $c)
        {
            echo("<td><strong>{$c}</strong></td>\n");
        }
        echo("</tr>\n");

        echo("<tr>\n");
        foreach($result as $row)
        {
            echo("<tr>\n");
            foreach($namesCol as $d)
            {
                echo("<td>{$row[$d]}</td>\n");
            }

            $htmlqueries = "";
            foreach ($tableKeys[$tableName] as $k) {
                $htmlqueries = $htmlqueries . "&" . $k . "=" . $row[$k];
            }

            if ($canEdit)
                echo("<td><a href=\"edit.php?table={$tableName}{$htmlqueries}\">Edit</a></td>\n");
            if ($canRem)
                echo("<td><a href=\"remove.php?table={$tableName}{$htmlqueries}\">Remove</a></td>\n");

            echo("</tr>\n");
        }
        echo("</tr>\n");

        echo("</table>\n");
    
        $db = null;
    }
    catch (PDOException $e)
    {
        echo("<p>ERRO: {$e->getMessage()}</p>");
    }
?>
    </body>
</html>
        
