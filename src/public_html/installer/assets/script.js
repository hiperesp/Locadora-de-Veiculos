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
                        let contentElement = document.createElement("p");
                        contentElement.textContent = content;
                        alertElement.appendChild(contentElement);
                }
        }
        alertElement.addEventListener("click", function(e){
                this.classList.add("removing");
                setTimeout(function(element) {
                        element.remove();
                }, 500, this);
        });
        document.querySelector(".alert-container").appendChild(alertElement);
}

