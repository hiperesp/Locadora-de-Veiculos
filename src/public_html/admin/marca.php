<?php
include_once __DIR__."/../includes/include-all.inc.php";
include_once __DIR__."/includes/admin-actions.inc.php";
include "views/head.php";
?>
		<main class="main">
			<hr>
			<form action="#" method="post">
				<h2>Cadastrar Marca</h2>
				<input type="hidden" name="action" value="addMarca">
				<label>
					Marca:<br>
					<input type="text" name="txtMarca" value=""><br>
				</label><br>
				<label>
					<input type="submit" value="Cadastrar Marca"><br>
				</label><br>
				<hr>
			</form>
			<h2>Marcas cadastradas</h2>
			<label>
				Filtrar Marca:<br>
				<input type="text" id="filter-marca" value=""><br>
			</label><br>
			<ul id="marca-list">
				<li>
					<div class="list-text">Marca 1</div>
					<div class="list-options">
						<a href="#"><input type="button" class="inline-button link-button" value="Editar"></a>
						<a href="#"><input type="button" class="inline-button link-button" value="Excluir"></a>
					</div>
					<span class="clear"></span>
				</li>
				<li>
					<div class="list-text">Marca 2</div>
					<div class="list-options">
						<a href="#"><input type="button" class="inline-button link-button" value="Editar"></a>
						<a href="#"><input type="button" class="inline-button link-button" value="Excluir"></a>
					</div>
					<span class="clear"></span>
				</li>
				<li>
					<div class="list-text">Marca 3</div>
					<div class="list-options">
						<a href="#"><input type="button" class="inline-button link-button" value="Editar"></a>
						<a href="#"><input type="button" class="inline-button link-button" value="Excluir"></a>
					</div>
					<span class="clear"></span>
				</li>
				<li>
					<div class="list-text">Marca 4</div>
					<div class="list-options">
						<a href="#"><input type="button" class="inline-button link-button" value="Editar"></a>
						<a href="#"><input type="button" class="inline-button link-button" value="Excluir"></a>
					</div>
					<span class="clear"></span>
				</li>
			</ul>
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
					formEditar.method = "post";
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
	});
		</script>
<?php
include "views/foot.php";
?>