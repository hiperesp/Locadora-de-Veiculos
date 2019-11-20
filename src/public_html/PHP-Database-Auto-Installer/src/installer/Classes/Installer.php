<?php
include_once __DIR__."/InstallerConstants.php";

class Installer implements InstallerConstants {
    public static $pdoExceptionMessage = null;
    public static $pdoExceptionOriginalMessage = null;
    public static $genericExceptionMessage = null;
    public static $configFileContent = null;
    public static function install($hostname, $username, $password, $database){
        if(empty(trim($database))) return self::NOT_INSTALLED_UNKNOWN_DATABASE;
		try {
            $connection = new PDO("mysql:host=".$hostname/*.";dbname=".$database*/, $username, $password);
            $connection->exec("CREATE DATABASE IF NOT EXISTS ".$database.";");
            $connection->exec("USE ".$database.";");
			$connection->setAttribute(PDO::ATTR_EMULATE_PREPARES, 0);

			$sqlFilesToInstall = count(InstallerSettings::$sqlFilesLocation);
			for($i=0; $i<$sqlFilesToInstall; $i++) {
				$sql = file_get_contents(InstallerSettings::$sqlFilesLocation[$i]);
				$connection->exec($sql);
            }
            return self::writeSettingsFile($hostname, $username, $password, $database);
		} catch (PDOException $e) {
			preg_match('/SQLSTATE\[(\w+)\] \[(\w+)\] (.*)/', $e->getMessage(), $matches);
            $code = ($matches[1] == 'HT000' ? $matches[2] : $matches[1]);
            $message = $matches[3];
            self::$pdoExceptionMessage = $message."\\nCode: ".$code;
            self::$pdoExceptionOriginalMessage = $e->getMessage();
            return self::NOT_INSTALLED_PDO_EXCEPTION;
		}
    }
    public static function writeSettingsFile($hostname, $username, $password, $database) {
        $configFileContent = file_get_contents(InstallerSettings::$configSampleFileLocation);
        $configFileContent = str_replace("%hiperesp_hostname%", $hostname, $configFileContent);
        $configFileContent = str_replace("%hiperesp_username%", $username, $configFileContent);
        $configFileContent = str_replace("%hiperesp_password%", $password, $configFileContent);
        $configFileContent = str_replace("%hiperesp_database%", $database, $configFileContent);
        if(!@file_put_contents(InstallerSettings::$configOutputFileLocation, $configFileContent)) {
            self::$configFileContent = $configFileContent;
            return self::INSTALLED_WRITE_ERROR;
        }
        return self::INSTALLED_SUCCESSFULLY;
    }
}