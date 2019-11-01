<?php
include_once "includes/include-all.inc.php";
?>
<?php
$title = "Rent a car";
include_once "views/admin_head.php";
?>
<main>
	<div class="header form-item">
		<h1>Cadastrar cliente</h1>
		<form action="#" method="post">
			<input type="hidden" name="action" value="add_marca">
			<div class="form-item">
				<input type="text" name="marca" value="" placeholder="Insira a Marca">
			</div>
			<div class="form-item">
				<input type="submit" value="Cadastrar">
			</div>
		</form>
	</div>
</main>
<?php
include_once "views/admin_foot.php";
