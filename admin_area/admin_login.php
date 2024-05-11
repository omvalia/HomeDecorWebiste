<?php
include('../includes/connect.php');
include('../functions/common_function.php');
@session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Registeration</title>
     <!--Bootstrap CSS link -->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
     <!--Bootstrap Modal Link-->
     <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
     <!--Font Awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!--CSS Link-->
    <link rel="stylesheet" href="../style.css">
    <style>
        body{
            overflow:hidden;
        }
    </style>
</head>
<body>
    <div class="user_login_page" style="display: flex;
    justify-content: center; align-items: center; align-content:center;
    flex-direction: column; width: 100%;">
        <h2 class="text-center user-head" style="margin-bottom: 100px;margin-top: 100px">Admin Login</h2>
        <div style="width: 40%">
                <form action="" method="post">
                    <div>
                        <label for="username" class="form-label">Username</label><br>
                        <input type="text" class="user_login_field" name="admin_name" id="username" placeholder="Enter your username" required="required" class="form-contol">
                    </div>

                    <div>
                        <label for="password" class="form-label">Password</label><br>
                        <input type="text" class="user_login_field" name="admin_password" id="password" placeholder="Enter your password" required="required" class="form-contol">
                    </div>

                    <div>
                        <input type="submit" name="admin_login" value="Login" class="user_login_btn">
                        <p class="text-center">Do you already have an account? <a href="admin_register.php" class="text-danger text-decoration-none">Register</a></p>
                    </div>
                </form>
        </div>
    </div>
</body>
</html>

<?php
if(isset($_POST['admin_login'])){
    $admin_name=$_POST['admin_name'];
    $admin_password=$_POST['admin_password'];

    $select_query="select * from `admin_table` where admin_name='$admin_name'";
    $result=mysqli_query($con,$select_query);
    $row_count=mysqli_num_rows($result);
    $row_data=mysqli_fetch_assoc($result);

    if($row_count>0){
        $_SESSION['admin_name']=$admin_name;
        if(password_verify($admin_password,$row_data['admin_password'])){
            //echo"<script>alert('Login Successful')</script>";
            if($row_count==1){
                $_SESSION['username']=$user_username;
                echo"<script>alert('Login Successful')</script>";
                echo"<script>window.open('index.php','_self')</script>";
            }
    else{
        echo"<script>alert('Invalid credientials')</script>";
    }
}
}
}
?>