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

    //Script to display all the songs present in the database
    //Defining Query to get all the songs
    $query =  "SELECT id, name, artist, album, date_released, genre, likes FROM songs WHERE id IN (SELECT song_id FROM added_songs WHERE user_id = '$user_id')";

    

    //Script to show content in tables
   
    //$table_content = "<p class='text-center'>Sorry! No results found!<p>";    
    if($result = mysqli_query($conn, $query)){
        if (mysqli_num_rows($result) > 0) {
        $table_content = "<table class='table'>
                            <thead>
                              <tr>
                                <th></th>
                                <th>Song</th>
                                <th>Artist</th>
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
                            <td>".$row['artist']."</td>
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
        
    
?>



<!DOCTYPE html>
<html>
<head>
    <title>Songs</title>
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
            background: #222222;
            color: #ddd;
        }
        h3 {
            color: #eee;
        }
        .container {
            padding: 10px;
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
        .badge {
            background: #bbb;
            color: #222222;
            border-radius: 18px;
        }
        .add-button {
            background: #222222;
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
    
</head>
<body>
    <div class="container">
        <br>
        <h3>Songs</h3>
        <br><br>
        <p>
        
        </p>
        <!-- table to show all the songs -->
        <?php echo $table_content ?>
    </div>
</body>
</html>