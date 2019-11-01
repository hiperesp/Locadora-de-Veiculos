<?php
class Marca {
	public $idMarca;
	public $nomeMarca;

	public function getProperties(){
		return [
			Connection::int($this->idMarca),
			Connection::treatString($this->nomeMarca, 2, 32)
		];
	}
	public function cadastrar(){
		list($idMarca, $nomeMarca) = $this->getProperties();
		$error = $this->verifyError();
		if($error===false) {
			Connection::exec("INSERT INTO `tbMarca`(`idMarca`, `nomeMarca`) VALUES (NULL, ".$nomeMarca.");");
			return true;
		}
		return $error;
	}
	public function remove() {
		list($idMarca, $nomeMarca) = $this->getProperties();
		Connection::exec("DELETE FROM `tbMarca` WHERE `idMarca` = ".$idMarca.";");
		return true;
	}
	public function edit() {
		list($idMarca, $nomeMarca) = $this->getProperties();
		$error = $this->verifyError();
		if($error===false) {
			Connection::exec("UPDATE `tbMarca` SET `nomeMarca`=".$nomeMarca." WHERE `idMarca` = ".$idMarca);
			return true;
		}
		return $error;
	}
	public static function approximateSearch($query) {
		$select = Connection::treatString("% ".$query."%", 0, 34);
		if($select!==false) {
			return Connection::query("SELECT `idMarca`, `nomeMarca` FROM `tbMarca` HAVING CONCAT(' ', `nomeMarca`) LIKE ".$select." ORDER BY `nomeMarca` LIMIT 10;")->fetchAll(PDO::FETCH_CLASS, "Marca");
		}
		return [];
	}
	public static function get($id) {
		$marca_id = Connection::int($id);
		$query = Connection::query("SELECT `idMarca`, `nomeMarca` FROM `tbMarca` WHERE `idMarca` = ".$marca_id." LIMIT 1;");
		$query->setFetchMode(PDO::FETCH_CLASS, "Marca");
		return $query->fetch();
	}
	public function verifyError() {
		list($idMarca, $nomeMarca) = $this->getProperties();
		if($nomeMarca===false) {
			return "Verifique o nome da marca.";
		}
		return false;
	}
}