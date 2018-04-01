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
    Script to link an album to a user account
    --------------------------------------------------------------------*/

    //Getting the album Id
    if(isset($_GET["ID"])){
        //setting the id into the variable
        $album_id = $_GET["ID"];
        /*--------------------------------------
        Checking if the album id already added
        ---------------------------------------*/
        //defining the sql query
        $sql_query_to_check = "SELECT album_id FROM follows_album WHERE album_id = '$album_id' AND user_id = '$user_id'";
        //Executing the query
        if($result = mysqli_query($conn,$sql_query_to_check)){
            if(mysqli_num_rows($result) == 0){
    
                /*--------------------------------
                Inserting artist_id in users account
                --------------------------------*/
                //Defining the sql query
                $sql_query_to_add_album = "INSERT INTO follows_album(user_id,album_id)
                VALUES('$user_id','$album_id')";
                //Executing the query
                if(mysqli_query($conn,$sql_query_to_add_album)){
                    //echo "Successful!";
                    header("Location: main.php");
                }
            } else{
                //echo "already present!";
            }
        }    
    }


?>