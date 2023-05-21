<?php include("../config/constants.php") ?>
<html>

<head>
    <title>Login - Food Order System</title>
    <link rel="stylesheet" href="../css/admin.css">
</head>

<body>
    <div class="login">
        <h1 class="text-center">Login</h1>
        <br><br>

        <?php 
            if(isset($_SESSION['login'])){
                echo $_SESSION['login'];
                unset($_SESSION['login']);
            }
            if(isset($_SESSION['no-login-message'])){
                echo $_SESSION['no-login-message'];
                unset($_SESSION['no-login-message']);
            }
        
        ?>
        <br><br>
        <!-- Login Form Starts Here -->
        <form action="" method="POST" class="text-center">
            <label for="username">Username:</label>
            <input type="text" name="username" id="username" placeholder="Enter username">
            <br><br>
            <label for="password">Password:</label>
            <input type="password" name="password" placeholder="Enter Password">
            <br><br>
            <input type="submit" name="submit" value="Login" class="btn-primary">
            <br><br>
        </form>

        <!-- Login Form Ends Here -->

        <p class="text-center">Created By <a href="www.adrienkjn.com">Adrien Kouyoumjian</a></p>
    </div>
</body>
</html>

<?php 

// Check whether he Submit Button is clicked or not
if(isset($_POST['submit'])){
    // Process for Login
    // 1. Get the Data from Login Form
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    // 2. SQL to Check whether the user with username and password exists
    $sql = "SELECT * FROM tbl_admin WHERE username='$username' AND password ='$password'";

    // 3. Execute the Query
    $res = mysqli_query($conn, $sql);
    

    //4. Count Rows to check whether the user exists or not
    $count = mysqli_num_rows($res);
    if($count==1){
        // User Available and Login Success
        $_SESSION['login'] = "<div class='success'>Login Successfull</div>";
        $_SESSION['user'] = $username; // Check whether the user is Logged in or Not and Logout will unset it
        // Redirect to Home Page/Dashboard
        header('Location:'.SITEURL.'admin/');

    }else {
        // User not Available and Login Failed
        $_SESSION['login'] = "<div class='error text-center'>Username or password did not match</div>";
        // Redirect to Home Page/Dashboard
        header('Location:'.SITEURL.'admin/login.php');
    }
}


?>