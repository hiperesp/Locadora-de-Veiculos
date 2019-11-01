<?php
include_once __DIR__."/../includes/include-all.inc.php";
include_once __DIR__."/includes/admin-actions.inc.php";
include "views/head.php";
?>
		<main class="main">
			<hr>
<?php
if(!@$marca) $marca = new Marca();
if($formType=="edit") {
?>
			<form action="marca.php" method="post">
				<h2>Editar Marca</h2>
				<input type="hidden" name="action" value="editMarca">
				<input type="hidden" name="idMarca" value="<?php echo $marca->idMarca; ?>">
<?php
} else if($formType=="add") {
?>
			<form action="#" method="post">
				<h2>Cadastrar Marca</h2>
				<input type="hidden" name="action" value="addMarca">
<?php
}
?>
				<label>
					Marca:<br>
					<input type="text" name="nomeMarca" value="<?php echo $marca->nomeMarca; ?>"><br>
				</label><br>
				<label>
<?php
if($formType=="edit") {
?>
					<input type="submit" value="Editar Marca"><br>
<?php
} else if($formType=="add") {
?>
					<input type="submit" value="Cadastrar Marca"><br>
<?php
}
?>				</label><br>
				<hr>
			</form>
			<h2>Marcas cadastradas</h2>
			<label>
				Filtrar Marca:<br>
				<input type="text" id="filter-marca" value=""><br>
			</label><br>
			<ul id="marca-list"></ul>
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
					let formEditar = document.createElement("form");
					formEditar.action = "#";
					formEditar.method = "get";
					{
						let action = document.createElement("input");
						action.type = "hidden";
						action.name = "action";
						action.value = "editMarca";
						formEditar.appendChild(action);
						let idMarca = document.createElement("input");
						idMarca.type = "hidden";
						idMarca.name = "idMarca";
						idMarca.value = list[i].idMarca;
						formEditar.appendChild(idMarca);
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
						action.value = "removeMarca";
						formExcluir.appendChild(action);
						let idMarca = document.createElement("input");
						idMarca.type = "hidden";
						idMarca.name = "idMarca";
						idMarca.value = list[i].idMarca;
						formExcluir.appendChild(idMarca);
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