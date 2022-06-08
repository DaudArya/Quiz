<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>GuestBook</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.js"></script>
    <style type="text/css">
        .wrapper{
            width: 650px;
            margin: 0 auto;
        }
        .page-header h2{
            margin-top: 0;
        }
        table tr td:last-child a{
            margin-right: 15px;
        }
    </style>
    <script type="text/javascript">
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header clearfix">
                        <h2 class="pull-left">Guest Book</h2>
                        <a href="createGB.php" class="btn btn-success pull-right">Tambah Baru</a>
                    </div>
                    <?php
                    // menjalankan koneksi ke database
                    require_once "connect.php";

                    // menampilkan hasil query ke dalam form tabel website
                    $sql = "SELECT * FROM guestbook";
                    if($result = mysqli_query($link, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            echo "<table class='table table-bordered table-striped'>";
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>#ID</th>"; // memberikan judul pada tabel ID
                                        echo "<th>Nama</th>"; //memberikan judul pada tabel nama
                                        echo "<th>Email</th>"; //memberikan judul pada tabel email
                                        echo "<th>Alamat</th>"; //memberikan judul pada tabel email
                                        echo "<th>Kelola</th>"; //memberikan judul pada tabel kelola
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = mysqli_fetch_array($result)){
                                    echo "<tr>";
                                        echo "<td>" . $row['id'] . "</td>"; //memanggil id user yang telah ada di database
                                        echo "<td>" . $row['Name'] . "</td>"; //memanggil nama user yang telah ada di database
                                        
                                        echo "<td>" . $row['Email'] . "</td>"; //memanggil email user yang telah ada didatabse
                                        echo "<td>" . $row['Address'] . "</td>"; //memanggil alamt user yang telah ada di database

                                        echo "<td>";
                                            echo "<a href='editGB.php?id=". $row['id'] ."' title='Update Record' data-toggle='tooltip'><span class='glyphicon glyphicon-pencil'></span></a>";
                                            //menampilkan icon edit untuk merubah data yang telah diinput
                                            echo "<a href='delete.php?id=". $row['id'] ."' title='Delete Record' data-toggle='tooltip'><span class='glyphicon glyphicon-trash'></span></a>";
                                            //menampilkan icon delete untuk menghapus data yang ada didatabse sesuai barisnya
                                            echo "</td>";
                                    echo "</tr>";
                                }
                                echo "</tbody>";
                            echo "</table>";
                            
                            mysqli_free_result($result);
                        } else{
                            echo "<p class='lead'><em>No records were found.</em></p>";
                        }
                    } else{
                        echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
                    }

                    // Close connection
                    mysqli_close($link);
                    ?>
                </div>
            </div>
            <p><a href="welcome.php" class="btn btn-primary">Back</a></p>
        </div>   
    </div>
    
</body>
</html>