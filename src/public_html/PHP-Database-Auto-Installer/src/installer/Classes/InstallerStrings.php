<?php
class InstallerStrings {
    public static $webpageTitle = "PHP Database Auto Installer - ALPHA 2";
    public static $contentTitle = "PHP Database Auto Installer - Instalação";
    public static $contentSubtitle = "Alpha 2";

    public static $databaseTitle = "Banco de dados";
    public static $hostname = "Nome do host";
    public static $username = "Nome de usuário";
    public static $password = "Senha";
    public static $database = "Nome do banco de dados";
    public static $startInstall = "Iniciar instalação";

    public static $databaseNameCantBeBlank = "O nome do banco de dados não pode estar em branco.";

    public static $installedWriteErrorTitle = "Instalação efetuada";
    public static $installedWriteErrorContent = "A instalação foi efetuada, porém não conseguimos escrever o arquivo \"includes/classes/Config.php\".<br>Por favor, crie esse arquivo com o seguinte conteúdo:";
    public static $installedWriteErrorNextButton = "Tentar novamente";

    public static $installedSuccessTitle = "Instalação efetuada";
    public static $installedSuccessContent = "A instalação foi efetuada com sucesso! Escolha uma opção abaixo e aproveite o nosso sistema!";
    public static $installedSuccessOptions = [ //strings for InstallerSettings::$installedOptions
        "Ir para a página inicial",
        "Ir para o painel administrativo",
    ];

    public static $successAlertTitle = "Sucesso!";
    public static $errorAlertTitle = "Ocorreu um erro!";
}
