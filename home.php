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
        <!--
        <link href="musicplayerstyle.css" rel="stylesheet" type="text/css">
        -->
        <link rel="stylesheet" href="style.css">
        <!-- Scrollbar Custom CSS -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">
        <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/prefixfree/1.0.7/prefixfree.min.js"></script>
        
        <style>
            .player-section {
                margin-top: 0;
                width: 100%;
                background: #333333;
                color: #fff;
            }
            .column { 
                width:inherit;
            }


            /* Typography / Links
            ================================================== */

            p { color:#fff;
                display:block;
                font-size:.9rem;
                font-weight:400;
                margin:0 0 2px;
            }

            a,a:visited { 
                color:#fff;
                outline:0;
                text-decoration:none;
            }
            a:hover,a:focus { 
                color:#bbdef5;
            }
            p a,p a:visited { 
                line-height:inherit;
            }


            /* Misc.
            ================================================== */

            .add-bottom { margin-bottom:0rem !important; }
            .left { 
                float:left;
            }
            .right { float:right; }
            .center { text-align:center; }


            /* Audio Player Styles
            ================================================== */

            audio {
            margin:0 15px 0 14px;
            width:670px;
            }

            #mainwrap {
                text-align: center;
            }

            #audiowrap,
            #plwrap {
            margin:0 auto;
            padding: 0px;
            }

            #tracks {
            position:relative;
            text-align:center;
            padding: 0px;
            }


            .album-art {
                max-width: 150px;
                max-height: 150px;
                min-width: 100px;
                display: inline;
                width: 10%;
                padding: 20px;
                margin-top: -10%;
            }

            #player-control-info {
                display: inline-block;
                text-align: center;
                width: 75%;
            }
            #nowPlay {
            display:inline;
            }
            #npAction {
            padding: 25px;
            }

            #npTitle {
            padding:21px;
            }

            #plList li {
            cursor:pointer;
            display:block;
            margin:0;
            padding:21px 0;
            }

            #plList li:hover {
            background-color:rgba(0,0,0,.3);
            }

            .plItem {
            position:relative;
            }

            .plTitle {
            left:50px;
            overflow:hidden;
            position:absolute;
            right:65px;
            text-overflow:ellipsis;
            top:0;
            white-space:nowrap;
            }

            .plNum {
            padding-left:21px;
            width:25px;
            }

            .plLength {
            padding-left:21px;
            position:absolute;
            right:21px;
            top:0;
            }

            .plSel,
            .plSel:hover {
            background-color:rgba(0,0,0,.1);
            color:#fff;
            cursor:default !important;
            }

            a[id^="btn"] {
            border-radius:3px;
            color:#fff;
            cursor:pointer;
            display:inline-block;
            font-size:2rem;
            height:35px;
            line-height:.8;
            margin:0 20px 20px;
            padding:10px;
            text-decoration:none;
            transition:background .3s ease;
            width:35px;
            }

            a[id^="btn"]:last-child {
            margin-left:-4px;
            }

            a[id^="btn"]:hover,
            a[id^="btn"]:active {
            background-color:rgba(0,0,0,.1);
            color:#fff;
            }

            a[id^="btn"]::-moz-focus-inner {
            border:0;
            padding:0;
            }


            /* Plyr Overrides
            ================================================== */

            .plyr--audio .plyr__controls {
            background-color:inherit;
            border:none;
            color:#fff;;
            padding:3px 25px 10px 5px;
            width:100%;
            }

            .plyr--audio .plyr__controls button.tab-focus:focus,
            .plyr--audio .plyr__controls button:hover,
            .plyr__play-large {
            color: #000;
            background: inherit;
            }

            .plyr__progress--played, .plyr__volume--display {
            color:#fff;
            height: 6px;
            }

            .plyr--audio .plyr__progress--buffer,
            .plyr--audio .plyr__volume--display {
            background:rgba(0,0,0,.1);
            height: 6px;
            }

            .plyr--audio .plyr__progress--buffer {
            color:rgba(0,0,0,.1);
            }
            .btn-queue, .btn-queue:focus {
                background: inherit;
                outline: none !important;
            }

            /* Media Queries
            ================================================== */

            @media only screen and (max-width:850px) {
                #nowPlay { display:none; }
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
                    <p>File Manager</p>
                    <li>
                        <a href="song.php" target="browsing-window">Songs</a>
                    </li>
                    <li>
                        <a href="artist.html" target="browsing-window">Artists</a>
                    </li>
                    <li>
                        <a href="album.html" target="browsing-window">Albums</a>
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
                                <!-- next/ previous nav buttons -->
                                <div class="col-lg-1 up-navigation">
                                    <div class="text-center next-prev">
                                        
                                            <button type="button" class="btn navbar-btn">
                                                <i class="fas fa-angle-left"></i>  
                                                <span>Prev</span>
                                            </button>
                                        
                                    </div>
                                </div>
                                <div class="col-lg-8 up-navigation" >
                                    <div class="text-center">
                                        <div class="col-lg-2 nav-buttons">
                                            <button type="button" id="sidebarCollapse" class="btn navbar-btn">
                                                <i class="glyphicon glyphicon-align-left"></i>
                                                <span>File Manager</span>
                                            </button>
                                        </div>
                                        
                                        <div class="col-lg-2  nav-buttons">
                                            <button type="button" class="btn navbar-btn">
                                                <i class="far fa-snowflake"></i>
                                                <span><a href="main.html#newly_added" target="browsing-window">New</a></span>
                                            </button>
                                        </div>
                                        <div class="col-lg-2 nav-buttons">
                                            <button type="button" class="btn navbar-btn">
                                                <i class="fas fa-home"></i> 
                                                <span><a href="main.html" target="browsing-window">Home</a></span>
                                            </button>
                                        </div>
                                        <div class="col-lg-2 nav-buttons">
                                            <button type="button" class="btn navbar-btn">
                                                <i class="fas fa-globe"></i>  
                                                <span><a href="main.html#discover" target="browsing-window">Discover</a></span>
                                            </button>
                                        </div>
                                        <div class="col-lg-4 nav-search">
                                            <form class="navbar-form navbar-right" role="search">
                                                <div class="form-group">
                                                    <input type="text" class="form-control search-box" placeholder="Search...">
                                                    <button type="submit" class="btn btn-default search-icon">
                                                    <span class="glyphicon glyphicon-search"></span>
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- next/ previous nav buttons -->
                                <div class="col-lg-1 up-navigation">
                                    <div class="text-center next-prev">
                                        
                                            <button type="button" class="btn navbar-btn"> 
                                                <span>Next</span>
                                                <i class="fas fa-angle-right"></i> 
                                            </button>
                                        
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
                            <iframe src="main.html" class="browsing-window" id="style-1" height="410px" width="100%" name="browsing-window" style="margin-bottom: -6px;"></iframe>
                        </div>
                    </div>
                    <!-- player section -->
                    <div class="container-fluid player-section fixed-footer">
                        <div class="column add-bottom">
                            
                            <div id="mainwrap">
                                <img src="images/taylor.jpg" class="img-responsive img-fluid album-art">
                                <div id="player-control-info">
                                    <div id="nowPlay">
                                        <span class="left" id="npTitle"></span>
                                        
                                    </div>
                                    
                                    <div id="audiowrap">
                                        <div id="audio0">
                                            <audio preload id="audio1" controls="controls">Your browser does not support HTML5 Audio!</audio>
                                        </div>
                                        <div id="tracks">
                                            <a id="btnPrev"><i class="fas fa-chevron-left"></i></a>
                                            <a id="btnNext"><i class="fas fa-chevron-right"></i></a>

                                            <div>
                                            Songs in Queue
                                                <button type="button" class="btn btn-queue" data-toggle="collapse" data-target="#playlist-section"><i class="fas fa-list"></i></button>
                                            </div>

                                        </div>

                                    </div>
                                </div>
                                
                                
                                
                                <br>
                                <div id="playlist-section" class="collapse">
                                    <div id="plwrap">
                                        <ul id="plList"></ul>
                                    </div>
                                </div>
                            </div>
                        </div>
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
        <!--
        <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
        -->
        <script src='http://api.html5media.info/1.1.8/html5media.min.js'></script>
        
        <script src='http://cdn.plyr.io/2.0.13/plyr.js'></script>
        


        <script  src="musicplayer.js"></script>
    </body>
</html>
