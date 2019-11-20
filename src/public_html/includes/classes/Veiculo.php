<?php
class Veiculo {
	public $idVeiculo;
	public $idMarca;
	public $anoVeiculo;
	public $corVeiculo;
	public $modeloVeiculo;
	public $valorDiariaVeiculo;
	public $fotoVeiculo;
	public $nomeMarca;
	
	public function getProperties(){
		return [
			Connection::int($this->idVeiculo),
			Connection::int($this->idMarca),
			Connection::int($this->anoVeiculo),
			Connection::color($this->corVeiculo),
			Connection::treatString($this->modeloVeiculo, 2, 32),
			Connection::double($this->valorDiariaVeiculo),
			Connection::treatString($this->fotoVeiculo, 2, 64),
		];
	}
	public function cadastrar(){
		list($idVeiculo, $idMarca, $anoVeiculo, $corVeiculo, $modeloVeiculo, $valorDiariaVeiculo, $fotoVeiculo) = $this->getProperties();
		$error = $this->verifyError();
		if($error===false) {
			Connection::exec("INSERT INTO `tbVeiculo` (`idVeiculo`, `idMarca`, `anoVeiculo`, `corVeiculo`, `modeloVeiculo`, `valorDiariaVeiculo`, `fotoVeiculo`) VALUES (null, ".$idMarca.", ".$anoVeiculo.", ".$corVeiculo.", ".$modeloVeiculo.", ".$valorDiariaVeiculo.", ".$fotoVeiculo.");");
			return true;
		}
		return $error;
	}
	public function remove() {
		list($idVeiculo, $idMarca, $anoVeiculo, $corVeiculo, $modeloVeiculo, $valorDiariaVeiculo, $fotoVeiculo) = $this->getProperties();
		Connection::exec("DELETE FROM `tbVeiculo` WHERE `idVeiculo` = ".$idVeiculo.";");
		return true;
	}
	public function edit() {
		list($idVeiculo, $idMarca, $anoVeiculo, $corVeiculo, $modeloVeiculo, $valorDiariaVeiculo, $fotoVeiculo) = $this->getProperties();
		$error = $this->verifyEditError();
		if($error===false) {
			Connection::exec("UPDATE `tbVeiculo` SET `idMarca` = ".$idMarca.", `anoVeiculo` = ".$anoVeiculo.", `corVeiculo` = ".$corVeiculo.", `modeloVeiculo` = ".$modeloVeiculo.", `valorDiariaVeiculo` = ".$valorDiariaVeiculo.($fotoVeiculo!==false?", `fotoVeiculo` = ".$fotoVeiculo:"")." WHERE `idVeiculo` = ".$idVeiculo.";");
			return true;
		}
		return $error;
	}
	public static function approximateSearch($query) {
		$select = Connection::treatString("% ".$query."%", 0, 34);
		if($select!==false) {
			return Connection::query("SELECT `idVeiculo`,`idMarca`,`anoVeiculo`,`corVeiculo`,`modeloVeiculo`,`valorDiariaVeiculo`,`valorDiariaVeiculo`, `fotoVeiculo` FROM `tbVeiculo` HAVING CONCAT(' ', `modeloVeiculo`) LIKE ".$select." ORDER BY `modeloVeiculo` LIMIT 10;")->fetchAll(PDO::FETCH_CLASS, "Veiculo");
		}
		return [];
	}
	public static function getAll($limit) {
        $limit = (int)$limit;
        if($limit<1) {
            $stringLimit = "";
        } else {
            $stringLimit = "LIMIT ".$limit;
        }
        return Connection::query("SELECT `idVeiculo`,`idMarca`,`anoVeiculo`,`corVeiculo`,`modeloVeiculo`,`valorDiariaVeiculo`,`valorDiariaVeiculo`, `fotoVeiculo` FROM `tbVeiculo` ORDER BY `idVeiculo` ".$stringLimit.";")->fetchAll(PDO::FETCH_CLASS, "Veiculo");
		return [];
	}
	public static function get($id) {
		$veiculo_id = Connection::int($id);
		$query = Connection::query("SELECT `idVeiculo`,`tbVeiculo`.`idMarca`,`nomeMarca`,`anoVeiculo`,`corVeiculo`,`modeloVeiculo`,`valorDiariaVeiculo`,`valorDiariaVeiculo`, `fotoVeiculo` FROM `tbVeiculo` INNER JOIN `tbMarca` ON `tbVeiculo`.`idMarca`=`tbMarca`.`idMarca` WHERE `idVeiculo` = ".$veiculo_id." LIMIT 1;");
		$query->setFetchMode(PDO::FETCH_CLASS, "Veiculo");
		return $query->fetch();
	}
	public function verifyError() {
		list($idVeiculo, $idMarca, $anoVeiculo, $corVeiculo, $modeloVeiculo, $valorDiariaVeiculo, $fotoVeiculo) = $this->getProperties();
		if($fotoVeiculo===false) {
			return "Verifique a foto do veículo.";
		}
		return $this->verifyEditError();
	}
	public function verifyEditError() {
		list($idVeiculo, $idMarca, $anoVeiculo, $corVeiculo, $modeloVeiculo, $valorDiariaVeiculo, $fotoVeiculo) = $this->getProperties();
		if($modeloVeiculo===false) {
			return "Verifique o modelo do veículo.";
		}
		return false;
	}
}