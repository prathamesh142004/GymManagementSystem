<?php
session_start();
include('dbcon.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Gym System Staff Login</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/bootstrap-responsive.min.css" />
    <link rel="stylesheet" href="css/matrix-style.css" />
    <link rel="stylesheet" href="css/matrix-login.css" />
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>
</head>
    
<body>
    <div id="loginbox">            
        <form id="loginform" method="POST" class="form-vertical" action="#">
            <div class="control-group normal_text"> <h3><img src="img/icontest3.png" alt="Logo" /></h3></div>
            <div class="control-group">
                <div class="controls">
                    <div class="main_input_box">
                        <span class="add-on bg_lg"><i class="icon-user"> </i></span>
                        <input type="text" name="user" placeholder="Username" required/>
                    </div>
                </div>
            </div>
            <div class="control-group">
                <div class="controls">
                    <div class="main_input_box">
                        <span class="add-on bg_ly"><i class="icon-lock"></i></span>
                        <input type="password" name="pass" placeholder="Password" required />
                    </div>
                </div>
            </div>
            <div class="form-actions center">
                <button type="submit" class="btn btn-block btn-large btn-warning" title="Log In" name="login" value="Staff Login">Staff Login</button>
            </div>
        </form>

        <?php
           if (isset($_POST['login'])) {
            $username = mysqli_real_escape_string($conn, $_POST['user']);
            $password = mysqli_real_escape_string($conn, $_POST['pass']);
        
            $query = mysqli_query($conn, "SELECT * FROM staffs WHERE username='$username'");
            if (!$query) {
                die(mysqli_error($conn)); // Check for any SQL errors
            }
            $row = mysqli_fetch_array($query);
            if ($row) {
                $stored_password = $row['password'];
        
                // Verify the password using password_verify
                if (password_verify($password, $stored_password)) {
                    $_SESSION['user_id'] = $row['user_id'];
                    header('location:staff-pages/index.php');
                } else {
                    echo "<div class='alert alert-danger alert-dismissible' role='alert'>
                        Invalid Password
                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                        </button>
                    </div>";
                }
            } else {
                echo "<div class='alert alert-danger alert-dismissible' role='alert'>
                    No user found with username $username
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                        <span aria-hidden='true'>&times;</span>
                    </button>
                </div>";
            }
        }
        
?>


        <div class="pull-left">
            <a href="../index.php"><h6>Admin Login</h6></a>
        </div>
        <div class="pull-right">
            <a href="../customer"><h6>Customer Login</h6></a>
        </div>
    </div>
        
    <script src="js/jquery.min.js"></script>  
    <script src="js/matrix.login.js"></script> 
    <script src="js/bootstrap.min.js"></script> 
    <script src="js/matrix.js"></script>
</body>
</html>
