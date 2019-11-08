<?php
include __DIR__."/installer/installedOnly.php";
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no">
        <title>Arquivo de exemplo</title>
    </head>
    <body>
        <p>Esse arquivo só poderá ser acessado após a instalação.<br>Ao acessar esse arquivo, caso a instalação não foi efetuada, ele chamará o instalador.</p>
        <a href="page2.php">Acessar página 2</a>
    </body>
</html>