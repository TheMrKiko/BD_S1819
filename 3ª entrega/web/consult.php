<html>
    <style>
        td {text-align: center;}
    </style>
    <body>
    <a href="consultform.php?<?=http_build_query($_REQUEST)?>">< Back</a>

<?php

    $consult = $_REQUEST['consult'];

    $consultTableNames = [
        "processo_socorro" => "acciona",
        "local_incendio" => "acciona"
    ];

    $consultSQLQuery = [
        "processo_socorro" => "select * from acciona where num_processo_socorro = :num_processo_socorro;",
        "local_incendio" => "SELECT;"
    ];

    $consultParams = [
        "processo_socorro" => "num_processo_socorro",
        "local_incendio" => "morada_local"
    ];

    $consultDescript = [
        "processo_socorro" => "meios acionados num processo de socorro",
        "local_incendio" => "meios de Socorro acionados em processos de socorro originados num dado local de incendio"
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
    
    $tableName = $consultTableNames[$consult];
    $sql = $consultSQLQuery[$consult];
    $namesCol = $collumnNames[$tableName];
    $description = $consultDescript[$consult];
    $param = $consultParams[$consult];

    echo("<h3>Consulta de $description</h3>");

    try
    {
        $host = "db.ist.utl.pt";
        $user ="ist186416";
        $password = "12345678";
        $dbname = $user;
        
        $db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                
        $executeSubst = [];

        $executeSubst[":" . $param] = $_REQUEST[$param];
        
        $result = $db->prepare($sql);
        $result->execute($executeSubst);
        
        echo("<table border=\"0\" cellspacing=\"5\">\n");
        
        echo("<tr>\n");

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
        
