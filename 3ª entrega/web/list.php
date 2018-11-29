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
        "localidade" => ["a", "r"],
        "acciona" => []
    ];

    $collumnNames = [
        "localidade" => ["morada_local"],
        "acciona" => ["num_meio", "nome_entidade", "num_processo_socorro"]
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

            if ($canEdit)
                echo("<td><a href=\"edit.php?table={$tableName}\">Edit</a></td>\n");
            if ($canRem)
                echo("<td><a href=\"remove.php?table={$tableName}\">Remove</a></td>\n");

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
        
