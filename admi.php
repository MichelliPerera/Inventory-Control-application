<?php
session_start();
error_reporting(0);
include("include/config.php");

// Login functionality
if(isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    $query = "SELECT * FROM admin WHERE username='$username' AND password='$password'";
    $result = mysqli_query($con, $query);
    $num = mysqli_num_rows($result);

    if($num > 0) {
        $admin_data = mysqli_fetch_array($result);
        $_SESSION['alogin'] = $admin_data['username'];
        $_SESSION['id'] = $admin_data['id'];
        $_SESSION['admintype'] = $admin_data['admintype']; // Assuming 'admintype' is the column for admin type
        $redirect_url = "category.php"; // Change this to the dashboard page
        header("location: $redirect_url");
        exit();
    } else {
        $_SESSION['errmsg'] = "Invalid username or password";
    }
}

// Registration functionality
if(isset($_POST['register'])) {
    $username = $_POST['reg_username'];
    $password = md5($_POST['reg_password']);
    $admintype = $_POST['admintype']; // Assuming admin type is selected from a dropdown

    // Check if the username is already taken
    $check_query = "SELECT * FROM admin WHERE username='$username'";
    $check_result = mysqli_query($con, $check_query);
    $check_num = mysqli_num_rows($check_result);

    if($check_num > 0) {
        $_SESSION['reg_errmsg'] = "Username already exists";
    } else {
        // Insert new staff member into the admin table
        $insert_query = "INSERT INTO admin (username, password, admintype) VALUES ('$username', '$password', '$admintype')";
        $insert_result = mysqli_query($con, $insert_query);
        if($insert_result) {
            $_SESSION['reg_success'] = "New staff member registered successfully";
        } else {
            $_SESSION['reg_errmsg'] = "Registration failed";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Portal | Admin login</title>
    <link type="text/css" href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link type="text/css" href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
    <link type="text/css" href="css/theme.css" rel="stylesheet">
    <link type="text/css" href="images/icons/css/font-awesome.css" rel="stylesheet">
    <link type="text/css" href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600' rel='stylesheet'>
</head>
<body>

    <div class="navbar navbar-fixed-top">
        <div class="navbar-inner">
            <div class="container">
                <a class="btn btn-navbar" data-toggle="collapse" data-target=".navbar-inverse-collapse">
                    <i class="icon-reorder shaded"></i>
                </a>

                <a class="brand" href="index.html">
                    Shopping Portal | Admin
                </a>

                <div class="nav-collapse collapse navbar-inverse-collapse">
                
                    <ul class="nav pull-right">
                        <li><a href="http://localhost/shopping/">Back to Portal</a></li>
                    </ul>
                </div><!-- /.nav-collapse -->
            </div>
        </div><!-- /navbar-inner -->
    </div><!-- /navbar -->

    <div class="wrapper">
        <div class="container">
            <div class="row">
                <!-- Login form -->
                <div class="module module-login span4 offset4">
                    <form class="form-vertical" method="post">
                        <div class="module-head">
                            <h3>Sign In</h3>
                        </div>
                        <span style="color:red;"><?php echo htmlentities($_SESSION['errmsg']); ?><?php echo htmlentities($_SESSION['errmsg']="");?></span>
                        <div class="module-body">
                            <div class="control-group">
                                <div class="controls row-fluid">
                                    <input class="span12" type="text" id="inputEmail" name="username" placeholder="Username">
                                </div>
                            </div>
                            <div class="control-group">
                                <div class="controls row-fluid">
                                    <input class="span12" type="password" id="inputPassword" name="password" placeholder="Password">
                                </div>
                            </div>
                        </div>
                        <div class="module-foot">
                            <div class="control-group">
                                <div class="controls clearfix">
                                    <button type="submit" class="btn btn-primary pull-right" name="submit">Login</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Registration form -->
                <div class="module module-register span4 offset4">
                    <form class="form-vertical" method="post">
                        <div class="module-head">
                            <h3>Register New Staff</h3>
                        </div>
                        <span style="color:red;"><?php echo htmlentities($_SESSION['reg_errmsg']); ?><?php echo htmlentities($_SESSION['reg_errmsg']="");?></span>
                        <span style="color:green;"><?php echo htmlentities($_SESSION['reg_success']); ?><?php echo htmlentities($_SESSION['reg_success']="");?></span>
                        <div class="module-body">
                            <div class="control-group">
                                <div class="controls row-fluid">
                                    <input class="span12" type="text" name="reg_username" placeholder="Username">
                                </div>
                            </div>
                            <div class="control-group">
                                <div class="controls row-fluid">
                                    <input class="span12" type="password" name="reg_password" placeholder="Password">
                                </div>
                            </div>
                            <div class="control-group">
                                <div class="controls row-fluid">
                                    <select class="span12" name="admintype">
                                        <option value="">Select Admin Type</option>
                                        <option value="1">Production Manager</option>
                                        <option value="2">Chief Accountant</option>
                                        <option value="3">Inventory handling clerk</option>
                                        <!-- Add more admin types if needed -->
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="module-foot">
                            <div class="control-group">
                                <div class="controls clearfix">
                                    <button type="submit" class="btn btn-primary pull-right" name="register">Register</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div><!--/.wrapper-->

    <!-- Footer section -->

    <!-- Scripts section -->
</body>
</html>
