<?php
include_once __DIR__."/../../includes/include-all.inc.php";

function uploadImage($image, $optional = false){
    if($image!==null) {
        $target_dir = __DIR__."/../../uploads/";
        $check = @getimagesize($image["tmp_name"]);
        if($check !== false) {
            //echo "File is an image - " . $check["mime"] . ".";
            $target_file = uniqid().image_type_to_extension($check[2]);
            if (move_uploaded_file($image["tmp_name"], $target_dir.$target_file)) {
                return $target_file;
            } else {
                Notification::addActionNotification("", "", "Ocorreu um erro ao enviar a foto do veículo (CHMOD).");
            }
        } else {
            if(!$optional) {
                Notification::addActionNotification("", "", "A foto do veículo selecionada não é uma imagem.");
            }
        }
    } else {
        if(!$optional) {
            Notification::addActionNotification("", "", "A foto do veículo não foi encontrada.");
        }
    }
    if($optional) {
        return true;
    }
    return false;
}

switch(@$_POST['action']) {
    case "addMarca":
    case "removeMarca":
    case "editMarca":
        $marca = new Marca();
        list(
             $marca->idMarca
            ,$marca->nomeMarca
        ) = [
             @$_POST['idMarca']
            ,@$_POST['nomeMarca']
        ];
        break;
    case "addVeiculo":
    case "removeVeiculo":
    case "editVeiculo":
        $veiculo = new Veiculo();
        list(
             $veiculo->idVeiculo
            ,$veiculo->idMarca
            ,$veiculo->anoVeiculo
            ,$veiculo->corVeiculo
            ,$veiculo->modeloVeiculo
            ,$veiculo->valorDiariaVeiculo
            ,$veiculo->fotoVeiculo
        ) = [
             @$_POST['idVeiculo']
            ,@$_POST['idMarca']
            ,@$_POST['anoVeiculo']
            ,@$_POST['corVeiculo']
            ,@$_POST['modeloVeiculo']
            ,@$_POST['valorDiariaVeiculo']
            ,@$_FILES['fotoVeiculo']
        ];
        break;
    case "addCliente":
    case "removeCliente":
    case "editCliente":
        $cliente = new Cliente();
        list(
             $cliente->idCliente
            ,$cliente->nomeCliente
            ,$cliente->cpfCliente
            ,$cliente->cnhCliente
            ,$cliente->logradouroCliente
            ,$cliente->numCliente
            ,$cliente->complCliente
            ,$cliente->bairroCliente
            ,$cliente->cidadeCliente
            ,$cliente->cepCliente
            ,$cliente->ufCliente
        ) = [
             @$_POST['idCliente']
            ,@$_POST['nomeCliente']
            ,@$_POST['cpfCliente']
            ,@$_POST['cnhCliente']
            ,@$_POST['logradouroCliente']
            ,@$_POST['numCliente']
            ,@$_POST['complCliente']
            ,@$_POST['bairroCliente']
            ,@$_POST['cidadeCliente']
            ,@$_POST['cepCliente']
            ,@$_POST['ufCliente']
        ];
        break;
}
switch(@$_POST['action']) {
    case "addMarca":
        $response = $marca->cadastrar();
        Notification::addActionNotification("Sucesso", "Sucesso ao cadastrar marca.", $response);
        if($response===true) unset($marca);
        break;
    case "editMarca":
        $response = $marca->edit();
        Notification::addActionNotification("Sucesso", "Sucesso ao editar marca.", $response);
        if($response===true) unset($marca);
        break;
    case "removeMarca":
        $response = $marca->remove();
        Notification::addActionNotification("Sucesso", "Sucesso ao remover marca.", $response);
        if($response===true) unset($marca);
        break;
    case "addVeiculo":
        $veiculo->fotoVeiculo = uploadImage($veiculo->fotoVeiculo);
        if($veiculo->fotoVeiculo!==false) {
            $response = $veiculo->cadastrar();
            Notification::addActionNotification("Sucesso", "Sucesso ao cadastrar veículo.", $response);
            if($response===true) unset($veiculo);
        }
        break;
    case "editVeiculo":
        $veiculo->fotoVeiculo = uploadImage($veiculo->fotoVeiculo, true);
        if($veiculo->fotoVeiculo!==false) {
            $response = $veiculo->edit();
            Notification::addActionNotification("Sucesso", "Sucesso ao editar veículo.", $response);
            if($response===true) unset($veiculo);
        }
        break;
    case "removeVeiculo":
        $response = $veiculo->remove();
        Notification::addActionNotification("Sucesso", "Sucesso ao remover veículo.", $response);
        if($response===true) unset($veiculo);
        break;
    case "addCliente":
        $response = $cliente->cadastrar();
        Notification::addActionNotification("Sucesso", "Sucesso ao cadastrar cliente.", $response);
        if($response===true) unset($cliente);
        break;
    case "editCliente":
        $response = $cliente->edit();
        Notification::addActionNotification("Sucesso", "Sucesso ao editar cliente.", $response);
        if($response===true) unset($cliente);
        break;
    case "removeCliente":
        $response = $cliente->remove();
        Notification::addActionNotification("Sucesso", "Sucesso ao remover cliente.", $response);
        if($response===true) unset($cliente);
        break;
}

$formType = "add";

switch(@$_GET['action']) {
    case "editMarca":
        $formType = "edit";
        $marca = Marca::get(@$_GET['idMarca']);
        if(!$marca) {
            header("Location: marca.php");
            die();
        }
        break;
    case "editVeiculo":
        $formType = "edit";
        $veiculo = Veiculo::get(@$_GET['idVeiculo']);
        if(!$veiculo) {
            header("Location: veiculo.php");
            die();
        }
        break;
    case "editCliente":
        $formType = "edit";
        $cliente = Cliente::get(@$_GET['idCliente']);
        if(!$cliente) {
            header("Location: cliente.php");
            die();
        }
        break;
}