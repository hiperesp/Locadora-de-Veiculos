<?php
include_once __DIR__."/InstallerSettings.php";
include_once __DIR__."/InstallerStrings.php";

class InstallerView {
	public static function showInstallScreen($hostname = "", $username = "", $password = "", $database = "", $responseText = "", $error = true, $topMessage = ""){
		self::showTopMessage($topMessage);
		self::showHeader();
		self::showInstallScreenContent($hostname, $username, $password, $database);
		self::showFooter($responseText, $error);
		die;
	}
	public static function showConfigFileScreen($hostname, $username, $password, $database, $configFileContent, $responseText = "", $error = false, $topMessage = ""){
		self::showTopMessage($topMessage);
		self::showHeader();
		self::showConfigFileScreenContent($hostname, $username, $password, $database, $configFileContent);
		self::showFooter($responseText, $error);
		die;
	}
	public static function showSuccessInstalledScreen($responseText = "", $error = false, $topMessage = ""){
		self::showTopMessage($topMessage);
		self::showHeader();
		self::showSuccessInstalledScreenContent();
		self::showFooter($responseText, $error);
		die;
	}
	public static function showTopMessage($message) {
		echo "<!--\n".$message."-->";
	}
	public static function showHeader() {
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no">
		<title><?php echo InstallerStrings::$webpageTitle; ?></title>
		<link rel="stylesheet" type="text/css" href="assets/style.css">
	</head>
	<body>
		<header>
			<div class="container">
				<h1><?php echo InstallerStrings::$contentTitle; ?></h1>
				<h3 class="version"><?php echo InstallerStrings::$contentSubtitle; ?></h3>
			</div>
		</header>
<?php
	}
	public static function showInstallScreenContent($hostname = "", $username = "", $password = "", $database = "") {
?>
		<main>
			<form action="#" method="post">
				<input type="hidden" name="action" value="installSystem">
				<hr>
				<h2><?php echo InstallerStrings::$databaseTitle; ?></h2>
				<label>
					<?php echo InstallerStrings::$hostname; ?><br>
					<input type="text" name="dbHostname" value="<?php echo $hostname; ?>"><br>
				</label><br>
				<label>
					<?php echo InstallerStrings::$username; ?><br>
					<input type="text" name="dbUsername" value="<?php echo $username; ?>"><br>
				</label><br>
				<label>
					<?php echo InstallerStrings::$password; ?><br>
					<input type="password" name="dbPassword" value="<?php echo $password; ?>"><br>
				</label><br>
				<label>
					<?php echo InstallerStrings::$database; ?><br>
					<input type="text" name="dbDatabase" value="<?php echo $database; ?>"><br>
				</label><br>
				<label>
					<input type="submit" value="<?php echo InstallerStrings::$startInstall; ?>"><br>
				</label><br>
				<hr>
			</form>
		</main>
<?php
	}
	public static function showConfigFileScreenContent($hostname, $username, $password, $database, $configFileContent) {
?>
		<main>
			<hr>
			<h2><?php echo InstallerStrings::$installedWriteErrorTitle; ?></h2>
			<label>
				<?php echo InstallerStrings::$installedWriteErrorContent; ?><br>
				<pre id="code"><?php echo htmlspecialchars($configFileContent); ?></pre><br>
			</label><br>
			<label>
			<form action="#" method="post">
				<input type="hidden" name="action" value="checkConfigFile">
				<input type="hidden" name="dbHostname" value="<?php echo $hostname; ?>">
				<input type="hidden" name="dbUsername" value="<?php echo $username; ?>">
				<input type="hidden" name="dbPassword" value="<?php echo $password; ?>">
				<input type="hidden" name="dbDatabase" value="<?php echo $database; ?>">
				<input type="submit" value="<?php echo InstallerStrings::$installedWriteErrorNextButton; ?>"><br>
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
	}
	public static function showSuccessInstalledScreenContent(){
?>
		<main>
			<hr>
			<h2><?php echo InstallerStrings::$installedSuccessTitle; ?></h2>
			<label>
				<?php echo InstallerStrings::$installedSuccessContent; ?><br>
			</label><br>
<?php foreach(InstallerSettings::$installedOptions as $key => $address) { ?>
			<a href="<?php echo $address; ?>"><input type="button" class="inline-button" value="<?php echo InstallerStrings::$installedSuccessOptions[$key]; ?>"></a>
<?php } ?>
			<br>
			<hr>
		</main>
<?php
	}
	public static function showFooter($responseText = "", $error = false) {
?>
		<div class="alert-container"></div>
		<script type="application/javascript" src="assets/script.js"></script>
		<script>
<?php if($responseText!=="") {?>addAlert("<?php echo $error===true?InstallerStrings::$successAlertTitle:InstallerStrings::$errorAlertTitle; ?>", "<?php echo $responseText; ?>"); <?php } ?>
		</script>
	</body>
</html>
<?php
	}
}
