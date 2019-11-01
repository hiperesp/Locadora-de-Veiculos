<?php
include_once __DIR__."/../includes/include-all.inc.php";
$do_not_show_back_button = true;
include "views/head.php";
?>
		<main class="main">
			<hr>
			<h2>Opções disponíveis</h2>
			<a href="cliente.php"><input type="button" class="inline-button" value="Clientes"></a>
			<a href="marca.php"><input type="button" class="inline-button" value="Marcas"></a>
			<a href="veiculo.php"><input type="button" class="inline-button" value="Veículos"></a>
		</main>
<?php
include "views/foot.php";
?>