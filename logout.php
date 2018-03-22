<?php
    //Starting the session
    session_start();
    session_destroy();
    //Taking back to login oage
    header("Location: index.php");
?>