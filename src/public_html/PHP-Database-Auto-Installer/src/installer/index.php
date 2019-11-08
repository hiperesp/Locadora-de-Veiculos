<?php
include_once __DIR__."/Classes/InstallerUtils.php";
$action = @$_POST["action"];
if(!InstallerUtils::needToInstall()&&$action!="checkConfigFile") InstallerUtils::redirectToHomepage();
include_once __DIR__."/Classes/Installer.php";
include_once __DIR__."/Classes/InstallerView.php";

list($hostname, $username, $password, $database) = [@$_POST['dbHostname'], @$_POST['dbUsername'], @$_POST['dbPassword'], @$_POST['dbDatabase']];
if($action=="installSystem") {
	$installerResponse = Installer::install($hostname, $username, $password, $database);
	if($installerResponse==Installer::INSTALLED_SUCCESSFULLY) InstallerView::showSuccessInstalledScreen();
	if($installerResponse==Installer::INSTALLED_WRITE_ERROR) InstallerView::showConfigFileScreen($hostname, $username, $password, $database, Installer::$configFileContent);
	if($installerResponse==Installer::NOT_INSTALLED_PDO_EXCEPTION) InstallerView::showInstallScreen($hostname, $username, $password, $database, Installer::$pdoExceptionMessage, true, Installer::$pdoExceptionOriginalMessage);
	if($installerResponse==Installer::NOT_INSTALLED_UNKNOWN_DATABASE) InstallerView::showInstallScreen($hostname, $username, $password, $database, InstallerStrings::$databaseNameCantBeBlank, true);
	echo "What is it?\nWhy am I here?";
} else if($action=="checkConfigFile") {
	if(!InstallerUtils::needToInstall()) InstallerView::showSuccessInstalledScreen();
	$writeResponse = Installer::writeSettingsFile($hostname, $username, $password, $database);
	if($writeResponse==Installer::INSTALLED_SUCCESSFULLY) InstallerView::showSuccessInstalledScreen();
	if($writeResponse==Installer::INSTALLED_WRITE_ERROR) InstallerView::showConfigFileScreen($hostname, $username, $password, $database, Installer::$configFileContent);
	echo "What is it?\nWhy am I here?";
} else {
	InstallerView::showInstallScreen();
}
?>