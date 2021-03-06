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

    //Getting the Artist id from the artists page
    $artist_id = $_GET['ID'];
    //Getting all the info about the album
    //Query to fetch artist data
    $sql = "SELECT name, country, image, followers FROM artists WHERE id = '$artist_id'";
    $result = mysqli_query($conn,$sql);
    $result_array = mysqli_fetch_assoc($result);
    $name = $result_array["name"];
    $country = $result_array["country"];
    $image = $result_array["image"];
    $followers = $result_array["followers"];
    $num_of_songs = 0;
    //Displaying Songs Related to that artist
    //Defining Query to get all the songs of that artist
    $query =  "SELECT id, name, artist, album, date_released, genre, likes FROM songs WHERE artist = '$name'";

    

    //Script to show content in tables   
    if($result = mysqli_query($conn, $query)){
        if (mysqli_num_rows($result) > 0) {
        $table_content = "<table class='table'>
                            <thead>
                              <tr>
                                <th></th>
                                <th>Song</th>
                                <th>Album</th>
                                <th>Date released</th>
                                <th>Likes</th>
                                <th>Genre</th>
                                <th>Add</th>
                              </tr>
                            </thead>
                                <tbody>";
            while($row = mysqli_fetch_assoc($result)) {
                $table_content .= "
                        
                          <tr>
                            <td>
                              <div class='play-pause-button'>
                                <span class='play-icon'><i class='far fa-play-circle'></i></span>
                                <span class='pause-icon'><i class='far fa-pause-circle'></i></span>
                              </div>
                            </td>
                            <td>".$row['name']."</td>
                            <td>".$row['album']."</td>
                            <td>".$row['date_released']."</td>
                            <th><span class='badge'>".$row['likes']."</span></th>
                            <td>".$row['genre']."</td>
                            <td>
                                <form action='#' method='get'>
                                  <button type='submit' class='add-button' formaction='#'><i class='fas fa-plus'></i></button>
                                </form>
                              </td>
                          </tr>
                            ";
                $num_of_songs++;
                }
            $table_content .= "</tbody>
                        </table>";
        } else {
            $table_content = "<p class='text-center'>Sorry! No Music Available</p>";
        }
    } else {
        //Error in executing the query
        echo "Error executing the query";
    }
    
    //Script to find the albums of the artist
    //query to find the albums by that artist
    $sql = "SELECT album FROM songs WHERE artist = '$name' GROUP BY album";

    if($result = mysqli_query($conn,$sql)){
        if(mysqli_num_rows($result)>0){
            $num_of_albums = 0;
            while($row = mysqli_fetch_assoc($result)){
                $albums[$num_of_albums] = $row["album"];
                $num_of_albums++;
            }
        } else {
            echo "No data to display";
        }
    } else {
        echo "Error occured while executing the query.";
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

    <title>Artist Page</title>
    <style>
        body {
            background: #222222;
            color: #ddd;
        }
        .jumbotron {
            border-radius: 0px;
            padding: 20px;
            background: #222222;
            
        }
        .album-img{
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
            height: 220px;
            width: 220px;
        }
        .album-info {
            padding: 10px;
        }
        .album-info table, .album-info tr, .album-info tr td {
            border: none;
            margin: 0px;
            padding: 3px;
        }
        .line {
            width: 100%;
            display: block;
            border-top: 1px solid #ddd;
        }
        .play-pause-button {
            width: 40px;
            text-align: center;
        }
        .play-icon, .pause-icon {
            font-size: 22px;
        }
        .pause-icon {
            display: none;
        }
        .play-pause-button:hover {
            color: #999;
        }
        .add-button {
            background: #333333;
            color: #ddd;
            border: none;
            height: inherit;
            padding: 0px;
        }
        .add-button:hover, .add-button:focus {
            color: #fff;
            outline: none;
        }
    </style>
    <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
  </head>
  <body>
    <!-- Basic artist info -->
    <div class="container">
    <div class="jumbotron">
        <div class="row">
            <!-- album image -->
            <div class="col-lg-4 col-md-4 album-img-div text-center">
                <img class="img-fluid album-img" src="images/artists_cover_art/<?php echo $image ?>">
            </div>
            
            <!-- album info -->
            <div class="col-lg-8 col-md-8 album-info text-left">
                <h3>Artist Info</h3>
                <table class="table">
                    <tr>
                        <td>Name</td>
                        <td>:</td>
                        <td><?php echo $name ?></td>
                    </tr>
                    <tr>
                        <td>Number Of Albums</td>
                        <td>:</td>
                        <td><?php echo $num_of_albums ?></td>
                    </tr>
                    <tr>
                        <td>Albums</td>
                        <td>:</td>
                        <td>
                        <?php
                        $count = 0;
                        foreach($albums as $album){
                            if($count == 0){
                                echo $album;
                            } else {
                            echo ", ".$album;
                            }
                            $count++;
                        }
                        ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Country</td>
                        <td>:</td>
                        <td><?php echo $country ?></td>
                    </tr>
                    <tr>
                        <td>Followers</td>
                        <td>:</td>
                        <td><?php echo $followers ?></td>
                    </tr>
                </table>
            </div>
        </div>
        <br>
        <h3>Songs</h3>
        <br><br>
        <!-- table to show all the songs Related to that album -->
        <?php echo $table_content ?>
            
    </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>