<?php
//perintah memuat isi connect.php ke dalam file create-table.php 
include "connect.php";

//query untuk membuat tabel kontak 
$sql = "CREATE TABLE users (
id INT(5) NOT NULL AUTO_INCREMENT PRIMARY KEY,
Name VARCHAR(50),
Address VARCHAR(50),
Email VARCHAR (50),
Homepage VARCHAR (50),
username VARCHAR(25),
password VARCHAR(25))";

//Mengecek apakah terjadi eror ketika pembuatan tabel
if (mysqli_query($conn, $sql)) {
    echo "New Record Succesfully";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

//Menutup koneksi
mysqli_close($conn);