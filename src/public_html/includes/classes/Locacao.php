<?php
class Locacao {
	public $idLocacao;
	public $idCliente;
	public $idVeiculo;
	public $idUsuario;
	public $dtInicial;
	public $dtFinal;
	public $valorTotal;

	public function getProperties(){
		return [
			Connection::int($this->idLocacao),
			Connection::int($this->idCliente),
			Connection::int($this->idVeiculo),
			Connection::int($this->idUsuario),
			Connection::treatString($this->dtInicial, 10, 10),
			Connection::treatString($this->dtFinal, 10, 10),
			Connection::double($this->valorTotal),
		];
	}
	public function cadastrar(){
        global $usuarioLogado;
		list($idLocacao, $idCliente, $idVeiculo, $idUsuario, $dtInicial, $dtFinal, $valorTotal) = $this->getProperties();
		$error = $this->verifyError();
		if($error===false) {
			Connection::exec("INSERT INTO `tbLocacao` (`idLocacao`, `idCliente`, `idVeiculo`, `idUsuario`, `dtInicial`, `dtFinal`, `valorTotal`) VALUES (NULL, ".$idCliente.", ".$idVeiculo.", ".$usuarioLogado->idUsuario.", ".$dtInicial.", ".$dtFinal.", ".$valorTotal.");");
			return true;
		}
		return $error;
	}
	public static function approximateSearch($query) {
		$select = Connection::treatString("% ".$query."%", 0, 34);
		if($select!==false) {
			return Connection::query("SELECT `idLocacao`, `tbUsuario`.`nomeUsuario`, `tbCliente`.`idCliente`, `nomeCliente`, `tbVeiculo`.`idVeiculo`, `tbVeiculo`.`modeloVeiculo`, `tbMarca`.`nomeMarca`, `dtInicial`, `dtFinal`, `valorTotal` FROM `tbLocacao`"
									."INNER JOIN `tbVeiculo` ON `tbVeiculo`.`idVeiculo`=`tbLocacao`.`idVeiculo` INNER JOIN `tbMarca` ON `tbMarca`.`idMarca`=`tbVeiculo`.`idMarca` INNER JOIN `tbCliente` ON `tbCliente`.`idCliente`=`tbLocacao`.`idCliente` INNER JOIN `tbUsuario` ON `tbUsuario`.`idUsuario`=`tbLocacao`.`idUsuario` ORDER BY `idLocacao` DESC LIMIT 10;")->fetchAll(PDO::FETCH_CLASS, "Locacao");
		}
		return [];
	}
	public static function get($id) {
		$locacao_id = Connection::int($id);
		$query = Connection::query("SELECT `idLocacao`, `idCliente`, `idVeiculo`, `idUsuario`, `dtInicial`, `dtFinal`, `valorTotal` FROM `tbLocacao` WHERE `idLocacao` = ".$locacao_id." LIMIT 1;");
		$query->setFetchMode(PDO::FETCH_CLASS, "Locacao");
		return $query->fetch();
	}
	public function verifyError() {
		list($idLocacao, $idCliente, $idVeiculo, $idUsuario, $dtInicial, $dtFinal, $valorTotal) = $this->getProperties();
		if($dtInicial===false) {
			return "Verifique a data inicial.";
		}
		if($dtFinal===false) {
			return "Verifique a data final.";
		}
		if($valorTotal<0) {
			return "Verifique o valor total.";
		}
		return false;
	}
}