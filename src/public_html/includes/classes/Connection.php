<?php
class Connection {
	private static $connection;
	public static function init(){
		self::$connection = new PDO("mysql:host=".Config::$hostname.";dbname=".Config::$database, Config::$username, Config::$password);
		self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		self::$connection->exec("SET CHARACTER SET utf8");
		return self::$connection;
	}
	public static function exec($query) {
		return self::$connection->exec($query);
	}
	public static function query($query) {
		return self::$connection->query($query);
	}
	public static function treatString($string, $min = 1, $max = PHP_INT_SIZE) {
		$string = trim($string);
		if(strlen($string)<$min||strlen($string)>$max) return false;
		$string = self::quote($string);
		return $string;
	}
	public static function quote($string) {
		return self::$connection->quote($string);
	}
	public static function int($number) {
		return (int)$number;
	}
	public static function double($number) {
		return (double)$number;
	}
}
