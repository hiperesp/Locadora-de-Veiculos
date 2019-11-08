<?php
include_once __DIR__."/Classes/InstallerUtils.php";
if(InstallerUtils::needToInstall()) InstallerUtils::redirectToInstaller();