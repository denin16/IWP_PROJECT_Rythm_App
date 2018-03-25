<<<<<<< HEAD
<?php
    //Connecting the database
    require "connect_db.php";

    //Starting the session for user
    session_start();

=======
<?php 
    //connecting to database
    require "connect_db.php";

    //Starting the user session
    session_start();
>>>>>>> branch1
    //Getting the user id
    $user_id = $_SESSION["user_id"];

    //Checking if the php file is called directly
    if($_SESSION["user_id"] == ""){
        header("Location: connection_error.php");
    }

<<<<<<< HEAD
?>

=======
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
>>>>>>> branch1

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
<<<<<<< HEAD
=======
        font-size: 15px;
>>>>>>> branch1
    }
    h3 {
        color: #ddd;
    }
<<<<<<< HEAD
    .card {
        padding: 0px;
        color: #ddd;
        background: #111;
        border: 1px solid #222222;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.25), 0 6px 20px 0 rgba(0, 0, 0, 0.25); 
    }
    
=======

    .music-card {
        margin: 8px;
        margin-bottom: 15px;
    }
>>>>>>> branch1
    .card-body {
        margin: 0px;
        padding: 0px;
    }
    .card-body p {
        margin: 2px;
        padding-left: 5px;
        color: #ddd;
    }
