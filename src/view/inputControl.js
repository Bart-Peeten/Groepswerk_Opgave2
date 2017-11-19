function inputControl(firstName, lastName, emailAddress) {
    lastName.style.backgroundColor = "";
    firstName.style.backgroundColor = "";
    emailAddress.style.backgroundColor = "";
    bool = true;
    if(firstName.value == ''){
        firstName.style.backgroundColor = "red";
        bool=false;
    }
    if(lastName.value == ''){
        lastName.style.backgroundColor = "red";
        bool=false;
    }
    if(emailAddress.value == ''){
        emailAddress.style.backgroundColor = "red";
        bool=false;
    }

    if((emailAddress.value).split("@").length-1 != 1 || (emailAddress.value).split(".").length-1 == 0){
        emailAddress.style.backgroundColor = "red";
        bool=false;
    }
return bool;
}