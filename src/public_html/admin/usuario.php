<?php
include_once __DIR__."/../includes/include-all.inc.php";
include_once __DIR__."/includes/admin-actions.inc.php";
include "views/head.php";
?>
		<main class="main">
			<hr>
<?php
if(!@$usuario) $usuario = new Usuario();
if($formType=="edit") {
?>
			<form action="usuario.php" method="post">
				<h2>Editar Usuario</h2>
				<input type="hidden" name="action" value="editUsuario">
				<input type="hidden" name="idUsuario" value="<?php echo $usuario->idUsuario; ?>">
<?php
} else if($formType=="add") {
?>
			<form action="#" method="post">
				<h2>Cadastrar Usuário</h2>
				<input type="hidden" name="action" value="addUsuario">
<?php
}
?>
				<label>
					Nome do Funcionário:<br>
					<input type="text" name="nomeUsuario" value="<?php echo $usuario->nomeUsuario; ?>"><br>
				</label><br>
				<hr>
				<label>
					Login do Funcionário:<br>
					<input type="text" name="loginUsuario" value="<?php echo $usuario->loginUsuario; ?>"><br>
				</label><br>
				<label>
					Senha do Funcionário:<br>
					<input type="password" name="senhaUsuario" value="<?php echo $usuario->senhaUsuario; ?>"><br>
				</label><br>
				<label>
<?php
if($formType=="edit") {
?>
					<input type="submit" value="Editar Funcionário"><br>
<?php
} else if($formType=="add") {
?>
					<input type="submit" value="Cadastrar Funcionário"><br>
<?php
}
?>
				</label><br>
				<hr>
			</form>
			<h2>Funcionários cadastrados</h2>
			<label>
				Filtrar Funcionário:<br>
				<input type="text" id="filter-funcionario" value=""><br>
			</label><br>
			<ul id="funcionario-list"></ul>
			<hr>
		</main>
		<script>
approximateSearch(
	 document.querySelector("input#filter-funcionario")
	,(element) => "/api.php?action=approximate-search-usuario&query="+element.value
	,(list) => {
		let container = document.querySelector("#funcionario-list");
		while(container.firstChild) container.firstChild.remove();
		for(let i=0; i<list.length; i++) {
			let line = document.createElement("li");
			{
				let text = document.createElement("div");
				text.classList.add("list-text");
				text.textContent = list[i].nomeUsuario;
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
						action.value = "editUsuario";
						formEditar.appendChild(action);
						let idUsuario = document.createElement("input");
						idUsuario.type = "hidden";
						idUsuario.name = "idUsuario";
						idUsuario.value = list[i].idUsuario;
						formEditar.appendChild(idUsuario);
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
						action.value = "removeUsuario";
						formExcluir.appendChild(action);
						let idUsuario = document.createElement("input");
						idUsuario.type = "hidden";
						idUsuario.name = "idUsuario";
						idUsuario.value = list[i].idUsuario;
						formExcluir.appendChild(idUsuario);
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