<<<<<<< HEAD
    .card:hover  .card-img-top {
=======
    .music-card:hover  .card-img-top {
>>>>>>> branch1
        opacity: 0.4;
    }
</style>
</head>
<body>
<div class="container">
    
<<<<<<< HEAD
    <!-- Recently Played -->
    <h3>Recently Played ...</h3>
    <div class="card-deck">

        <div class="card">
            <div class="text-center">
                <img class="card-img-top img-fluid img-responsive" src="images/israel-palacio-459693.jpg" alt="Card image cap">
                <div class="card-body text-left">
                  <p class="card-text"><span class="title">Title: </span></p>
                  <p class="card-text"><span class="artist">Artist: </span></p>
                  <p class="card-text"></p>
                </div>
            </div>

        </div>

    </div>
    <br>
    <div class="card-deck">

        <div class="card">
            <div class="text-center">
                <img class="card-img-top img-fluid img-responsive" src="images/nkululeko-mabena-436777.jpg" alt="Card image cap">
                <div class="card-body text-left">
                  <p class="card-text"><span class="title">Title: </span></p>
                  <p class="card-text"><span class="artist">Artist: </span></p>
                  <p class="card-text"></p>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="text-center">
                <img class="card-img-top img-fluid img-responsive" src="images/austin-neill-222825.jpg" alt="Card image cap">
                <div class="card-body text-left">
                  <p class="card-text"><span class="title">Title: </span></p>
                  <p class="card-text"><span class="artist">Artist: </span></p>
                  <p class="card-text"></p>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="center">
                <img class="card-img-top img-fluid img-responsive" src="images/ben-neale-194644.jpg" alt="Card image cap">
                <div class="card-body text-left">
                  <p class="card-text"><span class="title">Title: </span></p>
                  <p class="card-text"><span class="artist">Artist: </span></p>
                  <p class="card-text"></p>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="text-center">
                <img class="card-img-top img-fluid img-responsive" src="images/simon-maennling-27234.jpg" alt="Card image cap">
                <div class="card-body text-left">
                  <p class="card-text"><span class="title">Title: </span></p>
                  <p class="card-text"><span class="artist">Artist: </span></p>
                  <p class="card-text"></p>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="text-center">
                <img class="card-img-top img-fluid img-responsive" src="images/singer-540771__340.jpg" alt="Card image cap">
                <div class="card-body text-left">
                  <p class="card-text"><span class="title">Title: </span></p>
                  <p class="card-text"><span class="artist">Artist: </span></p>
                  <p class="card-text"></p>
                </div>
            </div>
        </div>


    </div>
    <div class="text-right" style="padding: 3px;">
        <p><a href="#" class="text-muted">See all...</a></p>
    </div>
    <br>
    <h3 id="newly_added">Newly added...</h3>
    <div class="card-deck">

        <div class="card">
            <div class="text-center">
                <img class="card-img-top img-fluid img-responsive" src="images/israel-palacio-459693.jpg" alt="Card image cap">
                <div class="card-body text-left">
                  <p class="card-text"><span class="title">Title: </span></p>
                  <p class="card-text"><span class="artist">Artist: </span></p>
                  <p class="card-text"></p>
                </div>
            </div>

        </div>

        <div class="card">
            <div class="text-center">
                <img class="card-img-top img-fluid img-responsive" src="images/4902320203_29e3235af5_z.jpg" alt="Card image cap">
                <div class="card-body text-left">
                  <p class="card-text"><span class="title">Title: </span></p>
                  <p class="card-text"><span class="artist">Artist: </span></p>
                  <p class="card-text"></p>
                </div>
            </div>

        </div>

        <div class="card">
            <div class="text-center">
                <img class="card-img-top img-fluid img-responsive" src="images/music-3090204__340.jpg" alt="Card image cap">
                <div class="card-body text-left">
                  <p class="card-text"><span class="title">Title: </span></p>
                  <p class="card-text"><span class="artist">Artist: </span></p>
                  <p class="card-text"></p>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="text-center">
                <img class="card-img-top img-fluid img-responsive" src="images/jazz-1658887__340.jpg" alt="Card image cap">
                <div class="card-body text-left">
                  <p class="card-text"><span class="title">Title: </span></p>
                  <p class="card-text"><span class="artist">Artist: </span></p>
                  <p class="card-text"></p>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="text-center">
                <img class="card-img-top img-fluid img-responsive" src="images/music-594275__340.jpg" alt="Card image cap">
                <div class="card-body text-left">
                  <p class="card-text"><span class="title">Title: </span></p>
                  <p class="card-text"><span class="artist">Artist: </span></p>
                  <p class="card-text"></p>
                </div>
            </div>
        </div>

    </div>
    <br>
    <div class="card-deck">

        <div class="card">
            <div class="text-center">
                <img class="card-img-top img-fluid img-responsive" src="images/nkululeko-mabena-436777.jpg" alt="Card image cap">
                <div class="card-body text-left">
                  <p class="card-text"><span class="title">Title: </span></p>
                  <p class="card-text"><span class="artist">Artist: </span></p>
                  <p class="card-text"></p>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="text-center">
                <img class="card-img-top img-fluid img-responsive" src="images/austin-neill-222825.jpg" alt="Card image cap">
                <div class="card-body text-left">
                  <p class="card-text"><span class="title">Title: </span></p>
                  <p class="card-text"><span class="artist">Artist: </span></p>
                  <p class="card-text"></p>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="center">
                <img class="card-img-top img-fluid img-responsive" src="images/ben-neale-194644.jpg" alt="Card image cap">
                <div class="card-body text-left">
                  <p class="card-text"><span class="title">Title: </span></p>
                  <p class="card-text"><span class="artist">Artist: </span></p>
                  <p class="card-text"></p>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="text-center">
                <img class="card-img-top img-fluid img-responsive" src="images/simon-maennling-27234.jpg" alt="Card image cap">
                <div class="card-body text-left">
                  <p class="card-text"><span class="title">Title: </span></p>
                  <p class="card-text"><span class="artist">Artist: </span></p>
                  <p class="card-text"></p>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="text-center">
                <img class="card-img-top img-fluid img-responsive" src="images/singer-540771__340.jpg" alt="Card image cap">
                <div class="card-body text-left">
                  <p class="card-text"><span class="title">Title: </span></p>
                  <p class="card-text"><span class="artist">Artist: </span></p>
                  <p class="card-text"></p>
                </div>
            </div>
        </div>
        
    </div>
    <div class="text-right" style="padding: 3px;">
        <p><a href="#" class="text-muted">See all...</a></p>
    </div>
    <br>
    <h3 id="discover">Discover something amazing ...</h3>
    <div class="card-deck">

        <div class="card">
            <div class="text-center">
                <img class="card-img-top img-fluid img-responsive" src="images/israel-palacio-459693.jpg" alt="Card image cap">
                <div class="card-body text-left">
                  <p class="card-text"><span class="title">Title: </span></p>
                  <p class="card-text"><span class="artist">Artist: </span></p>
                  <p class="card-text"></p>
                </div>
            </div>

        </div>

        <div class="card">
            <div class="text-center">
                <img class="card-img-top img-fluid img-responsive" src="images/4902320203_29e3235af5_z.jpg" alt="Card image cap">
                <div class="card-body text-left">
                  <p class="card-text"><span class="title">Title: </span></p>
                  <p class="card-text"><span class="artist">Artist: </span></p>
                  <p class="card-text"></p>
                </div>
            </div>

        </div>

        <div class="card">
            <div class="text-center">
                <img class="card-img-top img-fluid img-responsive" src="images/music-3090204__340.jpg" alt="Card image cap">
                <div class="card-body text-left">
                  <p class="card-text"><span class="title">Title: </span></p>
                  <p class="card-text"><span class="artist">Artist: </span></p>
                  <p class="card-text"></p>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="text-center">
                <img class="card-img-top img-fluid img-responsive" src="images/jazz-1658887__340.jpg" alt="Card image cap">
                <div class="card-body text-left">
                  <p class="card-text"><span class="title">Title: </span></p>
                  <p class="card-text"><span class="artist">Artist: </span></p>
                  <p class="card-text"></p>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="text-center">
                <img class="card-img-top img-fluid img-responsive" src="images/music-594275__340.jpg" alt="Card image cap">
                <div class="card-body text-left">
                  <p class="card-text"><span class="title">Title: </span></p>
                  <p class="card-text"><span class="artist">Artist: </span></p>
                  <p class="card-text"></p>
                </div>
            </div>
        </div>

    </div>
    <br>
    <div class="card-deck">

        <div class="card">
            <div class="text-center">
                <img class="card-img-top img-fluid img-responsive" src="images/nkululeko-mabena-436777.jpg" alt="Card image cap">
                <div class="card-body text-left">
                  <p class="card-text"><span class="title">Title: </span></p>
                  <p class="card-text"><span class="artist">Artist: </span></p>
                  <p class="card-text"></p>
                </div>
            </div>
        </div>
        <br>
        <div class="card">
            <div class="text-center">
                <img class="card-img-top img-fluid img-responsive" src="images/austin-neill-222825.jpg" alt="Card image cap">
                <div class="card-body text-left">
                  <p class="card-text"><span class="title">Title: </span></p>
                  <p class="card-text"><span class="artist">Artist: </span></p>
                  <p class="card-text"></p>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="center">
                <img class="card-img-top img-fluid img-responsive" src="images/ben-neale-194644.jpg" alt="Card image cap">
                <div class="card-body text-left">
                  <p class="card-text"><span class="title">Title: </span></p>
                  <p class="card-text"><span class="artist">Artist: </span></p>
                  <p class="card-text"></p>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="text-center">
                <img class="card-img-top img-fluid img-responsive" src="images/simon-maennling-27234.jpg" alt="Card image cap">
                <div class="card-body text-left">
                  <p class="card-text"><span class="title">Title: </span></p>
                  <p class="card-text"><span class="artist">Artist: </span></p>
                  <p class="card-text"></p>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="text-center">
                <img class="card-img-top img-fluid img-responsive" src="images/singer-540771__340.jpg" alt="Card image cap">
                <div class="card-body text-left">
                  <p class="card-text"><span class="title">Title: </span></p>
                  <p class="card-text"><span class="artist">Artist: </span></p>
                  <p class="card-text"></p>
                </div>
            </div>
        </div>
        
    </div>
    <div class="text-right" style="padding: 3px;">
        <p><a href="#" class="text-muted">See all...</a></p>
=======
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
>>>>>>> branch1
    </div>
</div>
    
</body>
</html>
