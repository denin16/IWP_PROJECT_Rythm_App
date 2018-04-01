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
    Script to add the desired song to the account user account
    --------------------------------------------------------------------*/

    //Getting the song Id
    if(isset($_GET["ID"])){
        //setting the id into the variable
        $song_id = $_GET["ID"];
        /*--------------------------------------
        Checking if the song id already present
        ---------------------------------------*/
        //defining the sql query
        $sql_query_to_check = "SELECT song_id FROM added_songs WHERE song_id = '$song_id' AND user_id = '$user_id'";
        //Executing the query
        if($result = mysqli_query($conn,$sql_query_to_check)){
            if(mysqli_num_rows($result) == 0){
    
                /*--------------------------------
                Inserting song_id in users account
                --------------------------------*/
                //Defining the sql query
                $sql_query_to_add_song = "INSERT INTO added_songs(user_id,song_id)
                VALUES('$user_id','$song_id')";
                //Executing the query
                if(mysqli_query($conn,$sql_query_to_add_song)){
                    //echo "Successful!";
                    header("Location: main.php#'.$song_id.'");
                }
            } else{
                //echo "already present!";
            }
        }    
    }


?>