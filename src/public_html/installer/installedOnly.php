<?php
include __DIR__."/installerSettings.php";
if(!@include $installerSettings["ConfigOutputFileLocation"]){
    header("Location: ".$installerSettings["InstallerAddress"]."/index.php");
    die();
}
