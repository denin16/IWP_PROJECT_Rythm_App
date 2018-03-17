

//function to check username or email
function emailCheck(){
    var x = document.getElementById("email").value;
    var pattern = /^([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,5})$/;
    if(x != ""){
        //making the message dissapear
        document.getElementById("emailmessage").innerHTML = "";
        //making the border to defualt color
        document.getElementById("email").style.borderColor= "#ddd";
        
        //checking if it matches the pattern
        if(pattern.test(x)){
            document.getElementById("email").style.borderColor= "#00ff00";
            return true;
        } else {
            document.getElementById("email").style.borderColor= "#ff2323";
            document.getElementById("emailmessage").innerHTML = "Please enter a valid email";
            return false;
        }
        
    } else {
        document.getElementById("emailmessage").innerHTML = "Please enter a email";
        return false;
    }
}

//function to check for password
function passwordCheck(){
    var x = document.getElementById("password").value;
    var pattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&])[A-Za-z\d$@$!%*?&]{8,}$/;
    if(x != ""){
        //making the message dissapear
        document.getElementById("passwordmessage").innerHTML = "";
        //making the border to defualt color
        document.getElementById("password").style.borderColor= "#ddd";
        
        //checking if it matches the pattern
        if(pattern.test(x)){
            document.getElementById("password").style.borderColor= "#00ff00";
            return true;
            
        } else {
            document.getElementById("password").style.borderColor= "#ff2323";
            document.getElementById("passwordmessage").innerHTML = "The password should be on minimum 8 chars, atleast one uppercase, one lowercase, one letter, one number and one special char";
            return false;
        }
        
    } else {
        document.getElementById("passwordmessage").innerHTML = "Please enter a password";
        document.getElementById("password").style.borderColor= "#ff2323";
        return false;
    }
}