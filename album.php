<?php

    //connecting to database
    require "connect_db.php";

    //Starting the user session
    session_start();
    //Getting the user id
    $user_id = $_SESSION["user_id"];

    //Checking if the php file is called directly
    if($_SESSION["user_id"] == ""){
        header("Location: connection_error.php");
    }

    //Script to fetch all the albums
    $sql = "SELECT id, name, artist, date_released, image, followers FROM albums";

    if($result = mysqli_query($conn,$sql)){
        if(mysqli_num_rows($result)>0){
            $i = 0;
            while($row = mysqli_fetch_assoc($result)){
                $id[$i] = $row["id"];
                $album[$i] = $row["name"];
                $artist[$i] = $row["artist"];
                $images[$i] = $row["image"];
                $i++;
            }
        } else {
            echo "No data to display";
        }
    } else {
        echo "Error occured while executing the query.";
    }    
?>



<!DOCTYPE html>
<html>
<head>
    <title>Album Page</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/sidebar.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">

<style> 
    body {
        padding: 10px;
        background: #222222;
        
    }
    p {
        color: #ddd;
    }
    h3 {
        color: #ddd;
    }
    .card-area {
        padding: 5px;
    }
    .card-body {
        margin: 15px;
        padding: 0px;
    }
    .card-body p {
        margin: 2px;
        padding-left: 5px;
        padding-top: 5px;
    }
    .card-img-top {
        height: 150px;
        border-radius: 50%;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.35), 0 6px 20px 0 rgba(0, 0, 0, 0.35); 
    }
    .card-area:hover  .card-img-top {
        opacity: 0.5;
    }
</style>
</head>
<body>
<div class="container">
    <!-- Recently Played -->
    <h3>Albums :</h3>
    <br>
    <div class="row">
        <?php 
        //Displaying all tha albums
                for($j = 0; $j < count($album); $j++){
                    echo  "
                       <div class='col-lg-2'>
                            <div class='text-center card-area'>
                                <a href='album_page.php?ID={$id[$j]}'>
                                <img class='card-img-top img-fluid img-responsive' src='images/albums_cover_art/".$images[$j]."' alt='Card image cap'>
                                </a>
                                <div class='card-body'>
                                  <p class='card-text'><span class='title'>".$album[$j]."</span></p>
                                  <p class='card-text'>by <span class='artist'>".$artist[$j]."</span></p>
                                </div>
                            </div>
                        </div> 
                    "; 
                }
        ?>
    </div>
</div>
    
</body>
</html>