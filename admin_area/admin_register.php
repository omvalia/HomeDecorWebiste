<?php
include('../includes/connect.php');
include('../functions/common_function.php');
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
    <div class="user_regis_page">
        <h2 class="user_regis_head">Admin Registeration</h2>
                <form action="" method="post">
                    <div>
                        <label for="username" class="form-label">Username</label><br>
                        <input type="text" class="user_regis_field" name="admin_name" id="username" placeholder="Enter your username" required="required" class="form-contol">
                    </div>

                    <div>
                        <label for="email" class="form-label">Email</label><br>
                        <input type="text" class="user_regis_field" name="admin_email" id="email" placeholder="Enter your email" required="required" class="form-contol">
                    </div>

                    <div>
                        <label for="password" class="form-label">Password</label><br>
                        <input type="password" class="user_regis_field" name="admin_password" id="password" placeholder="Enter your password" required="required" class="form-contol">
                    </div>

                    <div>
                        <label for="confirm_password" class="form-label">Confirm Password</label><br>
                        <input type="password "class="user_regis_field" name="admin_confirm_password" id="confirm_password" placeholder="Enter your Confirm Password" required="required" class="form-contol">
                    </div>

                    <div>
                        <input type="submit" name="admin_register" value="Register"  class="user_regis_btn">
                        <p class="text-center">Don't you have an account? <a href="admin_login.php" class="text-danger text-decoration-none">Login</a></p>
                    </div>
                </form>
    </div>
</body>
</html>
<!--php code-->
<?php
if(isset($_POST['admin_register'])){
    $admin_name=$_POST['admin_name'];
    $admin_email=$_POST['admin_email'];
    $admin_password=$_POST['admin_password'];
    $hash_password=password_hash($admin_password,PASSWORD_DEFAULT);
    $admin_confirm_password=$_POST['admin_confirm_password'];

    //select_query
    $select_query="select * from `admin_table` where admin_name='$admin_name' or admin_email='$admin_email'";
    $result=mysqli_query($con,$select_query);
    $rows_count=mysqli_num_rows($result);
    if($rows_count>0){
        echo "<script>alert('Username or email already exists')</script>";
    }
    elseif($admin_password!=$admin_confirm_password){
        echo"<script>alert('Password does not match')</script>";
    }
    else{
        //insert_query
        $insert_query="insert into `admin_table` (admin_name,admin_email,admin_password) values('$admin_name','$admin_email','$hash_password')";
        $sql_execute=mysqli_query($con,$insert_query);
        if($sql_execute){
            echo"<script>alert('Admin registered successfully')</script>";
            echo"<script>window.open('admin_login.php','_self')</script>";
        }
        else{
            die(mysqli_error($con));
        }
    }
}
?>