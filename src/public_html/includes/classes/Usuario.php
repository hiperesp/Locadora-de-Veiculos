<?php
class Usuario {
	public $idUsuario;
	public $nomeUsuario;
	public $loginUsuario;
	public $senhaUsuario;

	public function getProperties(){
		return [
			Connection::int($this->idUsuario),
			Connection::treatString($this->nomeUsuario, 2, 255),
			Connection::treatString($this->loginUsuario, 2, 64),
			Connection::treatString(md5($this->senhaUsuario), 8, 32)
		];
	}
	public function cadastrar(){
		list($idUsuario, $nomeUsuario, $loginUsuario, $senhaUsuario) = $this->getProperties();
		$error = $this->verifyError();
		if($error===false) {
			Connection::exec("INSERT INTO `tbUsuario` (`idUsuario`, `nomeUsuario`, `loginUsuario`, `senhaUsuario`) VALUES (NULL, ".$nomeUsuario.", ".$loginUsuario.", ".$senhaUsuario.")");
			return true;
		}
		return $error;
	}
	public function remove() {
        global $usuarioLogado;
		list($idUsuario, $nomeUsuario, $loginUsuario, $senhaUsuario) = $this->getProperties();
        if($idUsuario==$usuarioLogado->idUsuario) {
            return "Você não pode se excluir. Peça para outro funcionário.";
        }
		Connection::exec("DELETE FROM `tbUsuario` WHERE `idUsuario` = ".$idUsuario.";");
		return true;
	}
	public function edit() {
		list($idUsuario, $nomeUsuario, $loginUsuario, $senhaUsuario) = $this->getProperties();
		$error = $this->verifyError();
		if($error===false) {
			Connection::exec("UPDATE `tbUsuario` SET `nomeUsuario`=".$nomeUsuario.", `senhaUsuario`=".$senhaUsuario." WHERE `idUsuario` = ".$idUsuario);
			return true;
		}
		return $error;
	}
	public static function approximateSearch($query) {
		$select = Connection::treatString("% ".$query."%", 0, 34);
		if($select!==false) {
			return Connection::query("SELECT `idUsuario`, `nomeUsuario`, `loginUsuario` FROM `tbUsuario` HAVING CONCAT(' ', `loginUsuario`) LIKE ".$select." OR CONCAT(' ', `nomeUsuario`) LIKE ".$select." ORDER BY `loginUsuario` LIMIT 10;")->fetchAll(PDO::FETCH_CLASS, "Usuario");
		}
		return [];
	}
	public static function get($id) {
		$usuario_id = Connection::int($id);
		$query = Connection::query("SELECT `idUsuario`, `nomeUsuario`, `loginUsuario` FROM `tbUsuario` WHERE `idUsuario` = ".$usuario_id." LIMIT 1;");
		$query->setFetchMode(PDO::FETCH_CLASS, "Usuario");
		return $query->fetch();
	}
    public function auth() {
		list($idUsuario, $nomeUsuario, $loginUsuario, $senhaUsuario) = $this->getProperties();
		$error = $this->verifyAuthError();
		if($error===false) {
            $query = Connection::query("SELECT `idUsuario`, `nomeUsuario`, `loginUsuario` FROM `tbUsuario` WHERE `loginUsuario` = ".$loginUsuario." AND `senhaUsuario` = ".$senhaUsuario." LIMIT 1;");
            $query->setFetchMode(PDO::FETCH_CLASS, "Usuario");
            return $query->fetch();
        }
        return $error;
    }
	public function verifyError() {
		list($idUsuario, $nomeUsuario, $loginUsuario, $senhaUsuario) = $this->getProperties();
		if($nomeUsuario===false) {
			return "Verifique o nome do usuário.";
		}
		return $this->verifyAuthError();
	}
	public function verifyAuthError() {
		list($idUsuario, $nomeUsuario, $loginUsuario, $senhaUsuario) = $this->getProperties();
		if($loginUsuario===false) {
			return "Verifique o login do usuário.";
		}
		if($senhaUsuario===false) {
			return "Verifique a senha do usuário deve possuir pelo menos 8 caracteres.";
		}
		return false;
	}
}