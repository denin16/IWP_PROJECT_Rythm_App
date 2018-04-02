<?php

$servername = "localhost";
$username = "root";
$password = "";
$db="rythm";
// Create connection
$conn = new mysqli($servername, $username, $password,$db);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

//defining error variables
$error01=$error02=$error0=$error1=$error2=$error3=0;
$upload = 1;

if(isset($_POST['submit']))
{
    //Uploading both mp3 and jpg file
    $target_dir1 = "media/";
    $targetfile1 = $target_dir1 . basename($_FILES["songupload"]["name"]); 

    $target_dir2 = "images/albums_cover_art/";
    $targetfile2 = $target_dir2 . basename($_FILES["jpgupload"]["name"]); 
    
    
    //checking for file size of the uploaded mp3 file
    //max 2 MB allowed
    $filesize1=$_FILES['songupload']['size'];
    /*
    if($filesize1>10097152)
    {
        $error1=1;
        $upload=0;
    }
    */
    //checking for file size of the uploaded image file
    $filesize2=$_FILES['jpgupload']['size'];
    if($filesize2>2097152)
    {
        $error01=1;
        $upload=0;
    }
    
    //checking for file extension - only mp3 files allowed
    $fileextension1="mp3";
    $filename1=$_FILES['songupload']['name'];
    $filetype1=strtolower(pathinfo($filename1,PATHINFO_EXTENSION));
    if($filetype1!=$fileextension1)
    {
        $error0=1;
        $upload=0;
    }
    
    //checking for file extension - only jpg files allowed
    
    $fileextension2="jpg";
    $filename2=$_FILES['jpgupload']['name'];
    $filetype2=strtolower(pathinfo($filename2,PATHINFO_EXTENSION));
    if($filetype2!=$fileextension2)
    {
        $error02=1;
        $upload=0;
    }
    
    //checking if file already exists 
    
    if(file_exists($targetfile1))
    {
        $error2= 1;
        $upload=0;
        
    }
        
    //uploading file to directory on the server 
    if($upload==1)
    {
        
        //Inserting the file data in database
        $songid = "";
        $songname = $_POST["name"];
        $artistname = $_POST["artistname"];
        $albumname = $_POST["albumname"];
        $genre = $_POST["genre"];
        $date_released = date("Y-m-d");
        
        $mp3file = basename($_FILES["songupload"]["name"]);
        $imagefile = basename($_FILES["jpgupload"]["name"]);
        
        $sql_query1 = "INSERT INTO songs (name,artist,album,genre,date_released,likes,image,file_name) VALUES('$songname','$artistname','$albumname','$genre','$date_released',0,'$imagefile','$mp3file')";
        
        if(mysqli_query($conn,$sql_query1)){
            echo "How file will be uploaded";
            if (move_uploaded_file($_FILES["jpgupload"]["tmp_name"], $targetfile2)) {
               if(move_uploaded_file($_FILES["songupload"]["tmp_name"], $targetfile1)) {
                   $upload = 1;
                } else {
                    echo "Sorry, there was an error uploading your mp3 file.";
                   $upload = 0;
                } 
            } else {
                echo "Sorry, there was an error uploading your imagee file.";
                $upload = 0;
            }
        } else {
            echo "Problem with uploading files";
            $upload = 0;
        }
        
        
    }
    
} else {
    $upload = 0;
}
?>
 
 <html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/ratchet/2.0.2/css/ratchet.css" rel="stylesheet"/>
    <title>Upload | Rhythm</title>
      
    <style>
        body {
            background: #333333;
        }
        p {
            color: #ddd;
        }
        .adv {
            padding: 23px;
            background: #333333;
            color: #ddd;
        }
        .form-section {
            background: #fff;
        }
        .form-control {
            padding: 8px;
        } 
        #submit-button {
            width: 200px;
            text-align: left;
            margin-top: 8px;
            background: #00b300;
            color: #fff;
        }
        #submit-button:hover, #submit-button:active {
            background:#fff;
            border: 1px solid #00b300;
            color: #00b300;
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
  <body style="overflow:auto">
    
    <!-- advertisement -->
    <div class="jumbotron jumbotron-fluid adv">
      <div class="container">
        <h1 class="display-4">Rhythm</h1>
        <p class="lead">Welcome to Rhythm | Upload Your Creation Here</p>
      </div>
    </div>
      
    <!-- Signup Content -->
    <div class="container-fluid form-section" style="padding-top: 25px; padding-bottom: 40px;">
        <div class="row">
            <div class="col-lg-3"></div>
            <div class="col-lg-6">
                <div class="text-left form-container">
                    <!-- nav links for Signup and LogIn -->
                    <div class="form-heading">
                        <h3>Fill this form</h3>
                    </div>
                    <br>
                    <!-- form -->
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
                        
                        <div class="form-group">
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name Of Song" oninput="nameCheck()"  required>
                            <small id="namemessage"></small>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="artistname" name="artistname" placeholder="Enter Name Of Artist" oninput="nameCheck()" required>
                            <small id="namemessage"></small>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="albumname" name="albumname" placeholder="Enter Name Of Album" oninput="nameCheck()" required>
                            <small id="namemessage"></small>
                        </div>
                        <div class="form-group">
                            <select class="custom-select my-1 mr-sm-2" id="inlineFormCustomSelectPref" id="genre" name="genre">
                                <option selected>Choose genre</option>
                                <option value="Rock Music">Rock music</option>
                                <option value="Electronic Dance Music">Electronic dance music</option>
                                <option value="Country Music">Country music</option>
                                <option value="Alternative Rock">Alternative rock</option>
                                <option value="Rythm & Blues">Rhythm and blues</option>
                                <option value="Progressive Rock">Progressive Rock</option>
                              </select>
                            <small id="confirmpasswordmessage"></small>
                        </div>
                        <div>
                            <label for="songupload" class="btn btn-primary">Choose Song</label>              
                            <input type="file" name="songupload" id="songupload" accept="audio/*" style="display: none">
                            <label for="jpgupload" class="btn btn-primary">Choose Album Art</label>
                            <input type="file" name="jpgupload" id="jpgupload" accept="image/*" style="display:none"><br>
                            <input type="submit" name="submit" class="btn btn-success" id="submit-button" value="Upload" >
                        </div>
                    
                    </form>
                    
                    <?php 
                    
                    if ($error0 == 1){
                        echo "
                        <div class='alert alert-danger alert-dismissible fade show'>
                            <button type='button' class='close' data-dismiss='alert'>&times;</button>
                              Your File Is Not a mp3 File
                        </div>";
                    }
                    
                    if ($error02 == 1){
                        echo "
                        <div class='alert alert-danger alert-dismissible fade show'>
                            <button type='button' class='close' data-dismiss='alert'>&times;</button>
                              Your File Is Not a jpg File
                        </div>";
                    }
                    
                    if ($error1 == 1){
                        echo "
                        <div class='alert alert-danger alert-dismissible fade show'>
                            <button type='button' class='close' data-dismiss='alert'>&times;</button>
                               The mp3 File Size is Greater Than 2MB.
                        </div>";
                    }
                    
                    if ($error01 == 1){
                        echo "
                        <div class='alert alert-danger alert-dismissible fade show'>
                            <button type='button' class='close' data-dismiss='alert'>&times;</button>
                               The Image File Size is Greater Than 2MB.
                        </div>";
                    }
                    
                    if ($error2 == 1){
                        echo "
                        <div class='alert alert-danger alert-dismissible fade show'>
                            <button type='button' class='close' data-dismiss='alert'>&times;</button>
                               The mp3 File Already Exist.
                        </div>";
                    }
                    if($upload == 1){
                        echo "
                        <div class='alert alert-success alert-dismissible fade show'>
                            <button type='button' class='close' data-dismiss='alert'>&times;</button>
                               The File is Uploaded.
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
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  </body>
</html>