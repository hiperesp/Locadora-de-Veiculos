<?php
include_once __DIR__."/../includes/include-all.inc.php";
include_once __DIR__."/includes/admin-actions.inc.php";
include "views/head.php";
?>
		<main class="main">
			<hr>
<?php
if(!@$locacao) $locacao = new Locacao();
if($formType=="add") {
?>
			<form action="#" method="post" enctype="multipart/form-data">
				<h2>Cadastrar Locação</h2>
				<input type="hidden" name="action" value="addLocacao">
<?php
}
?>
				<input type="hidden" name="idVeiculo" value="<?php echo $locacao->idVeiculo; ?>">
				<input type="hidden" name="idCliente" value="<?php echo $locacao->idCliente; ?>">
				<label>
					Veiculo:<br>
					<input type="text" id="filter-veiculo" value="<?php echo $locacao->idVeiculo; ?>"><br>
					<ul id="veiculo-list"></ul><br>
				</label><br>
				<label>
					Cliente:<br>
					<input type="text" id="filter-cliente" value="<?php echo $locacao->idCliente; ?>"><br>
					<ul id="cliente-list"></ul><br>
				</label><br>
				<label>
					Data inicial:<br>
					<input type="date" name="dtInicial" value=""><br>
				</label><br>
				<label>
					Data final:<br>
					<input type="date" name="dtFinal" value=""><br>
				</label><br>
				<label>
					Valor Total:<br>
					<input type="number" readonly="" name="valorTotal" value="0.00"><br>
				</label><br>
				<label>
<?php
if($formType=="add") {
?>
					<input id="submitButton" type="submit" value="Cadastrar Locação"><br>
<?php
}
?>				</label><br>
				<hr>
			</form>
			<h2>Últimas locações cadastradas</h2>
			<label style="display:none;">
				Filtrar Locação:<br>
				<input type="text" id="filter-locacao" value=""><br>
			</label><br style="display:none;">
			<ul>
				<li style="background-color: #0000000f;"><div class="list-text">ID - Funcionário - Cliente - Veículo - Período - Valor</div><span class="clear"></li>
			</ul>
			<ul id="locacao-list"></ul>
			<hr>
		</main>
		<script>
let selectedVehiclePrice = 0;
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
					let selectThis = document.createElement("input");
					selectThis.type = "button";
					selectThis.value = "Selecionar";
					selectThis.classList.add("inline-button");
					selectThis.classList.add("link-button");
					selectThis.addEventListener("click", function(e){
						document.querySelector("input[name=idVeiculo]").value = list[i].idVeiculo;
						selectedVehiclePrice = list[i].valorDiariaVeiculo;
						selectOnly(container, e.target);
					});
					if(document.querySelector("input[name=idVeiculo]").value==list[i].idVeiculo) {
						selectedVehiclePrice = list[i].valorDiariaVeiculo;
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
		if(document.querySelector("input[name=idVeiculo]").value=="") selectFirst(container);
	}
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
					let selectThis = document.createElement("input");
					selectThis.type = "button";
					selectThis.value = "Selecionar";
					selectThis.classList.add("inline-button");
					selectThis.classList.add("link-button");
					selectThis.addEventListener("click", function(e){
						document.querySelector("input[name=idCliente]").value = list[i].idCliente;
						selectOnly(container, e.target);
					});
					if(document.querySelector("input[name=idCliente]").value==list[i].idCliente) {
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
		if(document.querySelector("input[name=idCliente]").value=="") selectFirst(container);
	}
);
approximateSearch(
	 document.querySelector("input#filter-locacao")
	,(element) => "/api.php?action=approximate-search-locacao&query="+element.value
	,(list) => {
		let container = document.querySelector("#locacao-list");
		while(container.firstChild) container.firstChild.remove();
		for(let i=0; i<list.length; i++) {
			let line = document.createElement("li");
			{
				let text = document.createElement("div");
				text.classList.add("list-text");
				let dtInicial = new Date(list[i].dtInicial);
				let dtFinal = new Date(list[i].dtFinal);
				dtInicial = dtInicial.toJSON().slice(0,10).split("-").reverse().join("/");
				dtFinal = dtFinal.toJSON().slice(0,10).split("-").reverse().join("/");
				text.textContent = ""+list[i].idLocacao+" - "+list[i].nomeUsuario.split(" ")[0]+" - "+list[i].nomeCliente.split(" ")[0]+" - "+list[i].nomeMarca+" "+list[i].modeloVeiculo+" - ["+dtInicial+" - "+dtFinal+"] - R$ "+list[i].valorTotal;
				line.appendChild(text);
				/*let options = document.createElement("div");
				options.classList.add("list-options");
				{
					let formExcluir = document.createElement("form");
					formExcluir.action = "#";
					formExcluir.method = "post";
					{
						let action = document.createElement("input");
						action.type = "hidden";
						action.name = "action";
						action.value = "removeLocacao";
						formExcluir.appendChild(action);
						let idLocacao = document.createElement("input");
						idLocacao.type = "hidden";
						idLocacao.name = "idLocacao";
						idLocacao.value = list[i].idLocacao;
						formExcluir.appendChild(idLocacao);
						let submit = document.createElement("input");
						submit.type = "submit";
						submit.value = "Excluir";
						submit.classList.add("inline-button");
						submit.classList.add("link-button");
						formExcluir.appendChild(submit);
					}
					options.appendChild(formExcluir);
				}
				line.appendChild(options);*/
				let clear = document.createElement("span");
				clear.classList.add("clear");
				line.appendChild(clear);
			}
			container.appendChild(line);
		}
	}
);

let dtInicial = document.querySelector("*[name=dtInicial]");
dtInicial.addEventListener("change", recalculatePrice);
let dtFinal = document.querySelector("*[name=dtFinal]");
dtFinal.addEventListener("change", recalculatePrice);
let price = document.querySelector("*[name=valorTotal]");
let submitButton = document.querySelector("#submitButton");

function recalculatePrice() {
	let today = new Date().getTime();
	let start = new Date(dtInicial.value).getTime();
	let end = new Date(dtFinal.value).getTime();
	let offset;
	submitButton.onclick = function(){};
	if(start<today) {
		submitButton.onclick = submitHandleClick(-2);
		offset = 0;
	} else {
		offset = end-start;
		if(offset<0||isNaN(offset)) {
			submitButton.onclick = submitHandleClick(-1);
			offset = 0;
		} else if(offset<1*24*60*60*1000||isNaN(offset)) {
			offset = 1*24*60*60*1000;
		}
	}
	offset = offset/1000/60/60/24;
	price.value = offset*selectedVehiclePrice;
}
function submitHandleClick(error) {
	if(error==-1) return function(){addAlert("Não é possível continuar.", "Verifique a data da locação", true); return false;}
	if(error==-2) return function(){addAlert("Não é possível continuar.", "A data de locação não pode ser menor que hoje", true); return false;}
}
		</script>
<?php
include "views/foot.php";
?>