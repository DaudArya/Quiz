<?php
$servername = "localhost";
$username = "root";
$password = "";

//create connection
$conn = mysqli_connect($servername, $username, $password);

if(!$conn){
    die ("Connection Failed: ". mysqli_connect_error());
}

//Create database
$sql = "CREATE DATABASE myweb";
if(mysqli_query($conn, $sql)){
    echo "Database created succesfully";
}else{
    echo "Error creating database: " . mysqli_connect_error($conn);
}