window.addEventListener("load", handleGetContactById);


function handleGetContactById(){
var id = document.getElementById("contactid").value;
console.log(id);

    const URL = 'http://192.168.33.22/Groepswerk_Opgave2/contacts/';
    fetch(URL+id).then((response) => {return response.json();})
        .then(function(data) {writeOutput(data);})
        .catch ((exception) => {writeException(exception);});
}


function writeOutput(data){
    document.getElementbyid("firstName").value = data.firstName;







}