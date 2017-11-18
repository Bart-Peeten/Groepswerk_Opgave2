window.addEventListener("load", handleGetAllContacts);



function handleGetAllContacts(){
    const URL = 'http://192.168.33.22/Groepswerk_Opgave2/contacts/';
        fetch(URL).then((response) => {return response.json();})
        .then(function(data) {writeOutput(data);})
        .catch ((exception) => {writeException(exception);});
    };


function handleDeleteContactById(id){
    const URL = 'http://192.168.33.22/Groepswerk_Opgave2/contacts/';
    fetch(URL+id,{
        method:"DELETE"
    }).then((response) => {return response.json();})
        .then(function(data) {writeOutput(data);})
        .catch ((exception) => {writeException(exception);});
};

function handleEditContactById(id){
    const URL = 'http://192.168.33.22/Groepswerk_Opgave2/contacts/';
    fetch(URL+id,{
        method:"POST",
        body: JSON.stringify()
    }).then((response) => {return response.json();})
        .then(function(data) {writeOutput(data);})
        .catch ((exception) => {writeException(exception);});
};

function writeOutput(data){
    table = document.getElementById('contactTable');

        for(i = 0; i < data.length; i++){
            var tr = document.createElement('TR');
            var td = document.createElement('TD');
            td.appendChild(document.createTextNode(data[i].id));
            tr.appendChild(td);
            td = document.createElement('TD');
            td.appendChild(document.createTextNode(data[i].first_name));
            tr.appendChild(td);
            td = document.createElement('TD');
            td.appendChild(document.createTextNode(data[i].last_name));
            tr.appendChild(td);
            td = document.createElement('TD');
            td.appendChild(document.createTextNode(data[i].email_address));
            tr.appendChild(td);
            var button = document.createElement('Button');
            button.textContent = "EDIT";
            button.id = data[i].id;
            button.onclick = function (e) {
                window.location = 'edit.php?id='+e.target.id;
            };
            var delbutton = document.createElement('Button');
            delbutton.textContent = "DELETE";
            delbutton.id = data[i].id;
            delbutton.onclick = function (e) {
                alert(e.target.id)
            };

            tr.appendChild(button);
            tr.appendChild(delbutton);
            table.appendChild(tr);
        }

}

function writeException(exception){
    var textNode = document.createTextNode(exception);
    var output = document.getElementById('contactTable');
    output.appendChild(textNode);

}

