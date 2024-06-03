<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('location:../index.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Gym System Admin</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../css/bootstrap.min.css" />
    <link rel="stylesheet" href="../css/bootstrap-responsive.min.css" />
    <link rel="stylesheet" href="../css/matrix-style.css" />
    <link rel="stylesheet" href="../css/matrix-media.css" />
    <link href="../font-awesome/css/fontawesome.css" rel="stylesheet" />
    <link href="../font-awesome/css/all.css" rel="stylesheet" />
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>
</head>
<body>

<!--Header-part-->
<div id="header">
    <h1><a href="dashboard.html">Perfect Gym Admin</a></h1>
</div>
<!--close-Header-part-->

<!--top-Header-menu-->
<?php include 'includes/topheader.php'?>

<!--sidebar-menu-->
<?php $page='staffs-entry'; include 'includes/sidebar.php'?>

<div id="content">
    <div id="content-header">
        <div id="breadcrumb">
            <a href="index.html" title="Go to Home" class="tip-bottom"><i class="fas fa-home"></i> Home</a>
            <a href="#" class="tip-bottom">Manage Staff</a>
            <a href="#" class="current">Add Staff</a>
        </div>
        <h1>Staff Entry Form</h1>
    </div>

    <form role="form" action="index.php" method="POST">
        <?php
        if(isset($_POST['fullname'])){
            $fullname = $_POST["fullname"];
            $username = $_POST["username"];
            $password = $_POST["password"];
            $email = $_POST["email"];
            $address = $_POST["address"];
            $designation = $_POST["designation"];
            $gender = $_POST["gender"];
            $contact = $_POST["contact"];

            // Hash the password
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            include 'dbcon.php';

            // Prepare and bind the SQL statement
            $stmt = $conn->prepare("INSERT INTO staffs (fullname, username, password, email, address, designation, gender, contact) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssssss", $fullname, $username, $hashed_password, $email, $address, $designation, $gender, $contact);

            // Execute the statement
            if ($stmt->execute()) {
                echo "<div class='container-fluid'>
                        <div class='row-fluid'>
                            <div class='span12'>
                                <div class='widget-box'>
                                    <div class='widget-title'> <span class='icon'> <i class='fas fa-info'></i> </span>
                                        <h5>Message</h5>
                                    </div>
                                    <div class='widget-content'>
                                        <div class='error_ex'>
                                            <h1>Success</h1>
                                            <h3>Staff details have been added!</h3>
                                            <p>The requested details are added. Please click the button to go back.</p>
                                            <a class='btn btn-inverse btn-big' href='staffs.php'>Go Back</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>";
            } else {
                echo "<div class='container-fluid'>
                        <div class='row-fluid'>
                            <div class='span12'>
                                <div class='widget-box'>
                                    <div class='widget-title'> <span class='icon'> <i class='fas fa-info'></i> </span>
                                        <h5>Error Message</h5>
                                    </div>
                                    <div class='widget-content'>
                                        <div class='error_ex'>
                                            <h1 style='color:maroon;'>Error 404</h1>
                                            <h3>Error occurred while entering staff details</h3>
                                            <p>Please Try Again</p>
                                            <a class='btn btn-warning btn-big' href='edit-staff.php'>Go Back</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>";
            }

            // Close the statement and database connection
            $stmt->close();
            $conn->close();
        } else {
            echo "<h3>YOU ARE NOT AUTHORIZED TO REDIRECT THIS PAGE. GO BACK to <a href='index.php'>DASHBOARD</a></h3>";
        }
        ?>
    </form>
</div>

<!--Footer-part-->
<div class="row-fluid">
    <div id="footer" class="span12"><?php echo date("Y");?> &copy; Developed By Naseeb Bajracharya</div>
</div>

<style>
    #footer {
        color: white;
    }
</style>

<!--end-Footer-part-->

<script src="../js/jquery.min.js"></script>
<script src="../js/jquery.ui.custom.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/jquery.validate.js"></script>
<script src="../js/jquery.wizard.js"></script>
<script src="../js/matrix.js"></script>
<script src="../js/matrix.wizard.js"></script>
</body>
</html>
