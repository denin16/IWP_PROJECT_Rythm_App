<?php
    //connecting to database
    require "connect_db.php";

    //Starting the session for user
    session_start();
    
    //Checking if the php file is called directly
    if($_SESSION["user_id"] == ""){
        header("Location: index.php");
    }
    //Defining $session Variables

    //getting te=he user details
    $user_id = $_SESSION["user_id"];
    $user_name_query = "SELECT name FROM users WHERE id = '$user_id'";
    
    //executing_query
    $user_name_row = mysqli_fetch_assoc(mysqli_query($conn,$user_name_query));
    $user_name = $user_name_row["name"];

    //Script to display all the songs present in the database
    //Defining Query to get all the songs
    $query =  "SELECT id, name, artist, album,image,file_name, date_released, genre, likes FROM songs WHERE id IN (SELECT song_id FROM added_songs WHERE user_id = '$user_id')";

    //Script to show content in tables
   
    //$table_content = "<p class='text-center'>Sorry! No results found!<p>";    
    if($result = mysqli_query($conn, $query)){
        if (mysqli_num_rows($result) > 0) {
        $list_content = "<ul id='playlist' class='list-group'>";
            while($row = mysqli_fetch_assoc($result)) {
                $file = $row["file_name"]; 
                $title = $row["name"];
                $artist = $row["artist"];
                $album = $row["album"];
                $image = $row["image"];
                $list_content .= "
                                        <li class='list-group-item' song='$file' cover='$image' artist='$artist'>$title - $artist</li>
                            ";
                }
                $list_content .= "</ul>";
        } else {
            $list_content = "<p class='text-center'>Sorry! No Music Available</p>";
        }
    } else {
        //Error in executing the query
        echo "Error executing the query";
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <title>Rhythm | Follow the Vibes of Music</title>

        <!-- Bootstrap CSS CDN -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
        <link rel='stylesheet prefetch' href='http://cdn.plyr.io/2.0.13/plyr.css'>
        <!-- BOOTSTRAP CDN -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <!-- Our Custom CSS -->
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="css/musicstyle.css" type="text/css">
        <!-- Scrollbar Custom CSS -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">
        <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/prefixfree/1.0.7/prefixfree.min.js"></script>
        
        <style>
            body {
                background: #333333;
            }
        </style>
        
    </head>
    <body>

        <div class="wrapper">
            <!-- Sidebar Holder -->
            <nav id="sidebar">
                
                <div id="dismiss">
                    <i class="glyphicon glyphicon-arrow-left"></i>
                </div>
                <div class="sidebar-header">
                    <h3>Rhythm</h3>
                </div>
                <ul class="list-unstyled components">
                    <p style="font-size: 20px;">File Manager</p>
                    <li>
                        <a href="song.php" target="browsing-window">Songs</a>
                    </li>
                    <li>
                        <a href="artist.php" target="browsing-window">Artists</a>
                    </li>
                    <li>
                        <a href="album.php" target="browsing-window">Albums</a>
                    </li>
                    <li>
                        <a href="#">Genres</a>
                    </li>
                    <li>
                        <a href="#">Favourites</a>
                    </li>
                    <li>
                        <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false">Playlists</a>
                        <ul class="collapse list-unstyled" id="pageSubmenu">
                            <li><a href="#">Playsist 1</a></li>
                            <li><a href="#">Playsist 2</a></li>
                            <li><a href="#">Playlist 3</a></li>
                        </ul>
                    </li>
                </ul>
                <ul class="list-unstyled">
                    <li><a href="#">About Us</a></li>
                    <li><a href="#">Contact Us</a></li>
                </ul>
            </nav>

            <!-- Page Content Holder -->
            <div id="content">
                <div class="container-fluid" style="padding: 0px;">
                    
                    <!-- Jumbotron for advertisements -->
                    <div class="jumbotron row adv">
                        <div class="col-lg-6">
                            <h3>Rhythm</h3>
                        </div>
                        <div class="col-lg-6 text-right">
                            <h3>Welcome to Rythm</h3>
                            <p>Feel the Vibes of Music</p>
                        </div>
                    </div>
                    
                    <!-- main browsing window -->
                    <div class="row main-browsing-window">
                        
                        <!-- center section of browsing window -->
                        <div class="col-lg-12">
                            <!-- upper navigation -->
                            <div class="row upper-navigation">
                                <div class="col-lg-2"></div>
                                <div class="col-lg-8 up-navigation" >
                                    <div class="text-center">
                                        <div class="col-lg-2 col-md-6 nav-buttons">
                                            <button type="button" id="sidebarCollapse" class="btn navbar-btn">
                                                <i class="glyphicon glyphicon-align-left"></i>
                                                <span>File Manager</span>
                                            </button>
                                        </div>
                                        
                                        <div class="col-lg-2 col-md-6  nav-buttons">
                                            <button type="button" class="btn navbar-btn">
                                                <i class="far fa-snowflake"></i>
                                                <span><a href="main.php#newly_added" target="browsing-window">New</a></span>
                                            </button>
                                        </div>
                                        <div class="col-lg-2 col-md-6 nav-buttons">
                                            <button type="button" class="btn navbar-btn">
                                                <i class="fas fa-home"></i> 
                                                <span><a href="main.php" target="browsing-window">Home</a></span>
                                            </button>
                                        </div>
                                        <div class="col-lg-2 col-md-6 nav-buttons">
                                            <button type="button" class="btn navbar-btn">
                                                <i class="fas fa-globe"></i>  
                                                <span><a href="main.php#discover" target="browsing-window">Discover</a></span>
                                            </button>
                                        </div>
                                        <div class="col-lg-4 nav-search">
                                            <form class="navbar-form navbar-right" role="search" action="searchresult.php" method="POST">
                                                <div class="form-group">
                                                    <input type="text" class="form-control search-box" name="search" placeholder="Search...">
                                                    <button type="submit" class="btn btn-default search-icon">
                                                    <span class="glyphicon glyphicon-search"></span>
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- user menu -->
                                <div class="col-lg-2 up-navigation text-center">
                                    <!-- User Info -->
                                    <div class="dropdown user-menu">
                                      <button class="btn btn-default dropdown-toggle user-menu-button" type="button" id="menu1" data-toggle="dropdown">
                                        <?php echo $user_name ?>
                                      <span class="caret"></span></button>
                                      <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
                                        <li role="presentation"><a role="menuitem" href="#">Profile</a></li>
                                        <li role="presentation"><a role="menuitem" href="#">Settings</a></li>
                        
                                        <li role="presentation" class="divider"></li>
                                          
                                        <li role="presentation"><a role="menuitem" href="logout.php">Log-out</a></li>
                                      </ul>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- main content browsing window -->
                            <iframe src="main.php" class="browsing-window" id="style-1" height="410px" width="100%" name="browsing-window" style="margin-bottom: -6px;"></iframe>
                        </div>
                    </div>
                  
                    <!-- Audio Player Section -->
        
                        <div class="row">
                            
                            <div class="col-lg-2 audio-section">
                                <div id="audio-image text-center">
                                    <img class="cover" width="150px" height="200px">
                                </div>
                            </div>
                            <div class="col-lg-8 audio-section-1">
                                <div id="audio-player">
                                    <div id="audio-info">
                                        <span class="artist"></span>-<span class="title"></span>
                                    </div>
                                    <input id="volume" type="range" min="0" max="10" value="5">
                                    <br>
                                    <div class="text-center">
                                    <div id="audio-buttons">
                                        <button id="prev"></button>
                                        <button id="play"></button>
                                        <button id="pause"></button>
                                        <button id="stop"></button>
                                        <button id="next"></button>
                                    </div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div id="tracker">
                                        <div id="progressbar">
                                            <span id="progress"></span>
                                        </div>
                                        <span id="duration"></span>
                                    </div>
                                    <div class="clearfix"></div>
                                    <br><br>
                                    <ul id="playlist" class="list-group">
                                        <?php echo $list_content ?>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-2"></div>
                        </div>
                    </div>
                
                </div>
            
        </div>
        


        <div class="overlay"></div>


        <!-- jQuery CDN -->
        <script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
        <!-- Bootstrap Js CDN -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <!-- jQuery Custom Scroller CDN -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js"></script>

        <script type="text/javascript">
            $(document).ready(function () {
                $("#sidebar").mCustomScrollbar({
                    theme: "minimal"
                });

                $('#dismiss, .overlay').on('click', function () {
                    $('#sidebar').removeClass('active');
                    $('.overlay').fadeOut();
                });

                $('#sidebarCollapse').on('click', function () {
                    $('#sidebar').addClass('active');
                    $('.overlay').fadeIn();
                    $('.collapse.in').toggleClass('in');
                    $('a[aria-expanded=true]').attr('aria-expanded', 'false');
                });
            });
        </script>
        
        <script src="js/musicscript.js"></script>
        
        <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
        <!--
        <script src='http://api.html5media.info/1.1.8/html5media.min.js'></script>
        
        <script src='http://cdn.plyr.io/2.0.13/plyr.js'></script>
        -->
    </body>
</html>
