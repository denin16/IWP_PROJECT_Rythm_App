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

    /*-------------------------------------------------------------
    Script to display all the new songs present in the database
    --------------------------------------------------------------*/
    $limit = "";
    //fetching limit value
    if(isset($_GET["ID"])){
        $limit = $_GET["ID"];
    }
    if($limit == "1"){
        //Defining Query to get all the new songs
        $query1 =  "SELECT id, name, artist, album, image FROM songs ORDER BY date_released DESC";
    } else{
        //Defining Query to get only the 10 new songs
        $query1 =  "SELECT id, name, artist, album, image FROM songs ORDER BY date_released DESC LIMIT 10";
    }
    

    //Script to show content in cards form
    $i = 0;
    if($result = mysqli_query($conn, $query1)){
        if (mysqli_num_rows($result) > 0) {
            while($result_array = mysqli_fetch_assoc($result)){
                $id[$i] = $result_array["id"];
            $songs[$i] = $result_array["name"];
            $artist[$i] = $result_array["artist"];
            $album[$i] = $result_array["album"];
            $images[$i] = $result_array["image"];
            $i++;
            }
        } else {
            $table_content = "<p class='text-center'>Sorry! No Music Available</p>";
        }
    } else {
        //Error in executing the query
        echo "Error executing the query";
    }
        
    
?>

<!DOCTYPE html>
<html>
<head>
    <title>MAIN PAGE</title>
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
        font-size: 15px;
    }
    h3 {
        color: #ddd;
    }

    .music-card {
        margin: 8px;
        margin-bottom: 15px;
    }
    .card-body {
        margin: 0px;
        padding: 0px;
    }
    .card-body p {
        margin: 2px;
        padding-left: 5px;
        color: #ddd;
    }
    .music-card:hover  .card-img-top {
        opacity: 0.4;
    }
</style>
</head>
<body>
<div class="container">
    
    <h3 id="newly_added">Newly added...</h3>
    <div class="row">
        <!--Displaying New songs -->
        <?php
        for($i = 0; $i < count($id); $i++){
        echo "
        <div class='col-lg-2 music-card'>
            <div class='text-center'>
                <img class='card-img-top img-fluid img-responsive' id='' src='images/albums_cover_art/{$images[$i]}' alt='Card image cap'>
                <div class='card-body text-left'>
                  <p class='card-text'><span class='title'>Title: $songs[$i]</span></p>
                  <p class='card-text'><span class='artist'>Artist: $artist[$i]</span></p>
                </div>
            </div>
        </div>";
        }
        ?>
    </div>
    <div class="text-right" style="padding: 3px;">
        <p><a href="main.php?ID=1" class="">See all...</a></p>
    </div>
</div>
    
</body>
</html>
