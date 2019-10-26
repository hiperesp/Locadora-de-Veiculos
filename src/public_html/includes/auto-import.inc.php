<?php
spl_autoload_register(function($class){
	return include_once "includes/classes/".$class.".class.php";
});