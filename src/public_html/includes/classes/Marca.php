<?php
class Marca {
	public $idMarca;
	public $nomeMarca;
	public function cadastrar(){
		$marca = Connection::treatString($this->nomeMarca, 2, 32);
		if($marca!==false) {
			Connection::exec("INSERT INTO `tbMarca`(`idMarca`, `nomeMarca`) VALUES (NULL, ".$marca.");");
			return true;
		}
		return "Verifique o nome da marca.";
	}
	public static function approximateSearch($query) {
		$select = Connection::treatString("% ".$query."%", 0, 34);
		if($select!==false) {
			return Connection::query("SELECT `idMarca`, `nomeMarca` FROM `tbMarca` HAVING CONCAT(' ', `nomeMarca`) LIKE ".$select." LIMIT 10;")->fetchAll(PDO::FETCH_CLASS, "Marca");
		}
		return [];
	}
}