<?php

session_start();
//memulai sesi pada operasi PHP
if(!isset($_SESSION["username"])){ 
    header("location: index.php");
}
//memberikan pengecekan apakah sesi 'username' pada program ini ada , jika tidak ada maka akan kembali ke menu login.
include 'config.php';
//memberikan koneksi ke database.
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Homepage</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; text-align: left;padding: 20px 40px; }
        /* memberikan tampilan pada homepage dengan ketentuan CSS diatas berdasarkan library CSS bootstrap */
    </style>
</head>
<body>
    <div class="page-header">
        <h1>Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b></h1>
        <!-- mengambil data username dari database untuk ditampilkan sebagai sambutan pada dashboard -->
    </div>
    <?php
        $tampil    =mysqli_query($conn, "SELECT * FROM users WHERE username='$_SESSION[username]'");
        // fungsi query yang memberikan perintah untuk mengambil semua data pada tabel "users" berdasarkan username.
        $user    =mysqli_fetch_array($tampil);
        //Fungsi mysql_fetch_object pada php adalah untuk menyajikan hasil perintah query dalam gaya penulisan object oriented sehingga mysql_fetch_object() akan menampilkan hasil tabel mysql sebagai objek.
    ?>

    <h3>Selamat Datang , <?=$user['Name'] ?>. Pada hari,  <?php echo date('D - M / Y'); ?> </h3>
    <h3>Email : <?=$user['Email']?> </h3>
    <h3>Alamat : <?=$user['Address']?> </h3>
    
    <br>
    <!-- menampilkan semua data yang di miliki olhe users kecuali password akun -->
    <p><a href="guestbook.php" class="btn btn-primary">Guest Book</a></p>
    <p><a href="logout.php" class="btn btn-primary">Log Out</a></p>
    
    <!-- button log out -->
    
</body>
</html>