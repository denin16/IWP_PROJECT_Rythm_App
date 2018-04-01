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
    
    //Defining Query to get all the new songs
    $query1 =  "SELECT id, name, artist, album, image FROM songs ORDER BY date_released DESC";
    
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

    /*---------------------------------------------------------------
    Script to all the popular artists
    ----------------------------------------------------------------*/
    //Defining Query to get all artist
    $query2 = "SELECT id, name, image FROM artists";

    if($result = mysqli_query($conn,$query2)){
        if(mysqli_num_rows($result)>0){
            $i = 0;
            while($row = mysqli_fetch_assoc($result)){
                $artist_id[$i] = $row["id"];
                $artist_name[$i] = $row["name"];
                $artist_images[$i] = $row["image"];
                $i++;
            }
        } else {
            echo "No data to display";
        }
    } else {
        echo "Error occured while executing the query.";
    }

    /*---------------------------------------------------------------
    Script to all the popular albums
    ----------------------------------------------------------------*/
    //Defining Query to get all albums
    $query2 = "SELECT id, name, image FROM albums";

    if($result = mysqli_query($conn,$query2)){
        if(mysqli_num_rows($result)>0){
            $i = 0;
            while($row = mysqli_fetch_assoc($result)){
                $album_id[$i] = $row["id"];
                $album_name[$i] = $row["name"];
                $album_images[$i] = $row["image"];
                $i++;
            }
        } else {
            echo "No data to display";
        }
    } else {
        echo "Error occured while executing the query.";
    }

    /*----------------------------------------------------------------
    Script to display the random songs
    ----------------------------------------------------------------*/
    //Defining query to get random songs
    
    $query3 = "SELECT id, name, artist, album, image FROM songs ORDER BY RAND() LIMIT 10";
    
    if($result = mysqli_query($conn,$query3)){
        if(mysqli_num_rows($result)>0){
            $i = 0;
            while($row = mysqli_fetch_assoc($result)){
                $rand_song_id[$i] = $row["id"];
                $rand_song_name[$i] = $row["name"];
                $rand_song_artist[$i] = $row["artist"];
                $rand_song_images[$i] = $row["image"];
                $i++;
            }
        }
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
    .card-img-top{
        height: 150px;
        border-radius: 50%;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.35), 0 6px 20px 0 rgba(0, 0, 0, 0.35); 
    }
    .card-img-top:hover {
        opacity: 0.4;
    }
    .add-button {
        background: #222222;
        color: #ccc;
        border: none;
        font-size: 25px;
        outline: none;
        text-decoration: none;
    }
    .add-button:hover,.add-button:focus {
        outline: none;
        color: #fff;
        text-decoration: none;
    }
    .card-img-top-artist {
        height: 150px;
        border-radius: 50%;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.35), 0 6px 20px 0 rgba(0, 0, 0, 0.35); 
    }
    .card-img-top-artist:hover {
        opacity: 0.4;
    }
    
</style>
</head>
<body>
<div class="container">
            
    <h3 id="newly_added">Newly added Songs...</h3>
    <div class="row">
        <!--Displaying New songs -->
        <?php
        for($i = 0; $i < count($id); $i++){
        echo "
        <div class='col-lg-2 music-card' id='{$id[$i]}'>
            <div class='text-center'>
                <img class='card-img-top img-fluid img-responsive' id='' src='images/albums_cover_art/{$images[$i]}' alt='Card image cap'>
                <div class='card-body row text-left'>
                  <div class='col-lg-9'>
                      <p class='card-text'><span class='title'>$songs[$i] ($artist[$i])</span></p>
                  </div>
                  <div class='col-lg-3 add-button-section'>
                        <a href='addsong.php?ID={$id[$i]}' class='add-button'>+</a>
                  </div>
                </div>
            </div>
        </div>";
        }
        ?>
    </div>
    <br><br>
    <h3 id="popular_artist">Popular Artists...</h3>
    <div class="row">
        <!--Displaying Popular Artists -->
        <?php
        for($i = 0; $i < count($artist_id); $i++){
        echo "
        <div class='col-lg-2 music-card' id='{$artist_id[$i]}'>
            <div class='text-center'>
                <a href='artist_page.php?ID={$artist_id[$i]}'>
                <img class='card-img-top-artist img-fluid img-responsive' id='' src='images/artists_cover_art/{$artist_images[$i]}' alt='Card image cap'>
                </a>
                <div class='card-body row text-left'>
                  <div class='col-lg-9'>
                      <p class='card-text'><span class='artist'>$artist_name[$i]</span></p>
                  </div>
                  <div class='col-lg-3 add-button-section'>
                        <a href='addartist.php?ID={$artist_id[$i]}' class='add-button'>+</a>
                  </div>
                </div>
            </div>
        </div>";
        }
        ?>
    </div>
    <br><br>
    <h3 id="popular_albums">Popular Albums...</h3>
    <div class="row">
        <!--Displaying Popular Albums -->
        <?php
        for($i = 0; $i < count($album_id); $i++){
        echo "
        <div class='col-lg-2 music-card' id='{$album_id[$i]}'>
            <div class='text-center'>
                <a href='album_page.php?ID={$album_id[$i]}'>
                <img class='card-img-top-artist img-fluid img-responsive' id='' src='images/albums_cover_art/{$album_images[$i]}' alt='Card image cap'>
                </a>
                <div class='card-body row text-left'>
                  <div class='col-lg-9'>
                      <p class='card-text'><span class='artist'>$album_name[$i]</span></p>
                  </div>
                  <div class='col-lg-3 add-button-section'>
                        <a href='addalbum.php?ID={$album_id[$i]}' class='add-button'>+</a>
                  </div>
                </div>
            </div>
        </div>";
        }
        ?>
    </div>
    <br><br>
    <h3 id="discover">Discover Songs...</h3>
    <div class="row">
        <!--Displaying New songs -->
        <?php
        for($i = 0; $i < 10; $i++){
        echo "
        <div class='col-lg-2 music-card' id='{$rand_song_id[$i]}'>
            <div class='text-center'>
                <img class='card-img-top img-fluid img-responsive' id='' src='images/albums_cover_art/{$rand_song_images[$i]}' alt='Card image cap'>
                <div class='card-body row text-left'>
                  <div class='col-lg-9'>
                      <p class='card-text'><span class='title'>$songs[$i] ($rand_song_artist[$i])</span></p>
                  </div>
                  <div class='col-lg-3 add-button-section'>
                        <a href='addsong.php?ID={$rand_song_id[$i]}' class='add-button'>+</a>
                  </div>
                </div>
            </div>
        </div>";
        }
        ?>
    </div>
    
    
</div>   
</body>
</html>
