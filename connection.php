<?php
//This is a connection file
$host = "localhost";
$user = "root";
$pwd = "";
$db = "tutorfinder";

$conn = mysqli_connect($host,$user,$pwd,$db);

if(!$conn){
    echo "Unable to connect to database!!!";
}
?>