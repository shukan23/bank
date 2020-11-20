<?php
$server="localhost";
$username="root";
$password="";

$conn = mysqli_connect($server,$username,$password,"bank");

if(!$conn){
    die("connection to database failed");
}
// echo "congrats shukan database connection done successfully";


?>