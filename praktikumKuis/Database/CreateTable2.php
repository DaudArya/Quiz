<?php
//perintah memuat isi connect.php ke dalam file create-table.php 
include "connect.php";

//query untuk membuat tabel kontak 
$sql = "CREATE TABLE guestbook (
id INT(5) NOT NULL AUTO_INCREMENT PRIMARY KEY,
posted DATE ,
Name VARCHAR(50),
Email VARCHAR (75),
Address VARCHAR (75),
City VARCHAR(75),
pesan TEXT)";

//Mengecek apakah terjadi eror ketika pembuatan tabel
if (mysqli_query($conn, $sql)) {
    echo "New Record Succesfully";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

//Menutup koneksi
mysqli_close($conn);