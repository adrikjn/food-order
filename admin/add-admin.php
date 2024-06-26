<?php include('partials/menu.php') ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1>
        <br> <br>

        <?php 
            if(isset($_SESSION['add'])){ // Checking whether the Session is Set or Not
                echo $_SESSION['add']; // Displaying Session Message if Set
                unset($_SESSION['add']); // Remove Session Message
            }
        ?>
        <form action="" method="post">
            <table class="tbl-30">
                <tr>
                    <td>Full Name:</td>
                    <td>
                        <input type="text" name="full_name" placeholder="Enter Your Name">
                    </td>
                </tr>
                <tr>
                    <td>Username: </td>
                    <td>
                        <input type="text" name="username" placeholder="Your Username">
                    </td>
                </tr>
                <tr>
                    <td>Password:</td>
                    <td>
                        <input type="password" name="password" placeholder="Your Password">
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php include('partials/footer.php') ?>

<?php

// Process the value from Form and Save it in database
// Check whether the button submit is clicked or not
if (isset($_POST['submit'])) {
    // Button Clicked
    // echo "Button Clicked";

    //1. Get the Data from form
    $full_name = $_POST['full_name'];
    $username = $_POST['username'];
    $password = md5($_POST['password']); // Password Encryption with MD5

    //2. SQL Query to Save the data into database
    $sql = "INSERT INTO tbl_admin SET
        full_name = '$full_name',
        username= '$username',
        password = '$password'
    ";

    //3. Executing Query and Saving Data into Database
    $res = mysqli_query($conn, $sql) or die(mysqli_error());

    //4. Chech whether the (Query is Executed) data is inserted or not and display appropriate message
    if($res==true){
        // Data inserted
        // echo "Data Inserted";
        // Create a Session Variable to Display Message
        $_SESSION['add'] = "<div class='success'>Admin Added Successfully</div>";
        // Redirect Page to Manage Admin
        header('Location:' . SITEURL. 'admin/manage-admin.php');
    }else {
        // Failed to insert Data
        // echo "Failed to Insrt Data";
        // Create a Session Variable to Display Message
        $_SESSION['add'] = "<div class='error'>Failed to Add Admin</div>";
        // Redirect Page to Add Admin
        header('Location:' . SITEURL. 'admin/add-admin.php');
    }
} else {
    // Button not clicked
}


?>

