
//function to check name
function nameCheck(){
    var x = document.getElementById("name").value;
    var pattern = /^[a-zA-Z ]+$/;
    if(x != ""){
        //making the message dissapear
        document.getElementById("namemessage").innerHTML = "";
        //making the border to defualt color
        document.getElementById("name").style.borderColor= "#ddd";
        
        //checking if it matches the pattern
        if(pattern.test(x)){
            document.getElementById("name").style.borderColor= "#00ff00";
            return true;
        } else {
            document.getElementById("name").style.borderColor= "#ff2323";
            document.getElementById("namemessage").innerHTML = "Please enter a valid first name";
            return false;
        }
        
    } else {
        document.getElementById("namemessage").innerHTML = "Please enter a first name";
        document.getElementById("name").style.borderColor= "#ff2323";
        return false;
    }
}

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

//function to check for confirmpassword
function confirmPasswordCheck(){
    var x = document.getElementById("confirmpassword").value;
    var y = document.getElementById("password").value;
    if(x != ""){
        //making the message dissapear
        document.getElementById("confirmpasswordmessage").innerHTML = "";
        //making the border to defualt color
        document.getElementById("confirmpassword").style.borderColor= "#ddd";
        
        //checking if it matches the passowrd
        if(x == y){
            document.getElementById("confirmpassword").style.borderColor= "#00ff00";
            return true;
        } else {
            document.getElementById("confirmpassword").style.borderColor= "#ff2323";
            document.getElementById("confirmpasswordmessage").innerHTML = "Password doesnt matches";
            return false;
        }
        
    } else {
        document.getElementById("confirmpasswordmessage").innerHTML = "Please enter the password again";
        return false;
    }
}


//function to check for mobile
function mobileCheck(){
   
    var x = document.getElementById("mobile").value;
    
    var pattern = /^\d{10}/;
    if(x != ""){
        //making the message dissapear
        document.getElementById("mobilemessage").innerHTML = "";
        //making the border to defualt color
        document.getElementById("mobile").style.borderColor= "#ddd";
        
        //checking if it matches the pattern
        if(pattern.test(x)){
            document.getElementById("mobile").style.borderColor= "#00ff00";
            return true;
            
        } else {
            document.getElementById("mobile").style.borderColor= "#ff2323";
            document.getElementById("mobilemessage").innerHTML = "Please enter valid Mobile Number";
            return false;
        }
        
    } else {
        document.getElementById("mobilemessage").innerHTML = "Please enter Mobile Number";
        document.getElementById("mobile").style.borderColor= "#ff2323";
        return false;
    }
}


