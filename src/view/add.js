window.addEventListener("load", handleEventListeners);

function handleEventListeners() {
    cancelContact(document.getElementById("cancelButton"));
    addContact(document.getElementById("saveButton"));
}

function addContact(e) {

    e.onclick = function () {
        if(inputControl(document.getElementById('firstName'), document.getElementById('lastName'),document.getElementById('emailAddress'))){
            var contact = {
                id: null,
                first_name: document.getElementById('firstName').value,
                last_name: document.getElementById('lastName').value,
                email_address: document.getElementById('emailAddress').value
            };
            const URL = 'http://192.168.33.22/Groepswerk_Opgave2/contacts/';
            fetch(URL,{
                method: "POST",
                body: JSON.stringify(contact)
            }).then((response) => {
                if(response.status == 200){
                    window.location = 'index.html';
                } else {
                    writeException(response.status);
                }
            })
        }
    }


}

function cancelContact(e) {
    e.onclick = function () {
        window.location = 'index.html';
    }
}

