<?php
include_once __DIR__."/../includes/include-all.inc.php";
include_once __DIR__."/includes/admin-actions.inc.php";
include "views/head.php";
?>
		<main class="main">
			<hr>
<?php
if(!@$veiculo) $veiculo = new Veiculo();
if($formType=="edit") {
?>
			<form action="veiculo.php" method="post" enctype="multipart/form-data">
				<h2>Editar Veículo</h2>
				<input type="hidden" name="action" value="editVeiculo">
				<input type="hidden" name="idVeiculo" value="<?php echo $veiculo->idVeiculo; ?>">
				<?php
} else if($formType=="add") {
?>
			<form action="#" method="post" enctype="multipart/form-data">
				<h2>Cadastrar Veículo</h2>
				<input type="hidden" name="action" value="addVeiculo">
<?php
}
?>
				<input type="hidden" name="idMarca" value="<?php echo $veiculo->idMarca; ?>">
				<label>
					Modelo:<br>
					<input type="text" name="modeloVeiculo" value="<?php echo $veiculo->modeloVeiculo; ?>"><br>
				</label><br>
				<label>
					Foto:<br>
<?php if($formType=="edit") { ?>
					<div class="responsive-image" style="background-image: url('/uploads/<?php echo $veiculo->fotoVeiculo; ?>');">
						<img src="/uploads/<?php echo $veiculo->fotoVeiculo; ?>"><br>
					</div><br>
<?php } ?>
					<input type="file" name="fotoVeiculo"><br>
				</label><br>
				<label>
					Marca:<br>
					<input type="text" id="filter-marca" value="<?php echo $veiculo->nomeMarca; ?>"><br>
					<ul id="marca-list"></ul><br>
				</label><br>
				<label>
					Cor:<br>
					<input type="color" name="corVeiculo" value="<?php echo Connection::getHexColor($veiculo->corVeiculo); ?>"><br>
				</label><br>
				<label>
					Ano:<br>
					<input type="number" name="anoVeiculo" min="1990" max="<?php echo date("Y"); ?>" value="<?php echo $veiculo->anoVeiculo; ?>"><br>
				</label><br>
				<label>
					Valor da Diária:<br>
					<input type="text" name="valorDiariaVeiculo" value="<?php echo $veiculo->valorDiariaVeiculo; ?>"><br>
				</label><br>
				<label>
<?php
if($formType=="edit") {
?>
					<input type="submit" value="Editar Veículo"><br>
<?php
} else if($formType=="add") {
?>
					<input type="submit" value="Cadastrar Veículo"><br>
<?php
}
?>				</label><br>
				<hr>
			</form>
			<h2>Veículos cadastradas</h2>
			<label>
				Filtrar Veículos:<br>
				<input type="text" id="filter-veiculo" value=""><br>
			</label><br>
			<ul id="veiculo-list"></ul>
			<hr>
		</main>
		<script>
approximateSearch(
	 document.querySelector("input#filter-marca")
	,(element) => "/api.php?action=approximate-search-marca&query="+element.value
	,(list) => {
		let container = document.querySelector("#marca-list");
		while(container.firstChild) container.firstChild.remove();
		for(let i=0; i<list.length; i++) {
			let line = document.createElement("li");
			{
				let text = document.createElement("div");
				text.classList.add("list-text");
				text.textContent = list[i].nomeMarca;
				line.appendChild(text);
				let options = document.createElement("div");
				options.classList.add("list-options");
				{
					let selectThis = document.createElement("input");
					selectThis.type = "button";
					selectThis.value = "Selecionar";
					selectThis.classList.add("inline-button");
					selectThis.classList.add("link-button");
					selectThis.addEventListener("click", function(e){
						document.querySelector("input[name=idMarca]").value = list[i].idMarca;
						selectOnly(container, e.target);
					});
					if(document.querySelector("input[name=idMarca]").value==list[i].idMarca) {
						selectOnly(container, selectThis);
					}
					options.appendChild(selectThis);
				}
				line.appendChild(options);
				let clear = document.createElement("span");
				clear.classList.add("clear");
				line.appendChild(clear);
			}
			container.appendChild(line);
		}
		if(document.querySelector("input[name=idMarca]").value=="") selectFirst(container);
	}
);
approximateSearch(
	 document.querySelector("input#filter-veiculo")
	,(element) => "/api.php?action=approximate-search-veiculo&query="+element.value
	,(list) => {
		let container = document.querySelector("#veiculo-list");
		while(container.firstChild) container.firstChild.remove();
		for(let i=0; i<list.length; i++) {
			let line = document.createElement("li");
			{
				let text = document.createElement("div");
				text.classList.add("list-text");
				text.textContent = list[i].modeloVeiculo;
				line.appendChild(text);
				let options = document.createElement("div");
				options.classList.add("list-options");
				{
					let formEditar = document.createElement("form");
					formEditar.action = "#";
					formEditar.method = "get";
					{
						let action = document.createElement("input");
						action.type = "hidden";
						action.name = "action";
						action.value = "editVeiculo";
						formEditar.appendChild(action);
						let idVeiculo = document.createElement("input");
						idVeiculo.type = "hidden";
						idVeiculo.name = "idVeiculo";
						idVeiculo.value = list[i].idVeiculo;
						formEditar.appendChild(idVeiculo);
						let submit = document.createElement("input");
						submit.type = "submit";
						submit.value = "Editar";
						submit.classList.add("inline-button");
						submit.classList.add("link-button");
						formEditar.appendChild(submit);
					}
					options.appendChild(formEditar);
					let formExcluir = document.createElement("form");
					formExcluir.action = "#";
					formExcluir.method = "post";
					{
						let action = document.createElement("input");
						action.type = "hidden";
						action.name = "action";
						action.value = "removeVeiculo";
						formExcluir.appendChild(action);
						let idVeiculo = document.createElement("input");
						idVeiculo.type = "hidden";
						idVeiculo.name = "idVeiculo";
						idVeiculo.value = list[i].idVeiculo;
						formExcluir.appendChild(idVeiculo);
						let submit = document.createElement("input");
						submit.type = "submit";
						submit.value = "Excluir";
						submit.classList.add("inline-button");
						submit.classList.add("link-button");
						formExcluir.appendChild(submit);
					}
					options.appendChild(formExcluir);
				}
				line.appendChild(options);
				let clear = document.createElement("span");
				clear.classList.add("clear");
				line.appendChild(clear);
			}
			container.appendChild(line);
		}
	}
);
		</script>
<?php
include "views/foot.php";
?>