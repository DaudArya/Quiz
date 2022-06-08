<?php 

include 'config.php';
// memberikan koneksi ke database.
error_reporting(0);
//melaporkan jikalau ada kesalahan atau error.
session_start();
//memulai sesi pada program ini.
if (isset($_SESSION['username'])) {
    header("Location: index.php");
}
//memberikan pengecekan apakah session "username" sudah dijalankan , jika belum maka akan di redirect ke halaman index.php
if (isset($_POST['submit'])) {
	$Name = $_POST['Name'];
	$Address = $_POST['Address'];
	$Email = $_POST['Email'];
	$Homepage =$_POST['Homepage'];
	$username= $_POST['username'];
	$password = $_POST['password'];
	$cpassword =$_POST['cpassword'];
// pengecekan apakah method 'submit' tersedia , jika sudah maka array data akan di definis
	if ($password == $cpassword) { //pengecekan apakah password sama dengan confirmation password.
		$sql = "SELECT * FROM users WHERE email='$email'";
		$result = mysqli_query($conn, $sql);
		if (!$result->num_rows > 0) 
		//pengecekan apakah hasil dari pemerikasaan diatas hasil inputan tidak ada yang sama dengan yang ada di database
		{
			$sql = "SELECT * FROM users WHERE username='$username'";
		$result = mysqli_query($conn, $sql);
		if (!$result->num_rows > 0)
		//pengecekan apakah hasil dari pemerikasaan diatas hasil inputan tidak ada yang sama dengan yang ada di database
		{
			$sql = "INSERT INTO users (Name, Address,Email, Homepage , username , password )
					VALUES ('$Name', '$Address', '$Email', '$Homepage','$username', '$password' )";
					//query insert data ke tabel users
			$result = mysqli_query($conn, $sql);
			//jika result dijalankan dan berhasil, maka form akan dikosongkan dan pengguna bisa login.
			if ($result) { 
				echo "<script>alert('Wow! Registrasi Pengguna Baru Berhasil.')</script>";
				$username = "";
				$email = "";
				$_POST['password'] = "";
				$_POST['cpassword'] = "";
				$alamat = "";
				$makanan = "";
			} else {
				echo "<script>alert('Woops! Ada Kesalahan.')</script>";
			}
		

		}else {
			echo "<script>alert('Woops! username Sudah Dipakai.')</script>";
		}
	} else {
		echo "<script>alert('Woops! Email Sudah Dipakai.')</script>";
	}
			
		
	} else {
		echo "<script>alert('Password Salah.')</script>";
	}
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

	<link rel="stylesheet" type="text/css" href="style.css">

	<title>Register Form</title>
</head>
<body>
	<div class="container">
		<form action="" method="POST" class="login-email">
            <p class="login-text" style="font-size: 2rem; font-weight: 800;">Register</p>
			<div class="input-group">
				<input type="text" placeholder="Name" name="Name" value="<?php echo $Name; ?>" required>
			</div>
			<div class="input-group">
				<input type="alamat" placeholder="Address" name="Address" value="<?php echo $Address; ?>" required>
			</div>
			<div class="input-group">
				<input type="email" placeholder="Email" name="Email" value="<?php echo $Email; ?>" required>
			</div>
			<div class="input-group">
				<input type="username" placeholder="username" name="username" value="<?php echo $username; ?>" required>
			</div>
			<div class="input-group">
				<input type="password" placeholder="Password" name="password" value="<?php echo $_POST['password']; ?>" required>
            </div>
            <div class="input-group">
				<input type="password" placeholder="Confirm Password" name="cpassword" value="<?php echo $_POST['cpassword']; ?>" required>
			</div>
			
			
			<!-- menampilkan field htl untuk input data -->
			<div class="input-group">
				<button name="submit" class="btn">Register</button>
				<!-- tombol register -->
			</div>
			<p class="login-register-text">Have an account? <a href="index.php">Login Here</a>.</p>
			<!-- redirect ke form login -->
		</form>
	</div>
</body>
</html>