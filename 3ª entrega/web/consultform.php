<html>
    <body>
        <a href="index.html">< Back</a>
        <form action="consult.php" method="post">
            <p><input type="hidden" name="consult" value="<?=$_REQUEST['consult']?>"/></p>
            <?php
                $consult = $_REQUEST['consult'];

                $consultParams = [
                    "processo_socorro" => "num_processo_socorro",
                    "local_incendio" => "morada_local"
                ];

                $consultDescript = [
                    "processo_socorro" => "meios acionados num processo de socorro",
                    "local_incendio" => "meios de Socorro acionados em processos de socorro originados num dado local de incendio"
                ];

                $field = $consultParams[$consult];
                $description = $consultDescript[$consult];

                echo("<h3>Consulta de $description</h3>");
                echo("<p>$field: <input type='text' name='$field'/></p>");

            ?>
            <p><input type="submit" value="Consultar"/></p>
        </form>
    </body>
</html>
