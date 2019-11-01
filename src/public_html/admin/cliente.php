<?php
include_once __DIR__."/../includes/include-all.inc.php";
include_once __DIR__."/includes/admin-actions.inc.php";
include "views/head.php";
?>
		<main class="main">
			<hr>
<?php
if(!@$cliente) $cliente = new Cliente();
if($formType=="edit") {
?>
			<form action="cliente.php" method="post">
				<h2>Editar Cliente</h2>
				<input type="hidden" name="action" value="editCliente">
				<input type="hidden" name="idCliente" value="<?php echo $cliente->idCliente; ?>">
<?php
} else if($formType=="add") {
?>
			<form action="#" method="post">
				<h2>Cadastrar Cliente</h2>
				<input type="hidden" name="action" value="addCliente">
<?php
}
?>
				<label>
					Nome do Cliente:<br>
					<input type="text" name="nomeCliente" value="<?php echo $cliente->nomeCliente; ?>"><br>
				</label><br>
				<label>
					CPF:<br>
					<input type="text" name="cpfCliente" minlength="11" maxlength="11" value="<?php echo $cliente->cpfCliente; ?>"><br>
				</label><br>
				<label>
					CNH:<br>
					<input type="text" name="cnhCliente" minlength="11" maxlength="11" value="<?php echo $cliente->cnhCliente; ?>"><br>
				</label><br>
				<hr>
				<label>
					CEP:<br>
					<input type="text" name="cepCliente" minlength="8" maxlength="8" value="<?php echo $cliente->cepCliente; ?>"><br>
				</label><br>
				<label>
					Logradouro:<br>
					<input type="text" name="logradouroCliente" value="<?php echo $cliente->logradouroCliente; ?>"><br>
				</label><br>
				<label>
					Número:<br>
					<input type="text" name="numCliente" value="<?php echo $cliente->numCliente; ?>"><br>
				</label><br>
				<label>
					Complemento:<br>
					<input type="text" name="complCliente" value="<?php echo $cliente->complCliente; ?>"><br>
				</label><br>
				<label>
					Bairro:<br>
					<input type="text" name="bairroCliente" value="<?php echo $cliente->bairroCliente; ?>"><br>
				</label><br>
				<label>
					Cidade:<br>
					<input type="text" name="cidadeCliente" value="<?php echo $cliente->cidadeCliente; ?>"><br>
				</label><br>
				<label>
				Estado:<br>
					<select id="estado" name="ufCliente">
						<option value="AC">Acre</option>
						<option value="AL">Alagoas</option>
						<option value="AP">Amapá</option>
						<option value="AM">Amazonas</option>
						<option value="BA">Bahia</option>
						<option value="CE">Ceará</option>
						<option value="DF">Distrito Federal</option>
						<option value="ES">Espírito Santo</option>
						<option value="GO">Goiás</option>
						<option value="MA">Maranhão</option>
						<option value="MT">Mato Grosso</option>
						<option value="MS">Mato Grosso do Sul</option>
						<option value="MG">Minas Gerais</option>
						<option value="PA">Pará</option>
						<option value="PB">Paraíba</option>
						<option value="PR">Paraná</option>
						<option value="PE">Pernambuco</option>
						<option value="PI">Piauí</option>
						<option value="RJ">Rio de Janeiro</option>
						<option value="RN">Rio Grande do Norte</option>
						<option value="RS">Rio Grande do Sul</option>
						<option value="RO">Rondônia</option>
						<option value="RR">Roraima</option>
						<option value="SC">Santa Catarina</option>
						<option value="SP">São Paulo</option>
						<option value="SE">Sergipe</option>
						<option value="TO">Tocantins</option>
					</select><br>
				</label><br>
				<label>
<?php
if($formType=="edit") {
?>
					<input type="submit" value="Editar Cliente"><br>
<?php
} else if($formType=="add") {
?>
					<input type="submit" value="Cadastrar Cliente"><br>
<?php
}
?>
				</label><br>
				<hr>
			</form>
			<h2>Clientes cadastrados</h2>
			<label>
				Filtrar Cliente:<br>
				<input type="text" id="filter-cliente" value=""><br>
			</label><br>
			<ul id="cliente-list"></ul>
			<hr>
		</main>
		<script>
//preguiça:
document.querySelector("#estado").value = "<?php echo $cliente->ufCliente; ?>"||document.querySelector("#estado").value;
cepAutocomplete(
	 document.querySelector("input[name=cepCliente]")
	,document.querySelector("input[name=logradouroCliente]")
	,document.querySelector("input[name=numCliente]")
	,document.querySelector("input[name=complCliente]")
	,document.querySelector("input[name=bairroCliente]")
	,document.querySelector("input[name=cidadeCliente]")
	,document.querySelector("select[name=ufCliente]")
);

approximateSearch(
	 document.querySelector("input#filter-cliente")
	,(element) => "/api.php?action=approximate-search-cliente&query="+element.value
	,(list) => {
		let container = document.querySelector("#cliente-list");
		while(container.firstChild) container.firstChild.remove();
		for(let i=0; i<list.length; i++) {
			let line = document.createElement("li");
			{
				let text = document.createElement("div");
				text.classList.add("list-text");
				text.textContent = list[i].nomeCliente;
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
						action.value = "editCliente";
						formEditar.appendChild(action);
						let idCliente = document.createElement("input");
						idCliente.type = "hidden";
						idCliente.name = "idCliente";
						idCliente.value = list[i].idCliente;
						formEditar.appendChild(idCliente);
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
						action.value = "removeCliente";
						formExcluir.appendChild(action);
						let idCliente = document.createElement("input");
						idCliente.type = "hidden";
						idCliente.name = "idCliente";
						idCliente.value = list[i].idCliente;
						formExcluir.appendChild(idCliente);
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