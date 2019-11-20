<?php
include_once __DIR__."/includes/include-all.inc.php";
include_once __DIR__."/includes/auth.inc.php";
$action = @$_GET['action'];
$query = @$_GET['query'];
switch($action) {
    case "approximate-search-marca":
        echo json_encode(Marca::approximateSearch($query));
        break;
    case "approximate-search-veiculo":
        echo json_encode(Veiculo::approximateSearch($query));
        break;
    case "approximate-search-cliente":
        echo json_encode(Cliente::approximateSearch($query));
        break;
    case "approximate-search-usuario":
        echo json_encode(Usuario::approximateSearch($query));
        break;
    case "approximate-search-locacao":
        echo json_encode(Locacao::approximateSearch($query));
        break;
}