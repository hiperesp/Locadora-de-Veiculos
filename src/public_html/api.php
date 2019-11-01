<?php
include_once __DIR__."/includes/include-all.inc.php";
$action = @$_GET['action'];
$query = @$_GET['query'];
switch($action) {
    case "approximate-search-marca":
        echo json_encode(Marca::approximateSearch($query));
        break;
}