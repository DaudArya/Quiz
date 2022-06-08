<?php 

include 'config.php';
//menambahkan koneksi ke database.
session_start();
//memulai session
error_reporting(0);
//handler untuk menginformasikan error
if (isset($_SESSION['username']) ) {
    header("Location: welcome.php");
}
//pengecekan untuk melihat apakah session username sudah ada jika ada maka redirect akan masuk ke welcom.php
if (isset($_POST['submit'])) { //mengecek apakah method submit sudah disediakan pada form html
	$email = $_POST['email'];
	$password = $_POST['password'];
//jika ada maka array email dan password untuk submit form login
	$sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
	$result = mysqli_query($conn, $sql);
	//query untuk melihat apakah inputan dari pengguna telah cocok dengan data di database
	if ($result->num_rows > 0) {
		//pengecekan apakah result dari query ada atau tidak null
		$row = mysqli_fetch_assoc($result);
		//digunakan untuk mengambil baris hasil sebagai array asosiatif, Nama kolom yang dikembalikan dari fungsi ini peka huruf besar / kecil(Case-sensitive).
		$_SESSION['username'] = $row['username'];
		header("Location: welcome.php");
		//direct ke homepage di welcome.php
	} else {
		echo "<script>alert('Woops! Email atau Password.')</script>";
	}
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<!-- import library CSS bootstrap -->
	<link rel="stylesheet" type="text/css" href="style.css">

	<title>Login Form</title>
</head>
<body>
	<div class="container">
		<form action="" method="POST" class="login-email">
			<p class="login-text" style="font-size: 2rem; font-weight: 800;">Login</p>
			<div class="input-group">
				<input type="email" placeholder="Email" name="email" value="<?php echo $email; ?>" required>
			</div>
			<div class="input-group">
				<input type="password" placeholder="Password" name="password" value="<?php echo $_POST['password']; ?>" required>
			</div>
			<div class="input-group">
				<button name="submit" class="btn">Login</button>
			</div>
			<p class="login-register-text">Don't have an account? <a href="register.php">Register Here</a>.</p>
		</form>
	</div>
</body>
</html>