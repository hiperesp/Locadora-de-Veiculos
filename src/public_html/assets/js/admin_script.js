var lastCep = "";
function cepAutocomplete(element, logradouroElement, numeroElement, complementoElement, bairroElement, cidadeElement, estadoElement) {
	element.addEventListener("keyup", async (event) => {
		if(event.target.value.length=="8"&&event.target.value!=lastCep) {
			lastCep = event.target.value;
			let json = await fetch("https://viacep.com.br/ws/"+event.target.value+"/json")
			.then((data) => data.json())
			.then((json) => json);
			if(json.erro) {
				addAlert("Atenção:", "O cep informado não foi localizado");
			} else {
				logradouroElement.value		= json.logradouro	||logradouroElement.value;
				numeroElement.value			= json.numero		||numeroElement.value;
				complementoElement.value	= json.complemento	||complementoElement.value;
				bairroElement.value			= json.bairro		||bairroElement.value;
				cidadeElement.value			= json.localidade	||cidadeElement.value;
				estadoElement.value			= json.uf			||estadoElement.value;
			}
		}
	});
}

function approximateSearch(element, action, callback){
	element.addEventListener("keyup", async (event) => {
		let json = await fetch(action(element))
		.then((data) => data.json())
		.then((json) => json);
		callback(json);
	});
	element.dispatchEvent(new Event("keyup"));
}
function selectOnly(container, element) {
	let listElements = container.querySelectorAll("li input[type=button]");
	for(let i=0; i<listElements.length; i++) {
		listElements[i].classList.remove("selected-button");
		listElements[i].value = "Selecionar";
	}
	element.classList.add("selected-button");
	element.value = "Selecionado";
}
function selectFirst(container) {
	let firstListElement = container.querySelector("li input[type=button]");
	if(firstListElement) firstListElement.dispatchEvent(new Event("click"));
}
function addAlert(title, content, error = true){
	let alertElement = document.createElement("div");
	alertElement.classList.add("alert");
	if(!error) alertElement.classList.add("success");
	{
		{
			let titleElement = document.createElement("h3");
			titleElement.textContent = title;
			alertElement.appendChild(titleElement);
		}
		{
			let separator = document.createElement("hr");
			alertElement.appendChild(separator);
		}
		{
			let titleElement = document.createElement("p");
			titleElement.textContent = content;
			alertElement.appendChild(titleElement);
		}
	}
	alertElement.addEventListener("click", function(e){
		this.classList.add("removing");
		setTimeout(function(element) {
			element.remove();
		}, 500, this);
    });
    if(!document.querySelector(".alert-container")) {
        let alertContainer = document.createElement("div");
        alertContainer.classList.add("alert-container");
        document.querySelector("body").appendChild(alertContainer);
    }
	document.querySelector(".alert-container").appendChild(alertElement);
}
