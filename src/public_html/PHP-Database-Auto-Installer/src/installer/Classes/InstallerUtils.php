<?php
include_once __DIR__."/InstallerSettings.php";

class InstallerUtils {
    public static function needToInstall(){
        return !file_exists(InstallerSettings::$configOutputFileLocation);
    }
    public static function redirectToInstaller(){
        self::redirectTo(InstallerSettings::$installerAddress);
    }
    public static function redirectToHomepage(){
        self::redirectTo(InstallerSettings::$homepageAddress);
    }
    public static function redirectTo($address) {
        header("location: ".$address);
        die;
    }
}