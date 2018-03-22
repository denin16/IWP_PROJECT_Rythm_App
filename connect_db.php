<?php
$servername = "localhost";
$username = "root";
$password = "";
$db = "rythm";
//Create Connection
$conn = mysqli_connect($servername, $username, $password, $db);
//checking the connection
If(!$conn){
	Die("connection failed: ". mysqli_connect_error());
}
?>