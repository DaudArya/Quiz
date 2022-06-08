<?php
// Include config file
require_once "connect.php";

// Define variables and initialize with empty values
$Posted = $Name = $Email = $Address = $City = $pesan ="";
$Posted_err =$Name_err = $Email_err = $Address_err = $City_err = $pesan_err ="";
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Validate Posted
    // $input_Posted = trim($_POST["Posted"]);
    // if(empty($input_Posted)){
        // $Posted_err = "Please enter an Date Posted.";
    // } else{
        // $Posted = $input_Posted;
    // }


    // Validate name
    
    $input_Name = trim($_POST["name"]);
    if(empty($input_Name)){
       $Name_err = "Please enter an Name.";
    } else{
       $Name = $input_Name;
 }

    $input_Email = trim($_POST["Email"]);
    if(empty($input_Email)){
        $Email_err = "Please enter an Email.";
    } else{
        $Email = $input_Email;
    }

    // Validate address
    $input_Address = trim($_POST["address"]);
   if(empty($input_Address)){
       $Address_err = "Please enter an address.";
   } else{
        $Address = $input_Address;
   }

    // Validate City
    $input_City = trim($_POST["City"]);
    if(empty($input_City)){
        $City_err = "Please enter an City.";
    } else{
        $City = $input_City;
    }

    // Validate address
    $input_pesan = trim($_POST["pesan"]);
   if(empty($input_pesan)){
       $pesan_err = "Please enter an pesan.";
   } else{
        $pesan = $input_pesan;
   }

    // Check input errors before inserting in database
    if(empty($Posted_err) && empty($Name_err) &&  empty($Email_err) && empty($Address_err) && empty($City_err)&& empty($pesan_err)){
        // Prepare an insert statement
        $sql = "INSERT INTO guestbook (Posted, Name, Email, Address,City ,pesan) VALUES (?, ?, ?, ?, ?, ?)";

        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssssss", $param_Posted, $param_Name, $param_Email, $param_Address, $param_City ,$param_pesan);

            // Set parameters
            $param_Posted = $Posted;
            $param_Name = $Name;
            $param_Email = $Email;
            $param_Address = $Address;
            $param_City = $City;
            $param_pesan = $pesan;
            

            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records created successfully. Redirect to landing page
                header("location: welcome.php");
                exit();
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }

        // Close statement
        mysqli_stmt_close($stmt);
    }

    // Close connection
    mysqli_close($link);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Record</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        .wrapper{
            width: 500px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h2>Tambah Guestbook</h2>
                    </div>
                    <p>Silahkan isi form di bawah ini kemudian submit untuk menambahkan data Tamu</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group <?php echo (!empty($Posted_err)) ? 'has-error' : ''; ?>">
                            <label>Tanggal</label>
                            <input type="text" name="posted" class="form-control" value="<?php echo $Posted; ?>">
                            <span class="help-block"><?php echo $Posted_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($Name_err)) ? 'has-error' : ''; ?>">
                            <label>Nama</label>
                            <input type="text" name="name" class="form-control" value="<?php echo $Name; ?>">
                            <span class="help-block"><?php echo $Name_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($Email_err)) ? 'has-error' : ''; ?>">
                            <label>Email</label>
                            <input type="text" name="Email" class="form-control" value="<?php echo $Email; ?>">
                            <span class="help-block"><?php echo $Email_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($Address_err)) ? 'has-error' : ''; ?>">
                            <label>Alamat</label>
                            <textarea name="address" class="form-control"><?php echo $Address; ?></textarea>
                            <span class="help-block"><?php echo $Address_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($City_err)) ? 'has-error' : ''; ?>">
                            <label>Asal Kota</label>
                            <input type="text" name="City" class="form-control" value="<?php echo $City; ?>">
                            <span class="help-block"><?php echo $City_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($pesan_err)) ? 'has-error' : ''; ?>">
                            <label>Pesan</label>
                            <textarea name="pesan" class="form-control"><?php echo $pesan; ?></textarea>
                            <span class="help-block"><?php echo $pesan_err;?></span>
                        </div>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="index.php" class="btn btn-default">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>