<?php
spl_autoload_register(function($class){
	return include_once __DIR__."/classes/".$class.".php";
});
