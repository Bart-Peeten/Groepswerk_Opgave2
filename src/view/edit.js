window.addEventListener("load", handleGetContactById);

var id;

function handleGetContactById(){
    console.log(id);
id = document.getElementById("contactid").value;

if(id != undefined){

    const URL = 'http://192.168.33.22/Groepswerk_Opgave2/contacts/';
    fetch(URL+id).then((response) => {return response.json();})
        .then(function(data) {writeOutput(data);})
        .catch ((exception) => {writeException(exception);});
}

}


function writeOutput(data){
    console.log(data);
    if(data.length > 0){
        document.getElementById("firstName").value = data[0].first_name;
        document.getElementById("lastName").value = data[0].last_name;
        document.getElementById("emailAddress").value = data[0].email_address;
    }else{
        alert("No contact for ID: " + id);
    }
}

function writeException(exception){
    alert("Your input is not validated. Please try again!");
}

function updateContact(contact){
    const URL = 'http://192.168.33.22/Groepswerk_Opgave2/contacts/';
    console.log("update");
    console.log(contact);
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

function submitForm(){
    console.log("submit");
    if(inputControl(document.getElementById('firstName'), document.getElementById('lastName'),document.getElementById('emailAddress'))){
        var contact = {
            id: id,
            first_name: document.getElementById('firstName').value,
            last_name: document.getElementById('lastName').value,
            email_address: document.getElementById('emailAddress').value
        };
        updateContact(contact);
    }


}

function cancelForm(){
    window.location = 'index.html';
}