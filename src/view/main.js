window.addEventListener("load", handleGetAllContacts);



function handleGetAllContacts(){
    const URL = 'http://192.168.33.22/Groepswerk_Opgave2/src/contacts/';
        fetch(URL).then((response) => response.json())
        .then(function(data) {writeOutput(data);})
        .catch ((exception) => {writeException(exception);});
    };



function writeOutput(data){
    console.log(data.length);
    table = document.getElementById('contactTable');

    if(data.length = 1){

         tr = document.createElement('TR');
        td = document.createElement('TD');
        td.appendChild(document.createTextNode(data.id));
        tr.appendChild(td);
         td = document.createElement('TD');
        td.appendChild(document.createTextNode(data.first_name));
        tr.appendChild(td);
         td = document.createElement('TD');
        td.appendChild(document.createTextNode(data.last_name));
        tr.appendChild(td);
         td = document.createElement('TD');
        td.appendChild(document.createTextNode(data.email_address));
        tr.appendChild(td);
        table.appendChild(tr);
    }

    if(data.length > 1){
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
            table.appendChild(tr);
        }


    }







    //var output = document.getElementById("contactTable");


    //var textNode = document.createTextNode(data.id);
    //output.appendChild(textNode);







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
    var output = document.getElementById('contactTable');
    output.appendChild(textNode);

}