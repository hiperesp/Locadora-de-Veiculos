<?php
include_once "includes/include-all.inc.php";
?>
<?php
if(isset($_FILES["foto"])) {
	$target_dir = "uploads/";
	$target_file = $target_dir . basename($_FILES["foto"]["name"]);
	$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
	
	$check = getimagesize($_FILES["foto"]["tmp_name"]);
	if($check !== false) {
		echo "File is an image - " . $check["mime"] . ".";
		if (move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file)) {
			echo "The file ". basename( $_FILES["foto"]["name"]). " has been uploaded.";
		} else {
			echo "Sorry, there was an error uploading your file.";
		}
		$uploadOk = true;
	} else {
		echo "File is not an image.";
		$uploadOk = false;
	}
}
$title = "Rent a car";
include_once "views/admin_head.php";
?>
<main>
	<div class="header form-item">
		<h1>Cadastrar veículo</h1>
		<form action="#" method="post" enctype="multipart/form-data">
			<input type="hidden" name="action" value="add_marca">
			<div class="form-item">
				<h3>Selecione a marca do veículo</h3>
				<select>
					<option readonly="">Selecionar</option>
					<option value="1">Marca</option>
					<option value="2">mArca</option>
					<option value="3">MARCA</option>
				</select>
			</div>
			<div class="form-item">
				<h3>Selecione o ano do veículo</h3>
				<input type="number" min="2000" max="<?php echo date("Y"); ?>" name="anoVeiculo" value="" placeholder="Ano do veículo" required="">
			</div>
			<div class="form-item">
				<h3>Selecione a cor do veículo</h3>
				<input type="color" name="color" value="">
			</div>
			<div class="form-item">
				<h3>Insira o modelo do veículo</h3>
				<input type="text" name="modelo" value="">
			</div>
			<div class="form-item">
				<h3>Insira o valor da diária do veículo</h3>
				<input type="number" step="0.01" name="diaria" value="">
			</div>
			<div class="form-item">
				<h3>Insira a foto do veículo</h3>
				<input type="file" name="foto">
			</div>
			<div class="form-item">
				<input type="submit" value="Cadastrar"><br><br>
			</div>
		</form>
	</div>
</main>
<?php
include_once "views/admin_foot.php";
