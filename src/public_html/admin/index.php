<?php
$do_not_show_back_button = true;
include_once __DIR__."/../includes/include-all.inc.php";
include_once __DIR__."/includes/admin-actions.inc.php";
include "views/head.php";
?>
		<main class="main">
			<hr>
			<h2>Opções disponíveis</h2>
			<a href="usuario.php"><input type="button" class="inline-button" value="Funcionários"></a>
			<a href="cliente.php"><input type="button" class="inline-button" value="Clientes"></a>
			<a href="marca.php"><input type="button" class="inline-button" value="Marcas"></a>
			<a href="veiculo.php"><input type="button" class="inline-button" value="Veículos"></a>
			<a href="locacao.php"><input type="button" class="inline-button" value="Locação"></a>
			<a href="?logout"><input type="button" class="inline-button" value="Logout"></a>
		</main>
<?php
include "views/foot.php";
?>