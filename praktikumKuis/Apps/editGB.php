<?php
// Include config file
require_once "connect.php";
 
// Define variables and initialize with empty values
$Name = $Email = $Address = $City = $pesan ="";
$Name_err = $Email_err = $Address_err = $City_err = $pesan_err ="";
 
// Processing form data when form is submitted
if(isset($_POST["id"]) && !empty($_POST["id"])){
    // Get hidden input value
    $id = $_POST["id"];
    
    // Validate name
    $input_Name = trim($_POST["name"]);
    if(empty($input_Name)){
        $Name_err = "Please enter an Name.";     
    } else{
        $Name = $input_Name;
    }

    // Validate address email
    $input_Email = trim($_POST["email"]);
    if(empty($input_Email)){
        $Email_err = "Please enter an email.";     
    } else{
        $Email = $input_Email;
    }
    
    // Validate address address
    $input_Address = trim($_POST["address"]);
    if(empty($input_Address)){
        $Address_err = "Please enter an address.";     
    } else{
        $Address = $input_Address;
    }
    
    // Validate address City
    $input_city = trim($_POST["city"]);
    if(empty($input_city)){
        $City_err = "Please enter an City.";     
    } else{
        $City = $input_city;
    }

    // Validate address City
    $input_pesan = trim($_POST["pesan"]);
    if(empty($input_pesan)){
        $pesan_err = "Please enter an Message.";     
    } else{
        $pesan = $input_pesan;
    }
    
    // Check input errors before inserting in database
    if(empty($Posted_err) && empty($Name_err) &&  empty($Email_err) && empty($Address_err) && empty($City_err)&& empty($pesan_err)){
        // Prepare an update statement
        $sql = "UPDATE guestbook SET Name=?, Email=?, Address=?, City=? , pesan=? WHERE id=?";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssssi", $param_Name, $param_Email, $param_Address, $param_City ,$param_pesan, $param_id);
            
            // Set parameters
            $param_Name = $Name;
            $param_Email = $Email;
            $param_Address = $Address;
            $param_City = $City;
            $param_pesan = $pesan;
            $param_id = $id;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records updated successfully. Redirect to landing page
                header("location: guestbook.php");
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
} else{
    // Check existence of id parameter before processing further
    if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
        // Get URL parameter
        $id =  trim($_GET["id"]);
        
        // Prepare a select statement
        $sql = "SELECT * FROM guestbook WHERE id = ?";
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "i", $param_id);
            
            // Set parameters
            $param_id = $id;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                $result = mysqli_stmt_get_result($stmt);
    
                if(mysqli_num_rows($result) == 1){
                    /* Fetch result row as an associative array. Since the result set
                    contains only one row, we don't need to use while loop */
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    
                    // Retrieve individual field value
                    $Name = $row["Name"];
                    $Email = $row["Email"];
                    $Address = $row["Address"];
                    $City = $row["City"];
                    $pesan = $row["pesan"];
                } else{
                    // URL doesn't contain valid id. Redirect to error page
                    header("location: error.php");
                    exit();
                }
                
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
        
        // Close statement
        mysqli_stmt_close($stmt);
        
        // Close connection
        mysqli_close($link);
    }  else{
        // URL doesn't contain id parameter. Redirect to error page
        header("location: error.php");
        exit();
    }
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Record</title>
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
                        <h2>Update Record</h2>
                    </div>
                    <p>Please edit the input values and submit to update the record.</p>
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                        <div class="form-group <?php echo (!empty($Name_err)) ? 'has-error' : ''; ?>">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control" value="<?php echo $Name; ?>">
                            <span class="help-block"><?php echo $Name_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($Email_err)) ? 'has-error' : ''; ?>">
                            <label>Email</label>
                            <input type="text" name="email" class="form-control" value="<?php echo $Email; ?>">
                            <span class="help-block"><?php echo $Email_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($Address_err)) ? 'has-error' : ''; ?>">
                            <label>Address</label>
                            <textarea name="address" class="form-control"><?php echo $Address; ?></textarea>
                            <span class="help-block"><?php echo $Address_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($City_err)) ? 'has-error' : ''; ?>">
                            <label>City</label>
                            <input type="text" name="city" class="form-control" value="<?php echo $City; ?>">
                            <span class="help-block"><?php echo $City_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($pesan_err)) ? 'has-error' : ''; ?>">
                            <label>Message</label>
                            <textarea name="pesan" class="form-control"><?php echo $pesan; ?></textarea>
                            <span class="help-block"><?php echo $pesan_err;?></span>
                        </div>
                        <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="index.php" class="btn btn-default">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>