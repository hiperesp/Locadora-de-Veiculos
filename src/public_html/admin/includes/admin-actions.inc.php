<?php
include_once __DIR__."/../../includes/include-all.inc.php";
$action = @$_POST['action'];
switch($action) {
    case "addMarca":
        $marca = new Marca();
        $marca->nomeMarca = @$_POST['txtMarca'];
        $marca->cadastrar();
        break;
}