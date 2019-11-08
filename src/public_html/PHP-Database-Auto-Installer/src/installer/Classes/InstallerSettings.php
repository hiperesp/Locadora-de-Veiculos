<?php
class InstallerSettings {
    public static $homepageAddress = "/";
    public static $installerAddress = "/PHP-Database-Auto-Installer/src/installer";
    public static $configSampleFileLocation = __DIR__."/../../../../includes/classes/Config.sample.php";
    public static $configOutputFileLocation = __DIR__."/../../../../includes/classes/Config.php";
    public static $sqlFilesLocation = [
        __DIR__."/../sql/create.sql",
        __DIR__."/../sql/insert.sql",
    ];
    public static $installedOptions = [
        "/",
        "/admin"
    ];
}
