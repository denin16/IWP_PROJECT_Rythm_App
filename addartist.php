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

    /*--------------------------------------------------------------------
    Script to link an artist to a user account
    --------------------------------------------------------------------*/

    //Getting the artist Id
    if(isset($_GET["ID"])){
        //setting the id into the variable
        $artist_id = $_GET["ID"];
        /*--------------------------------------
        Checking if the artist id already added
        ---------------------------------------*/
        //defining the sql query
        $sql_query_to_check = "SELECT artist_id FROM follows_artist WHERE artist_id = '$artist_id' AND user_id = '$user_id'";
        //Executing the query
        if($result = mysqli_query($conn,$sql_query_to_check)){
            if(mysqli_num_rows($result) == 0){
    
                /*--------------------------------
                Inserting artist_id in users account
                --------------------------------*/
                //Defining the sql query
                $sql_query_to_add_song = "INSERT INTO follows_artist(user_id,artist_id)
                VALUES('$user_id','$artist_id')";
                //Executing the query
                if(mysqli_query($conn,$sql_query_to_add_song)){
                    //echo "Successful!";
                    header("Location: main.php");
                }
            } else{
                //echo "already present!";
            }
        }    
    }


?>