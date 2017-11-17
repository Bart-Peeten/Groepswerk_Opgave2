window.addEventListener("load", handleGetAllContacts);

var require = require('express')


function handleGetAllContacts(){
    const URL = 'http://192.168.33.22/contacts/';
    fetch(URL)

        .then((response) => {return response;})
        .then(function(data) {writeOutput(data);})
    .catch ((exception) => {writeException(exception);});
}

function writeOutput(data){
    var output = document.getElementById("output");


    for(var i = 1; i < data.length; i++){
        var textNode = document.createTextNode(data[i].toString());
        output.appendChild(textNode);
    }

    var textNode = document.createTextNode(JSON.parse(data[1]));
    output.appendChild(textNode);







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