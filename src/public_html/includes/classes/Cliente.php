<?php
class Cliente {

	public $idCliente;
	public $nomeCliente;
	public $cpfCliente;
	public $cnhCliente;
	public $logradouroCliente;
	public $numCliente;
	public $complCliente;
	public $bairroCliente;
	public $cidadeCliente;
	public $cepCliente;
	public $ufCliente;

	public function getProperties(){
		return [
			Connection::int($this->idCliente),
			Connection::treatString($this->nomeCliente, 2, 255),
			Connection::treatString($this->cpfCliente, 11, 11),
			Connection::treatString($this->cnhCliente, 11, 11),
			Connection::treatString($this->logradouroCliente, 2, 255),
			Connection::int($this->numCliente),
			Connection::treatString($this->complCliente, 0, 32),
			Connection::treatString($this->bairroCliente, 2, 64),
			Connection::treatString($this->cidadeCliente, 2, 128),
			Connection::treatString($this->cepCliente, 8, 8),
			Connection::treatString($this->ufCliente, 2, 2),
		];
	}
	public function cadastrar(){
		list($idCliente, $nomeCliente, $cpfCliente, $cnhCliente, $logradouroCliente, $numCliente, $complCliente, $bairroCliente, $cidadeCliente, $cepCliente, $ufCliente) = $this->getProperties();
		$error = $this->verifyError();
		if($error===false) {
			Connection::exec("INSERT INTO `tbCliente` (`idCliente`, `nomeCliente`, `cpfCliente`, `cnhCliente`, `logradouroCliente`, `numCliente`, `complCliente`, `bairroCliente`, `cidadeCliente`, `cepCliente`, `ufCliente`) VALUES (".$idCliente.", ".$nomeCliente.", ".$cpfCliente.", ".$cnhCliente.", ".$logradouroCliente.", ".$numCliente.", ".$complCliente.", ".$bairroCliente.", ".$cidadeCliente.", ".$cepCliente.", ".$ufCliente.");");
			return true;
		}
		return $error;
	}
	public function remove() {
		list($idCliente, $nomeCliente, $cpfCliente, $cnhCliente, $logradouroCliente, $numCliente, $complCliente, $bairroCliente, $cidadeCliente, $cepCliente, $ufCliente) = $this->getProperties();
		Connection::exec("DELETE FROM `tbCliente` WHERE `idCliente` = ".$idCliente);
		return true;
	}
	public function edit() {
		list($idCliente, $nomeCliente, $cpfCliente, $cnhCliente, $logradouroCliente, $numCliente, $complCliente, $bairroCliente, $cidadeCliente, $cepCliente, $ufCliente) = $this->getProperties();
		$error = $this->verifyError();
		if($error===false) {
			Connection::exec("UPDATE `tbCliente` SET `nomeCliente` = ".$nomeCliente.", `cpfCliente` = ".$cpfCliente.", `cnhCliente` = ".$cnhCliente.", `logradouroCliente` = ".$logradouroCliente.", `numCliente` = ".$numCliente.", `complCliente` = ".$complCliente.", `bairroCliente` = ".$bairroCliente.", `cidadeCliente` = ".$cidadeCliente.", `cepCliente` = ".$cepCliente.", `ufCliente` = ".$ufCliente." WHERE `tbCliente`.`idCliente` = ".$idCliente.";");
			return true;
		}
		return $error;
	}
	public static function approximateSearch($query) {
		$select = Connection::treatString("% ".$query."%", 0, 34);
		if($select!==false) {
			return Connection::query("SELECT `idCliente`, `nomeCliente`, `cpfCliente`, `cnhCliente` FROM `tbCliente` HAVING CONCAT(' ', `nomeCliente`) LIKE ".$select." OR CONCAT(' ', `cpfCliente`) LIKE ".$select." OR CONCAT(' ', `cnhCliente`) LIKE ".$select." ORDER BY `nomeCliente` LIMIT 10;")->fetchAll(PDO::FETCH_CLASS, "Cliente");
		}
		return [];
	}
	public static function get($id) {
		$cliente_id = Connection::int($id);
		$query = Connection::query("SELECT `idCliente`, `nomeCliente`, `cpfCliente`, `cnhCliente`, `logradouroCliente`, `numCliente`, `complCliente`, `bairroCliente`, `cidadeCliente`, `cepCliente`, `ufCliente` FROM `tbCliente` WHERE `idCliente` = ".$cliente_id." LIMIT 1;");
		$query->setFetchMode(PDO::FETCH_CLASS, "Cliente");
		return $query->fetch();
	}
	public function verifyError(){
		list($idCliente, $nomeCliente, $cpfCliente, $cnhCliente, $logradouroCliente, $numCliente, $complCliente, $bairroCliente, $cidadeCliente, $cepCliente, $ufCliente) = $this->getProperties();
		if($nomeCliente===false){
			return "Verifique o nome do cliente.";
		}
		if($cpfCliente===false) {
			return "Verifique o cpf do cliente.";
		}
		if($cnhCliente===false) {
			return "Verifique a cnh do cliente.";
		}
		if($logradouroCliente===false) {
			return "Verifique o logradouro do cliente.";
		}
		if($complCliente===false) {
			return "Verifique a cnh do cliente.";
		}
		if($bairroCliente===false) {
			return "Verifique o bairro do cliente.";
		}
		if($cidadeCliente===false) {
			return "Verifique a cidade do cliente.";
		}
		if($cepCliente===false) {
			return "Verifique o cep do cliente.";
		}
		if($ufCliente===false) {
			return "Verifique o estado do cliente.";
		}
		return false;
	}
}
