<?php

    //connecting to database
    require "connect_db.php";
    //Defining User varibables
    $name = $email = $password = $mobile_number = "";
    $message = "";
    
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        //taking the data from form
        $name = $_POST["name"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $mobile_number = $_POST["mobile_number"];
        $gender = $_POST["gender"];
        
        //checking if the user already exists
        $sql_query_1 = "SELECT email_id FROM users WHERE email_id = '$email'";
        $check_account = mysqli_query($conn,$sql_query_1);
        if(mysqli_num_rows($check_account) > 0){
            $message = "Account already exists.";
        } else {
            
            //Creating an account for the user
                    
            //defining sql query
            $sql_query = "INSERT INTO users (name,email_id,password,mobile_no,gender)
            VALUES('$name','$email','$password','$mobile_number','$gender')";

            //Executing the query
            if(mysqli_query($conn,$sql_query)){
            //taking user directly to Home page.
            //defining sql query to get details from the database.
            $sql_query_2 = "SELECT id ,email_id, password FROM users";

            $result_array = mysqli_query($conn,$sql_query_2);

                if(mysqli_num_rows($result_array) > 0){
                    //output data of each row
                    while($row = mysqli_fetch_assoc($result_array)){
                        //check if the email and password is present or not
                        $email_fetch = $row["email_id"];
                        $password_fetch = $row["password"];

                        if(($email_fetch == $email) && ($password_fetch == $password)){
                                //Creating a session for the user
                                session_start();
                                //defining session variables
                                $_SESSION["user_id"] = $row["id"];
                                header ("Location: home.php");

                                } else {
                                }

                    }
                } else {
                        header ("Location: index.php");
                }

            } else {
            echo "Error: " . $sql_query . "<br>" . mysqli_error($conn);   
            } 
        }
    }
        
        
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>SignUp | Rhythm</title>
      
    <style>
        .adv {
            padding: 23px;
            background: #333333;
            color: #ddd;
        }
        .form-control {
            padding: 10px;
        } 
        .footer-section {
            bottom: 0px;
            background: #333333;
            padding: 20px;
            color: #ddd;
        }
        .footer-section a {
            color: #ddd;
        }
        .footer-section a:hover{
            color: #fff;
        }
        .form-control,.form-control:focus,.form-control:hover {
            border-color: #555;
            background: #fff;
            color: #555;
            outline: 0px !important;
            box-shadow: none;
            -moz-box-shadow: none;
            -webkit-box-shadow: none;
        }
    </style>
    <script type="text/javascript" src="signupscript.js"></script>
  </head>
  <body>
    
    <!-- advertisement -->
    <div class="jumbotron jumbotron-fluid adv">
      <div class="container">
        <h1 class="display-4">Rhythm</h1>
        <p class="lead">Welcome to Rhythm | Feel the Vibes of Music</p>
      </div>
    </div>
      
    <!-- Signup Content -->
    <div class="container-fluid" style="padding-bottom: 40px;">
        <div class="row">
            <div class="col-lg-3"></div>
            <div class="col-lg-6">
                <div class="text-left form-container">
                    <!-- nav links for Signup and LogIn -->
                    <div class="form-heading">
                        <nav class="nav">
                          <a class="nav-link" href="Signup.php" style="color: #222222;">SignUp</a>
                          <span style="border: 1px solid #333333;"></span>
                          <a class="nav-link text-muted" href="index.php">LogIn &gt;&gt;</a>
                        </nav>
                    </div>
                    <br>
                    <!-- form -->
                    <form onsubmit="return nameCheck() && emailCheck() && passwordCheck() && confirmPasswordCheck() && mobileCheck();" action="Signup.php" method="post">
                        <div class="form-group">
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter your Name" oninput="nameCheck()" required>
                            <small id="namemessage"></small>
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control" id="email" name="email" placeholder="Enter Your email" oninput="emailCheck()" required>
                            <small id="emailmessage"></small>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" id="password" name="password" placeholder="Enter a password" oninput="passwordCheck()" required>
                            <small id="passwordmessage"></small>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" id="confirmpassword"  placeholder="Enter password again to confirm" oninput="confirmPasswordCheck()" required>
                            <small id="confirmpasswordmessage"></small>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="mobile" name="mobile_number" placeholder="Enter mobile number" oninput="mobileCheck()" required>
                            <small id="mobilemessage"></small>
                        </div>
                        <div class="form-group text-left row">
                            <div class="col-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="gender" id="male" value="male" checked>
                                    <label class="form-check-label" for="name">Male</label>
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="gender" id="female" value="female">
                                    <label class="form-check-label" for="name">Female</label>
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="gender" id="other" value="other">
                                    <label class="form-check-label" for="name">Other</label>
                                </div>
                            </div>
                            <div class="col-6"></div>
                        </div>
                        <div class="form-group text-left">
                        <input type="submit" class="btn btn-success" value="SignUp">
                        </div>
                    </form>
                    
                    <?php 
                    if ($message != ""){
                        echo "
                        <div class='alert alert-danger alert-dismissible fade show'>
                            <button type='button' class='close' data-dismiss='alert'>&times;</button>
                               The account already exists.
                        </div>";
                    }
                    ?>
                </div>
            </div>
            <div class="col-lg-3"></div>
        </div>  
    </div> 
      
    <footer class="container-fluid footer-section">
        <div class="row text-center">
            <div class="col-lg-3">
            
            </div>
            <div class="col-lg-6">
                <div class="text-center">
                    <ul class="nav">
                        <li class="nav-item">
                            <a class="nav-link" href="#">Contact Us</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">About Us</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Our Team</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Help</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-3">
            
            </div>
        </div>
    </footer>
    
    

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>