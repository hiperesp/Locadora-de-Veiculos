function approximateSearch(element, action, callback){
	element.addEventListener("keyup", async (event) => {
		let json = await fetch(action(element))
		.then((data) => data.json())
		.then((json) => json);
		callback(json);
	});
	element.dispatchEvent(new Event("keyup"));
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
