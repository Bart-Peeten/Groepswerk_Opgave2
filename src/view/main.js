window.addEventListener("load", handleGetAllContacts);

var require = require('express')


function handleGetAllContacts(){
    const URL = 'http://192.168.33.22/contacts/';
    fetch(URL)
        .then((response) => {return response.json();})
        .then(function(data) {writeOutput(data);})
    .catch ((exception) => {writeException(exception);});
}

function writeOutput(data){
    var output = document.getElementById("output");

    var objects = JSON.parse(data);

    for(var i = 0; i < objects.COLUMNS.length; i++){
        var textNode = document.createTextNode(objects.COLUMN[i]);
        output.appendChild(textNode);
    }









   //  var output = document.getElementById("output");
   // data.forEach((function(contact){
   //     var textNode = document.createTextNode(contact.toString());
   //
   //     output.appendChild(textNode);
   //
   //  }))

}

function writeException(exception){
    var textNode = document.createTextNode(exception);
    var output = document.getElementById("output");
    output.appendChild(textNode);
}