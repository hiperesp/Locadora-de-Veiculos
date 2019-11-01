<?php
include __DIR__."/installerSettings.php";
if(@include $installerSettings["ConfigOutputFileLocation"]){
	header("Location: ".$installerSettings["HomepageAddress"]);
    die();
}
$action = @$_POST['action'];
$mainContent = "install_screen";
$responseText = "";

$hostname = @$_POST['db_hostname'];
$username = @$_POST['db_username'];
$password = @$_POST['db_password'];
$database = @$_POST['db_database'];

switch($action){
	case "install_system":
		try {
			$connection = new PDO("mysql:host=".$hostname.";dbname=".$database, $username, $password);
			$connection->setAttribute(PDO::ATTR_EMULATE_PREPARES, 0);
			$sql = file_get_contents($installerSettings["SQLFileLocation"]);
			$connection->exec($sql);
			$file_content = '<?php
class Config {
	public static $hostname = "'.$hostname.'";
	public static $username = "'.$username.'";
	public static $password = "'.$password.'";
	public static $database = "'.$database.'";
}';
			if(!@file_put_contents($installerSettings["ConfigOutputFileLocation"], $file_content)) {
				$mainContent = "config_file_screen";
			} else {
				header("Location: ".$installerSettings["HomepageAddress"]);
				die();
			}
		} catch (PDOException $e) {
			preg_match('/SQLSTATE\[(\w+)\] \[(\w+)\] (.*)/', $e->getMessage(), $matches);
            $code = ($matches[1] == 'HT000' ? $matches[2] : $matches[1]);
            $message = $matches[3];
			$responseText = $message."\\nCode: ".$code;
		}
		break;
}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no">
		<title><?php echo $installerSettings["InstallerWebpageTitle"]; ?></title>
		<link rel="stylesheet" type="text/css" href="assets/style.css">
	</head>
	<body>
		<header>
			<div class="container">
				<h1><?php echo $installerSettings["InstallerContentTitle"]; ?></h1>
				<h3 class="version"><?php echo $installerSettings["InstallerContentSubtitle"]; ?></h3>
			</div>
		</header>
<?php
switch($mainContent) {
	case "install_screen":
?>
		<main>
			<form action="#" method="post">
				<input type="hidden" name="action" value="install_system">
				<hr>
				<h2>Banco de dados</h2>
				<label>
					Host:<br>
					<input type="text" name="db_hostname" value="<?php echo $hostname; ?>"><br>
				</label><br>
				<label>
					User:<br>
					<input type="text" name="db_username" value="<?php echo $username; ?>"><br>
				</label><br>
				<label>
					Password:<br>
					<input type="password" name="db_password" value="<?php echo $password; ?>"><br>
				</label><br>
				<label>
					Database name:<br>
					<input type="text" name="db_database" value="<?php echo $database; ?>"><br>
				</label><br>
				<label>
					<input type="submit" value="Iniciar instalação"><br>
				</label><br>
				<hr>
			</form>
		</main>
<?php
		break;
	case "config_file_screen":
?>
		<main>
			<hr>
			<h2>Instalação efetuada</h2>
			<label>
				A instalação foi efetuada, porém não conseguimos escrever o arquivo "includes/classes/Config.php".<br>
				Por favor, crie esse arquivo com o seguinte conteúdo:<br>
				<pre id="code"><?php echo htmlspecialchars($file_content); ?></pre><br>
			</label><br>
			<label>
				<a href="index.php"><input type="button" value="Pronto!"></a><br>
			</label><br>
			<hr>
		</main>
		<script>
document.querySelector("#code").addEventListener("click", function(e){
	if (document.body.createTextRange) {
		const range = document.body.createTextRange();
		range.moveToElementText(this);
		range.select();
	} else if (window.getSelection) {
		const selection = window.getSelection();
		const range = document.createRange();
		range.selectNodeContents(this);
		selection.removeAllRanges();
		selection.addRange(range);
	}
});
		</script>
<?php
		break;
}
?>
		<div class="alert-container"></div>
		<script type="application/javascript" src="assets/script.js"></script>
		<script>
<?php if($responseText!=="") {?>addAlert("Ocorreu um erro:", "<?php echo $responseText; ?>"); <?php } ?>
		</script>
	</body>
</html>